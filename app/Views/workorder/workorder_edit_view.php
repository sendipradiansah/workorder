<?= view('header_view'); ?>
<!--end::Sidebar-->
      <!--begin::App Main-->
      <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6"><h3 class="mb-0">Work Order</h3></div>
              <!-- <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol>
              </div> -->
            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content Header-->
        <!--begin::App Content-->
        <div class="app-content">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6 col-md-12">
                <!--begin::Horizontal Form-->
                <div class="card card-warning card-outline mb-4">
                  <!--begin::Header-->
                  <div class="card-header"><div class="card-title">Form Ubah Work Order</div></div>
                  <!--end::Header-->
                  <!--begin::Form-->  
                  <?php
                      $validation = session()->getFlashdata('validation') ?? \Config\Services::validation();
                      // validation_errors()
                  ?>
                  <form action="<?= base_url('workorder/update/'. $data['id']);?>" method="POST">
                  <?= csrf_field(); ?>
                    <!--begin::Body-->
                    <div class="card-body">
                      <div class="row mb-3">
                        <label for="product_name" class="col-sm-2 col-form-label">Nama Produk</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control <?= ($validation->hasError('product_name')) ? 'is-invalid' : ''; ?>" id="product_name" name="product_name" value="<?= old('product_name', $data['product_name']); ?>"/>   
                          <div class="invalid-feedback"><?= $validation->getError('product_name') ?></div>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label for="quantity" class="col-sm-2 col-form-label">Jumlah</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control <?= ($validation->hasError('quantity')) ? 'is-invalid' : ''; ?>" id="quantity" name="quantity" value="<?= old('quantity', $data['quantity']); ?>"/>
                          <div class="invalid-feedback"><?= $validation->getError('quantity'); ?></div>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label for="deadline" class="col-sm-2 col-form-label">Batas Waktu</label>
                        <div class="col-sm-10">
                          <input type="date" class="form-control <?= ($validation->hasError('deadline')) ? 'is-invalid' : ''; ?>" id="deadline" name="deadline" value="<?= old('deadline', $data['deadline']); ?>"/>
                          <div class="invalid-feedback"><?= $validation->getError('deadline'); ?></div>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label for="operator" class="col-sm-2 col-form-label">Operator</label>
                        <div class="col-sm-10">
                          <select class="form-select <?= ($validation->hasError('operator')) ? 'is-invalid' : ''; ?>" id="operator" name="operator">
                            <option selected disabled value="">-- Pilih Operator --</option>
                          </select>
                          <div class="invalid-feedback"><?= $validation->getError('operator'); ?></div>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label for="status" class="col-sm-2 col-form-label">Status</label>
                        <div class="col-sm-10">
                          <select class="form-select" id="status" name="status">
                            <option selected disabled value="">-- Pilih Status --</option>
                            <option value="Pending" <?= ($data['status'] == 'Pending') ? 'selected' : ''; ?>>Pending</option>
                            <option value="In Progress" <?= ($data['status'] == 'In Progress') ? 'selected' : ''; ?>>In Progress</option>
                            <option value="Completed" <?= ($data['status'] == 'Completed') ? 'selected' : ''; ?>>Completed</option>
                            <option value="Canceled" <?= ($data['status'] == 'Canceled') ? 'selected' : ''; ?>>Canceled</option>
                          </select>
                        </div>
                        <div class="invalid-feedback"><?= $validation->getError('operator'); ?></div>
                      </div>
                      <!-- <div class="row mb-3">
                        <div class="col-sm-10 offset-sm-2">
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="gridCheck1" />
                            <label class="form-check-label" for="gridCheck1">
                              Example checkbox
                            </label>
                          </div>
                        </div>
                      </div> -->
                    </div>
                    <!--end::Body-->
                    <!--begin::Footer-->
                    <div class="card-footer">
                      <button type="submit" class="btn btn-warning">Submit</button>
                      <button type="submit" class="btn float-end" onClick="goBack(event);">Cancel</button>
                    </div>
                    <!--end::Footer-->
                  </form>
                  <!--end::Form-->
                </div>
                <!--end::Horizontal Form-->
              </div>
            </div>
            <!--end::Row-->
            <!--begin::Row-->
            <!-- /.row (main row) -->
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content-->
      </main>
      <!--end::App Main-->
      <script>
        $(document).ready(function(){
          $('#workorder').DataTable();
          getListOperator();
        });
          function getListOperator(){

            let oldOperator = "<?= old('operator', $data['operator']); ?>"
            $.ajax({
                url: '<?= base_url(); ?>user/get_list_operator',
                success: function(response){
                    console.log(response);
                    $('#operator').empty();
                    $('#operator').append(`<option value="">-- Pilih Operator --</option>`);

                    for(let i=0; i<response.length; i++){
                        let selected = (oldOperator == response[i].id) ? 'selected' : '';
                        $('#operator').append(`<option value="${response[i].id}" ${selected}>${response[i].id} - ${response[i].name}</option>`);
                    }
                },
                async: false,
                error: function(e){
                    console.log(e);
                }
            });
        }
        function goBack(event) {
            event.preventDefault(); // Prevent form submission
            window.history.back(); // Go to previous page
        }
      </script>
<?= view('footer_view'); ?>  