<?= $this->extend('layout/main'); ?>

<?= $this->section('main-content'); ?>
<div class="row justify-content-center">
    <div class="col-md-4">
        <div class="card text-center" style="width: 100%;">
            <img src="<?= base_url(); ?>peserta.png" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">Data Santri</h5>
                <p class="card-text">Rekap hasil pengisian wawancara online oleh peserta PSB Tahun Ajaran 2025/2026.</p>
                <a href="<?= base_url(); ?>data-santri" class="btn btn-success"><i data-feather="external-link" stroke-width="2" height="20"></i> Lebih lanjut</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class=" card text-center" style="width: 100%;">
            <img src="<?= base_url(); ?>peserta.png" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">Data Wali</h5>
                <p class="card-text">Rekap hasil pengisian wawancara online oleh wali peserta PSB Tahun Ajaran 2025/2026.</p>
                <a href="<?= base_url(); ?>data-wali" class="btn btn-success"><i data-feather="external-link" stroke-width="2" height="20"></i> Lebih lanjut</a>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>