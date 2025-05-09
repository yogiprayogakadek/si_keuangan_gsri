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

            <?= $this->renderSection('content') ?>
        </div>
    </main>
    
    <?= $this->include('template\partials\footer') ?>
    <?= $this->include('template\partials\js') ?>
</body>
</html>