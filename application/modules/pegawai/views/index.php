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
                                                <button class="btn waves-effect waves-light btn-success">
                                                    <a class="text-white" href="<?= base_url('skp/export/') ?>"> <i class="fas fa-file-export"></i>&ensp;Export Data</a>
                                                </button>
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