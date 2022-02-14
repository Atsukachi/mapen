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

                                <h4 class="card-title">Tabel Role Users</h4>
                                <h6 class="card-subtitle">Tabel digunakan untuk mengubah <code>"jenis akun pengguna"</code> aplikasi MAPEN.
                                </h6>
                                <div class="table-responsive">

                                    <a class="btn waves-effect waves-light btn-primary mb-3 mt-2 text-white" data-toggle="modal" data-target="#role-modal"> <i class="fa fa-plus"></i> Add New Role</a>

                                    <table id="multi_col_order" class="table table-striped table-bordered display no-wrap" style="width:100%">
                                        <thead class="bg-danger text-white text-center">
                                            <tr>
                                                <th>#</th>
                                                <th>Role</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-center">
                                            <?php $i = 1; ?>
                                            <?php foreach ($role as $r) : ?>
                                                <tr>
                                                    <td class="align-middle"><?= $i++; ?></td>
                                                    <td class="align-middle"><?= $r['role']; ?></td>
                                                    <td class="text-center">
                                                        <a class="btn waves-effect waves-light btn-warning text-white" href="<?= base_url('admin/roleAccess/' . $r['id']) ?>"> <i class="fa fa-pencil-alt"></i> Role Access</a>
                                                        <a class="btn waves-effect waves-light btn-danger text-white" href="<?= base_url('admin/delete_role/' . $r['id']) ?>"> <i class="fa fa-trash"></i> Delete</a>
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
            <div id="role-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-body">
                            <div class="text-center mt-2 mb-4">
                                <a href="<?= base_url('admin') ?>" class="text-success">
                                    <span><img class="mr-2" src="<?= base_url(); ?>assets/images/logo.png" alt="" height="50"></span>
                                </a>
                                <h5 class="mt-3">Tambah Role User</h5>
                            </div>

                            <form class="pl-3 pr-3" action="<?= base_url('Admin/addrole'); ?>" method="post">

                                <div class="form-group">
                                    <label for="menuname">Role Users</label>
                                    <input class="form-control" type="text" id="role" name="role" required>
                                </div>

                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" required id="customCheck1">
                                        <label class="custom-control-label" for="customCheck1">I
                                            accept <a href="#">Terms and Conditions</a></label>
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
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->