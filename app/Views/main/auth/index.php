<!DOCTYPE html>
<html lang="en">

<?= $this->include('template\partials\head') ?>

<body class="background no-footer ltr rounded">

    <!-- <div class="fixed-background" style="opacity: 1;"></div> -->
    <main style="opacity: 1;" class="default-transition">
        <div class="container">
            <div class="row h-100">
                <div class="col-12 col-md-10 mx-auto my-auto">
                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-warning rounded">
                        <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif ?>
                    <div class="card auth-card">
                        <div class="position-relative image-side">
                            <p class="text-white h2">GEREJA SANTAPAN ROHANI INDONESIA DENPASAR</p>
                            <p class="white mb-0">Sistem Informasi<br>Pengelolaan Keuangan</p>
                        </div>
                        <div class="form-side">
                            <span class="logo-single"></span>
                            <h6 class="mb-4">Login</h6>
                            <form method="post" action="<?= site_url(route_to('login.process')) ?>">
                                <label class="form-group has-float-label mb-4">
                                    <input class="form-control" name="username" required value="<?= old('username') ?>"> 
                                    <span>Username</span>
                                </label> 
                                <label class="form-group has-float-label mb-4">
                                    <input class="form-control" type="password" name="password">
                                    <span>Password</span>
                                </label>
                                <div class="d-flex justify-content-between align-items-center">
                                    <!-- <a href="#">Forget password?</a> -->
                                    <button class="btn btn-primary btn-lg btn-shadow" type="submit">LOGIN</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?= $this->include('template\partials\js') ?>
</body>

</html>