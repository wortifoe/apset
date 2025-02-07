<?= $this->extend('theme/app') ?>

<?= $this->section('header') ?>
<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>

<div class="page-heading">
    <h5>Ubah Data Aset</h5>
</div>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="row">
    <div class="col-12 col-lg-12">
        <div class="card">
            <div class="card-body">
                <form class="forms-sample" action="/aset/update/<?= $aset['id'] ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="id_unit">Nama Barang</label>
                        <select name="id_unit" class="form-control" required>
                            <?php foreach ($unit as $un): ?>
                                <option value="<?= $un['id'] ?>" <?= $un['id'] == $aset['id_unit'] ? 'selected' : '' ?>>
                                    <?= $un['nama_barang'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Merk</label>
                        <input type="text" name="merk" class="form-control" value="<?= $aset['merk'] ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Jumlah</label>
                        <input type="text" name="jumlah" class="form-control" value="<?= $aset['jumlah'] ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="status">Status Barang</label>
                        <select name="status" class="form-control" required>
                            <option value="baik" <?= $aset['status'] == 'baik' ? 'selected' : '' ?>>Baik</option>
                            <option value="rusak" <?= $aset['status'] == 'rusak' ? 'selected' : '' ?>>Rusak</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="id_penempatan">Penempatan</label>
                        <select name="id_penempatan" class="form-control" required>
                            <?php foreach ($penempatan as $pn): ?>
                                <option value="<?= $pn['id'] ?>" <?= $pn['id'] == $aset['id_penempatan'] ? 'selected' : '' ?>>
                                    <?= $pn['lokasi'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="karyawan">Karyawan</label>
                        <select class="form-control" id="karyawan" name="id_karyawan">
                            <option value="">Pilih Karyawan</option>
                            <?php foreach ($karyawan as $row): ?>
                                <option value="<?= $row['id'] ?>" <?= $row['id'] == $aset['id_karyawan'] ? 'selected' : '' ?>>
                                    <?= $row['nama'] ?>
                                </option>
                            <?php endforeach; ?>
                            <option value="other" <?= is_null($aset['id_karyawan']) && $aset['penanggung_jawab'] ? 'selected' : '' ?>>Lainnya</option>
                        </select>
                    </div>

                    <div class="form-group" id="penanggung-jawab-group" style="display: <?= is_null($aset['id_karyawan']) && $aset['penanggung_jawab'] ? 'block' : 'none' ?>;">
                        <label for="penanggung-jawab">Penanggung Jawab</label>
                        <input type="text" class="form-control" id="penanggung-jawab" name="penanggung_jawab" value="<?= $aset['penanggung_jawab'] ?>">
                    </div>

                    <div class="form-group" id="uploadForm">
                    <label>Foto</label> <br>
                        <?php if (!empty($aset['file'])) : ?>
                            <img id="previewImage" src="<?= base_url('uploads/file/' . $aset['file']); ?>" alt="Gambar" width="100" height="100">
                            <br>
                        <?php endif; ?>
                        <label><small>Input dalam Format JPG</small></label> <br>
                        <input type="file" id="fileInput" name="file" class="form-control-file" accept=".jpg, .jpeg, .png">
                    </div>

                    <div class="form-group">
                        <label>Keterangan</label>
                        <input type="text" name="keterangan" class="form-control" value="<?= $aset['keterangan'] ?>" required>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-success mr-2">Simpan</button>
                        <a href="<?= base_url('/aset'); ?>" class="btn btn-danger">Batal</a>
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
     document.getElementById('karyawan').addEventListener('change', function () {
        const penanggungJawabGroup = document.getElementById('penanggung-jawab-group');
        if (this.value === 'other') {
            penanggungJawabGroup.style.display = 'block';
        } else {
            penanggungJawabGroup.style.display = 'none';
            document.getElementById('penanggung-jawab').value = null; // Reset nilai ke NULL
        }
    });
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