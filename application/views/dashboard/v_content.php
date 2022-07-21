<!-- page content -->
<div class="right_col" role="main">
    <div class="">

        <div class="clearfix"></div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="animated flipInY col-lg-4 col-md-3 col-sm-6 ">
                        <div class="tile-stats">
                        <div class="icon"><i class="fa fa-cubes" style="color: #1ABB9C;"></i></div>
                        <div class="count"><?= $total_obat ?></div>
                        <h3>Jumlah Obat</h3>
                        <p></p>
                        </div>
                    </div>

                    <div class="animated flipInY col-lg-4 col-md-3 col-sm-6 ">
                        <div class="tile-stats">
                        <div class="icon"><i class="fa fa-tags" style="color: #1ABB9C;"></i></div>
                        <div class="count"><?= $total_laporan ?></div>
                        <h3>Jumlah Laporan</h3>
                        <p></p>
                        </div>
                    </div>
                    <div class="animated flipInY col-lg-4 col-md-3 col-sm-6 ">
                        <div class="tile-stats">
                        <div class="icon"><i class="fa fa-comment" style="color: #1ABB9C;"></i></div>
                        <div class="count"><?= $total_rekomendasi ?></div>
                        <h3>Jumlah Rekomendasi</h3>
                        <p></p>
                        </div>
                    </div>
                    
                </div>

                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="alert alert-success " role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                        <strong>Selamat datang</strong> <?= $user ?> ,di sistem informasi Apotek Kita.
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- /page content -->

