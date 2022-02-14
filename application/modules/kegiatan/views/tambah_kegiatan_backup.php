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
                      <h2><b> Form Kegiatan Harian</b></h2>
                    </div>
                    <div class="card-body">
                      <?= $this->session->flashdata('message'); ?>
                      <form action="<?= base_url('kegiatan/addKegiatan') ?>" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                          <label for="Nama">Kode Kegiatan</label>
                          <input type="text" readonly class="form-control" name="kegiatan_id" value="<?php echo $kegiatan_id ?>">
                        </div>
                        <div class="form-group">
                          <label for="skp_id">SKP</label>
                          <select name="skp_id" id="skp_id" class="form-control" required>
                            <optgroup label="Masukkan Pilihan">
                              <?php foreach ($skp as $s) : ?>
                                <option value="<?= $s['id_skp'] ?>"><?= $s['nama_skp'] ?></option>
                              <?php endforeach ?>
                              <option value="0">Tidak Termasuk SKP</option>
                            </optgroup>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="unit_kerja">Unit Kerja</label>
                          <select name="unit_kerja" id="unit_kerja" class="form-control" required>
                            <optgroup label="Masukkan Pilihan">
                              <?php foreach ($unit_kerja as $uk) : ?>
                                <option value="<?= $uk['id_unit_kerja'] ?>"><?= $uk['nama_unit_kerja'] ?></option>
                              <?php endforeach ?>
                            </optgroup>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="Uraian">Uraian Pekerjaan</label>
                          <textarea name="uraian" style="height: 250px;" class="form-control"></textarea>
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
                          <input required type="file" name="file" class="form-control" style="border: 0;">
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Submit</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>

              <!-- ============================================================== -->
              <!-- End Page Content -->
              <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->