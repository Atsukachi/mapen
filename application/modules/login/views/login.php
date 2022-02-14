        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center position-relative" style="background:url(<?= base_url('assets/') ?>images/bg-auth.png) no-repeat center center;">
            <div class="auth-box row" style="max-width:650px;">
                <div class="col-lg-12 col-md-7 mx-auto">
                    <div class="p-3">
                        <div class="text-center">
                            <img src="<?= base_url('assets/') ?>images/logo.png" style="max: width 70px;max-height: 70px;" alt="wrapkit">
                        </div>
                        <?= $this->session->flashdata('message'); ?>
                        <h2 class="mt-3 text-center font-weight-bold" style="font-family:'Montserrat', sans-serif">Form Sign In Account</h2>
                        <p class="text-center">Enter your email address and password to access admin panel.</p>
                        <form class="mt-4" method="post" action="<?= base_url('login') ?>">
                            <div class="row">
                                <div class="col-lg-9 mx-auto">
                                    <div class="form-group">
                                        <label class="text-dark" for="uname">Email</label>
                                        <input class="form-control" id="email" name="email" type="email" placeholder="Enter your username" value="<?= set_value('email'); ?>" style="border-radius: 75px;">
                                        <?= form_error('email', '<small class="text-danger pl-2">', '</small>'); ?>
                                    </div>
                                </div>
                                <div class="col-lg-9 mx-auto">
                                    <div class="form-group">
                                        <label class="text-dark" for="pwd">Password</label>
                                        <input class="form-control" id="password" name="password" type="password" placeholder="Enter your password" value="<?= set_value('password'); ?>" style="border-radius: 75px;">
                                        <?= form_error('password', '<small class="text-danger pl-2">', '</small>'); ?>
                                    </div>
                                </div>
                                <div class="col-lg-12 text-center pt-2">
                                    Forgot Password ? <a href="<?= base_url("register/forgotPassword") ?>" class="text-danger">Reset Password</a>
                                </div>
                                <div class="col-lg-12 text-center pt-2">
                                    Don't have an account? <a href="<?= base_url("register") ?>" class="text-danger">Sign Up</a>
                                </div>
                                <div class="col-lg-12 text-center d-flex justify-content-center mb-3">
                                    <button type="submit" class="btn btn-block btn-info" style="border-radius: 75px; width: 40%">Sign In</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->