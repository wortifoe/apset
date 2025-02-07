<?= $this->extend('theme/app') ?>

<?= $this->section('header') ?>
<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>

<div class="page-heading">
    <h5>Tambah Berita Acara</h5>
</div>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="row">
    <div class="col-12 col-lg-12">
        <div class="card">
            <div class="card-body">
                <form class="forms-sample" action="/bakerusakan/store" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Nama Barang</label>
                        <select name="id_aset" class="form-control" required>

                            <?php foreach ($aset as $as) : ?>
                                <option value="<?= $as['id']; ?>"><?= $as['kode_barang']; ?> - <?= $as['merk']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tanggal</label>
                        <input type="date" name="tanggal" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Diajukan</label>
                        <select class="form-control" name="diajukan">
                            <option value="" disabled>Pilih Karyawan</option>
                            <?php foreach ($karyawan as $row): ?>
                                <option value="<?= $row['id'] ?>"><?= $row['nama'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Diketahui</label>
                        <select class="form-control" name="diketahui">
                            <option value="" disabled>Pilih Karyawan</option>
                            <?php foreach ($karyawan as $row): ?>
                                <option value="<?= $row['id'] ?>"><?= $row['nama'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Disetujui</label>
                        <select class="form-control" name="disetujui">
                            <option value="" disabled>Pilih Karyawan</option>
                            <?php foreach ($karyawan as $row): ?>
                                <option value="<?= $row['id'] ?>"><?= $row['nama'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Lampiran</label> <br>
                        <div id="previewContainer" style="display: none;">
                            <img id="previewImage" src="" alt="Pratinjau Gambar" width="100" height="100">
                        </div>
                        <label><small>Upload dalam Format JPG dan PNG</small></label> <br>

                        <input type="file" name="lampiran" id="fileUpload" class="form-control-file" accept=".jpg, .jpeg, .png">
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-success mr-2">Simpan</button>
                        <a href="<?= base_url('/bakerusakan'); ?>" class="btn btn-danger">Batal</a>
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
<script>

    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                document.getElementById('previewImage').setAttribute('src', e.target.result);
                document.getElementById('previewContainer').style.display = 'block'; // Tampilkan pratinjau kontainer
            }

            reader.readAsDataURL(input.files[0]); // Membaca data URL gambar
        }
    }

    // Panggil fungsi previewImage() ketika pengguna memilih gambar baru
    document.getElementById('fileUpload').addEventListener('change', function() {
        previewImage(this);
    });
</script>

<?= $this->endSection() ?>