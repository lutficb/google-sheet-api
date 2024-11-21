<?= $this->extend('layout/main'); ?>

<?= $this->section('main-content'); ?>
<div class="card">
    <div class="card-header">
        <strong>Data Wali from Google Sheet</strong>
    </div>
    <div class="card-body">
        <table id="santri" class="table table-striped" style="width:100%;">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Nama</th>
                    <th class="text-center">NISN</th>
                    <th class="text-center">Jenjang</th>
                    <th>Nama Orang Tua</th>
                    <th>Yang Mengisi</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php for ($n = 0; $n <= $long - 1; $n++): ?>
                    <tr>
                        <td class="text-center"><?= $i; ?></td>
                        <td><?= $data[$n]['Nama Putra/Putri']; ?></td>
                        <td class="text-center"><?= $data[$n]['NISN']; ?></td>
                        <td class="text-center"><?= $data[$n]['Jenjang Daftar']; ?></td>
                        <td><?= $data[$n]['Nama Ayah']; ?>/ <?= $data[$n]['Nama Ibu']; ?></td>
                        <td><?= $data[$n]['Status yang mengisi formulir ini dan yang diwawancarai adalah ? (Yang mengisi wajib hadir di lokasi test, Pondok Pesantren Imam Syafi\'i Tulungagung, saat hari pelaksanaan, Ahad, 10 November 2024.']; ?></td>
                        <td>
                            <a href="<?= base_url('detail-wali/' . $data[$n]['NISN']); ?>" title="Lihat detail" class="btn btn-primary btn-sm"><i data-feather="user-check" stroke-width="2" height="18"></i></a>
                            <a href="<?= base_url('cetak-wali/' . $data[$n]['NISN']); ?>" title="Unduh file PDF" class="btn btn-warning btn-sm"><i data-feather="download" stroke-width="2" height="18"></i></a>
                        </td>
                    </tr>
                    <?php $i++; ?>
                <?php endfor; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script>
    new DataTable('#santri', {
        columnDefs: [{
            "defaultContent": "-",
            "targets": "_all"
        }]
    });
</script>
<?= $this->endSection(); ?>