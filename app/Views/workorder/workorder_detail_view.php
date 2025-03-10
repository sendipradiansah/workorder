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
              <!-- <div class="col-sm-6"><h3 class="mb-0"><strong><?= $data['workorder_number']; ?></strong></h3></div> -->
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
        <?php
        $badgeColor = '';
        if($data['status'] == 'Pending'){
          $badgeColor = 'badge text-bg-warning';
        }if($data['status'] == 'In Progress'){
          $badgeColor = 'badge text-bg-primary';
        }if($data['status'] == 'Completed'){
          $badgeColor = 'badge text-bg-success';
        }if($data['status'] == 'Canceled'){
          $badgeColor = 'badge text-bg-danger';
        }
        ?>
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
                  <div class="card-header"><div class="card-title">Detail Nomor <?= $data['workorder_number']; ?></div></div>
                  <!--end::Header-->
                  <!--begin::Form-->  
                  <?php
                      $validation = session()->getFlashdata('validation') ?? \Config\Services::validation();
                      // validation_errors()
                  ?>
                  <!-- <form action="<?= base_url('workorder/update/'. $data['id']);?>" method="POST"> -->
                  <!-- <?= csrf_field(); ?> -->
                    <!--begin::Body-->
                    <div class="card-body">
                      <div class="row mb-3">
                        <label for="product_name" class="col-sm-2 col-form-label">Nama Produk</label>
                        <div class="col-sm-10">
                          <div class="col-form-label">: <?= $data['product_name']; ?></div>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label for="quantity" class="col-sm-2 col-form-label">Jumlah</label>
                        <div class="col-sm-10">
                          <div class="col-form-label">: <?= $data['quantity']; ?></div>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label for="deadline" class="col-sm-2 col-form-label">Batas Waktu</label>
                        <div class="col-sm-10">
                          <div class="col-form-label">: <?= $data['deadline']; ?></div>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label for="operator" class="col-sm-2 col-form-label">Operator</label>
                        <div class="col-sm-10">
                          <div class="col-form-label">: <?= $data['name']; ?></div>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label for="operator" class="col-sm-2 col-form-label">Status</label>
                        <div class="col-sm-10">
                          <div class="col-form-label">: <span class="<?=  $badgeColor; ?>"><?= $data['status']; ?></span></div>
                        </div>
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
                    <!-- <div class="card-footer">
                      <button type="submit" class="btn btn-warning">Submit</button>
                      <button type="submit" class="btn float-end" onClick="goBack(event);">Cancel</button>
                    </div> -->
                    <!--end::Footer-->
                  <!-- </form> -->
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
        });
        function goBack(event) {
            event.preventDefault(); // Prevent form submission
            window.history.back(); // Go to previous page
        }
      </script>
<?= view('footer_view'); ?>  