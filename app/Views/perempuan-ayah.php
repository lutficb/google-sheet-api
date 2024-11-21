<?= $this->extend('layout/main'); ?>

<?= $this->section('main-content'); ?>
<div class="card">
    <div class="card-header">
        <strong>Data Santri from Google Sheet</strong>
    </div>
    <div class="card-body">
        <table id="pria-ibu" class="table table-striped" style="width:100%;">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Nama</th>
                    <th class="text-center">Pengisi</th>
                    <th class="text-center">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php for ($n = 0; $n <= $long - 1; $n++): ?>
                    <tr>
                        <td class="text-center"><?= $i; ?></td>
                        <td><?= $data[$n]['Nama']; ?></td>
                        <td><?= $data[$n]['Pengisi']; ?></td>
                        <td><?= $data[$n]['Status']; ?></td>
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
    new DataTable('#pria-ibu', {
        columnDefs: [{
            "defaultContent": "-",
            "targets": "_all"
        }]
    });
</script>
<?= $this->endSection(); ?>