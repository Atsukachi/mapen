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
                      <h2><b> Form Kegiatan Harian</b></h2>
                    </div>
                    <div class="card-body">
                      <?= $this->session->flashdata('message'); ?>
                      <form action="<?= base_url('kegiatan/addKegiatan') ?>" method="POST" enctype="multipart/form-data">
                        <div class="form-group rec-element">
                          <label for="Nama">Kode Kegiatan</label>
                          <input type="text" readonly class="form-control" name="kegiatan_id[]" id="kegiatan_id1" alt="1" value="<?php echo $kegiatan_id ?>">
                        </div>
                        <div class="form-group">
                          <label for="skp_id">SKP</label>
                          <select name="skp_id[]" id="skp_id1" alt="1" class="form-control" required>
                            <optgroup label="Masukkan Pilihan">
                              <?php foreach ($skp as $s) : ?>
                                <option value="<?= $s['id_skp'] ?>"><?= $s['nama_skp'] ?></option>
                              <?php endforeach ?>
                              <option value="0">Tidak Termasuk SKP</option>
                            </optgroup>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="unit_kerja">Unit Kerja</label>
                          <select name="unit_kerja[]" id="unit_kerja1" alt="1" class="form-control" required>
                            <optgroup label="Masukkan Pilihan">
                              <?php foreach ($unit_kerja as $uk) : ?>
                                <option value="<?= $uk['id_unit_kerja'] ?>"><?= $uk['nama_unit_kerja'] ?></option>
                              <?php endforeach ?>
                            </optgroup>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="Uraian">Uraian Pekerjaan</label>
                          <textarea name="uraian[]" alt="1" id="uraian1" style="height: 250px;" class="form-control" required></textarea>
                        </div>
                        <div class="form-group">
                          <label for="Name">Nama</label>
                          <input type="hidden" readonly class="form-control" name="user[]" alt="1" id="user1" value="<?= $user['user_id']; ?>">
                          <input type="text" readonly class="form-control" name="username[]" alt="1" id="username1" value="<?= $user['name']; ?>">
                        </div>
                        <div class="form-group">
                          <label for="Tanggal">Tanggal</label>
                          <input type="datetime-local" class="form-control" name="tanggal[]" alt="1" id="tanggal1" min="<?= date('Y-m-d\TH:i:s') ?>" value="<?= date('Y-m-d\TH:i:s') ?>" required>
                        </div>
                        <div class="form-group">
                          <label for="File">File*</label>
                          <input type="file" name="files[]" alt="1" id="files1" class="form-control" style="border: 0;" mutiple="multiple" required>
                        </div>
                        <hr class="mt-4">
                        <div id="nextkolom" name="nextkolom"></div>
                        <button type="button" id="jumlahkolom" value="1" style="display:none"></button>
                        <div class="row">
                          <div class="col">
                            <button type="button" id="tambah-form" name="tambah-form" class="btn btn-warning btn-block tambah-form">Tambah File</button>
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
                    '<div class="form-group">' +
                    '<label for="File">File*</label>' +
                    '<input type="file" name="files[]" alt="' + i + '" id="files' + i + '" class="form-control" style="border: 0;" required>' +
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