<?= $this->extend('theme/app') ?>

<?= $this->section('header') ?>
<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>

<div class="page-heading">
    <h5>Laporan Barang Layak Pakai</h5>
</div>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="row">
    <div class="col-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="text-end">
                    <button class="btn btn-primary dropdown-toggle me-1" type="button"
                        id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        Cetak Data
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="/laporan/cetaklayak?jenis=bergerak" target="_blank">Aset Bergerak</a>
                        <a class="dropdown-item" href="/laporan/cetaklayak?jenis=non_bergerak" target="_blank">Aset Non Bergerak</a>
                        <a class="dropdown-item" href="/laporan/cetaklayak?jenis=semua" target="_blank">Cetak Semua Data</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="table1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Barang</th> 
                                <th>Nama Barang</th>
                                <th>Merk</th>
                                <th>Jumlah</th>
                                <th>Penanggung Jawab</th>
                                <th>Jenis Barang</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($aset)) : ?>
                                <?php $no = 1; ?>
                                <?php foreach ($aset as $row) : ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $row['kode_barang']; ?></td> 
                                        <td><?= $row['nama_barang']; ?></td>
                                        <td><?= $row['merk']; ?></td>
                                        <td><?= $row['jumlah']; ?></td>
                                     
                                        <td><?= $row['penanggung_jawab']; ?></td>
                                        <td>
                                            <?php
                                            if ($row['jenis'] == "bergerak") {
                                                echo '<span class="badge bg-primary">Aset Bergerak</span>';
                                            } elseif ($row['jenis'] == "non_bergerak") {
                                                echo '<span class="badge bg-success">Aset Non Bergerak</span>';
                                            } else {
                                                echo '<span class="badge bg-secondary">Unknown</span>';
                                            }
                                            ?>
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
<link rel="stylesheet" href="/assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" crossorigin href="/assets/compiled/css/table-datatable-jquery.css">
<?= $this->endSection() ?>

<!-- js -->
<?= $this->section('javascript') ?>
<script src="/assets/extensions/jquery/jquery.min.js"></script>
<script src="/assets/extensions/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="/assets/extensions/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
<script>
    $('#table1').DataTable({
        language: {
            emptyTable: "Tidak ada data yang tersedia di tabel"
        }
    });
</script>
<?= $this->endSection() ?>