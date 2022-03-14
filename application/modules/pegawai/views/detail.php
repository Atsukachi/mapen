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
                                        <h6 class="card-subtitle">Tabel digunakan untuk mengubah <code>"daftar presensi pegawai"</code> aplikasi MAPEN.</h6>
                                    </div>
                                    <div class="card-body pb-1">
                                        <div class="panel-body mb-2" style="height:400px;" id="map-canvas"></div>
                                        <div class="row">
                                            <?php if ($this->session->userdata('role_id') == '1' || $this->session->userdata('role_id') == '2') { ?>
                                                <div class="col-auto">
                                                    <div style="padding-top: 15px;">
                                                        <?php $id = $user['user_id'] ?>
                                                        <button class="btn waves-effect waves-light btn-success">
                                                            <a class="text-white" href="<?= base_url('pegawai/export_detail/' . $id) ?>"> <i class="fas fa-file-export"></i>&ensp;Export Data</a>
                                                        </button>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                            <div class="col-auto">
                                                <div style="padding-top: 15px;">
                                                    <?php $id = $user['user_id'] ?>
                                                    <button class="btn waves-effect waves-light btn-warning">
                                                        <a class="text-dark" data-toggle="modal" data-target="#chart-modal"><i class="fas fa-chart-line"></i>&ensp;Lihat Grafik</a>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body table-border-style pt-1">
                                        <div class="table-responsive pb-3">
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
                <!-- Signup modal content -->
                <div id="chart-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Chart Presensi "<?= $user['name'] ?>" per Bulan</h4>
                                        <?php foreach ($presensi_bulan as $pb) {
                                            $bln[] = $pb->bln;
                                            $tw_bulan[] = $pb->tepatwaktu;
                                            $tl_bulan[] = $pb->terlambat;
                                        } ?>
                                        <div id="chart-line-stroke"></div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
                <!-- ============================================================== -->
                <!-- End Container fluid  -->
                <!-- ============================================================== -->
                <script>
                    // @formatter:off
                    document.addEventListener("DOMContentLoaded", function() {
                        window.ApexCharts && (new ApexCharts(document.getElementById('chart-line-stroke'), {
                            chart: {
                                type: "line",
                                fontFamily: 'inherit',
                                height: 240,
                                parentHeightOffset: 0,
                                toolbar: {
                                    show: true,
                                },
                                animations: {
                                    enabled: true
                                },
                            },
                            fill: {
                                opacity: 1,
                            },
                            stroke: {
                                width: 2,
                                lineCap: "round",
                                curve: "straight",
                            },
                            series: [{
                                name: "Tepat Waktu",
                                data: <?= json_encode($tw_bulan); ?>
                            }, {
                                name: "Terlambat",
                                data: <?= json_encode($tl_bulan); ?>
                            }],
                            grid: {
                                padding: {
                                    top: -20,
                                    right: 0,
                                    left: -4,
                                    bottom: -4
                                },
                                strokeDashArray: 4,
                            },
                            xaxis: {
                                labels: {
                                    padding: 0
                                },
                                tooltip: {
                                    enabled: false
                                },
                                categories: <?= json_encode($bln); ?>,
                            },
                            yaxis: {
                                labels: {
                                    padding: 4
                                },
                            },
                            colors: ["#28a745", "#dc3545"],
                            legend: {
                                show: true,
                            },
                        })).render();
                    });
                    // @formatter:on
                </script>