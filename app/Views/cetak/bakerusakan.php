<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berita Acara Kerusakan Barang</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/laporan.css" rel="stylesheet">
</head>

<body class="bg-light">
    <?php
    // SET Lokalisasi Tanggal ke Indonesia
    $bulan = array(
        1 => 'Januari',
        2 => 'Februari',
        3 => 'Maret',
        4 => 'April',
        5 => 'Mei',
        6 => 'Juni',
        7 => 'Juli',
        8 => 'Agustus',
        9 => 'September',
        10 => 'Oktober',
        11 => 'November',
        12 => 'Desember'
    );

    // Memecah tanggal menjadi bagian-bagian
    $tanggal_parts = explode('-', $bakerusakan['tanggal']);
    $tanggal = (int)$tanggal_parts[2]; // Mengambil tanggal
    $bulan_index = (int)$tanggal_parts[1]; // Mengambil indeks bulan
    $tahun = $tanggal_parts[0]; // Mengambil tahun

    // Membuat format tanggal dengan nama bulan dalam bahasa Indonesia
    $tanggal_formatted = $tanggal . ' ' . $bulan[$bulan_index] . ' ' . $tahun;
    ?>

    <div class="container">
        <a href="#" class="btn btn-sm btn-dark mb-2" id="printButton">Cetak</a>
        <div class="header">
            <img src="/assets/logo/dinas.png" alt="Logo Dinas" class="logo">
            <div>
                <div class="title">DINAS KEHUTANAN PROVINSI KALIMANTAN TENGAH</div>
                <div class="subtitle">KESATUAN PENGELOLAAN HUTAN LINDUNG</div>
                <div class="subtitle">KAPUAS KAHAYAN</div>
                <p style="text-align: center;">Jl. Transito Sei Angga, Selat Hulu, Kec. Selat, Kabupaten Kapuas, Kalimantan Tengah 73581</p>
            </div>
            <img src="/assets/logo/kph.png" alt="Logo Dinas" class="logor">
        </div>
        <!-- Konten kwitansi -->

        <div class="sub-header mt-4">
            <div>
                <div class="title">BERITA ACARA KERUSAKAN BARANG</div>
            </div>
        </div>
        <!-- Konten kwitansi -->
        <div class="row mt-3">
            <div class="col-md-12">
                <p style="text-indent: 30px;">
                    Pada hari ini tanggal <?= $tanggal_formatted; ?>, Telah terjadi kerusakan <strong> <?= $aset['nama_barang']; ?> <?= $aset['merk']; ?></strong> yang mana <?= $aset['nama_barang']; ?> <?= $aset['merk']; ?> tersebut tidak bisa digunakan lagi. Terlampir nama penanggung jawab dan foto kerusakan barang:
                </p>
                <ul style="list-style-type: none; padding: 0; margin: 0; display: grid; grid-template-columns: 100px 10px auto; gap: 5px; text-indent: 30px;">
                    <li><span style="font-weight: bold;">Nama</span></li>
                    <li>:</li>
                    <li><?= $aset['penanggung_jawab']; ?></li>

                    <?php if (!empty($aset['jabatan_pj'])) : ?>
                        <li><span style="font-weight: bold;">Jabatan</span></li>
                        <li>:</li>
                        <li><?= $aset['jabatan_pj']; ?></li>
                    <?php endif; ?>
                </ul>

                <p style="text-indent: 30px;">
                    Demikian berita acara ini dibuat dengan sebenarnya untuk dipergunakan dengan sebagaimana mestinya.
                </p>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-12 text-end">
                <!-- Menggunakan text-end pada kolom penuh untuk memastikan tanggal berada di sebelah kanan -->
                <p style="text-align: right;">
                    Kapuas, <?= $tanggal_formatted; ?>
                </p>
            </div>
            <!-- Menambahkan kelas untuk memastikan jarak antar kolom tanda tangan -->
            <div class="col-md-4 text-center">
                <div class="sub-title">Dibuat,</div>
            </div>
            <div class="col-md-4 text-center">
                <div class="sub-title">Disetujui,</div>
            </div>
            <div class="col-md-4 text-center">
                <div class="sub-title">Diketahui,</div>
            </div>
        </div>

        <div class="row mt-3 mb-2" style="height: 70px;">

        </div>
        <div class="row mt-7 mb-3">
            <div class="col-md-4 text-center">
                <div class="sub-title"><b><u><?= $diajukan['nama']; ?></u></b></div>
                <div class="sub-title"><?= $diajukan['nip']; ?></div>
            </div>
            <div class="col-md-4 text-center">
                <div class="sub-title"><b><u><?= $disetujui['nama']; ?></u></b></div>
                <div class="sub-title"><?= $disetujui['nip']; ?></div>
            </div>
            <div class="col-md-4 text-center">
                <div class="sub-title"><b><u><?= $diketahui['nama']; ?></u></b></div>
                <div class="sub-title"><?= $diketahui['nip']; ?></div>
            </div>


        </div>
    </div>

    <div class="page-break mb-3"></div>
    <div class="container">
        <div class="sub-header mt-4">
            <div>
                <div class="title">Lampiran</div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8"><img src="<?= base_url('uploads/lampiran/' . $bakerusakan['lampiran']); ?>" alt="Gambar" class="img-fluid"></div>
            <div class="col-md-2"></div>
        </div>

    </div>



    <!-- Bootstrap JS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById("printButton").addEventListener("click", function() {
            window.print();
        });
    </script>

</body>

</html>