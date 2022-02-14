              <!-- ============================================================== -->
              <!-- Container fluid  -->
              <!-- ============================================================== -->
              <div class="container-fluid">
                  <!-- *************************************************************** -->
                  <!-- Start Page Content -->
                  <!-- ============================================================== -->
                  <!-- multi-column ordering -->
                  <div class="row">
                      <div class="col-12">
                          <div class="card">
                              <div class="card-body">
                                  <?= $this->session->flashdata('check'); ?>
                                  <?= $this->session->flashdata('message'); ?>

                                  <h4 class="card-title">Tabel Validasi Nilai SKP</h4>
                                  <h6 class="card-subtitle">Tabel digunakan untuk memvalidasi <code>"permintaan nilai skp pegawai"</code> aplikasi MAPEN.
                                  </h6>
                                  <div class="table-responsive">
                                      <table id="order_bulan" class="table table-striped table-bordered display no-wrap" style="width:100%">
                                          <thead class="bg-dark text-white text-center">
                                              <tr>
                                                  <th>User</th>
                                                  <th>Bulan</th>
                                                  <th>Tahun</th>
                                                  <th>Nama SKP</th>
                                                  <th>Jumlah Kegiatan</th>
                                                  <th>Nilai SKP</th>
                                                  <th>Aksi</th>
                                              </tr>
                                          </thead>
                                          <tbody class="text-center">
                                              <?php foreach ($nilai_skp as $ns) { ?>
                                                  <tr class="text-center">
                                                      <td class="align-middle"><?php echo $ns->name ?></td>
                                                      <td class="align-middle"><?php echo $ns->nama_bulan ?></td>
                                                      <td class="align-middle"><?php echo $ns->tahun ?></td>
                                                      <td class="align-middle"><?php echo $ns->nama_skp ?></td>
                                                      <td class="align-middle"><?php echo $ns->jml_kegiatan ?></td>
                                                      <td class="align-middle"><?php echo $ns->nilai ?></td>
                                                      <td>
                                                          <a class="btn waves-effect waves-light btn-warning text-dark" href="<?= base_url('confrimation/detail_nilai/' . $ns->id_skp) ?>"><i class="fas fa-check"></i> Validasi</a>
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
                  <!-- ============================================================== -->
                  <!-- End PAge Content -->
                  <!-- ============================================================== -->
              </div>