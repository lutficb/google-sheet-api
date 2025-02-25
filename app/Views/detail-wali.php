<?= $this->extend('layout/main'); ?>

<?= $this->section('main-content'); ?>
<div class="card" id="card-detail-santri">
    <div class="card-header">
        <button onclick="window.history.go(-1); return false;" class="btn btn-outline-secondary btn-sm"><i data-feather="arrow-left" stroke-width="2" height="18"></i> back</button>
        <a href="<?= base_url('cetak-wali/' . $biodata['NISN']); ?>" class="btn btn-outline-secondary btn-sm"><i data-feather="printer" stroke-width="2" height="18"></i> print</a>
    </div>
    <div class="card-body overflow-auto">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <img width="100%" src="<?= base_url(); ?>/header-ponpes.png" alt="">
            </div>
        </div>
        <div class="row mt-3 justify-content-center">
            <div class="col-md-7">
                <h6 class="text-center fw-bold">PENDAFTARAN SANTRI BARU T.A. 2025/2026</h6>
                <h6 class="text-center fw-bold">SOAL TEST WAWANCARA WALI CALON SANTRI</h6>
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
                            <td><?= $biodata['Status yang mengisi formulir ini dan yang diwawancarai adalah ?']; ?></td>
                        </tr>
                        <tr>
                            <td>Status yang Mengisi</td>
                            <td><?= $biodata['Sebutkan Statusnya']; ?></td>
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