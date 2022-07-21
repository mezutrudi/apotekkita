<div class="right_col" role="main">
  <div class="">

    <div class="clearfix"></div>
    
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2><?= $judul ?></h2>
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
                        <button type="button" class="btn btn-success btncarilaporan">Cari</button>
                      </div>
                    </div>

                </div>

            </div>
          </div>
        </div>
      </div>

      <div class="col-md-12 col-sm-12 " id="get_datalaporan">
        <div class="x_panel">

          <div class="x_content">
            <div class="row">
                <div class="col-sm-12">
                <?php
                echo validation_errors('<div class="alert alert-danger alert-dismissible">','</div>');
                if ($this->session->flashdata('success'))
                {
                    echo '<div class="alert alert-success alert-dismissible " role="alert">';
                    echo $this->session->flashdata('success');
                    echo '</div>';
                }
                if ($this->session->flashdata('error'))
                {
                    echo '<div class="alert alert-danger alert-dismissible " role="alert">';
                    echo $this->session->flashdata('error');
                    echo '</div>';
                }

                ?>

                  <div class="card-box table-responsive">
                  <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                      <tr>
                        <th style="width: 10%;">No.</th>
                        <th>Nomor Arsip</th>
                        <th>Tanggal</th>
                        <th style="width: 20%;">Aksi</th>
                      </tr>
                    </thead>


                    <tbody>
                    <?php $no=1; foreach($data as $row){?>
                      <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $row['no_arsip'] ?></td>
                        <td><?= $row['tanggal_laporan'] ?></td>
                        <td>
                          <button type="submit" class="btn-danger btnhapus" data-id="<?= $row['id_laporan'] ?>"><i class="fa fa-lg fa-trash"></i> Hapus</button>

                          <a href="<?= base_url()?>laporan/cetak/<?= $row['no_arsip'] ?>" type="submit" class="btn-sm btn-primary btnedit" target="_blank"><i class="fa fa-lg fa-print"></i> Cetak</a>
                          </td>

                      </tr>
                      <?php } ?> 
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>

  </div>
</div>
