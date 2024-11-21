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
            background-color: rgb(188, 226, 255);
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="text-center">PENDAFTARAN SANTRI BARU T.P. 2025/2026</h2>
        <h2 class="text-center">HASIL TEST WAWANCARA ONLINE WALI SANTRI BARU</h2>

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
                    <td><?= $biodata['Nama Putra/Putri']; ?></td>
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
                <tr>
                    <td>Yang Mengisi</td>
                    <td><?= $biodata['Status yang mengisi formulir ini dan yang diwawancarai adalah ? (Yang mengisi wajib hadir di lokasi test, Pondok Pesantren Imam Syafi\'i Tulungagung, saat hari pelaksanaan, Ahad, 10 November 2024.']; ?></td>
                </tr>
                <tr>
                    <td>Status yang Mengisi</td>
                    <td><?= $biodata['Sebutkan Statusnya']; ?></td>
                </tr>
            </tbody>
        </table>
        <br>
        <table>
            <thead>
                <tr>
                    <th>
                        Pertanyaan dan Jawaban Wawancara
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