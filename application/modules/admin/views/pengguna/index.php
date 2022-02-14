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

                      <?= $this->session->flashdata('message'); ?>

                      <h4 class="card-title">Tabel Data Pengguna</h4>
                      <h6 class="card-subtitle">Tabel digunakan untuk mengubah <code>"data pengguna"</code> aplikasi MAPEN.
                      </h6>
                      <div class="table-responsive">

                        <!-- <a class="btn waves-effect waves-light btn-primary mb-3 mt-2 text-white" data-toggle="modal" data-target="#role-modal"> <i class="fa fa-plus"></i> Add New User</a> -->

                        <table id="multi_col_order" class="table table-striped table-bordered display no-wrap" style="width:100%">
                          <thead class="bg-primary text-white text-center">
                            <tr>
                              <th>No</th>
                              <th>Nama</th>
                              <th>Email</th>
                              <th>Role</th>
                              <th>Foto</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody class="text-center">
                            <?php $i = 1; ?>
                            <?php foreach ($getuser as $u) : ?>
                              <tr>
                                <td class="align-middle"><?= $i++; ?></td>
                                <td class="align-middle"><?= $u['name']; ?></td>
                                <td class="align-middle"><?= $u['email']; ?></td>
                                <td class="align-middle">
                                  <?php if ($u['role_id'] == 1) { ?>
                                    <span class="badge bg-secondary text-white">Developer</span>

                                  <?php } else if ($u['role_id'] == 2) { ?>
                                    <span class="badge bg-info text-white">Atasan</span>

                                  <?php } else { ?>
                                    <span class="badge bg-warning text-white">Pegawai</span>

                                  <?php } ?>
                                </td>
                                <td class="align-middle">
                                  <img src="<?= base_url('assets/images/users/' . $u['image']); ?>" class="img-thumbnail" width="30%">
                                </td>
                                <td class="text-center align-middle">
                                  <?php if ($this->session->userdata('role_id') == '1' || '2') { ?>
                                    <?php
                                    $cek_jam = salam_jam();
                                    $sendpesan = 'Selamat ' . $cek_jam . ', ' . $u['name'] . '!%0ADiharapkan segera menghubungi pimpinan, terimakasih!%0A%0AHormat Kami,%0AAdmin Mapen';
                                    ?>
                                    <button class="btn waves-effect waves-light btn-success" onclick="window.open('<?= 'https://api.whatsapp.com/send?phone=' . $u['telephone'] . '&text=' . $sendpesan . '' ?>', '_blank')">
                                      <i class="fab fa-whatsapp"></i>
                                    </button>
                                  <?php } ?>
                                  <a class="btn waves-effect waves-light btn-warning text-white" href="<?= base_url('admin/DataPengguna/edit_pengguna/' . $u['user_id']) ?>"> <i class="fa fa-edit"></i> Edit</a>
                                  <a class="btn waves-effect waves-light btn-danger text-white" href="<?= base_url('admin/DataPengguna/hapus_pengguna/' . $u['user_id']) ?>"> <i class="fa fa-trash"></i> Delete</a>
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
              <!-- ============================================================== -->
              <!-- End PAge Content -->
              <!-- ============================================================== -->
            </div>
            <!-- Signup modal content -->

            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->