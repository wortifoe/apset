<?= $this->extend('theme/app') ?>

<?= $this->section('header') ?>
<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>

<div class="page-heading">
    <h5>Ubah Data User</h5>
</div>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="row">
    <div class="col-12 col-lg-12">
        <div class="card">
            <div class="card-body">
            <form action="/user/update/<?= $user['id']; ?>" enctype="multipart/form-data" method="post">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="nama" class="form-control"  value="<?= $user['nama']; ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" value="<?= $user['username']; ?>"  required>
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value="<?= $user['email']; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="level_user">Kategori User</label>
                        <select name="level_user" class="form-control" required>
                            <option value="1" <?= ($user['level_user'] == '1') ? 'selected' : ''; ?>>Admin</option>
                            <option value="2" <?= ($user['level_user'] == '2') ? 'selected' : ''; ?>>Kepala Departemen</option>
                            <option value="3" <?= ($user['level_user'] == '3') ? 'selected' : ''; ?>>Pengguna</option>
                        </select>
                    </div>

            
                    <div class="text-end">
                        <button type="submit" class="btn btn-success mr-2">Simpan</button>
                        <a href="<?= base_url('/user'); ?>" class="btn btn-danger">Batal</a>
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