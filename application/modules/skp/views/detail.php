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

                                  <h4 class="card-title">Tabel SKP</h4>
                                  <h6 class="card-subtitle">Tabel digunakan untuk menampilkan <code>"detail skp pegawai"</code> aplikasi MAPEN.</h6>
                                  <!-- <?php var_dump($skp) ?> -->
                                  <div class="table-responsive">
                                      <?php if ($this->session->userdata('role_id') == '1' || $this->session->userdata('role_id') == '2') { ?>
                                          <div style="padding-top: 15px;">
                                              <?php $id = $this->uri->segment(3, 0); ?>
                                              <button class="btn waves-effect waves-light btn-success">
                                                  <a class="text-white" href="<?= base_url('skp/export_detail/' . $id) ?>"> <i class="fas fa-file-export"></i>&ensp;Export Data</a>
                                              </button>
                                          </div>
                                      <?php } ?>
                                      <table id="order_bulan" class="table table-striped table-bordered display no-wrap" style="width:100%">
                                          <thead class="bg-dark text-white text-center">
                                              <tr>
                                                  <th>User</th>
                                                  <th>Bulan</th>
                                                  <th>Tahun</th>
                                                  <th>Nama SKP</th>
                                                  <th>Jumlah Kegiatan</th>
                                                  <th>Nilai</th>
                                                  <th>Validasi</th>
                                                  <th>Aksi</th>
                                              </tr>
                                          </thead>
                                          <tbody class="text-center">
                                              <?php foreach ($skp as $s) { ?>
                                                  <tr class="text-center">
                                                      <td class="align-middle"><?php echo $s->name ?></td>
                                                      <td class="align-middle"><?php echo $s->nama_bulan ?></td>
                                                      <td class="align-middle"><?php echo $s->tahun ?></td>
                                                      <td class="align-middle"><?php echo $s->nama_skp ?></td>
                                                      <td class="align-middle"><?php echo $s->jml_kegiatan ?></td>
                                                      <td>
                                                          <button class="btn waves-effect waves-light btn-warning">
                                                              <a class="text-white" href="<?= base_url('skp/nilai/' . $s->id_skp) ?>"> <i class="fas fa-tasks"></i>&ensp;Nilai SKP</a>
                                                          </button>
                                                      </td>
                                                      <td class="align-middle">
                                                          <?php if ($s->cek_validasi == 2) { ?>
                                                              Sudah Selesai
                                                          <?php } else if ($s->cek_validasi == 1) { ?>
                                                              Sedang Proses
                                                          <?php } else if ($s->cek_validasi == 0) { ?>
                                                              Belum Mengajukan Nilai
                                                          <?php } ?>
                                                      </td>
                                                      <td>
                                                          <a class="btn waves-effect waves-light btn-success text-white" href="<?= base_url('skp/edit_skp/' . $s->id_skp) ?>"><i class="fa fa-pencil-alt"></i> Edit</a>
                                                          <?php if ($this->session->userdata('role_id') == 1 || $this->session->userdata('role_id') == 2) { ?>
                                                              <a class="btn waves-effect waves-light btn-danger" href="<?= base_url('skp/hapus_skp/' . $s->id_skp) ?>"><i class="fa fa-trash"></i> Hapus</a>
                                                          <?php } ?>
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