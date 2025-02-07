<?= $this->extend('theme/app') ?>

<?= $this->section('header') ?>
<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>

<div class="page-heading">
    <h5>Data User</h5>
</div>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="row">
    <div class="col-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="text-end">
                    <a href="user/create/" class="btn btn-primary">Tambah data</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="table1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Usermame</th>
                                <th>Email</th>
                                <th>Level</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($user)) : ?>
                                <?php $no = 1; ?>
                                <?php foreach ($user as $row) : ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $row['nama']; ?></td>
                                        <td><?= $row['username']; ?></td>
                                        <td><?= $row['email']; ?></td>
                                        <td>
                                            <?php
                                            if ($row['level_user'] == 1) {
                                                echo '<span class="badge bg-primary">Admin</span>';
                                            } elseif ($row['level_user'] == 2) {
                                                echo '<span class="badge bg-success">Kepala Departemen</span>';
                                            } elseif ($row['level_user'] == 3) {
                                                echo '<span class="badge bg-success">Kepala Dinas</span>';
                                            }elseif ($row['level_user'] == 4) {
                                                echo '<span class="badge bg-warning">User</span>';
                                            } else {
                                                echo '<span class="badge bg-secondary">Unknown</span>';
                                            }
                                            ?>
                                        </td>

                                        <td>
                                            <a href="/user/edit/<?= $row['id']; ?>"
                                                class="btn btn-sm btn-success">Edit</a>
                                            <a href="/user/delete/<?= $row['id']; ?>"
                                                class="btn btn-sm btn-danger"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                Delete
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td class="text-center">...</td>
                                    <td class="text-center">...</td>
                                    <td class="text-center">...</td>
                                    <td class="text-center">...</td>
                                    <td class="text-center">...</td>
                                    <td class="text-center">...</td>
                                </tr>
                            <?php endif; ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
<!-- css -->
<?= $this->section('styles') ?>
<link rel="stylesheet" href="assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" crossorigin href="./assets/compiled/css/table-datatable-jquery.css">
<?= $this->endSection() ?>

<!-- js -->
<?= $this->section('javascript') ?>
<script src="assets/extensions/jquery/jquery.min.js"></script>
<script src="assets/extensions/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="assets/extensions/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        $('#table1').DataTable();
    });
</script>
<?= $this->endSection() ?>