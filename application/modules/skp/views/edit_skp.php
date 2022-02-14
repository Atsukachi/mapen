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
                      <h2><b> Form Edit Pengajuan SKP</b></h2>
                    </div>
                    <div class="card-body">
                      <form action="<?= base_url('skp/editSKP') ?>" method="POST" enctype="multipart/form-data">
                        <input type="hidden" class="form-control" name="id_skp" name="id_skp" value="<?= $skp_edit['id_skp']; ?>">
                        <div class="form-group">
                          <label for="Name">Nama</label>
                          <input type="hidden" readonly class="form-control" name="user_id" name="user_id" value="<?= $skp_edit['user_id']; ?>">
                          <input type="text" readonly class="form-control" name="user" name="user" value="<?= $skp_edit['name']; ?>">
                        </div>
                        <div class="form-group">
                          <label for="Bulan">Month</label>
                          <select name="bulan" id="bulan" class="form-control" required>
                            <option value=""><b>-- Selected Month --</b></option>
                            <option value="<?= $skp_edit['id_bulan']; ?>"><?= $skp_edit['nama_bulan']; ?></option>
                            <option value=""><b>-- Select Month --</b></option>
                            <?php foreach ($bulan as $b) : ?>
                              <option value="<?= $b->id_bulan ?>"><?= $b->nama_bulan ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="Tahun">Year</label>
                          <input id="tahun" name="tahun" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" maxlength="4" class="form-control" value="<?= $skp_edit['tahun']; ?>">
                        </div>
                        <div class="form-group">
                          <label for="Skp">SKP</label>
                          <input id="skp" name="skp" type="text" class="form-control" value="<?= $skp_edit['nama_skp']; ?>">
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