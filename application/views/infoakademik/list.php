<div class="content">
<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header card-header-primary">
          <h4 class="card-title ">Daftar Informasi Akademik</h4>
          <!-- <p class="card-category"> Here is a subtitle for this table</p> -->
        </div>  
        <div class="card-body">
        <?php if ($this->session->flashdata('delete')): ?>
          <div class="alert alert-warning" role="alert">
            <?php echo $this->session->flashdata('delete'); ?>
          </div>
        <?php endif; ?>
        <?php if ($this->session->flashdata('success')): ?>
          <div class="alert alert-success" role="alert">
            <?php echo $this->session->flashdata('success'); ?>
          </div>
        <?php endif; ?>
        <?php if ($this->session->flashdata('edit')): ?>
          <div class="alert alert-success" role="alert">
            <?php echo $this->session->flashdata('edit'); ?>
          </div>
        <?php endif; ?>
          <div class="table-responsive">
            <table class="table" id="myTable" width="100%">
              <thead class=" text-primary">
                <th width="5%">
                  ID
                </th>
                <th width="15%">
                  Tanggal
                </th>
                <th width="45%">
                  Judul
                </th>
                <th width="20%">
                  Tipe
                </th>
                <th width="25%">
                  Aksi
                </th>
              </thead>
              <tbody>
                <?php foreach ($infoakademik as $info): ?>
                <tr>
                  <td width="5%">
                    <?php echo $info->pmId ?>
                  </td>
                  <td width="15%">
                    <?php echo $info->pmTanggal ?>
                  </td>
                  <td width="45%">
                    <?php echo $info->pmJudul ?>
                  </td>
                  <td width="20%">
                    <?php echo $info->tppmrNama ?>
                  </td>
                  <td width="25%">
                    <a href="<?php echo base_url('infoakademik/detail/'.$info->pmId) ?>" class="btn-small text-success mr-3"><i class="fa fa-info-circle"></i> Info</a>
                    <a onclick="deleteConfirm('<?php echo base_url('infoakademik/delete/'.$info->pmId) ?>')"
                       href="#!" class="btn-small text-danger"><i class="fa fa-trash"></i> Hapus</a>
                  </td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>