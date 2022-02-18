            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
              <!-- *************************************************************** -->
              <!-- Start Page Content -->
              <!-- ============================================================== -->
              <!-- multi-column ordering -->
              <div class="row">
                <div class="col-md-10">
                  <!-- Form -->
                  <div class="card mb-3">
                    <div class="card-header">
                      <h2><b> Form Presensi Pegawai</b></h2>
                    </div>
                    <div class="card-body">
                      <?php
                      foreach ($presensi_cek as $pc) :
                        if ($pc['p_cek'] == '1') {
                          redirect('pegawai/blocked');
                        };
                      endforeach;
                      ?>
                      <?php foreach ($riwayat as $r) : ?>
                        <form id="form_presensi" action="<?= base_url('pegawai/tambah/' . $r['id_riwayat']) ?>" method="POST" enctype="multipart/form-data">
                        <?php endforeach; ?>
                        <input type="hidden" readonly class="form-control" id="user_id" name="user_id" value="<?= $user['user_id']; ?>">
                        <div class="form-group">
                          <label for="tanggal">Tanggal</label>
                          <input type="datetime" readonly class="form-control" id="tanggal" name="tanggal" value="<?= date("d-m-Y H:i:s") ?>">
                        </div>
                        <div class="form-group">
                          <label for="kerja">Pilih Metode Kerja</label>
                          <select name="kerja" id="kerja" class="form-control" required>
                            <optgroup label="Masukkan Pilihan">
                              <?php foreach ($kerja as $kj) : ?>
                                <option value="<?= $kj->id_kerja ?>"><?= $kj->metode ?></option>
                              <?php endforeach ?>
                            </optgroup>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="id_riwayat">Riwayat</label>
                          <?php foreach ($riwayat as $rw) : ?>
                            <input type="hidden" readonly class="form-control" id="id_riwayat" name="id_riwayat" value="<?= $rw['id_riwayat']; ?>">
                            <input type="text" readonly class="form-control" id="kegiatan" name="kegiatan" value="<?= $rw['riwayat']; ?>">
                          <?php endforeach; ?>
                        </div>
                        <div class="form-group">
                          <label for="status">Status</label>
                          <?php foreach ($riwayat as $rr) : ?>
                            <input type="hidden" readonly class="form-control" id="status_id" name="status_id" value="<?= $rr['status_id']; ?>">
                            <input type="text" readonly class="form-control" id="status" name="status" value="<?= $rr['status']; ?>">
                          <?php endforeach; ?>
                        </div>
                        <div class="form-group">
                          <label for="foto">Foto</label><br>
                          <div id="take_photo"></div>
                          <input id="image" type="hidden" name="image" value="">
                          <div class="pt-3">
                            <button type="button" onclick="openCam()" class="btn btn-light-info text-info font-medium radius">On</button>
                            <button type="button" onclick="closeCam()" class="btn btn-light-info text-info font-medium radius">Off</button>
                            <button type="button" onclick="batal()" class="btn btn-light-info text-info font-medium radius">Batal</button>
                            <!-- <button class="btn btn-danger font-medium radius">Close</button> -->
                            <input type="button" class="btn btn-warning text-white font-medium radius" value="Take a Photo" onClick="preview()">
                            <input id="check" name="check" type="hidden">
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="lokasi">Lokasi</label>
                          <div class="alert alert-warning" role="alert" style="width:70%">Mohon untuk aktifkan lokasi!</div>
                          <div id="googleMap" class="mb-3" style="width:70%;height:400px;"></div>
                          <div class="input-group mb-3" style="width:40%">
                            <input type="text" readonly id="lat" name="lat" class="form-control mr-2" placeholder="Latitude" aria-label="lat" aria-describedby="basic-addon2">
                            <input type="text" readonly id="lng" name="lng" class="form-control mr-2" placeholder="Longitude" aria-label="lng" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                              <input type=button class="btn btn-success text-white font-medium radius" value="Cek Lokasi" onClick="getLocation()">
                            </div>
                          </div>
                          <div class="input-group mb-3">
                            <button type="submit" name="submit" onClick="save()" class="btn btn-primary btn-block">Submit</button>
                          </div>
                        </div>
                        </form>
                    </div>
                  </div>
                </div>
              </div>

              <script src="http://maps.googleapis.com/maps/api/js"></script>
              <script src="<?= base_url('assets/website/js/webcam.js') ?>"></script>
              <script>
                function closeCam() {
                  Webcam.reset();
                  document.getElementById('take_photo').style.display = 'none';
                }

                function batal() {
                  // batal preview
                  Webcam.unfreeze();
                }

                function openCam() {
                  Webcam.set({
                    width: 320,
                    height: 240,
                    image_format: 'png',
                    jpeg_quality: 100
                  });
                  Webcam.attach('#take_photo');
                  document.getElementById('take_photo').style.display = '';
                }

                function preview() {
                  Webcam.freeze();
                }

                function save() {
                  Webcam.snap(function(data_uri) {
                    var raw_image_data = data_uri.replace(/^data\:image\/\w+\;base64\,/, '');
                    document.getElementById('image').value = raw_image_data;
                    document.getElementById('check').value = '1';
                    document.getElementById('form_presensi').submit();
                  });
                }
              </script>
              <script>
                var marker;

                function getLocation() {
                  if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(showPosition);
                  } else {
                    x.innerHTML = "Geolocation is not supported by this browser.";
                  }
                }

                function showPosition(position) {
                  lat = position.coords.latitude;
                  lng = position.coords.longitude;
                  latlng = new google.maps.LatLng(lat, lng);

                  mapholder = document.getElementById('googleMap');
                  var myOptions = {
                    center: latlng,
                    zoom: 14,
                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                    mapTypeControl: false,
                    navigationControlOptions: {
                      style: google.maps.NavigationControlStyle.SMALL
                    }
                  };
                  var map = new google.maps.Map(document.getElementById("googleMap"), myOptions);
                  var marker = new google.maps.Marker({
                    position: latlng,
                    map: map,
                    title: "You are here!",
                    animation: google.maps.Animation.BOUNCE
                  });
                  document.getElementById("lat").value = latlng.lat();
                  document.getElementById("lng").value = latlng.lng();
                }

                function initialize() {
                  var propertiPeta = {
                    center: new google.maps.LatLng(-7.095642914916857, 110.38964621070213),
                    zoom: 16,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                  };
                  var peta = new google.maps.Map(document.getElementById("googleMap"), propertiPeta);
                  google.maps.event.addListener(peta, 'click', function(event) {
                    taruhMarker(this, event.latLng);
                  });
                }
                google.maps.event.addDomListener(window, 'load', initialize);
              </script>
              <!-- ============================================================== -->
              <!-- End Page Content -->
              <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->