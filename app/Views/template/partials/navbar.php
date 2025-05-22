<nav class="navbar fixed-top">
        <div class="d-flex align-items-center navbar-left">
            <a href="#" class="menu-button d-none d-md-block"><svg
                    class="main"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 9 17">
                    <rect x="0.48" y="0.5" width="7" height="1" />
                    <rect x="0.48" y="7.5" width="7" height="1" />
                    <rect x="0.48" y="15.5" width="7" height="1" />
                </svg>
                <svg
                    class="sub"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 18 17">
                    <rect x="1.56" y="0.5" width="16" height="1" />
                    <rect x="1.56" y="7.5" width="16" height="1" />
                    <rect x="1.56" y="15.5" width="16" height="1" />
                </svg> </a><a href="#" class="menu-button-mobile d-xs-block d-sm-block d-md-none"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 26 17">
                    <rect x="0.5" y="0.5" width="25" height="1" />
                    <rect x="0.5" y="7.5" width="25" height="1" />
                    <rect x="0.5" y="15.5" width="25" height="1" />
                </svg></a>
        </div>
        <a class="navbar-logo" href="<?= site_url(route_to('dashboard')) ?>"><span class="logo d-none d-xs-block"></span>
            <span class="logo-mobile d-block d-xs-none"></span></a>
        <div class="navbar-right">
            <div class="header-icons d-inline-block align-middle">
                <div class="d-none d-md-inline-block align-text-bottom mr-3">
                    <div
                        class="custom-switch custom-switch-primary-inverse custom-switch-small pl-1"
                        data-toggle="tooltip"
                        data-placement="left"
                        title="Dark Mode">
                        <input
                            class="custom-switch-input"
                            id="switchDark"
                            type="checkbox"
                            checked="checked" />
                        <label class="custom-switch-btn" for="switchDark"></label>
                    </div>
                </div>
            </div>
            <div class="user d-inline-block">
                <button
                    class="btn btn-empty p-0"
                    type="button"
                    data-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false">
                    <span class="name"><?= session()->get('username') ?></span>
                    <span><img alt="Profile Picture" src="<?= base_url() ?>assets/img/profiles/user.webp" /></span>
                </button>
                <div class="dropdown-menu dropdown-menu-right mt-3">
                    <!-- <a class="dropdown-item" href="#">Account</a>
                    <a class="dropdown-item" href="#">Features</a>
                    <a class="dropdown-item" href="#">History</a>
                    <a class="dropdown-item" href="#">Support</a> -->
                    <a class="dropdown-item" href="<?= site_url(route_to('logout')) ?>">Sign out</a>
                </div>
            </div>
        </div>
    </nav>