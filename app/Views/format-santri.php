<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title; ?></title>

    <style>
        @page {
            margin: 0px;
        }

        .container {
            box-sizing: border-box;
            padding: 1cm;
        }

        h2 {
            font-size: 16px;
        }

        .text-center {
            text-align: center;
        }

        table {
            margin: auto;
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid #000000;
            height: 35px;
            margin: 8px;
            padding-left: 10px;
        }

        th {
            text-align: center;
            background-color: rgb(191, 255, 204);
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="text-center">PENDAFTARAN SANTRI BARU T.P. 2025/2026</h2>
        <h2 class="text-center">HASIL TEST WAWANCARA ONLINE SANTRI BARU</h2>

        <table>
            <thead>
                <tr>
                    <th colspan="2">
                        Biodata Peserta
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Nama Peserta</td>
                    <td><?= $biodata['Nama Lengkap']; ?></td>
                </tr>
                <tr>
                    <td>Jenis Kelamin</td>
                    <td><?= $biodata['Jenis Kelamin']; ?></td>
                </tr>
                <tr>
                    <td>Nama Ayah</td>
                    <td><?= $biodata['Nama Ayah']; ?></td>
                </tr>
                <tr>
                    <td>Nama Ibu</td>
                    <td><?= $biodata['Nama Ibu']; ?></td>
                </tr>
                <tr>
                    <td>Jenjang</td>
                    <td><?= $biodata['Jenjang Daftar']; ?></td>
                </tr>
            </tbody>
        </table>
        <br>
        <table>
            <thead>
                <tr>
                    <th>
                        Pertanyaan dan Jawaban
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php foreach ($jawaban as $soal => $jawab): ?>
                    <tr>
                        <td style="font-weight: bold;"><?= $soal; ?></td>
                    </tr>
                    <tr>
                        <td>
                            <small>Jawaban : </small>
                            <p><?= $jawab; ?></p>
                        </td>
                    </tr>
                    <?php $i++; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>