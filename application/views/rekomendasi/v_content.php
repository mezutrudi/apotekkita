<div class="right_col" role="main">
  <div class="">

    <div class="clearfix"></div>
    
    <div class="row">
      <div class="col-md-8 col-sm-12 ">
        <div class="x_panel">
          <div class="x_title">
            <h2><?= $judul ?></h2>
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

                <div class="dashboard-widget-content">

                  <ul class="list-unstyled timeline widget">
                  <?php foreach($data as $row){?>
                    <li>
                      <div class="block">
                        <div class="block_content">
                          <h2 class="title">
                            <a><?= $row['nama'] ?></a>
                          </h2>
                          <div class="byline">
                            <span><?= shortdate_indo($row['tanggal_rekomendasi']) ?></span> by <?= $row['nama'] ?></a>
                          </div>
                          <p class="excerpt"><?= $row['isi_rekomendasi'] ?>  <a href="rekomendasi/delete/<?= $row['id_rekomendasi'] ?>">Hapus</a>
                          </p>
                        </div>
                      </div>
                    </li>
                  <?php } ?>
                  </ul>
                </div>

                  
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>

  </div>
</div>
