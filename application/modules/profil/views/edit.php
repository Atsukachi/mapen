            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- *************************************************************** -->
                <!-- Start First Cards -->
                <!-- *************************************************************** -->
                <div class="card-group">

                    <div class="col-lg-8">
                        <form action="<?= base_url('profil/edit') ?>" method="POST" enctype="multipart/form-data">
                            <div class="form-group row self-items-center pt-3">
                                <label for="email" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10 pt-0">
                                    <input type="text" class="form-control" readonly value="<?= $user['email']; ?>" id="email" name="email">
                                </div>
                            </div>
                            <div class="form-group row self-items-center pt-3">
                                <label for="name" class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm-10 pt-0">
                                    <input type="text" name="name" class="form-control" id="name" name="name" value="<?= $user['name']; ?>" required>
                                    <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="form-group row self-items-center pt-3">
                                <label for="name" class="col-sm-2 col-form-label">Alamat<span class="text-danger">*</span></label>
                                <div class="col-sm-10 pt-0">
                                    <small class="text-muted">Please fill in completely and correctly*</small>
                                    <textarea cols="10" type="text" class="form-control" id="alamat" name="alamat" value="<?= $user['alamat']; ?>"><?= $user['alamat']; ?></textarea>
                                </div>
                            </div>
                            <div class="form-group row self-items-center pt-3">
                                <label for="name" class="col-sm-2 col-form-label">Nomor WA</label>
                                <div class="col-sm-10 pt-0">
                                    <div class="input-group mb-2 mr-sm-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">+62</div>
                                        </div>
                                        <input type="text" name="telephone" class="form-control" id="telephone" value="<?= substr($user['telephone'], 2) ?>">
                                        <?= form_error('telephone', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row self-items-center pt-3">
                                <div class="col-sm-2">Keahlian / CV<span class="text-danger">*</span></div>
                                <div class="col-sm-10 pt-0">
                                    <small class="text-muted">Support only PDF or Word Files*</small>
                                    <input type="file" name="file" id="file" class="form-control pl-0 mb-3" style="border: 0;">
                                    <input type="hidden" name="file_old" id="file_old" class="form-control" style="border: 0;" value="<?= $user['keahlian'] ?>">
                                    <div class="mt-2 mb-2">
                                        <text style="border:0">Current file&nbsp;:&nbsp;
                                            <?php if (!empty($user['keahlian'])) { ?>
                                                <b class="text-primary"><?= $user['keahlian'] ?></b><br>
                                            <?php } else { ?>
                                                <b class="text-primary">-</b><br>
                                            <?php } ?>
                                        </text>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row self-items-center pt-3">
                                <div class="col-sm-2">Picture<span class="text-danger">*</span></div>
                                <div class="col-sm-10 pt-0">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <img src="<?= base_url('assets/images/users/') . $user['image'];  ?>" class="img-thumbnail border-0" alt="">
                                        </div>
                                        <div class="col-sm-9">
                                            <small class="text-muted">Support only JPG, PNG or GIF Files*</small>
                                            <div class="custom-file">
                                                <input type="file" name="image" class="custom-file-input" name="image" id="image">
                                                <label for="image" class="custom-file-label">Pilih Gambar</label>
                                            </div>
                                            <input type="hidden" name="image_old" id="image_old" class="form-control" style="border: 0;" value="<?= $user['image'] ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row justify-content-end">
                                <div class="col-sm-10">
                                    <button type="submit" name="submit" id="submit" class="btn btn-primary btn-block">Edit Profile</button>
                                </div>
                            </div>
                    </div>
                </div>
                <!-- *************************************************************** -->
                <!-- End First Cards -->
                <!-- *************************************************************** -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->