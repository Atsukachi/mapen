            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <?= $this->session->flashdata('message'); ?>
                <!-- *************************************************************** -->
                <!-- Start First Cards -->
                <!-- *************************************************************** -->
                <div class="card-group">
                    <div class="card mb-3" style="max-width: 1040px;">
                        <div class="row g-0">
                            <div class="col-md-4 d-flex flex-column align-items-center justify-content-center">
                                <h4 class="card-title font-weight-bold">Foto Profil</h4>
                                <img src="<?= base_url('assets/images/users/') . $user['image']; ?>" class="card-img" style="margin: 10px;max-width: 60%;max-height: 60%;">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body p-3">
                                    <h4 class="card-title font-weight-bold">My Profile</h4>
                                    <table class="table mt-2">
                                        <tr>
                                            <td scope="col">Name</td>
                                            <td scope="col" width="5%">:</td>
                                            <td scope="col"><?= $user['name'] ?></td>
                                        </tr>
                                        <tr>
                                            <td scope="col">Email</td>
                                            <td scope="col" width="5%">:</td>
                                            <td scope="col"><?= $user['email'] ?></td>
                                        </tr>
                                        <tr>
                                            <td scope="col">Alamat</td>
                                            <td scope="col" width="5%">:</td>
                                            <td scope="col"><?= $user['alamat'] ?></td>
                                        </tr>
                                        <tr>
                                            <td scope="col">Phone</td>
                                            <td scope="col" width="5%">:</td>
                                            <td scope="col"><?= $user['telephone'] ?></td>
                                        </tr>
                                        <tr>
                                            <td scope="col">Keahlian / CV</td>
                                            <td scope="col">:</td>
                                            <td scope="col"><?= $user['keahlian'] ?></td>
                                        </tr>
                                    </table>
                                    <a class="btn waves-effect waves-light btn-success text-white" href="<?= base_url('profil/download_file/' . $user['user_id']) ?>"> <i class="fas fa-download"></i> Unduh File</a>
                                </div>
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