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
                                        <h2>Presensi Pegawai</h2>
                                    </div>
                                    <div class="card-body table-border-style">
                                        <div class="table-responsive">
                                            <table id="multi_col_order" class="table table-striped table-bordered display no-wrap" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">Riwayat</th>
                                                        <th class="text-center">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($cek_presensi as $cp) : ?>
                                                        <?php if ($cp['cek_p'] == 0) { ?>
                                                            <?php if ($cp['p_cek'] == 0) { ?>
                                                                <tr>
                                                                    <td class="text-center align-middle">
                                                                        <?= $cp['riwayat']; ?>
                                                                    </td>
                                                                    <td class="text-center align-middle">
                                                                        <a class="btn waves-effect waves-light btn-primary text-white" href="<?= base_url('pegawai/tambah/' . $cp['id_riwayat']) ?>"> <i class="fa fa-clock"></i> Presensi</a>
                                                                    </td>
                                                                </tr>
                                                            <?php } ?>
                                                        <?php } else { ?>
                                                            <div class="alert alert-success" role="alert">You are Already Presented Before!
                                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                        <?php } ?>
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
                    <!-- End Modal Content -->
                </div>
                <!-- ============================================================== -->
                <!-- End Container fluid  -->
                <!-- ============================================================== -->