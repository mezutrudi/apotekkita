<div class="right_col" role="main">
  <div class="">

    <div class="clearfix"></div>
    
    <div class="row">
      <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
          <div class="x_title">
            <h2><?= $judul ?></h2>
            <ul class="nav navbar-right panel_toolbox">
            <p><button type="button" class="btn btn-sm btn-success icon-btn btnadd"><i class="fa fa-plus"></i>Tambah Data</button></p>
            </ul>
            <div class="clearfix"></div>
          </div>

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
                        <th>Nama Obat</th>
                        <th>Jenis</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Tanggal</th>
                        <th style="width: 20%;">Aksi</th>
                      </tr>
                    </thead>


                    <tbody>
                    <?php $no=1; foreach($data as $row){?>
                      <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $row['nama_obat'] ?></td>
                        <td><?= $row['nama_jenis'] ?></td>
                        <td><?= $row['harga_obat'] ?></td>
                        <td><?= $row['stok_obat'] ?></td>
                        <td><?= shortdate_indo($row['tanggal_expired']) ?></td>
                        <td>
                          <button type="submit" class="btn-warning btnedit" data-id="<?= $row['id_obat'] ?>"><i class="fa fa-lg fa-edit"></i> Edit</button>

                          <button type="submit" class="btn-danger btnhapus" data-id="<?= $row['id_obat'] ?>"><i class="fa fa-lg fa-trash"></i> Hapus</button></td>
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

<div id="modal_add" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <form action="<?= base_url()?>obat/insert" method="post">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">Tambah Data Obat</h4>
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="form-horizontal form-label-left">
              <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Nama Obat
                  </label>
                  <div class="col-md-9 col-sm-12">
                    <input type="text" id="a_nama_obat" name="nama_obat" required="required" class="form-control" value="">
                    <input type="hidden" id="a_id_obat" name="id_obat" required="required" class="form-control" value="">
                  </div>
              </div>
              <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Jenis Obat
                  </label>
                  <div class="col-md-9 col-sm-12 ">
                    <select id="a_id_jenis" name="id_jenis" required="required" class="form-control ">
                      <option value="">- Pilih Jenis Obat -</option>
                      <?php $no=1; foreach($jenis as $row_jenis){?>
                        <option value="<?= $row_jenis['id_jenis'] ?>"><?= $row_jenis['nama_jenis'] ?></option>
                      <?php } ?>
                    </select>
                  </div>
              </div>

              <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Harga
                  </label>
                  <div class="col-md-9 col-sm-12 ">
                    <input type="number" id="a_harga_obat" name="harga_obat" required="required" class="form-control" value="">
                  </div>
              </div>

              <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Stok
                  </label>
                  <div class="col-md-9 col-sm-12 ">
                    <input type="number" id="a_stok_obat" name="stok_obat" required="required" class="form-control" value="">
                  </div>
              </div>

              <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Tanggal Expired
                  </label>
                  <div class="col-md-9 col-sm-12 ">
                    <input type="date" id="a_tanggal_expired" name="tanggal_expired" required="required" class="form-control" value="">
                  </div>
              </div>

            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-secondary icon-btn" data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
            <button type="submit" class="btn btn-sm btn-primary icon-btn"><i class="fa fa-save"></i> Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div id="modal_edit" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <form action="<?= base_url()?>obat/update" method="post">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">Edit Data Obat</h4>
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="form-horizontal form-label-left">
              <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Nama Obat
                  </label>
                  <div class="col-md-9 col-sm-12 ">
                    <input type="text" id="e_nama_obat" name="nama_obat" required="required" class="form-control" value="" required>
                    <input type="hidden" id="e_id_obat" name="id_obat" required="required" class="form-control" value="">
                  </div>
              </div>
              <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Jenis Obat
                  </label>
                  <div class="col-md-9 col-sm-12 ">
                    <select id="e_id_jenis" name="id_jenis" required="required" class="form-control ">
                      <option value="">- Pilih Jenis Obat -</option>
                      <?php $no=1; foreach($jenis as $row_jenis){?>
                        <option value="<?= $row_jenis['id_jenis'] ?>"><?= $row_jenis['nama_jenis'] ?></option>
                      <?php } ?>
                    </select>
                  </div>
              </div>

              <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Harga
                  </label>
                  <div class="col-md-9 col-sm-12 ">
                    <input type="number" id="e_harga_obat" name="harga_obat" required="required" class="form-control" value="">
                  </div>
              </div>

              <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Stok
                  </label>
                  <div class="col-md-9 col-sm-12 ">
                    <input type="number" id="e_stok_obat" name="stok_obat" required="required" class="form-control" value="">
                  </div>
              </div>

              <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Tanggal Expired
                  </label>
                  <div class="col-md-9 col-sm-12 ">
                    <input type="date" id="e_tanggal_expired" name="tanggal_expired" required="required" class="form-control" value="">
                  </div>
              </div>

            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-secondary icon-btn" data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
            <button type="submit" class="btn btn-sm btn-primary icon-btn"><i class="fa fa-save"></i> Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
