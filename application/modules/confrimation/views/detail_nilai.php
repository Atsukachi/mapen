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
                  <div class="alert alert-warning" role="alert">
                    <i class="fas fa-exclamation-circle"></i> Permintaan Nilai SKP akan keluar pada <strong>"awal bulan setelahnya sejak Pengajuan SKP"<strong>.
                  </div>
                  <!-- Form -->
                  <div class="card mb-3">
                    <div class="card-header">
                      <h2><b> Form Validasi Nilai SKP</b></h2>
                    </div>
                    <div class="card-body">
                      <form action="<?= base_url('confrimation/validasi_nilai') ?>" method="POST" enctype="multipart/form-data">
                        <?php foreach ($detail_nilai as $dn) : ?>
                          <div class="form-group">
                            <label for="nama_skp">Nama SKP</label>
                            <input type="hidden" readonly class="form-control" id="id_skp" name="id_skp" value="<?= $dn['id_skp']  ?>">
                            <input type="text" readonly class="form-control" id="nama_skp" name="nama_skp" value="<?= $dn['nama_skp'] ?>">
                          </div>
                          <div class="form-group">
                            <label for="nilai">Nilai <small class="text-muted">*isikan angka 1 - 100</small></label>
                            <?php if ($dn['cek_validasi'] == 1) { ?>
                              <input id="nilai" name="nilai" value="<?= $dn['nilai'] ?>" type="number" class="form-control">
                            <?php } ?>
                          </div>
                          <div class="form-group">
                            <label for="cek_validasi">Status SKP</label>
                            <input id="cek_validasi" readonly name="cek_validasi" type="hidden" class="form-control" value="<?= $dn['cek_validasi'] ?>">
                            <?php if ($dn['cek_validasi'] == 2) { ?>
                              <input id="cek_validasi" readonly name="cek_validasi" type="text" class="form-control" value="Sudah Selesai">
                            <?php } else if ($dn['cek_validasi'] == 1) { ?>
                              <input id="cek_validasi" readonly name="cek_validasi" type="text" class="form-control" value="Sedang Proses">
                            <?php } else if ($dn['cek_validasi'] == 0) { ?>
                              <input id="cek_validasi" readonly name="cek_validasi" type="text" class="form-control" value="Belum Mengajukan Nilai">
                            <?php } ?>
                          </div>
                          <?php if ($dn['cek_validasi'] == 1) { ?>
                            <button type=" submit" class="btn btn-primary btn-block">Submit</button>
                          <?php } ?>
                        <?php endforeach ?>
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