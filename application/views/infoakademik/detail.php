<div class="content">
<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header card-header-primary">
          <h4 class="card-title ">Detail Informasi Akademik</h4>
          <!-- <p class="card-category"> Here is a subtitle for this table</p> -->
        </div>  
        <div class="card-body">
        <?php if ($this->session->flashdata('delete')): ?>
          <div class="alert alert-warning" role="alert">
            <?php echo $this->session->flashdata('delete'); ?>
          </div>
        <?php endif; ?>
          <div class="table-responsive">
            <table class="table" width="100%">
              <?php foreach ($infoakademik as $info): ?>
              <tr>
                <td width="15%" class="text-primary">
                  ID
                </td>
                <td width="85%">
                  <?php echo $info->pmId ?>
                </td>
              </tr>
              <tr>
                <td width="15%" class="text-primary">
                  Tanggal
                </td>
                <td width="85%">
                  <?php echo $info->pmTanggal ?>
                </td>
              </tr>
              <tr>
                <td width="15%" class="text-primary">
                  Judul
                </td>
                <td width="85%">
                  <?php echo $info->pmJudul ?>
                </td>
              </tr>
              <tr>
                <td width="15%" class="text-primary">
                  Tipe
                </td>
                <td width="85%">
                  <?php echo $info->tppmrNama ?>
                </td>
              </tr>
              <tr>
                <td width="15%" class="text-primary">
                  Isi
                </td>
                <td width="85%">
                  <?php echo $info->pmIsi ?>
                </td>
              </tr>
              <?php endforeach; ?>
            </table>
          </div>
          <a href="<?php echo base_url('infoakademik') ?>" class="btn btn-primary pull-right">Kembali</a>
        </div>
      </div>
    </div>
  </div>
</div>
</div>