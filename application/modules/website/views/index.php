 <!-- ======= Home Section ======= -->

 <section id="home" class="hero d-flex align-items-center">
   <div class="container-fluid">
     <div id="carouselExampleIndicators" class="carousel slide" data-interval="false">
       <!-- If you want to pause carousel delete data-bs-ride and add data-interval="false" -->

       <div class="carousel-indicators">
         <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
         <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
         <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
       </div>
       <div class="carousel-inner">
         <div class="carousel-item active">
           <img src="<?= base_url('assets/website/img/bpmpk.jpg') ?>" class="d-block w-100">
           <div class="carousel-caption d-none d-md-block">
             <h3>BPMPK</h3>
             <p>Balai Pengembangan Multimedia Pendidikan dan Kebudayaan</p>
           </div>
         </div>
         <div class="carousel-item">
           <img src="<?= base_url('assets/website/img/meeting.jpg') ?>" class="d-block w-100">
           <div class="carousel-caption d-none d-md-block">
             <h3>BPMPK</h3>
             <p>Balai Pengembangan Multimedia Pendidikan dan Kebudayaan</p>
           </div>
         </div>
         <div class="carousel-item">
           <img src="<?= base_url('assets/website/img/office.jpg') ?>" class="d-block w-100">
           <div class="carousel-caption d-none d-md-block">
             <h3>BPMPK</h3>
             <p>Balai Pengembangan Multimedia Pendidikan dan Kebudayaan</p>
           </div>
         </div>
       </div>
       <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
         <span class="carousel-control-prev-icon" aria-hidden="true"></span>
         <span class="visually-hidden">Previous</span>
       </button>
       <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
         <span class="carousel-control-next-icon" aria-hidden="true"></span>
         <span class="visually-hidden">Next</span>
       </button>
     </div>
   </div>
 </section>
 <!-- End Home Section -->

 <main id="main">
   <!-- ======= About Section ======= -->
   <section id="about" class="about">
     <div class="container" data-aos="fade-up">
       <header class="section-header">
         <br>
         <h2>Apa itu MAPEN?</h2>
         <p>Merupakan platform aplikasi <i>website</i> mengenai <b>Sistem Informasi Manajemen Pegawai Online</b>. Aplikasi ini digunakan khusus untuk instansi BPMPK atau <b>Balai Pengembangan Multimedia Pendidikan dan Kebudayaan</b> untuk mengelola kinerja pegawai, input kegiatan harian, serta terdapat presensi kerja saat during maupun luring.</p>
       </header>
     </div>
   </section>
   <!-- End About Section -->

   <!-- ======= Contact Section ======= -->
   <section id="contact" class="contact">
     <div class="container" data-aos="fade-up">

       <header class="section-header">
         <h2>Kontak Kami</h2>
         <div class="feature-icons">
           <div class="row" data-aos="fade-up">

             <div class="col-lg-8 col-lg-push-4 d-flex content">
               <div class="row align-self-center gy-4">
                 <div class="col-xl icon-box" data-aos="fade-up">
                   <p>Jalan Mr. Koessoebiyono Tjondro Wibowo
                     <br>Kelurahan Pakintelan, Kecamatan Gunung Pati,
                     <br>Kodya Semarang 50227 | Jawa Tengah, Indonesia
                     <br>Telp 024-8314292 | Fax 024-8310051
                   </p>
                 </div>
                 <div class="text-center text-lg-start d-flex flex-column justify-content-center mt-5">
                   <?php
                    $nomer = 62895360622007;
                    $pesan = 'Permisi, perkenalkan...%0ANama&emsp;&emsp;&emsp;:%0AInstansi&emsp;&emsp;&nbsp;:%0AKeperluan&emsp;&nbsp;:';
                    ?>
                   <button onclick="window.open('<?= 'https://api.whatsapp.com/send?phone=' . $nomer . '&text=' . $pesan . '' ?>', '_blank')" class="border-0 btn-read-more d-inline-flex align-items-center justify-content-center align-self-center">
                     <h5>Kirim Pesan</h5>
                     <i class="bi bi-arrow-right"></i>
                   </button>
                 </div>
               </div>
             </div>
             <div class="col-lg-4 col-lg-pull-8 text-center" data-aos="fade-right" data-aos-delay="100">
               <img src="<?= base_url('assets/website') ?>/img/bpmpk2.jpg" class="img-fluid p-4" alt="">
             </div>
           </div>
         </div>
       </header>
       <!-- <button href="#" class="btn-1"><span>Read More</span></button> -->
     </div>
   </section><!-- End Contact Section -->
 </main><!-- End #main -->