    <script type="text/javascript"
            src="https://app.sandbox.midtrans.com/snap/snap.js"
            data-client-key="<CLIENT-KEY>"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <main id="main">


<!-- ======= Portfolio Details Section ======= -->
<section id="portfolio-details" class="portfolio-details mt-5" data-aos="fade-up">
  <div class="container">

    <div class="row gy-4">



      <div class="col-md-5">
        <div class="portfolio-info">

          <!-- <h3></h3> -->
          <ul>
            <li>
              <img src="<?= base_url('assets/images/users/' . $detailbayar['image']) ?>" class="rounded-circle" width="70px"> <strong class="ms-2"><?= $detailbayar['name'] ?></strong>
            </li>
            <li>
              <h4><b><?= $detailbayar['judul'] ?></b></h4>
            </li>
            <li><i class="fas fa-calendar-alt"></i> <?php $tgl = $detailbayar['tgl_event'];
                                                    echo format_indo($tgl); ?></li>
            <li><i class="fas fa-clock"></i> <?php $waktu = $detailbayar['tgl_event'];
                                              echo waktu_indo($waktu); ?></li>
            <li><i class="fas fa-map-marked-alt"></i> Online</li>
            <li><i class="fas fa-ticket-alt"></i>
              <?php if ($detailbayar['harga'] == 0) {
                echo "FREE";
              } else { ?>
                Rp. <?= number_format($detailbayar['harga'], 0); ?>
              <?php
              } ?>

            </li>
            <li><i class="fas fa-users"></i> Kuota Tersisa <?= $detailbayar['kuota'] ?> Peserta</li>
            <li> <span class="badge rounded-pill bg-secondary"><?= $detailbayar['categories'] ?></span></li>
          </ul>
        </div>
        <!-- <div class="portfolio-description">
            <h2>Keikutsertaan</h2>
            <p>
              Silakan masuk dahulu ke Event Tech untuk dapat melakukan pemesanan tiket acara ke event ini.
            </p>

          </div> -->
      </div>
      <div class="col-md-7">

        <div class="portfolio-info">
          <h4 class="mb-3"><i class="fas fa-user"></i> <b>Informasi Pribadi</b></h4>
        

    
          <form id="payment-form" method="post" action="<?=base_url()?>snap/finish">
                              <input type="hidden" name="result_type" id="result-type" value="">
                              <input type="hidden" name="result_data" id="result-data" value="">
                            
                              <div class="form-group ">
                            <input type="hidden" readonly class="form-control" id="event" name="event" value="<?= $detailbayar['event_id'] ?>">
                            </div>
                            <div class="form-group ">
                              <input class="form-control" type="hidden" id="price" name="price" value="<?= $detailbayar['harga'] ?>">
                            </div>
                            <div class="form-group ">
                              <input class="form-control" type="hidden" id="quantity" name="quantity" value="1">
                            </div>
                            <div class="form-group">
                              <input class="form-control" type="hidden" id="name" name="name" value="<?= $detailbayar['judul'] ?>">
                            </div>
                              <input class="form-control" type="hidden" id="gross_amount" name="gross_amount" value="<?= $detailbayar['harga'] ?>">
                            </div>
                            <div class="form-group ">
                              <label for="menuname">Email</label>
                            <input type="email" readonly class="form-control" id="email" aria-describedby="emailHelp"
                              value="<?= $detailbayar['email'] ?>">
                            </div>
                            <div class="mb-3 form-group">
                              <label for="exampleInputPassword1" class="form-label">Nama</label>
                              <input type="text" class="form-control" id="nama" name="nama"
                              value="<?= $detailbayar['name'] ?>">
                            </div>
                            <div class="mb-3 form-group ">
                              <label for="exampleInputPassword1" class="form-label">No Telp</label>
                              <input type="text" class="form-control" id="telephone"
                              value="<?= $detailbayar['telephone'] ?>">
                            </div>
                            <button class="btn btn-primary btn-lg btn-block" id="pay-button">Bayar</button>
                          </form>
                          </div>

</div>
</div>
</div>


</div>

</div>
<!-- ======= Features Section ======= -->
</section><!-- End Portfolio Details Section -->

</main><!-- End #main --> 

    <script type="text/javascript">

    $('#pay-button').click(function (event) {
      event.preventDefault();
      $(this).attr("disabled", "disabled");
      
                var event         = $("#event").val();
                var price         = $("#price").val();
                var quantity      = $("#quantity").val();
                var name          = $("#name").val();
                var gross_amount  = $("#gross_amount").val();
                var email         = $("#email").val();
                var nama          = $("#nama").val();
                var telephone     = $("#telephone").val();

    $.ajax({
      method : 'POST',
      url: '<?=site_url()?>/snap/token',
      data : {
                  event: event, 
                  price: price, 
                  quantity: quantity, 
                  name: name, 
                  gross_amount: gross_amount, 
                  email: email,
                  nama: nama, 
                  telephone: telephone
                },
      cache: false,

      success: function(data) {
        //location = data;

        console.log('token = '+data);
        
        var resultType = document.getElementById('result-type');
        var resultData = document.getElementById('result-data');

        function changeResult(type,data){
          $("#result-type").val(type);
          $("#result-data").val(JSON.stringify(data));
          //resultType.innerHTML = type;
          //resultData.innerHTML = JSON.stringify(data);
        }

        snap.pay(data, {
          
          onSuccess: function(result){
            changeResult('success', result);
            console.log(result.status_message);
            console.log(result);
            $("#payment-form").submit();
          },
          onPending: function(result){
            changeResult('pending', result);
            console.log(result.status_message);
            $("#payment-form").submit();
          },
          onError: function(result){
            changeResult('error', result);
            console.log(result.status_message);
            $("#payment-form").submit();
          }
        });
      }
    });
  });

  </script>
