            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- *************************************************************** -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <!-- multi-column ordering -->
                <div class="row">
                    <div class="card mb-3">
                        <?= $this->session->flashdata('message'); ?>
                        <div class="card-body">
                            <!-- [ stiped-table ] start -->
                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h2>Tabel Presensi Pegawai</h2>
                                        <h6 class="card-subtitle">Tabel digunakan untuk mengubah <code>"daftar presensi pegawai"</code> aplikasi MAPEN.
                                        </h6>
                                        <?php
                                        //ubah timezone menjadi jakarta
                                        date_default_timezone_set("Asia/Jakarta");

                                        //ambil jam, menit dan detik
                                        $jam = date('H:i:s');

                                        //atur salam menggunakan IF
                                        if ($jam > '05:30:00' && $jam < '10:00:00') {
                                            $salam = 'Pagi';
                                        } elseif ($jam >= '10:00:00' && $jam < '15:00:00') {
                                            $salam = 'Siang';
                                        } elseif ($jam < '18:00:00') {
                                            $salam = 'Sore';
                                        } else {
                                            $salam = 'Malam';
                                        }
                                        ?>
                                    </div>
                                    <div class="card-body table-border-style">
                                        <div class="pb-2">
                                            <?php if ($this->session->userdata('role_id') == '1' || $this->session->userdata('role_id') == '2') { ?>
                                                <div style="padding-top: 15px;">
                                                    <button class="btn waves-effect waves-light btn-success">
                                                        <a class="text-white" href="<?= base_url('skp/export/') ?>"> <i class="fas fa-file-export"></i>&ensp;Export Data</a>
                                                    </button>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <div class="table-responsive">
                                            <table id="multi_col_order" class="table table-striped table-bordered display no-wrap" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">User ID</th>
                                                        <th class="text-center">Nama</th>
                                                        <th class="text-center">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($semuauser as $su) : ?>
                                                        <tr>
                                                            <td class="align-middle text-center"><?= $su['user_id']; ?></td>
                                                            <td class="align-middle text-center"><?= $su['name']; ?></td>
                                                            <td class=" align-middle text-center">
                                                                <a class="btn waves-effect waves-light btn-primary text-white" href="<?= base_url('pegawai/detail/' . $su['user_id']) ?>"> <i class="fa fa-info-circle"></i> Detail</a>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- [ stiped-table ] end -->
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- End Page Content -->
                    <!-- ============================================================== -->
                </div>
                <!-- ============================================================== -->
                <!-- End Container fluid  -->
                <!-- ============================================================== -->

                <!-- Edit modal content -->
                <div id="export-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog d-flex align-items-center">
                        <div class="modal-content p-3">

                            <div class="modal-body">
                                <div class="text-center mt-2 mb-4">
                                    <a href="index.html" class="text-success">
                                        <span><img class="mr-2" src="<?= base_url(); ?>assets/images/logo.png" alt="" height="50"></span>
                                    </a>
                                    <h5 class="mt-3">Export Data</h5>
                                </div>
                                <?php if ($this->session->userdata('role_id') == '1' || $this->session->userdata('role_id') == '2') { ?>
                                    <div class="form-group pl-3">
                                        <button class="btn btn-warning" type="button" onclick="window.open('<?= base_url('pegawai/export'); ?>')"><i class="fas fa-sticky-note"></i> All</button>
                                    </div>
                                <?php } ?>
                                <form class="pl-3 pr-3" action="<?= base_url('pegawai/export'); ?>" method="post">
                                    <div class="form-group">
                                        <label for="username">User Name</label>
                                        <select name="user_id" id="user_id" class="form-control" required>
                                            <optgroup label="Masukkan Pilihan">
                                                <?php foreach ($semuauser as $su) : ?>
                                                    <option value="<?= $su['user_id'] ?>"><?= $su['name'] ?></option>
                                                <?php endforeach ?>
                                            </optgroup>
                                        </select>
                                    </div>
                                    <div class="form-group text-center">
                                        <button class="btn btn-primary" type="submit">Submit</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- End modal content -->