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
                      <h2><b> Form Pengajuan SKP</b></h2>
                    </div>
                    <div class="card-body">
                      <form action="<?= base_url('skp/addSKP') ?>" method="POST" enctype="multipart/form-data">
                        <div class="form-group rec-element">
                          <label for="Name">Nama</label>
                          <input type="hidden" readonly class="form-control" id="user_id1" name="user_id[]" alt="1" value="<?= $user['user_id']; ?>">
                          <input type="text" readonly class="form-control" id="user1" name="user[]" alt="1" value="<?= $user['name']; ?>">
                        </div>
                        <div class="form-group">
                          <label for="Bulan">Month</label>
                          <select name="bulan[]" alt="1" id="bulan1" class="form-control" required>
                            <optgroup label="Masukkan Pilihan">
                              <?php foreach ($bulan as $b) : ?>
                                <option value="<?= $b->id_bulan ?>"><?= $b->nama_bulan ?></option>
                              <?php endforeach ?>
                            </optgroup>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="Tahun">Year</label>
                          <input id="tahun1" alt="1" name="tahun[]" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" maxlength="4" class="form-control">
                        </div>
                        <div class="form-group">
                          <label for="Skp">Rincian Pekerjaan</label>
                          <input id="skp1" name="skp[]" alt="1" type="text" class="form-control">
                        </div>
                        <hr class="mt-4">
                        <div id="nextkolom" name="nextkolom"></div>
                        <button type="button" id="jumlahkolom" value="1" style="display:none"></button>
                        <div class="row">
                          <div class="col">
                            <button type="button" id="tambah-form" name="tambah-form" class="btn btn-warning btn-block tambah-form">Tambah Form</button>
                          </div>
                          <div class="col">
                            <button type="submit" class="btn btn-primary btn-block">Submit</button>
                          </div>
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
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <script src="<?= base_url('assets/dashboard/') ?>libs/jquery/dist/jquery.min.js"></script>
            <script>
              $(document).ready(function() {
                var i = 2;
                $(".tambah-form").on('click', function() {
                  row = '<div class="rec-element">' +
                    '<input type="hidden" readonly class="form-control" id="user_id1" name="user_id[]" alt="1" value="<?= $user['user_id']; ?>">' +
                    '<div class="form-group">' +
                    '<label for="Bulan">Month</label>' +
                    '<select name="bulan[]" alt="' + i + '" id="bulan' + i + '" class="form-control" required>' +
                    '<optgroup label="Masukkan Pilihan">' +
                    '<?php foreach ($bulan as $b) : ?>' +
                    '<option value="<?= $b->id_bulan ?>"><?= $b->nama_bulan ?></option>' +
                    '<?php endforeach ?>' +
                    '</optgroup>' +
                    '</select>' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label for="Tahun">Year</label>' +
                    '<input id="tahun' + i + '" alt="' + i + '" name="tahun[]" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" maxlength="4" class="form-control">' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label for="Skp">Rincian Pekerjaan</label>' +
                    '<input id="skp' + i + '" name="skp[]" alt="' + i + '" type="text" class="form-control">' +
                    '</div>' +
                    '<span class="input-group-btn">' +
                    '<button type="button" class="btn btn-danger del-element"><i class="fas fa-minus-circle"></i> Hapus</button>' +
                    '</span>' +
                    '<hr class="mt-4">' +
                    '</div>';
                  $(row).insertBefore("#nextkolom");
                  $('#jumlahkolom').val(i + 1);
                  i++;
                });
                $(document).on('click', '.del-element', function(e) {
                  e.preventDefault()
                  i--;
                  $(this).parents('.rec-element').remove();
                  $('#jumlahkolom').val(i - 1);
                });
              });
            </script>