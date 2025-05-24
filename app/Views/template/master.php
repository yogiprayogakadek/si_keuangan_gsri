<!DOCTYPE html>
<html lang="en">

<?= $this->include('template\partials\head') ?>

<body id="app-container" class="menu-default">
    <?= $this->include('template\partials\navbar') ?>
    
    <?= $this->include('template\partials\sidebar') ?>
    

    <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    
                    <nav
                        class="breadcrumb-container d-none d-sm-block d-lg-inline-block"
                        aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item"><a href="#"><?= $this->renderSection('page-title') ?></a></li>
                            <li class="breadcrumb-item active" aria-current="page"><?= $this->renderSection('subpage-title') ?></li>
                        </ol>
                    </nav>
                    <div class="separator mb-5"></div>
                </div>
            </div>

            <!-- MODAL -->
            <div class="modal fade" id="printModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Cetak Data</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                        <form action="<?= site_url(route_to('uangmasuk.print')) ?>" method="post" target="_blank" id="formPrint">
                            <?= csrf_field() ?>
                            <div class="modal-body">
                                <div class="container-fluid">
                                    <div class="form-group">
                                        <label for="start_date">Start Date</label>
                                        <input type="date" class="form-control" name="start_date" max="<?= date('Y-m-d') ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="end_date">End Date</label>
                                        <input type="date" class="form-control" name="end_date" max="<?= date('Y-m-d') ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="kategori">Kategori</label>
                                        <select name="kategori" id="kategori" class="form-control" required>
                                            <option value="">Pilih Kategori Keuangan</option>
                                            <option value="masuk">Uang Masuk</option>
                                            <option value="keluar">Uang Keluar</option>
                                        </select>
                                </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary btn-print">Print</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- end Modal -->

            <?= $this->renderSection('content') ?>
        </div>
    </main>
    
    <?= $this->include('template\partials\footer') ?>
    <?= $this->include('template\partials\js') ?>
</body>
</html>