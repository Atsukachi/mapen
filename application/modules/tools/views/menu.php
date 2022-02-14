            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- *************************************************************** -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <!-- multi-column ordering -->
                <div class="row">
                    <div class="col-md-7">
                        <div class="card">
                            <div class="card-body">

                                <?= $this->session->flashdata('message'); ?>

                                <h4 class="card-title">Tabel Daftar Menu</h4>
                                <h6 class="card-subtitle">Tabel digunakan untuk mengubah <code>"daftar menu"</code> aplikasi MAPEN.
                                </h6>
                                <div class="table-responsive">

                                    <table id="multi_col_order" class="table table-striped table-bordered display no-wrap" style="width:100%">
                                        <thead class="text-center bg-danger text-white">
                                            <tr>
                                                <th>#</th>
                                                <th>Menu</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-center">
                                            <?php $i = 1; ?>
                                            <?php foreach ($menu as $m) : ?>
                                                <tr>
                                                    <td class="align-middle"><?= $i++; ?></td>
                                                    <td class="align-middle"><?= $m['menu']; ?></td>
                                                    <td class="text-center">
                                                        <a class="btn waves-effect waves-light btn-success text-white" data-toggle="modal" data-target="#edit-modal<?php echo $m['id']; ?>"> <i class="fa fa-pencil-alt"></i> Edit</a>
                                                        <a class="btn waves-effect waves-light btn-warning text-white" href="<?= base_url('tools/delete_menu/' . $m['id']) ?>"> <i class="fa fa-trash"></i> Delete</a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="card">
                            <div class="card-header">Form Tambah Menu</div>
                            <div class="card-body">
                                <form action="<?= base_url('tools/addmenu') ?>" method="post">
                                    <div class="form-group">
                                        <label for="menuname">Menu Name</label>
                                        <input class="form-control" type="text" id="menu" name="menu" required>
                                        <br>
                                        <button type="submit" class="btn btn-block btn-primary">Selesai</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Page Content -->
                <!-- ============================================================== -->
            </div>
            <!-- Edit modal content -->
            <?php
            $i = 0;
            foreach ($menu as $m) : $i++; ?>
                <div id="edit-modal<?php echo $m['id']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog d-flex align-items-center">
                        <div class="modal-content p-3">

                            <div class="modal-body">
                                <div class="text-center mt-2 mb-4">
                                    <a href="index.html" class="text-success">
                                        <span><img class="mr-2" src="<?= base_url(); ?>assets/images/logo.png" alt="" height="50"></span>
                                    </a>
                                    <h5 class="mt-3">Edit Data Menu</h5>
                                </div>

                                <form class="pl-3 pr-3" action="<?= base_url('tools/edit_menu'); ?>" method="post">

                                    <div class="form-group">
                                        <label for="menuname">Menu Name</label>
                                        <input class="form-control" type="hidden" id="id" value="<?= $m['id']; ?>" name="id">
                                        <input class="form-control" type="text" id="menu" value="<?= $m['menu']; ?>" name="menu" required>
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
            <?php endforeach; ?>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->