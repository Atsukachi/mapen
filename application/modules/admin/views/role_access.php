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


                                <h2 class="card-title">Menu & Access</h2>
                                <h4 class="card-title mt-2 mb-2">Role : <?= $role['role'] ?></h4>
                                <h6 class="card-subtitle">Tabel digunakan untuk mengubah <code>"jenis akun pengguna"</code> aplikasi MAPEN.
                                    <div class="table-responsive">

                                        <table id="multi_col_order" class="table table-striped table-bordered display no-wrap" style="width:100%">
                                            <thead class="bg-primary text-white text-center">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Menu</th>
                                                    <th>Access</th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-center">
                                                <?php $i = 1; ?>
                                                <?php foreach ($menu as $m) : ?>
                                                    <tr>
                                                        <td><?= $i++; ?></td>
                                                        <td><?= $m['menu']; ?></td>
                                                        <td class="text-center">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" <?= check_access($role['id'], $m['id']); ?> data-role="<?= $role['id']; ?>" data-menu="<?= $m['id']; ?>">
                                                            </div>
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
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->