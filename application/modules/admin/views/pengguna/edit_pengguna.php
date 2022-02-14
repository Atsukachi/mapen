            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
              <!-- *************************************************************** -->
              <!-- Start Page Content -->
              <!-- ============================================================== -->
              <!-- multi-column ordering -->
              <form action="<?= base_url('admin/DataPengguna/update_pengguna') ?>" method="POST" enctype="multipart/form-data">
                <div class="row">
                  <div class="col-md-7">
                    <!-- Form -->
                    <div class="card mb-3">
                      <div class="card-header">
                        <h2><b> Form Edit Pengguna</b></h2>
                      </div>

                      <div class="card-body">

                        <div class="form-group">
                          <label for="Nama">Nama</label>
                          <input type="hidden" class="form-control" name="id" value="<?= $edit_id->user_id ?>">
                          <input type="text" class="form-control" name="name" value="<?= $edit_id->name ?>">

                        </div>
                        <div class="form-group">
                          <label for="Nama">Email</label>
                          <input type="text" class="form-control" name="email" value="<?= $edit_id->email ?>" readonly>

                        </div>
                        <div class="form-group">
                          <label for="kategori">Pilih Role</label>
                          <select name="role_id" id="role_id" class="form-control chosen" required>
                            <optgroup label="Terpilih">
                              <option value="<?= $edit_id->role_id ?>">
                                <?php if ($edit_id->role_id == 1) {
                                  echo "Administrator";
                                } else if ($edit_id->role_id == 2) {
                                  echo "Atasan";
                                } else if ($edit_id->role_id == 3) {
                                  echo "Pegawai";
                                }
                                ?>
                              </option>
                            </optgroup>
                            <optgroup label="Masukkan Pilihan">
                              <?php foreach ($getuser as $u) : ?>
                                <option value="<?= $u->role_id ?>">
                                  <?php if ($u->role_id == 1) {
                                    echo "Administrator";
                                  } else if ($u->role_id == 2) {
                                    echo "Atasan";
                                  } else {
                                    echo "Pegawai";
                                  } ?>
                                </option>
                              <?php endforeach ?>
                            </optgroup>
                          </select>
                        </div>

                        <div class="form-group row">
                          <div class="col-sm-2 mb-3">Gambar*</div>
                          <div class="col-sm-12">
                            <div class="row">
                              <div class="col-sm-3">
                                <img src="<?= base_url('assets/images/users/') . $edit_id->image;  ?>" class="img-thumbnail" alt="">
                              </div>
                              <div class="col-sm-9 mt-5">
                                <div class="custom-file">
                                  <input type="hidden" name="image_old" id="image_old" class="form-control" style="border: 0;" value="<?= $edit_id->image ?>">
                                  <input type="file" name="image" class="custom-file-input" id="image">
                                  <label for="image" class="custom-file-label">Pilih Gambar</label>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Update User</button>
                      </div>



                    </div>
                  </div>
                  <div class="col-md-5">
                    <div class="card mb-3">
                      <div class="card-header">
                        <h2><b>Ubah Password</b></h2>
                      </div>
                      <div class="card-body">
                        <div class="card bg-warning text-white mb-1 shadow">
                          <div class="card-body">
                            Kosongkan jika tidak ingin merubah!
                          </div>
                        </div>
                      </div>
                      <div class="card-body">
                        <div class="form-group">
                          <label for="new_password1">New Password</label>

                          <!-- Old Password -->
                          <input name="oldpwd" type="hidden" value="<?= $edit_id->password ?>">

                          <input class="form-control" type="password" id="new_password1" name="new_password1" placeholder="">
                        </div>
                        <div class="form-group">
                          <label for="new_password1">Repeat Password</label>
                          <input class="form-control" type="password" id="new_password2" name="new_password2" placeholder="">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </form>

              <!-- ============================================================== -->
              <!-- End PAge Content -->
              <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->