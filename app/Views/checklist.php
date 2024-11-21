<?= $this->extend('layout/main'); ?>

<?= $this->section('main-content'); ?>
<div class="card" id="card-detail-santri">
    <div class="card-header">
        <button onclick="window.history.go(-1); return false;" class="btn btn-outline-secondary btn-sm"><i data-feather="arrow-left" stroke-width="2" height="18"></i> back</button>
        <a href="" class="btn btn-outline-secondary btn-sm"><i data-feather="printer" stroke-width="2" height="18"></i> print</a>
    </div>
    <div class="card-body overflow-auto">
        <table class="table table-striped" style="width:100%;">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Nama</th>
                    <th class="text-center">NISN</th>
                    <th class="text-center">Wawancara Santri</th>
                    <th class="text-center">Wawancara Wali</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php for ($n = 0; $n <= $length - 1; $n++): ?>
                    <tr>
                        <td class=" text-center"><?= $i; ?></td>
                        <td><?= $checklist[$n]['nama']; ?></td>
                        <td class=" text-center"><?= $checklist[$n]['nisn']; ?></td>
                        <td class="text-center"><span class=" badge <?= ($checklist[$n]['santri'] == 'OK') ? 'text-bg-success' : 'text-bg-danger'; ?>"><?= ($checklist[$n]['santri'] == 'OK') ? 'Sudah' : 'Belum'; ?></span></td>
                        <td class="text-center"><span class=" badge <?= ($checklist[$n]['wali'] == 'OK') ? 'text-bg-success' : 'text-bg-danger'; ?>"><?= ($checklist[$n]['wali'] == 'OK') ? 'Sudah' : 'Belum'; ?></span></td>
                    </tr>
                    <?php $i++; ?>
                <?php endfor; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection(); ?>