            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- *************************************************************** -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <!-- multi-column ordering -->
                <div class="row">
                    <div class="card mb-3">
                        <?= $this->session->flashdata('check'); ?>
                        <?= $this->session->flashdata('message'); ?>
                        <div class="card-body">
                            <div class="row">
                                <!-- Column -->
                                <div class="col-md-6 col-lg-4 col-xlg-4">
                                    <div class="card card-hover">
                                        <div class="p-2 bg-primary text-center">
                                            <?php $total = '2' ?>
                                            <!-- total presensi tiap hari -->
                                            <?php foreach ($get_jmlpresensi as $jp) : ?>
                                                <?php if ($jp['jml_presensi'] == 0) { ?>
                                                    <h1 class="font-light text-danger">
                                                        <?= $jp['jml_presensi']; ?>
                                                        <span class="font-light text-white">
                                                            / <?= $total ?>
                                                        </span>
                                                    </h1>
                                                <?php } else if ($jp['jml_presensi'] < $total) { ?>
                                                    <h1 class="font-light text-warning">
                                                        <?= $jp['jml_presensi']; ?>
                                                        <span class="font-light text-white">
                                                            / <?= $total ?>
                                                        </span>
                                                    </h1>
                                                <?php } else { ?>
                                                    <h1 class="font-light text-success">
                                                        <?= $jp['jml_presensi']; ?>
                                                        <span class="font-light text-white">
                                                            / <?= $total ?>
                                                        </span>
                                                    </h1>
                                                <?php }  ?>
                                            <?php endforeach; ?>
                                            <h6 class="text-white">Jumlah Presensi Hari Ini</h6>
                                        </div>
                                    </div>
                                </div>
                                <!-- Column -->
                                <div class="col-md-6 col-lg-4 col-xlg-4">
                                    <div class="card card-hover">
                                        <div class="p-2 bg-cyan text-center">
                                            <?php $tot = '56' ?>
                                            <!-- total presensi tiap bulan -->
                                            <?php foreach ($get_totalpresensi as $tp) : ?>
                                                <?php if ($tp['jml_p'] == 0) { ?>
                                                    <h1 class="font-light text-danger">
                                                        <?= $tp['jml_p']; ?>
                                                        <span class="font-light text-white">
                                                            / <?= $tot ?>
                                                        </span>
                                                    </h1>
                                                <?php } else if ($tp['jml_p'] < $tot) { ?>
                                                    <h1 class="font-light text-warning">
                                                        <?= $tp['jml_p']; ?>
                                                        <span class="font-light text-white">
                                                            / <?= $tot ?>
                                                        </span>
                                                    </h1>
                                                <?php } else { ?>
                                                    <h1 class="font-light text-success">
                                                        <?= $tp['jml_p']; ?>
                                                        <span class="font-light text-white">
                                                            / <?= $tot ?>
                                                        </span>
                                                    </h1>
                                                <?php }  ?>
                                            <?php endforeach; ?>
                                            <h6 class="text-white">Jumlah Presensi Bulan Ini</h6>
                                        </div>
                                    </div>
                                </div>
                                <!-- Column -->
                                <div class="col-md-6 col-lg-4 col-xlg-4">
                                    <div class="card card-hover">
                                        <div class="p-2 bg-success text-center">
                                            <!-- total presensi tiap bulan -->
                                            <?php foreach ($get_tot as $gt) : ?>
                                                <h1 class="font-light text-white">
                                                    <?= $gt['tot_p']; ?>
                                                </h1>
                                            <?php endforeach; ?>
                                            <h6 class="text-white">Total Presensi</h6>
                                        </div>
                                    </div>
                                </div>
                                <!-- Column -->
                                <!-- <div class="col-md-6 col-lg-3 col-xlg-3">
                                    <div class="card card-hover">
                                        <div class="p-2 bg-danger text-center">
                                            <h1 class="font-light text-white">
                                                1
                                            </h1>
                                            <h6 class="text-white"></h6>
                                        </div>
                                    </div>
                                </div> -->
                                <!-- Column -->
                            </div>
                            <!-- [ stiped-table ] start -->
                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h2>Tabel Presensi Pegawai</h2>
                                        <h6 class="card-subtitle">Tabel digunakan untuk mengubah <code>"daftar presensi pegawai"</code> aplikasi MAPEN.
                                        </h6>
                                        <?php
                                        //ubah timezone menjadi jakarta
                                        date_default_timezone_set("Asia/Jakarta");

                                        //ambil jam, menit dan detik
                                        $jam = date('H:i:s');

                                        //atur salam menggunakan IF
                                        $data['salam'] = $this->db->get('status')->result();
                                        $salam = $data['salam'];
                                        foreach ($salam as $s) {
                                            if ($jam > $s->jam_datang && $jam < $s->jam_pulang) {
                                                //tampilkan pesan
                                                echo 'Selamat ' . $s->status . ',' . $user['name'] . '!';
                                            }
                                        }
                                        ?>
                                    </div>
                                    <div class="card-body table-border-style">
                                        <div class="table-responsive pb-3">
                                            <div class="panel-body mb-2" style="height:400px;" id="map-canvas"></div>
                                            <?php if ($this->session->userdata('role_id') == '1' || $this->session->userdata('role_id') == '2') { ?>
                                                <div style="padding-top: 15px;">
                                                    <?php $id = $this->uri->segment(3, 0); ?>
                                                    <button class="btn waves-effect waves-light btn-success">
                                                        <a class="text-white" href="<?= base_url('pegawai/export_detail/' . $id) ?>"> <i class="fas fa-file-export"></i>&ensp;Export Data</a>
                                                    </button>
                                                </div>
                                            <?php } ?>
                                            <table id="multi_col_order" class="table table-striped table-bordered display no-wrap" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">No.</th>
                                                        <th class="text-center">Nama</th>
                                                        <th class="text-center" style="display:none">User ID</th>
                                                        <th class="text-center">Tanggal</th>
                                                        <th class="text-center">Riwayat</th>
                                                        <th class="text-center">Status</th>
                                                        <th class="text-center">Kerja</th>
                                                        <th class="text-center" style="display:inline-block; width: 250px">Foto</th>
                                                        <th class="text-center">Lokasi</th>
                                                        <th class="text-center">Keterangan</th>
                                                        <?php if ($this->session->userdata('role_id') == 1 || $this->session->userdata('role_id') == 2) { ?>
                                                            <th class="text-center">Aksi</th>
                                                        <?php } ?>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no = 1; ?>
                                                    <?php foreach ($presensi_list as $pl) : ?>
                                                        <tr>
                                                            <?php
                                                            $waktu = date("H:i:s", $pl['tanggal']);
                                                            $tanggal = date("Y-m-d", $pl['tanggal']);
                                                            $tgl = tgl_indo($tanggal);
                                                            ?>
                                                            <td class="align-middle text-center"><?= $no++ ?></td>
                                                            <td class="align-middle text-center"><?= $pl['name']; ?></td>
                                                            <td class="align-middle text-center" style="display:none"><?= $pl['user_id']; ?></td>
                                                            <td class="align-middle text-center"><?= $tgl . ', ' . $waktu ?></td>
                                                            <td class="align-middle text-center"><?= $pl['jenis_riwayat'] ?></td>
                                                            <td class="align-middle text-center"><?= $pl['jenis_status'] ?></td>
                                                            <td class="align-middle text-center"><?= $pl['metode'] ?></td>
                                                            <?php if ($this->session->userdata('role_id') == 1 || $this->session->userdata('role_id') == 2) { ?>
                                                                <td class="align-middle text-center">
                                                                    <img src="<?= base_url('assets/images/presensi/' . $pl['foto']); ?>" class="img-thumbnail">
                                                                </td>
                                                            <?php } else { ?>
                                                                <td class="align-middle text-center">
                                                                    <img src="<?= base_url('assets/images/presensi/' . $pl['foto']); ?>" class="img-thumbnail" width="40%">
                                                                </td>
                                                            <?php } ?>
                                                            <td class="align-middle text-center">
                                                                <button id="viewmarkerpegawai" data-idpegawai="<?= $pl['id'] ?>" class="btn waves-effect waves-light text-primary"> <i class="fas fa-map-marker-alt"></i> Cek Lokasi</button>
                                                            </td>
                                                            <td class="align-middle text-center">
                                                                <?php if ($pl['cek_presensi'] == 1) { ?>
                                                                    <span class="badge bg-success text-white">Tepat Waktu</span>
                                                                <?php } else { ?>
                                                                    <span class="badge bg-danger text-white">Terlambat</span>
                                                                <?php } ?>
                                                            </td>
                                                            <?php if ($this->session->userdata('role_id') == 1 || $this->session->userdata('role_id') == 2) { ?>
                                                                <td class=" align-middle text-center">
                                                                    <a href="<?= base_url('pegawai/hapus_pegawai/' . $pl['id']) ?>" class="btn btn-small btn-danger"><i class="fa fa-trash"></i> Hapus</a>
                                                                </td>
                                                            <?php } ?>
                                                        </tr>

                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- [ stiped-table ] end -->
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- End Page Content -->
                    <!-- ============================================================== -->
                </div>
                <!-- ============================================================== -->
                <!-- End Container fluid  -->
                <!-- ============================================================== -->