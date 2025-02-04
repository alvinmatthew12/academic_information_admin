<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title">Publikasi Informasi Akademik</h4>
            <!-- <p class="card-category">Publikasi Informasi Akademik</p> -->
          </div>
          <div class="card-body">
            <?php if ($this->session->flashdata('success')): ?>
              <div class="alert alert-success" role="alert">
                <?php echo $this->session->flashdata('success'); ?>
              </div>
            <?php endif; ?>

            <?php foreach ($infoakademik as $info): ?>
            <form action="<?php echo base_url('infoakademik/edit/'.$info->pmId);?>" method="POST">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="bmd-label-floating">Judul</label>
                    <input type="text" class="form-control" name="judul" value="<?php echo $info->pmJudul ?>">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Tipe</label>
                    <select class="form-control btn btn-link" name="tipe">
                      <option value="<?php echo $info->pmTppmrId ?>" selected><?php echo $info->tppmrNama ?></option>
                      <option value="1">Informasi Akademik</option>
                      <option value="2">Kegiatan Mahasiswa</option>
                      <option value="3">Seputar Registrasi</option>
                      <option value="4">On Dev</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="bmd-label-floating">Isi</label>  
                    <div class="form-group">
                      <textarea id="isi" class="form-control" rows="10" name="isi">
                        <?php echo $info->pmIsi ?>
                      </textarea>
                    </div>
                  </div>
                </div>
              </div>
              <button type="submit" class="btn btn-primary pull-right">Perbaharui</button>
              <div class="clearfix"></div>
            </form>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>