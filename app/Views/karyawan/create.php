<?= $this->extend('theme/app') ?>

<?= $this->section('header') ?>
<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>

<div class="page-heading">
    <h5>Tambah Data Karyawan</h5>
</div>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="row">
    <div class="col-12 col-lg-12">
        <div class="card">
            <div class="card-body">
                <form class="forms-sample" action="/karyawan/store" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="nama" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>NIP</label>
                        <input type="text" name="nip" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Jabatan</label>
                        <input type="text" name="jabatan" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="kategori_pegawai">Kategori Pegawai</label>
                        <select name="kategori_pegawai" class="form-control" required>
                            <option value="PNS">PNS</option>
                            <option value="PTT">PTT</option>
                            <option value="Tenaga Ahli">Tenaga Ahli</option>
                            <option value="NON PNS">NON PNS</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>No Rek</label>
                        <input type="text" name="norek" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Foto</label> <br>
                        <div id="previewContainer" style="display: none;">
                            <img id="previewImage" src="" alt="Pratinjau Gambar" width="100" height="100">
                        </div>
                        <label><small>Upload dalam Format JPG dan PNG</small></label> <br>

                        <input type="file" name="file" id="fileUpload" class="form-control-file" accept=".jpg, .jpeg, .png">
                    </div>

                    <div class="form-group">
                        <label>Keterangan</label>
                        <input type="text" name="keterangan" class="form-control" required>
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