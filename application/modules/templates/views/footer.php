            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer text-center text-muted">
                <!-- All Rights Reserved by Mapen. Designed and Developed by <a href="https://wrappixel.com">Mapen</a>. -->
                All Rights Reserved by Mapen. Designed and Developed by <a href="https://dinus.ac.id/mahasiswa/A22.2019.02777">Didan Hafiz Putra Pratama</a>.
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Page wrapper  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Wrapper -->
            <!-- ============================================================== -->
            <!-- All Jquery -->
            <!-- ============================================================== -->
            <script src="<?= base_url('assets/dashboard/') ?>libs/jquery/dist/jquery.min.js"></script>
            <script src="<?= base_url('assets/dashboard/') ?>libs/popper.js/dist/umd/popper.min.js"></script>
            <script src="<?= base_url('assets/dashboard/') ?>libs/bootstrap/dist/js/bootstrap.min.js"></script>
            <!-- apps -->
            <!-- apps -->
            <script src="<?= base_url('assets/dashboard/') ?>dist/js/app.min.js"></script>
            <script src="<?= base_url('assets/dashboard/') ?>dist/js/app.init-menusidebar.js"></script>
            <script src="<?= base_url('assets/dashboard/') ?>dist/js/app-style-switcher.js"></script>
            <script src="<?= base_url('assets/dashboard/') ?>dist/js/feather.min.js"></script>
            <!--load all styles -->
            <script src="<?= base_url('assets/dashboard/') ?>dist/js/sidebarmenu.js"></script>
            <script src="<?= base_url('assets/dashboard/') ?>libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
            <script src="<?= base_url('assets/dashboard/') ?>extra-libs/sparkline/sparkline.js"></script>
            <!--Custom JavaScript -->
            <script src="<?= base_url('assets/dashboard/') ?>dist/js/custom.min.js"></script>
            <!--This page JavaScript -->
            <script src="<?= base_url('assets/dashboard/') ?>extra-libs/c3/d3.min.js"></script>
            <script src="<?= base_url('assets/dashboard/') ?>libs/chartist/dist/chartist.min.js"></script>
            <script src="<?= base_url('assets/dashboard/') ?>libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>
            <script src="<?= base_url('assets/dashboard/') ?>extra-libs/jvector/jquery-jvectormap-2.0.2.min.js"></script>
            <script src="<?= base_url('assets/dashboard/') ?>extra-libs/jvector/jquery-jvectormap-world-mill-en.js"></script>
            <script src="<?= base_url('assets/dashboard/') ?>dist/js/pages/dashboards/dashboard1.min.js"></script>

            <!--This page plugins -->
            <script src="<?= base_url('assets/dashboard/') ?>extra-libs/datatables.net/js/jquery.dataTables.min.js"></script>
            <script src="<?= base_url('assets/dashboard/') ?>dist/js/pages/datatable/datatable-basic.init.js"></script>
            <script src="<?= base_url('assets/dashboard/') ?>dist/js/sidebarmenu.js"></script>

            <!-- Dropify -->
            <script type="text/javascript" src="<?= base_url('assets/dashboard/') . 'dropify/dropify.min.js' ?>"></script>
            <script type="text/javascript">
                $(document).ready(function() {
                    $('.dropify').dropify({
                        messages: {
                            default: 'Drag atau drop untuk memilih gambar',
                            replace: 'Ganti',
                            remove: 'Hapus',
                            error: 'error'
                        }
                    });
                });
            </script>

            <!-- Javascript Chart -->
            <script src="<?= base_url('assets/dashboard/') ?>libs/raphael/raphael.min.js"></script>
            <script src="<?= base_url('assets/dashboard/') ?>libs/morris.js/morris.min.js"></script>
            <script src="<?= base_url('assets/dashboard/') ?>libs/apexcharts/dist/apexcharts.min.js"></script>
            <script src="<?= base_url('assets/dashboard/') ?>dist/js/pages/chartjs/chartjs.init.js"></script>
            <script src="<?= base_url('assets/dashboard/') ?>libs/chart.js/dist/Chart.min.js"></script>
            <!--Custom Text Area -->
            <script src="<?= base_url('assets/dashboard/') ?>chosen/chosen.jquery.min.js"></script>
            <script src="<?= base_url('assets/dashboard/') ?>ckeditor/ckeditor.js"></script>
            <script>
                CKEDITOR.replace('uraian[]');
                CKEDITOR.replace('deskripsi2');
            </script>
            <script>
                $('.chosen').chosen({
                    width: '100%',

                });
            </script>
            <script type="text/javascript">
                $(document).ready(function() {
                    $('#order_bulan').DataTable({
                        "order": [
                            [1, "desc"],
                            [2, "asc"]
                        ]
                    });
                });
            </script>
            <!-- Date Picker -->
            <script src="<?= base_url('assets/dashboard/') ?>dist/datetimepicker/DateTimePicker.js "></script>
            <script src="<?= base_url('assets/dashboard/') ?>extra-libs/datepicker/bootstrap-datepicker.js"></script>
            <script type="text/javascript">
                $(function() {
                    $(".datepicker").datepicker({
                        autoclose: true,
                        todayHighlight: true,
                        format: 'dd-mm-yyyy',
                        language: 'id'
                    });
                });
            </script>
            <script>
                function checkTime(i) {
                    if (i < 10) {
                        i = "0" + i;
                    }
                    return i;
                }

                function startTime() {
                    var today = new Date();
                    var h = today.getHours();
                    var m = today.getMinutes();
                    var s = today.getSeconds();
                    // add a zero in front of numbers<10
                    m = checkTime(m);
                    s = checkTime(s);
                    document.getElementById('ontime').innerHTML = h + ":" + m + ":" + s;
                    t = setTimeout(function() {
                        startTime()
                    }, 500);
                }
                startTime();
            </script>
            <script>
                // change filename in placeholder
                $(document).on('change', '.custom-file-input', function(event) {
                    $(this).next('.custom-file-label').html(event.target.files[0].name);
                })
            </script>
            <script>
                $('.form-check-input').on('click', function() {
                    const menuId = $(this).data('menu');
                    const roleId = $(this).data('role');

                    $.ajax({
                        url: "<?= base_url('admin/changeAccess'); ?>",
                        type: 'post',
                        data: {
                            menuId: menuId,
                            roleId: roleId
                        },
                        success: function() {
                            document.location.href = "<?= base_url('admin/roleAccess/'); ?>" + roleId;
                        }
                    })

                });
            </script>
            <script>
                function setDarkMode(isDark) {
                    if (isDark) {
                        document.body.setAttribute('id', 'darkmode')
                    } else {
                        document.body.setAttribute('id', '')
                    }

                }
            </script>
            </body>

            </html>