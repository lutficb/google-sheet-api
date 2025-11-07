<?= $this->extend('layout/main'); ?>

<?= $this->section('main-content'); ?>
<div class="card" id="card-detail-santri">
    <div class="card-header">
        <button onclick="window.history.go(-1); return false;" class="btn btn-outline-secondary btn-sm"><i data-feather="arrow-left" stroke-width="2" height="18"></i> back</button>
        <a href="<?= base_url('cetak-santri/' . $biodata['NISN']); ?>" class="btn btn-outline-secondary btn-sm"><i data-feather="printer" stroke-width="2" height="18"></i> print</a>
    </div>
    <div class="card-body overflow-auto">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <img width="100%" src="<?= base_url(); ?>/header-ponpes.png" alt="">
            </div>
        </div>
        <div class="row mt-3 justify-content-center">
            <div class="col-md-7">
                <h6 class="text-center fw-bold">PENDAFTARAN SANTRI BARU T.A. 2026/2027</h6>
                <h6 class="text-center fw-bold">SOAL TEST WAWANCARA CALON SANTRI</h6>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-7">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center" colspan="2">
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
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-7">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center" colspan="2">
                                Pertanyaan dan Jawaban Wawancara
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        zzz
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2" class="centermid"><strong>Diisi oleh petugas Wawancara</strong></td>
                        </tr>
                        <tr>
                            <td>Nama Petugas :</td>
                        </tr>
                        <tr>
                            <td>Rekomendasi</td>
                        </tr>
                        <tr>
                            <td>
                                <ol>
                                    <li>Diterima</li>
                                    <li>Diterima dengan syarat</li>
                                    <li>Tidak diterima</li>
                                </ol>
                            </td>
                        </tr>
                        <tr>
                            <td>Catatan</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>