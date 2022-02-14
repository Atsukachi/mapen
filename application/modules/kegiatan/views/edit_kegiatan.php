            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
              <!-- *************************************************************** -->
              <!-- Start Page Content -->
              <!-- ============================================================== -->
              <!-- multi-column ordering -->
              <div class="row">
                <div class="col-md-10">
                  <!-- Form -->
                  <div class="card mb-3">
                    <div class="card-header">
                      <h2><b> Form Edit Kegiatan</b></h2>
                    </div>
                    <div class="card-body">
                      <form action="<?= base_url('kegiatan/editKegiatan') ?>" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                          <label for="Nama">Kode Kegiatan</label>
                          <input type="hidden" readonly class="form-control" name="id" value="<?php echo $kegiatan_edit->id ?>">
                          <input type="text" readonly class="form-control" name="kegiatan_id" value="<?php echo $kegiatan_edit->kegiatan_id ?>">
                        </div>
                        <div class="form-group">
                          <label for="UnitKerja">Unit Kerja</label>
                          <select name="unit_kerja" id="unit_kerja" class="form-control" required>
                            <option value="" class="font-weight-bold">-- Selected Unit Kerja --</option>
                            <option value="<?= $kegiatan_edit->unitkerja ?>"><?= $kegiatan_edit->nama_unit_kerja ?></option>
                            <option value="" class="font-weight-bold">-- Select Unit Kerja --</option>
                            <?php foreach ($unit_kerja as $uk) : ?>
                              <option value="<?= $uk->id_unit_kerja ?>"><?= $uk->nama_unit_kerja ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="Uraian">Uraian Pekerjaan</label>
                          <textarea name="uraian" style="height: 250px;" class="form-control" placeholder="Isikan uraian..."><?= $kegiatan_edit->uraian ?></textarea>
                        </div>
                        <div class="form-group">
                          <label for="Name">Nama</label>
                          <input type="hidden" readonly class="form-control" name="user" value="<?= $user['user_id']; ?>">
                          <input type="text" readonly class="form-control" value="<?= $user['name']; ?>">
                        </div>
                        <div class="form-group">
                          <label for="Tanggal">Tanggal</label>
                          <input type="datetime-local" class="form-control" name="tanggal" min="<?= date('Y-m-d\TH:i:s') ?>" value="<?= date('Y-m-d\TH:i:s') ?>" required>
                        </div>
                        <div class="form-group">
                          <label for="File">File*</label>
                          <input type="file" name="file" id="file" class="form-control pl-0 mb-3" style="border: 0;">
                          <input type="hidden" name="file_old" id="file_old" class="form-control" style="border: 0;" value="<?= $kegiatan_edit->file ?>">
                          <text style="border:0" class="form-control pl-0">Current file&nbsp;:&nbsp;
                            <b class="text-primary"><?= $kegiatan_edit->file ?></b>
                          </text>
                          <?php if ($this->session->userdata('role_id') == 1 || $this->session->userdata('role_id') == 2) { ?>
                            <a class="btn waves-effect waves-light btn-success text-white" href="<?= base_url('kegiatan/download_file/' . $kegiatan_edit->id) ?>"> <i class="fas fa-download"></i> Download</a>
                          <?php } ?>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Update Harian</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>

              <!-- ============================================================== -->
              <!-- End PAge Content -->
              <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->