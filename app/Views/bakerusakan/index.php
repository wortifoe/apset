<?= $this->extend('theme/app') ?>

<?= $this->section('header') ?>
<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>

<div class="page-heading">
    <h5>Berita Acara Kerusakan Barang</h5>
</div>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="row">
    <div class="col-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="text-end">
                    <?php if (session('level_user') == 1) { ?>
                        <a href="bakerusakan/create/" class="btn btn-primary">Tambah data</a>
                    <?php } ?>
                </div>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="table1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Barang</th>
                                <th>Merk</th>
                                <th>Tanggal</th>
                                <th>Diajukan</th>
                                <th>Diketahui</th>
                                <th>disetujui</th>
                                <th>Lampiran</th>
                                <th>Verifikasi Kadep</th>
                                <th>Persetujuan Kadis</th>

                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($bakerusakan)) : ?>
                                <?php $no = 1; ?>
                                <?php foreach ($bakerusakan as $row) : ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $row['kode_barang']; ?></td>
                                        <td><?= $row['merk']; ?></td>
                                        <td><?= $row['tanggal']; ?></td>
                                        <td><?= $row['diajukan']; ?></td>
                                        <td><?= $row['diketahui']; ?></td>
                                        <td><?= $row['disetujui']; ?></td>
                                        <td><?= !empty($row['lampiran']) ? '<img src="' . base_url('uploads/lampiran/' . $row['lampiran']) . '" alt="Gambar" width="100" height="100">' : '-' ?></td>
                                        <td>
                                            <?php if (session('level_user') == 2) { ?>
                                                <!-- Dropdown Select yang selalu muncul -->
                                                <select class="form-select verifikasi-kadep" data-id="<?= $row['id']; ?>">
                                                    <?php if ($row['status_verifikasi'] === null || $row['status_verifikasi'] == 'menunggu') { ?>
                                                        <option value="menunggu" selected>Menunggu</option>
                                                    <?php } ?>
                                                    <option value="disetujui" <?= ($row['status_verifikasi'] == 'disetujui') ? 'selected' : ''; ?>>Disetujui</option>
                                                    <option value="ditolak" <?= ($row['status_verifikasi'] == 'ditolak') ? 'selected' : ''; ?>>Ditolak</option>
                                                </select>
                                            <?php } else { ?>
                                                <!-- Tampilan teks untuk user selain Kadep -->
                                                <?php if ($row['status_verifikasi'] == 'disetujui') { ?>
                                                    <span class="text-success">Disetujui</span>
                                                <?php } elseif ($row['status_verifikasi'] == 'ditolak') { ?>
                                                    <span class="text-danger">Ditolak</span>
                                                <?php } else { ?>
                                                    <span class="text-warning">Menunggu</span>
                                                <?php } ?>
                                            <?php } ?>
                                        </td>

                                        <td>
                                            <?php if (session('level_user') == 3) { ?>
                                                <!-- Dropdown Select yang selalu muncul -->
                                                <select class="form-select verifikasi-kadis" data-id="<?= $row['id']; ?>">
                                                    <?php if ($row['status_persetujuan'] === null || $row['status_persetujuan'] == 'menunggu') { ?>
                                                        <option value="menunggu" selected>Menunggu</option>
                                                    <?php } ?>
                                                    <option value="disetujui" <?= ($row['status_persetujuan'] == 'disetujui') ? 'selected' : ''; ?>>Disetujui</option>
                                                    <option value="ditolak" <?= ($row['status_persetujuan'] == 'ditolak') ? 'selected' : ''; ?>>Ditolak</option>
                                                </select>
                                            <?php } else { ?>
                                                <!-- Tampilan teks untuk user selain Kadep -->
                                                <?php if ($row['status_persetujuan'] == 'disetujui') { ?>
                                                    <span class="text-success">Disetujui</span>
                                                <?php } elseif ($row['status_persetujuan'] == 'ditolak') { ?>
                                                    <span class="text-danger">Ditolak</span>
                                                <?php } else { ?>
                                                    <span class="text-warning">Menunggu</span>
                                                <?php } ?>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <?php if (session('level_user') == 1): // Admin 
                                            ?>

                                                <?php if ($row['status_verifikasi'] == 'disetujui' && $row['status_persetujuan'] == 'disetujui'): ?>
                                                    <a href="/bakerusakan/cetak/<?= $row['id']; ?>" class="btn btn-sm btn-secondary" target="_blank">Cetak</a>
                                                <?php else: ?>
                                                    <a href="/bakerusakan/edit/<?= $row['id']; ?>" class="btn btn-sm btn-success">Edit</a>
                                                <?php endif; ?>
                                                <a href="/bakerusakan/delete/<?= $row['id']; ?>" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</a>
                                            <?php else: // Kadep/Kadis 
                                            ?>
                                                <?php if ($row['status_verifikasi'] == 'disetujui' && $row['status_persetujuan'] == 'disetujui'): ?>
                                                    <a href="/bakerusakan/cetak/<?= $row['id']; ?>" class="btn btn-sm btn-secondary" target="_blank">Cetak</a>
                                                <?php else: ?>
                                                    <p class="text-center">...</p>
                                                <?php endif; ?>
                                            <?php endif; ?>
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
    $('#table1').DataTable({
        language: {
            emptyTable: "Tidak ada data yang tersedia di tabel"
        }
    });

    // DOM Listener untuk Select Verifikasi Kadep
    $(document).on('change', '.verifikasi-kadep', function() {
        var id = $(this).data('id');
        var status = $(this).val();
        var url = '';

        // Tentukan URL berdasarkan status yang dipilih
        if (status === 'disetujui') {
            url = 'bakerusakan/setujuikadep';
        } else if (status === 'ditolak') {
            url = 'bakerusakan/tolakkadep';
        }

        // Kirim data dengan AJAX
        if (url !== '') {
            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    id: id
                },
                success: function(response) {
                    if (response.success) {
                        location.reload(); // Refresh halaman untuk melihat perubahan
                    } else {
                        alert("Gagal mengubah status!");
                    }
                },
                error: function() {
                    alert("Terjadi kesalahan saat mengubah status!");
                }
            });
        }
    });

    $(document).on('change', '.verifikasi-kadis', function() {
        var id = $(this).data('id');
        var status = $(this).val();
        var url = '';

        // Tentukan URL berdasarkan status yang dipilih
        if (status === 'disetujui') {
            url = 'bakerusakan/setujuikadis';
        } else if (status === 'ditolak') {
            url = 'bakerusakan/tolakkadis';
        }

        // Kirim data dengan AJAX
        if (url !== '') {
            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    id: id
                },
                success: function(response) {
                    if (response.success) {
                        location.reload(); // Refresh halaman untuk melihat perubahan
                    } else {
                        alert("Gagal mengubah status!");
                    }
                },
                error: function() {
                    alert("Terjadi kesalahan saat mengubah status!");
                }
            });
        }
    });
</script>
<?= $this->endSection() ?>