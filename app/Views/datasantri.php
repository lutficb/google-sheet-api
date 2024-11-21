<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css">
</head>

<body>
    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">GOOGLE SHEET API</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="#">Data Santri</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Data Wali</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Checklist</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- END NAVBAR -->

    <!-- Card Table Data santri -->
    <div class="main container mt-2">
        <div class="card">
            <div class="card-header">
                <strong>Data Santri from Google Sheet</strong>
            </div>
            <div class="card-body">
                <!-- <a href="#" class="btn btn-primary btn-block">Tarik data dari Google Sheet</a> -->
                <table id="santri" class="table table-striped" style="width:100%;">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Nama</th>
                            <th class="text-center">Jenjang</th>
                            <th>Nama Ayah</th>
                            <th>Nama Ibu</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php for ($n = 0; $n <= $long - 1; $n++): ?>
                            <tr>
                                <td class="text-center"><?= $i; ?></td>
                                <td><?= $data[$n]['Nama Lengkap']; ?></td>
                                <td class="text-center"><?= $data[$n]['Jenjang Daftar']; ?></td>
                                <td><?= $data[$n]['Nama Ayah']; ?></td>
                                <td><?= $data[$n]['Nama Ibu']; ?></td>
                                <td>
                                    <a href="<?= base_url('cetak-santri/' . $n); ?>" class="btn btn-primary btn-sm">Lihat detail</a>
                                </td>
                            </tr>
                            <?php $i++; ?>
                        <?php endfor; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- End Card Table Data santri -->

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>

    <script>
        new DataTable('#santri', {
            columnDefs: [{
                "defaultContent": "-",
                "targets": "_all"
            }]
        });
    </script>
</body>

</html>