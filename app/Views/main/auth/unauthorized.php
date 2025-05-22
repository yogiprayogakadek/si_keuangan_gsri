<!DOCTYPE html>
<html lang="en">

<?= $this->include('template\partials\head') ?>

<body class="background no-footer ltr rounded">

    <div class="fixed-background" style="opacity: 1;"></div>
    <main style="opacity: 1;" class="default-transition">
        <div class="container">
            <div class="row h-100">
                <div class="col-12 col-md-10 mx-auto my-auto">
                    <div class="card auth-card">
                        <div class="position-relative image-side">
                            <p class="text-white h2">GEREJA SANTAPAN ROHANI INDONESIA DENPASAR</p>
                            <p class="white mb-0">Sistem Informasi<br>Pengelolaan Keuangan</p>
                        </div>
                        
                        <div class="form-side">
                            <div class="text-center">
                                <a href="<?= site_url(route_to('dashboard')) ?>">
                                    <span class="logo-single"></span>
                                </a>
                                <h6 class="mb-4">Ooops... Kamu tidak mempunyai akses untuk membuka halaman ini</h6>
                                <p class="mb-0 text-muted text-small mb-0">Forbidden!</p>
                                <p class="display-1 font-weight-bold mb-5">403</p>
                                <a href="<?= site_url(route_to('dashboard')) ?>" class="btn btn-primary btn-lg btn-shadow">GO BACK HOME</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?= $this->include('template\partials\js') ?>
</body>

</html>