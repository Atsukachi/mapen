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

                    <h4 class="card-title">Edit Daftar SubMenu</h4>
                    <h6 class="card-subtitle">Tabel digunakan untuk mengubah <code>"daftar submenu"</code> aplikasi MAPEN.
                    </h6>
                    <form class="pl-3 pr-3 mt-5" action="<?= base_url('tools/ubah_Submenu'); ?>" method="post">

                        <div class="form-group">
                            <label for="menuname">SubMenu Name</label>
                            <input class="form-control" type="hidden" id="id" value="<?= $data_edit->id; ?>" name="id">
                            <input class="form-control" type="text" id="title" value="<?= $data_edit->title; ?>" name="title" required>
                        </div>
                        <div class="form-group">
                            <label for="menuname">Menu Name</label>
                            <select name="menu_id" id="menu_id" class="form-control" required>
                                <option value=""><b>-- Selected Menu --</b></option>
                                <option value="<?= $data_edit->menu_id; ?>"><?= $data_edit->menu; ?></option>
                                <option value="">-- Select Menu --</option>
                                <?php foreach ($menu as $m) : ?>
                                    <option value="<?= $m['id'] ?>"><?= $m['menu'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="menuname">SubMenu URL</label>
                            <input class="form-control" type="text" id="url" value="<?= $data_edit->url; ?>" name="url" required>
                        </div>
                        <div class="form-group">
                            <label for="menuname">SubMenu Icon</label>
                            <input class="form-control" type="text" id="icon" value="<?= $data_edit->icon; ?>" name="icon" required>
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
                    </form>
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