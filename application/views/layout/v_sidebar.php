<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="./dashboard" class="site_title"> <span>APOTEK KITA</span></a>
        </div>

        <div class="clearfix"></div>

        <!-- menu profile quick info -->
        <div class="profile clearfix">
            <div class="profile_pic">
                <img src="<?= base_url() ?>/public/image/icon.png" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
                <span>Selamat datang,</span>
                <h2><?= $this->session->userdata('nama') ?></h2>
            </div>
        </div>
        <!-- /menu profile quick info -->

        <br />

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                    <li><a href="<?= base_url() ?>dashboard"><i class="fa fa-home"></i> Dashboard</a>
                    </li>
                    <?php if($this->session->userdata('level') == 'Admin'){
                    ?>
                    </li>
                    <li><a><i class="fa fa-briefcase"></i> Master Data <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="<?= base_url() ?>obat">Data Obat</a></li>
                            <li><a href="<?= base_url() ?>expired">Data Expired</a></li>
                            <li><a href="<?= base_url() ?>jenis">Data Jenis Obat</a></li>
                        </ul>
                    </li>
                    
                    <?php
                    }
                    ?>
                    
                    <li><a href="<?= base_url() ?>laporan"><i class="fa fa-book"></i> Laporan</a>
                    <li><a href="<?= base_url() ?>rekomendasi"><i class="fa fa-edit"></i> Rekomendaasi</a>
                    </li>
                    <li><a href="<?= base_url() ?>login/logout"><i class="fa fa-sign-out"></i> Logout</a>
                    </li>
                    
                </ul>
            </div>

        </div>
        <!-- /sidebar menu -->
    </div>
</div>