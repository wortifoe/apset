<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Barang Rusak </title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/laporan.css" rel="stylesheet">
</head>

<body class="bg-light">

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
                <div class="title">Daftar Barang Rusak</div>
            </div>
        </div>
        <!-- Konten kwitansi -->
        <div class="row mt-3">
            <div class="col-md-12">
                <table class="table table-bordered" id="table1">
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
                                    <td><?= $row['jenis']; ?></td>
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



        <!-- Bootstrap JS CDN -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            document.getElementById("printButton").addEventListener("click", function() {
                window.print();
            });
        </script>

</body>

</html>