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

                                  <h4 class="card-title">Tabel Kegiatan Harian</h4>
                                  <h6 class="card-subtitle">Tabel digunakan untuk mengubah <code>"daftar kegiatan pegawai"</code> aplikasi MAPEN.
                                  </h6>
                                  <div class="table-responsive">
                                      <?php if (!$user['role_id'] = 1) { ?>
                                          <a class="btn waves-effect waves-light btn-primary mb-3 mt-2 text-white">
                                              <i class="fa fa-plus"></i> Add New Kegiatan Harian</a>
                                      <?php } ?>
                                      <?php if ($this->session->userdata('role_id') == '1' || $this->session->userdata('role_id') == '2') { ?>
                                          <div style="padding-top: 15px;">
                                              <?php $id = $this->uri->segment(3, 0); ?>
                                              <button class="btn waves-effect waves-light btn-success">
                                                  <a class="text-white" href="<?= base_url('kegiatan/export_detail/' . $id) ?>"> <i class="fas fa-file-export"></i>&ensp;Export Data</a>
                                              </button>
                                          </div>
                                      <?php } ?>
                                      <table id="multi_col_order" class="table table-striped table-bordered display no-wrap" style="width:100%">
                                          <thead class="bg-dark text-white text-center">
                                              <tr>
                                                  <th>Kegiatan ID</th>
                                                  <th>Unit Kerja</th>
                                                  <th>Uraian</th>
                                                  <th>SKP</th>
                                                  <?php if ($user['role_id'] = 1) { ?>
                                                      <th>User ID</th>
                                                  <?php } ?>
                                                  <th>Tanggal</th>
                                                  <th style="width: 20%;">File</th>
                                                  <?php if ($this->session->userdata('role_id') == 1 || $this->session->userdata('role_id') == 2) { ?>
                                                      <th>Action</th>
                                                  <?php } ?>
                                              </tr>
                                          </thead>
                                          <tbody class="text-center">
                                              <?php $i = 1; ?>
                                              <?php foreach ($keg as $kg) : ?>
                                                  <tr>
                                                      <?php
                                                        date_default_timezone_set("Asia/Jakarta");
                                                        $milis = $kg->tanggal / 1000;
                                                        $waktu = date("H:i:s", $milis);
                                                        $tanggal = date("Y-m-d", $milis);
                                                        $tgl = tgl_indo($tanggal);
                                                        ?>
                                                      <td class="align-middle"><?= $kg->kegiatan_id ?></td>
                                                      <td class="align-middle">
                                                          <?php foreach ($unit_kerja as $uk) : ?>
                                                              <?php if ($uk['id_unit_kerja'] == $kg->unitkerja) { ?>
                                                                  <?= $uk['nama_unit_kerja']; ?>
                                                              <?php } ?>
                                                          <?php endforeach; ?>
                                                      </td>
                                                      <td class="align-middle"><?= word_limiter($kg->uraian, 8); ?>
                                                      <td class="align-middle">
                                                          <?php if ($kg->skp != 0) { ?>
                                                              <?= word_limiter($kg->nama_skp, 8); ?>
                                                          <?php } else { ?>
                                                              Tidak Termasuk SKP
                                                          <?php } ?>
                                                      </td>
                                                      <?php if ($user['role_id'] = 1) { ?>
                                                          <td class="align-middle">
                                                              <?= $kg->user ?>
                                                          </td>
                                                      <?php } else { ?>
                                                          <td class="align-middle">
                                                              <?= $kg->user ?>
                                                          </td>
                                                      <?php } ?>
                                                      <td class="align-middle"><?= $tgl . ', ' . $waktu; ?></td>
                                                      <td class="align-middle">
                                                          <?php
                                                            if ($kg->file_categories == '1') { ?>
                                                              <img src="<?= base_url('assets/document/kegiatan/photo/' . $kg->file); ?>" class='img-thumbnail' alt=''>
                                                          <?php } else if ($kg->file_categories == '2') { ?>
                                                              <i class='fas fa-fw fa-video' style='font-size:80px; color:purple;'></i>
                                                          <?php } else if ($kg->file_categories == '3') { ?>
                                                              <i class='fas fa-fw fa-file-word' style='font-size:80px; color:blue;'></i>
                                                          <?php } else if ($kg->file_categories == '4') { ?>
                                                              <i class='fas fa-fw fa-file-excel' style='font-size:80px; color:green;'></i>
                                                          <?php } else if ($kg->file_categories == '5') { ?>
                                                              <i class='fas fa-fw fa-file-powerpoint' style='font-size:80px; color:orange;'></i>
                                                          <?php } else if ($kg->file_categories == '6') { ?>
                                                              <i class='fas fa-fw fa-file-pdf' style='font-size:80px; color:red;'></i>
                                                          <?php } else if ($kg->file_categories == '7') { ?>
                                                              <i class='fas fa-fw fa-file-archive' style='font-size:80px; color:yellow;'></i>
                                                          <?php } ?>
                                                      </td>
                                                      <?php if ($this->session->userdata('role_id') == 1 || $this->session->userdata('role_id') == 2) { ?>
                                                          <td class="align-middle">
                                                              <a class="btn waves-effect waves-light btn-success text-white" href="<?= base_url('kegiatan/edit_kegiatan/' . $kg->id) ?>"> <i class="fa fa-pencil-alt"></i> Edit</a>
                                                              <a class="btn waves-effect waves-light btn-danger text-white" href="<?= base_url('kegiatan/hapus_kegiatan/' . $kg->id) ?>"> <i class="fa fa-trash"></i> Delete</a>
                                                          </td>
                                                      <?php } ?>
                                                  </tr>
                                              <?php endforeach; ?>
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