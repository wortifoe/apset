<?= $this->extend('theme/app') ?>

<?= $this->section('header') ?>
<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>

<div class="page-heading">
    <h5>Ubah Data Karyawan</h5>
</div>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="row">
    <div class="col-12 col-lg-12">
        <div class="card">
            <div class="card-body">
                <form action="/karyawan/update/<?= $karyawan['id']; ?>" enctype="multipart/form-data" method="post">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="nama" class="form-control" value="<?= $karyawan['nama']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>NIP</label>
                        <input type="text" name="nip" class="form-control" value="<?= $karyawan['nip']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Jabatan</label>
                        <input type="text" name="jabatan" class="form-control" value="<?= $karyawan['jabatan']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="kategori_pegawai">Kategori Pegawai</label>
                        <select name="kategori_pegawai" class="form-control" required>
                            <option value="PNS" <?= ($karyawan['kategori_pegawai'] == 'PNS') ? 'selected' : ''; ?>>PNS</option>
                            <option value="PTT" <?= ($karyawan['kategori_pegawai'] == 'PTT') ? 'selected' : ''; ?>>PTT</option>
                            <option value="Tenaga Ahli" <?= ($karyawan['kategori_pegawai'] == 'Tenaga Ahli') ? 'selected' : ''; ?>>
                                Tenaga Ahli</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>No Rek</label>
                        <input type="text" name="norek" class="form-control" value="<?= $karyawan['norek']; ?>" required>
                    </div>
                    <div class="form-group" id="uploadForm">
                        <label>Foto</label> <br>
                        <?php if (!empty($karyawan['file'])) : ?>
                            <img id="previewImage" src="<?= base_url('uploads/file/' . $karyawan['file']); ?>" alt="Gambar" width="100" height="100">
                            <br>
                        <?php endif; ?>
                        <label><small>Input dalam Format JPG</small></label> <br>
                        <input type="file" id="fileInput" name="file" class="form-control-file" accept=".jpg, .jpeg, .png">
                    </div>
                    <div class="form-group">
                        <label>Keterangan</label>
                        <input type="text" name="keterangan" class="form-control" value="<?= $karyawan['keterangan']; ?>" required>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-success mr-2">Simpan</button>
                        <a href="<?= base_url('/karyawan'); ?>" class="btn btn-danger">Batal</a>
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
        function toggleUploadForm(element) {
            var uploadForm = document.getElementById('uploadForm');
            if (element.value === 'Ya') {
                uploadForm.style.display = 'block';
            } else {
                uploadForm.style.display = 'none';
            }
        }

        function previewImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    document.getElementById('previewImage').setAttribute('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]); // Membaca data URL gambar
            }
        }

        // Panggil fungsi previewImage() ketika pengguna memilih gambar baru
        document.getElementById('fileInput').addEventListener('change', function() {
            previewImage(this);
        });
    </script>
<?= $this->endSection() ?>