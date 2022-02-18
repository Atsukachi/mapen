            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- *************************************************************** -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <!-- multi-column ordering -->
                <div class="row">
                    <div class="col-md">
                        <div class="card">
                            <div class="card-body">

                                <?= $this->session->flashdata('message'); ?>

                                <h4 class="card-title">Tabel Daftar File</h4>
                                <h6 class="card-subtitle">Tabel digunakan untuk mengubah <code>"daftar file"</code> aplikasi MAPEN.
                                </h6>
                                <div class="table-responsive">

                                    <table id="multi_col_order" class="table table-striped table-bordered display no-wrap" style="width:100%">
                                        <thead class="text-center">
                                            <tr>
                                                <th>No</th>
                                                <th>Nama File</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1; ?>
                                            <?php foreach ($file as $fl) { ?>
                                                <tr class="text-center">
                                                    <td class="align-middle"><?php echo $no++; ?></td>
                                                    <td class="align-middle"><?php echo $fl->extension ?></td>
                                                    <td>
                                                        <a class="btn waves-effect waves-light btn-success text-white" data-toggle="modal" data-target="#edit-modal<?php echo $fl->file_id; ?>"> <i class="fa fa-pencil-alt"></i> Edit</a>
                                                        <a href="<?= base_url('table/hapus_file/' . $fl->file_id) ?>" class="btn btn-small btn-danger"><i class="fa fa-trash"></i> Hapus</a>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="card">
                            <div class="card-header">Form Tambah File Presensi</div>
                            <div class="card-body">
                                <form action="<?= base_url('table/tambah_file') ?>" method="post">
                                    <div class="form-group">
                                        <label for="">Nama File</label>
                                        <input type="text" class="form-control" name="extension" placeholder="Nama File">
                                        <br>
                                        <button type="submit" class="btn btn-block btn-primary">Selesai</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Signup modal content -->
                <!-- Edit modal content -->
                <?php
                $i = 0;
                foreach ($file as $fl) : $i++; ?>
                    <div id="edit-modal<?php echo $fl->file_id ?>" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <div class="modal-body">
                                    <div class="text-center mt-2 mb-4">
                                        <a href="index.html" class="text-success">
                                            <span><img class="mr-2" src="<?= base_url(); ?>assets/images/logo.png" alt="" height="50"></span>
                                        </a>
                                        <h5 class="mt-3">Edit Data File</h5>
                                    </div>

                                    <form class="pl-3 pr-3" action="<?= base_url('table/edit_file'); ?>" method="post">

                                        <div class="form-group">
                                            <label for="filename">File Name</label>
                                            <input class="form-control" type="hidden" id="file_id" value="<?= $fl->file_id; ?>" name="file_id">
                                            <input class="form-control" type="text" id="extension" value="<?= $fl->extension; ?>" name="extension" required>
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
            <!-- End PAge Content -->
            <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->