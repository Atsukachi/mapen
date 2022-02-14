 <!-- Login box.scss -->
 <!-- ============================================================== -->
 <div class="auth-wrapper d-flex no-block justify-content-center align-items-center position-relative" style="background:url(<?= base_url('assets/') ?>images/bg-auth.png) no-repeat center center;">
     <div class="col-lg-5 col-md-7 mx-auto auth-box">
         <div class="p-3">
             <div class="text-center">
                 <img src="<?= base_url('assets/') ?>images/logo.png" style="max: width 70px;max-height: 70px;" alt="wrapkit">
             </div>
             <h2 class="mt-3 text-center font-weight-bold" style="font-family:'Montserrat', sans-serif">Form Sign Up Account</h2>
             <p class="text-center pb-2">Enter your biodata to create a new account.</p>
             <form class="mt-4" method="post" action="<?= base_url('register'); ?>">
                 <div class="row">
                     <div class="col-lg-12">
                         <div class="form-group ml-5 mr-5">
                             <input class="form-control" id="name" name="name" type="text" placeholder="Fullname" value="<?= set_value('name'); ?>" style="border-radius: 75px;">
                             <?= form_error('name', '<small class="text-danger pl-2">', '</small>'); ?>
                         </div>
                     </div>
                     <div class="col-lg-12">
                         <div class="form-group ml-5 mr-5">
                             <input class="form-control" id="email" name="email" type="email" placeholder="Email" value="<?= set_value('email'); ?>" style="border-radius: 75px;">
                             <?= form_error('email', '<small class="text-danger pl-2">', '</small>'); ?>
                         </div>
                     </div>
                     <div class="col-lg-12">
                         <div class="form-group ml-5 mr-5">
                             <input class="form-control" id="password" name="password" type="password" placeholder="Password" value="<?= set_value('password'); ?>" style="border-radius: 75px;">
                             <?= form_error('password', '<small class="text-danger pl-2">', '</small>'); ?>
                         </div>
                     </div>
                     <div class="col-lg-12">
                         <div class="form-group ml-5 mr-5">
                             <input class="form-control" id="password2" name="password2" type="password" placeholder="Re-password" value="<?= set_value('password2'); ?>" style="border-radius: 75px;">
                             <?= form_error('password2', '<small class="text-danger pl-2">', '</small>'); ?>
                         </div>
                     </div>
                     <div class="col-lg-12 text-center pt-2">
                         Already have an account? <a href="<?= base_url("login"); ?>" class="text-danger">Sign In</a>
                     </div>
                     <div class="col-lg-12 text-center d-flex justify-content-center mb-3">
                         <button type="submit" class="btn btn-block btn-info" style="border-radius: 75px; width: 40%">Sign Up</button>
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