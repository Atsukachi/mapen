            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
            	<!-- *************************************************************** -->
            	<!-- Start First Cards -->
            	<!-- *************************************************************** -->
            	<div class="card-group">
            		<div class="card border-right">
            			<div class="card-body" onclick="window.location='<?= base_url('admin/DataPengguna') ?>'">
            				<div class=" d-flex d-lg-flex d-md-block align-items-center">
            					<div>
            						<div class="d-inline-flex align-items-center">
            							<h2 class="text-dark mb-1 font-weight-medium">
            								<?php foreach ($get_jmluser as $ju) {
												echo $ju['jml_user'];
											} ?>
            							</h2>
            							<!-- <span class="badge bg-primary font-12 text-white font-weight-medium badge-pill ml-2 d-lg-block d-md-none">+18.33%</span> -->
            						</div>
            						<h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Users</h6>
            					</div>
            					<div class="ml-auto mt-md-3 mt-lg-0">
            						<span class="opacity-7 text-muted"><i data-feather="users"></i></span>
            					</div>
            				</div>
            			</div>
            		</div>
            		<div class="card border-right">
            			<div class="card-body" onclick="window.location='<?= base_url('kegiatan') ?>'">
            				<div class="d-flex d-lg-flex d-md-block align-items-center">
            					<div>
            						<h2 class="text-dark mb-1 w-100 text-truncate font-weight-medium">
            							<?php foreach ($get_jmlkegiatan as $jk) {
											echo $jk['jml_kegiatan'];
										} ?>
            						</h2>
            						<h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Kegiatan
            						</h6>
            					</div>
            					<div class="ml-auto mt-md-3 mt-lg-0">
            						<span class="opacity-7 text-muted"><i data-feather="file"></i></span>
            					</div>
            				</div>
            			</div>
            		</div>
            		<div class="card border-right">
            			<div class="card-body" onclick="window.location='<?= base_url('presensi') ?>'">
            				<div class="d-flex d-lg-flex d-md-block align-items-center">
            					<div>
            						<div class="d-inline-flex align-items-center">
            							<h2 class="text-dark mb-1 font-weight-medium">
            								<?php foreach ($get_jmlpresensi as $jp) {
												echo $jp['jml_presensi'];
											} ?>
            							</h2>
            							<!-- <span class="badge bg-danger font-12 text-white font-weight-medium badge-pill ml-2 d-md-none d-lg-block">-18.33%</span> -->
            						</div>
            						<h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Presensi</h6>
            					</div>
            					<div class="ml-auto mt-md-3 mt-lg-0">
            						<span class="opacity-7 text-muted"><i data-feather="list"></i></span>
            					</div>
            				</div>
            			</div>
            		</div>
            		<div class="card">
            			<div class="card-body" onclick="window.location='<?= base_url('skp') ?>'">
            				<div class="d-flex d-lg-flex d-md-block align-items-center">
            					<div>
            						<h2 class="text-dark mb-1 font-weight-medium">
            							<?php foreach ($get_jmlskp as $js) {
											echo $js['jml_skp'];
										} ?>
            						</h2>
            						<h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">SKP</h6>
            					</div>
            					<div class="ml-auto mt-md-3 mt-lg-0">
            						<span class="opacity-7 text-muted"><i data-feather="folder"></i></span>
            					</div>
            				</div>
            			</div>
            		</div>
            	</div>
            	<!-- column -->
            	<!-- <div class="col-lg-12" style="padding: 0 0">
            		<div class="card">
            			<div class="card-body">
            				<h4 class="card-title">Chart Jumlah Event per bulan</h4>
            				<?php foreach ($event_bulan as $em) {
								$bln[] = $em->bln;
								$totalevent[] = $em->event;
							} ?>
            				<div id="chart-tasks-overview"></div>
            			</div>
            		</div>
            	</div> -->
            	<!-- column -->
            	<!-- multi-column ordering -->
            	<div class="row">
            		<!-- <div class="col-md-7">
							<div class="card">
								<div class="card-body">
									<h4 class="card-title">Chart Jumlah Kategori Event per bulan</h4>
									<?php foreach ($kategori_bulan as $kb) {
										$bulan[] = $kb->bulan;
										$webinar[] = $kb->webinar;
										$workshop[] = $kb->workshop;
										$lomba[] = $kb->lomba;
									} ?>
									<div id="chart-line-stroke"></div>
								</div>
							</div>
						</div> -->
            		<div class="col-md-5">
            			<div class="card">
            				<div class="card-body">
            					<h4 class="card-title">Chart Jumlah User</h4>
            					<?php foreach ($get_user as $gu) {
									$role[] = $gu->role;
									$position[] = $gu->position;
								} ?>
            					<div id="chart-total-pie"></div>
            				</div>
            			</div>
            		</div>
            	</div>
            	<!-- *************************************************************** -->
            	<!-- End First Cards -->
            	<!-- *************************************************************** -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <script>
            	// @formatter:off
            	document.addEventListener("DOMContentLoaded", function() {
            		window.ApexCharts && (new ApexCharts(document.getElementById('chart-tasks-overview'), {
            			chart: {
            				type: "bar",
            				fontFamily: 'inherit',
            				height: 320,
            				parentHeightOffset: 0,
            				toolbar: {
            					show: false,
            				},
            				animations: {
            					enabled: false
            				},
            			},
            			plotOptions: {
            				bar: {
            					columnWidth: '50%',
            				}
            			},
            			dataLabels: {
            				enabled: false,
            			},
            			fill: {
            				opacity: 1,
            			},
            			series: [{
            				name: "Total Event",
            				data: <?= json_encode($totalevent); ?>
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
            				axisBorder: {
            					show: false,
            				},
            				categories: <?= json_encode($bln); ?>,
            			},
            			yaxis: {
            				labels: {
            					padding: 4
            				},
            			},
            			colors: ["#206bc4"],
            			legend: {
            				show: false,
            			},
            		})).render();
            	});
            	// @formatter:on
            </script>
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
            					show: false,
            				},
            				animations: {
            					enabled: false
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
            				name: "Webinar",
            				data: <?= json_encode($webinar); ?>
            			}, {
            				name: "Workshop",
            				data: <?= json_encode($lomba); ?>
            			}, {
            				name: "Lomba",
            				data: <?= json_encode($workshop); ?>
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
            				categories: <?= json_encode($bulan); ?>,
            			},
            			yaxis: {
            				labels: {
            					padding: 4
            				},
            			},
            			colors: ["#ff922b", "#206bc4", "#5eba00"],
            			legend: {
            				show: false,
            			},
            		})).render();
            	});
            	// @formatter:on
            </script>
            <script>
            	// @formatter:off
            	document.addEventListener("DOMContentLoaded", function() {
            		window.ApexCharts && (new ApexCharts(document.getElementById('chart-total-pie'), {
            			chart: {
            				type: "pie",
            				fontFamily: 'inherit',
            				height: 243,
            				sparkline: {
            					enabled: true
            				},
            				animations: {
            					enabled: false
            				},
            			},
            			fill: {
            				opacity: 1,
            			},
            			series: <?= json_encode($position, JSON_NUMERIC_CHECK); ?>,
            			labels: <?= json_encode($role); ?>,
            			grid: {
            				strokeDashArray: 4,
            			},
            			colors: ["#6c757d", "#007bff", "#ffc107"],
            			legend: {
            				show: false,
            			},
            			tooltip: {
            				fillSeriesColor: false
            			},
            		})).render();
            	});
            	// @formatter:on
            </script>