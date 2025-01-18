<?= $this->extend('theme/app') ?>

<?= $this->section('header') ?>
<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>

<div class="page-heading">
    <h5>Ubah Data Departemen</h5>
</div>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="row">
    <div class="col-12 col-lg-12">
        <div class="card">
            <div class="card-body">
            <form action="/departemen/update/<?= $departemen['id']; ?>" enctype="multipart/form-data" method="post">
                    <div class="form-group">
                        <label>Kode Departemen</label>
                        <input type="text" name="kode_departemen" class="form-control"  value="<?= $departemen['kode_departemen']; ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Nama Departemen</label>
                        <input type="text" name="nama" class="form-control" value="<?= $departemen['nama']; ?>"  required>
                    </div>

                    <div class="form-group">
                        <label>Kepala Departemen</label>
                        <input type="text" name="kepala_departemen" class="form-control" value="<?= $departemen['kepala_departemen']; ?>"  required>
                    </div>
                    
                    <div class="text-end">
                        <button type="submit" class="btn btn-success mr-2">Simpan</button>
                        <a href="<?= base_url('/departemen'); ?>" class="btn btn-danger">Batal</a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
<!-- css -->
<?= $this->section('styles') ?>
<link rel="stylesheet" href="/assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" crossorigin href="/assets/compiled/css/table-datatable-jquery.css">
<?= $this->endSection() ?>

<!-- js -->
<?= $this->section('javascript') ?>
<script src="/assets/extensions/jquery/jquery.min.js"></script>
<script src="/assets/extensions/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="/assets/extensions/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        $('#table1').DataTable();
    });
</script>
<?= $this->endSection() ?>