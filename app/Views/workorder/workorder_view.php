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
            <a href="<?= base_url(); ?>workorder/add"><button class="btn btn-primary"><i class="nav-icon bi bi-plus me-2" aria-hidden="true"></i>Tambah</button></a>
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6 col-md-12">
                <table id="workorder" class="display table table-bordered" cellspacing="0" width="100%">
                  <thead>
                      <tr>
                          <th>Nomor Work Order</th>
                          <th>Nama Produk</th>
                          <th>Jumlah(qty)</th>
                          <th>Batas Waktu</th>
                          <th>Status</th>
                          <th>Operator</th>
                          <th>Waktu Dibuat</th>
                          <th>Waktu Diperbaharui</th>
                          <th>Aksi</th>
                      </tr>
                  </thead>
                  <tbody>
                    <?php foreach($data as $row): ?>
                      <tr>
                        <td><?= $row['workorder_number']; ?></td>
                        <td><?= $row['product_name']; ?></td>
                        <td><?= $row['quantity']; ?></td>
                        <td><?= $row['deadline']; ?></td>
                        <td><?= $row['status']; ?></td>
                        <td><?= $row['name']; ?></td>
                        <td><?= date('d-m-Y H:i:s', strtotime($row['created_at'])); ?></td>
                        <td><?= date('d-m-Y H:i:s', strtotime($row['updated_at'])); ?></td>
                        <td class="text-right py-0 align-middle">
                        <div class="d-flex gap-2 p-2">
                          <a href="<?= base_url('workorder/detail/' . $row['id']); ?>"><button class="btn btn-primary"><i class="nav-icon bi bi-eye-fill" aria-hidden="true"></i></button></a>
                          <a href="<?= base_url('workorder/edit/' . $row['id']); ?>"><button class="btn btn-warning"><i class="nav-icon bi bi-pencil-fill" aria-hidden="true"></i></button></a>
                          <button type="button" class="btn btn-danger btn-delete" data-bs-toggle="modal" data-bs-target="#confirmDialog" data-id="<?= $row['id']; ?>" data-name="<?= $row['workorder_number']; ?>"><i class="nav-icon bi bi-trash3-fill" aria-hidden="true"></i></button>
                        </div>
                      </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
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
      </div>


<!-- Modal -->
<div class="modal fade" id="confirmDialog" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Konfirmasi Hapus Data</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h6 class="h6">Apakah anda yakin akan menghapus data <strong id="woNumber"></strong>?</h6>
        <p>Data akan dihapus dari sistem.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
        <button id="confirmDelete" type="button" class="btn btn-danger">Delete</button>
      </div>
    </div>
  </div>
</div>
  
<script>

    let deleteId;

    $('.btn-delete').click(function(){
      deleteId = $(this).data('id')
      let woNumber = $(this).data('name');
      $('#woNumber').text(woNumber);
    });

    $('#confirmDelete').click(function(){
        $.ajax({
            url: "<?= base_url('workorder/delete'); ?>/" + deleteId,
            type: "POST",
            data: { <?= csrf_token() ?>: "<?= csrf_hash() ?>" }, // CSRF protection
            success: function(response) {
                // alert("Data berhasil dihapus!");
                location.reload(); // Refresh halaman setelah hapus
            },
            error: function(xhr) {
                alert("Terjadi kesalahan: " + xhr.responseText);
            }
        });
    });
</script>
<?= view('footer_view'); ?>  