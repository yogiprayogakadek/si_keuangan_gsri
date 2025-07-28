<div class="menu">
    <div class="main-menu">
        <div class="scroll">
            <ul class="list-unstyled">
                <li class="<?= url_is('') ? 'active' : '' ?>">
                    <a href="<?= base_url('') ?>"><i class="iconsminds-shop-4"></i> Dashboard</a>
                </li>
                <!-- <li class="<?= url_is('peminjaman') ? 'active' : '' ?>">
                    <a href="#"><i class="iconsminds-user"></i> Peminjam</a>
                </li> -->
                <?php if (in_array(session()->get('role'), ['Bendahara', 'Sekretaris'])): ?>
                    <li class="<?= url_is('/uang-masuk*') ? 'active' : (url_is('/uang-keluar*') ? 'active' : '') ?>">
                        <a href="#keuangan"><i class="iconsminds-money-bag"></i> <span>Keuangan</span></a>
                    </li>
                <?php endif ?>
                <li class="print-menu">
                    <a href="javascript:void(0);"><i class="simple-icon-printer"></i> Cetak Laporan</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="sub-menu">
        <div class="scroll">
            <ul class="list-unstyled" data-link="keuangan">
                <li class="<?= url_is('uang-masuk*') ? 'active' : '' ?>">
                    <a href="<?= site_url(route_to('uangmasuk.index')) ?>"><i class="iconsminds-arrow-out-right"></i>
                        <span class="d-inline-block">Uang Masuk</span></a>
                </li>
                <li class="<?= url_is('uang-keluar*') ? 'active' : '' ?>">
                    <a href="<?= site_url(route_to('uangkeluar.index')) ?>"><i class="iconsminds-arrow-out-left"></i>
                        <span class="d-inline-block">Uang Keluar</span></a>
                </li>
            </ul>
        </div>
    </div>
</div>