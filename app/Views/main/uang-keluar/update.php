<?= $this->extend('template\master') ?>

<?= $this->section('page-title') ?> Uang Keluar <?= $this->endSection() ?>
<?= $this->section('subpage-title') ?> Ubah Data <?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="row">
    <div class="col-12">
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger rounded">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif ?>
        <div class="card mb-4">
            <div class="position-absolute card-top-buttons">
                <a href="<?= site_url(route_to('uangkeluar.index')) ?>">
                    <button class="btn btn-header-primary">
                        <i class="glyph-icon simple-icon-arrow-left-circle"></i> List Data
                    </button>
                </a>
            </div>
            <div class="card-body">
                <div class="card-title"><h3>Ubah Data Uang Keluar</h3></div>
                <form action="<?= site_url(route_to('uangkeluar.update')) ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="form-group">
                        <input type="text" name="id" value="<?= $data['id'] ?>" hidden>
                        <label for="tanggal">Tanggal Pengeluaran Uang</label> 
                        <input type="date" name="tanggal" class="form-control <?= session('errors.tanggal') ? 'is-invalid' : '' ?>" id="tanggal" value="<?= esc($data['tanggal']) ?>" max="<?= date('Y-m-d') ?>"> 

                        <?php if (session('errors.tanggal')) : ?>
                            <div class="invalid-feedback">
                                <?= session('errors.tanggal') ?>
                            </div>
                        <?php endif ?>
                    </div>
                    <div class="form-group">
                        <label for="jumlah">Jumlah Uang</label> 
                        <input type="text" name="jumlah" class="form-control <?= session('errors.jumlah') ? 'is-invalid' : '' ?>" id="jumlah" placeholder="Masukkan jumlah uang" value="Rp <?= number_format($data['jumlah'], 0, ',', '.') ?>"> 
                        <small id="saldo" class="form-text text-muted"><strong>Sisa saldo saat ini + jumlah yang akan diupdate Rp <?= number_format($saldo, 0, ',', '.') ?></strong></small>
                        <?php if (session('errors.jumlah')) : ?>
                            <div class="invalid-feedback">
                                <?= session('errors.jumlah') ?>
                            </div>
                        <?php endif ?>
                    </div>
                    <div class="form-group">
                        <label for="tujuan">Tujuan</label> 
                        <input type="text" name="tujuan" class="form-control <?= session('errors.tujuan') ? 'is-invalid' : '' ?>" id="tujuan" placeholder="Masukkan tujuan uang" value="<?= esc($data['tujuan'])?>">

                        <?php if (session('errors.tujuan')) : ?>
                            <div class="invalid-feedback">
                                <?= session('errors.tujuan') ?>
                            </div>
                        <?php endif ?>
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label> 
                        <textarea name="keterangan" id="keterangan" class="form-control <?= session('errors.keterangan') ? 'is-invalid' : '' ?>" rows="5" placeholder="Masukkan keterangan"><?= esc($data['keterangan']) ?></textarea>
                        <?php if (session('errors.keterangan')) : ?>
                            <div class="invalid-feedback">
                                <?= session('errors.keterangan') ?>
                            </div>
                        <?php endif ?>
                    </div>
                    <button type="submit" class="btn btn-primary mb-0 float-right">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
    var rupiah = $("#jumlah");
    function convertToRupiah(number, prefix) {
        var number_string = number.replace(/[^,\d]/g, "").toString(),
            split = number_string.split(","),
            remaining = split[0].length % 3,
            rupiah = split[0].substr(0, remaining),
            thousand = split[0].substr(remaining).match(/\d{3}/gi);

        if (thousand) {
            separator = remaining ? "." : "";
            rupiah += separator + thousand.join(".");
        }

        rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
        return prefix == undefined ? rupiah : rupiah ? "Rp. " + rupiah : "";
    }
    $(document).ready(function () {
        $("body").on("keyup", '#jumlah', function (e) {
            $("#jumlah").val(convertToRupiah($(this).val(), "Rp. "))
        });
    });
</script>
<?= $this->endSection() ?>