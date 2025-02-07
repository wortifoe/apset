<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekomendasi Perbaikan Barang</title>
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

    // Fungsi untuk memformat tanggal menjadi format "DD NamaBulan YYYY"
    function formatTanggalIndonesia($tanggal, $bulan)
    {
        if (!$tanggal || $tanggal == '0000-00-00') {
            return '-'; // Jika tanggal kosong atau tidak valid, return "-"
        }

        $tanggal_parts = explode('-', $tanggal);

        if (count($tanggal_parts) === 3) {
            $tanggal_hari = (int)$tanggal_parts[2]; // Mengambil tanggal (hari)
            $bulan_index = (int)$tanggal_parts[1]; // Mengambil indeks bulan
            $tahun = $tanggal_parts[0]; // Mengambil tahun

            return $tanggal_hari . ' ' . $bulan[$bulan_index] . ' ' . $tahun;
        }

        return '-';
    }

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

        <div class="row mt-4">
            <div class="col-md-8">

                <div style="display: grid; grid-template-columns: auto 1fr; gap: 5px;">
                    <div>Nomor</div>
                    <div>: <?= $rekomendasi['nomor_surat']; ?></div>
                    <div>Perihal</div>
                    <div>: Rekomendasi Perbaikan Barang</div>
                    <div>Lampiran</div>
                    <div>: 1</div>
                </div>

                <br>

                <div style="margin-top: 10px;">
                    <div>Kepada Yth.</div>
                    <div>Kepala DINAS HUMOR INDONESIAN</div>
                    <div>di Tempat</div>
                    <div>Dengan hormat,</div>
                </div>

            </div>
        </div>

        <!-- Konten kwitansi -->
        <div class="row mt-3">
            <div class="col-md-12">
                <p style="text-align: justify;">
                    Sehubungan dengan temuan kerusakan pada <?= $rekomendasi['nama_barang']; ?> <?= $rekomendasi['merk']; ?> di <?= $rekomendasi['lokasi']; ?> yang kami peroleh berdasarkan hasil pemeriksaan oleh petugas teknis pada <?= formatTanggalIndonesia($rekomendasi['tanggal_pemeriksaan'] ?? null, $bulan); ?>, bersama ini kami menyampaikan rekomendasi untuk perbaikan barang dimaksud.
                </p>
                <p style="text-align: justify;">
                    Adapun rincian kerusakan yang ditemukan adalah sebagai berikut:
                </p>
                <p style="text-align:justify">
                    <?= $rekomendasi['deskripsi_kerusakan']; ?>
                </p>
                <p style="text-align: justify;" class="mb-2">
                    Mengingat pentingnya fungsi barang tersebut dalam menunjang kelancaran kegiatan di Dinas kami, kami berharap agar segera dilakukan perbaikan untuk mengembalikan kondisi barang tersebut seperti semula.
                </p>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-12 text-start">
                <!-- Menggunakan text-end pada kolom penuh untuk memastikan tanggal berada di sebelah kanan -->
                <p style="text-align: left;">
                    Kapuas, <?= formatTanggalIndonesia($rekomendasi['tgl_surat'] ?? null, $bulan); ?>
                </p>
            </div>
            <!-- Menambahkan kelas untuk memastikan jarak antar kolom tanda tangan -->
            <div class="col-md-4 text-center">
                <div class="sub-title">Dibuat,</div>
            </div>
            <div class="col-md-4 text-center">
                <div class="sub-title">Diverifikasi,</div>
            </div>
            <div class="col-md-4 text-center">
                <div class="sub-title">Disetujui,</div>
            </div>
        </div>

        <div class="row mt-3 mb-2" style="height: 70px;">

        </div>
        <div class="row mt-7 mb-3">
            <div class="col-md-4 text-center">
                <div class="sub-title"><b><u><?= $dibuat['nama']; ?></u></b></div>
                <div class="sub-title"><?= $dibuat['nip']; ?></div>
            </div>
            <div class="col-md-4 text-center">
                <div class="sub-title"><b><u><?= $diverifikasi['nama']; ?></u></b></div>
                <div class="sub-title"><?= $diverifikasi['nip']; ?></div>
            </div>
            <div class="col-md-4 text-center">
                <div class="sub-title"><b><u><?= $disetujui['nama']; ?></u></b></div>
                <div class="sub-title"><?= $disetujui['nip']; ?></div>
            </div>


        </div>
    </div>

    <div class="page-break mb-3"></div>

    <div class="container">
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
        <div class="sub-header mt-4">
            <div>
                <div class="title">Lampiran</div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8"><img src="<?= base_url('uploads/file/' . $rekomendasi['file']); ?>" alt="Gambar" class="img-fluid"></div>
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