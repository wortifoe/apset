<?= $this->extend('theme/app') ?>

<?= $this->section('header') ?>
<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>

<div class="page-heading">
    <h5>Data Penempatan</h5>
</div>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="row">
    <div class="col-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="text-end">
                    <a href="penempatan/create/" class="btn btn-primary">Tambah data</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="table1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Lokasi</th>
                                <th>Alamat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($penempatan)) : ?>
                                <?php $no = 1; ?>
                                <?php foreach ($penempatan as $row) : ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $row['lokasi']; ?></td>
                                        <td><?= $row['alamat']; ?></td>
                                        <td>
                                            <a href="/penempatan/edit/<?= $row['id']; ?>"
                                                class="btn btn-sm btn-success">Edit</a>
                                            <a href="/penempatan/delete/<?= $row['id']; ?>"
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
   $('#table1').DataTable({
        language: {
            emptyTable: "Tidak ada data yang tersedia di tabel"
        }
    });
</script>
<?= $this->endSection() ?>