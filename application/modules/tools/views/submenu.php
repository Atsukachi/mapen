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

                                            <h4 class="card-title">Tabel Daftar SubMenu</h4>
                                            <h6 class="card-subtitle">Tabel digunakan untuk mengubah <code>"daftar submenu"</code> aplikasi MAPEN.
                                            </h6>
                                            <div class="table-responsive">

                                                <a class="btn waves-effect waves-light btn-primary mb-3 mt-2 text-white" data-toggle="modal" data-target="#tambah-modal"> <i class="fa fa-plus"></i> Add New SubMenu</a>

                                                <table id="multi_col_order" class="table table-striped table-bordered display no-wrap" style="width:100%">
                                                    <thead class="bg-warning text-white text-center">
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Title</th>
                                                            <th>Menu</th>
                                                            <th>Url</th>
                                                            <th>Icon</th>
                                                            <th>Active</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="text-center">
                                                        <?php $i = 1; ?>
                                                        <?php foreach ($subMenu as $sm) : ?>
                                                            <tr>
                                                                <td class="align-middle"><?= $i++; ?></td>
                                                                <td class="align-middle"><?= $sm['title']; ?></td>
                                                                <td class="align-middle"><?= $sm['menu']; ?></td>
                                                                <td class="align-middle"><?= $sm['url']; ?></td>
                                                                <td class="align-middle"><?= $sm['icon']; ?></td>
                                                                <td class="align-middle"><?= $sm['is_active']; ?></td>
                                                                <td class="text-center">
                                                                    <a class="btn waves-effect waves-light btn-success text-white" href="<?= base_url('tools/edit_Submenu/' . $sm['id']) ?>"> <i class="fa fa-pencil-alt"></i> Edit</a>
                                                                    <a class="btn waves-effect waves-light btn-danger text-white" href="<?= base_url('tools/delete_submenu/' . $sm['id']) ?>"> <i class="fa fa-trash"></i> Delete</a>
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
                            <!-- End Page Content -->
                            <!-- ============================================================== -->
                        </div>
                        <!-- Tambah modal content -->
                        <div id="tambah-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <div class="modal-body">
                                        <div class="text-center mt-2 mb-4">
                                            <a href="index.html" class="text-success">
                                                <span><img class="mr-2" src="<?= base_url(); ?>assets/images/logo.png" alt="" height="50"></span>
                                            </a>
                                            <h5 class="mt-3">Tambah Data SubMenu</h5>
                                        </div>

                                        <form class="pl-3 pr-3" action="<?= base_url('tools/addsubmenu'); ?>" method="post">

                                            <div class="form-group">
                                                <label for="menuname">SubMenu Name</label>
                                                <input class="form-control" type="text" id="title" name="title" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="menuname">Menu Name</label>
                                                <select name="menu_id" id="menu_id" class="form-control chosen" required>
                                                    <option value="">Select Menu</option>
                                                    <?php foreach ($menu as $m) : ?>
                                                        <option value="<?= $m['id'] ?>"><?= $m['menu'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="menuname">SubMenu URL</label>
                                                <input class="form-control" type="text" id="url" name="url" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="menuname">SubMenu Icon</label>
                                                <input class="form-control" type="text" id="icon" name="icon" required>
                                            </div>
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" required id="is_active" name="is_active" value="1" checked>
                                                    <label class="custom-control-label" for="customCheck1">Is
                                                        Active </label>
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
                                            </div>

                                        </form>

                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->
                        <!-- Tambah modal content -->
                        <!-- ============================================================== -->
                        <!-- End Container fluid  -->
                        <!-- ============================================================== -->