<div class="right_col" role="main">
  <div class="">

    <div class="clearfix"></div>
    
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Data Obat Expired</h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <a class="dropdown-item" href="#">Settings 1</a>
                  <a class="dropdown-item" href="#">Settings 2</a>
                </div>
              </li>
              <li><a class="close-link"><i class="fa fa-close"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br />
            <div class="row">
                <div class="form-group col-md-6">

                    <div class="form-group row">
                      <label class="col-form-label col-md-4 col-sm-3 ">Jenis Obat</label>
                      <div class="col-md-8 col-sm-9 ">
                        <select id="id_jenis" name="id_jenis" required="required" class="form-control ">
                          <option value="">- Pilih Jenis Obat -</option>
                          <?php $no=1; foreach($jenis as $row_jenis){?>
                            <option value="<?= $row_jenis['id_jenis'] ?>"><?= $row_jenis['nama_jenis'] ?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-form-label col-md-4 col-sm-3 ">Dari tanggal</label>
                      <div class="col-md-8 col-sm-9 ">
                        <input type="date" id="tgl_awal" name="tgl_awal" required="required" class="form-control" value="">
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-form-label col-md-4 col-sm-3 ">Sampai dengan tanggal</label>
                      <div class="col-md-8 col-sm-9 ">
                        <input type="date" id="tgl_akhir" name="tgl_akhir" required="required" class="form-control" value="">
                      </div>
                    </div>

                </div>

                <div class="form-group col-md-6">

                    <div class="form-group row">
                      <div class="col-md-8 col-sm-9 ">
                        <button type="button" class="btn btn-success btnproseslaporan">Buat Laporan</button>
                      </div>
                    </div>

                </div>

            </div>
          </div>
        </div>
      </div>

      <div class="col-md-12 col-sm-12 " id="get_dataexpired">
        
      </div>

    </div>

  </div>
</div>
