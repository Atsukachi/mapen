            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
              <!-- *************************************************************** -->
              <!-- Start Page Content -->
              <!-- ============================================================== -->
              <!-- multi-column ordering -->
              <div class="row">
                <div class="col-md-7">
                  <div class="card">
                    <div class="card-body">

                      <?= $this->session->flashdata('message'); ?>

                      <h4 class="card-title">Tabel Daftar Riwayat</h4>
                      <h6 class="card-subtitle">Tabel digunakan untuk mengubah <code>"daftar riwayat"</code> aplikasi MAPEN.
                      </h6>
                      <div class="table-responsive">

                        <table id="multi_col_order" class="table table-striped table-bordered display no-wrap" style="width:100%">
                          <thead class="text-center">
                            <tr>
                              <th>ID Riwayat</th>
                              <th>Nama Riwayat</th>
                              <th>Status</th>
                              <th>Aksi</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php foreach ($riwayat as $r) { ?>
                              <tr class="text-center">
                                <td class="align-middle"><?php echo $r->id_riwayat ?></td>
                                <td class="align-middle"><?php echo $r->riwayat ?></td>
                                <td class="align-middle"><?php echo $r->status_id ?></td>
                                <td>
                                  <a class="btn waves-effect waves-light btn-success text-white" data-toggle="modal" data-target="#edit-modal<?php echo $r->id_riwayat; ?>"> <i class="fa fa-pencil-alt"></i> Edit</a>
                                  <a href="<?= base_url('table/hapus_riwayat/' . $r->id_riwayat) ?>" class="btn btn-small btn-danger"><i class="fa fa-trash"></i> Hapus</a>
                                </td>
                              </tr>
                            <?php } ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-5">
                  <div class="card">
                    <div class="card-header">Form Tambah Riwayat Presensi</div>
                    <div class="card-body">
                      <form action="<?= base_url('table/tambah_riwayat') ?>" method="post">
                        <div class="form-group">
                          <label for="">Nama Riwayat</label>
                          <input type="text" class="form-control" name="riwayat" placeholder="Nama Riwayat">
                        </div>
                        <div class="form-group">
                          <label for="menuname">Status ID</label>
                          <select name="status_id" id="status_id" class="form-control chosen" required>
                            <option value="">Select Menu</option>
                            <?php foreach ($status as $s) : ?>
                              <option value="<?= $s['id_status'] ?>"><?= $s['status'] ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                        <div class="form-group">
                          <button type="submit" class="btn btn-block btn-primary">Selesai</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Signup modal content -->
              <!-- Edit modal content -->
              <?php
              $i = 0;
              foreach ($riwayat as $r) : $i++; ?>
                <div id="edit-modal<?php echo $r->id_riwayat ?>" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">

                      <div class="modal-body">
                        <div class="text-center mt-2 mb-4">
                          <a href="index.html" class="text-success">
                            <span><img class="mr-2" src="<?= base_url(); ?>assets/images/logo.png" alt="" height="50"></span>
                          </a>
                          <h5 class="mt-3">Edit Data Riwayat Presensi</h5>
                        </div>

                        <form class="pl-3 pr-3" action="<?= base_url('table/edit_riwayat'); ?>" method="post">

                          <div class="form-group">
                            <label for="riwayatname">Riwayat Name</label>
                            <input class="form-control" type="hidden" id="id_riwayat" value="<?= $r->id_riwayat; ?>" name="id_riwayat">
                            <input class="form-control" type="text" id="categories" value="<?= $r->riwayat; ?>" name="categories" required>
                          </div>
                          <div class="form-group">
                            <label for="statusid">Status ID</label>
                            <select name="status_id" id="status_id" class="form-control" required>
                              <option value=""><b>-- Selected Menu --</b></option>
                              <option value="<?= $r->status_id; ?>"><?= $r->status; ?></option>
                              <option value="">-- Select Menu --</option>
                              <?php foreach ($status as $s) : ?>
                                <option value="<?= $s['id_status'] ?>"><?= $s['status'] ?></option>
                              <?php endforeach; ?>
                            </select>
                          </div>
                      </div>
                      <div class="form-group text-center">
                        <button class="btn btn-primary" type="submit">Submit</button>
                      </div>
                      </form>
                    </div>
                  </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            <?php endforeach; ?>
            <!-- ============================================================== -->
            <!-- End PAge Content -->
            <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->