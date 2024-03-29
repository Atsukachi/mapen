        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar" data-sidebarbg="skin6">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar" data-sidebarbg="skin6">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav pt-0    ">
                    <ul id="sidebarnav">
                        <!-- -->

                        <?php
                        $role_id = $this->session->userdata('role_id');
                        $queryMenu = "Select `user_menu`.`id`,`menu`
                                    FROM `user_menu` JOIN `user_access_menu`
                                    ON `user_menu`.`id`=`user_access_menu`.`menu_id`
                                    WHERE `user_access_menu`.`role_id`=$role_id
                                    ORDER BY `user_access_menu`.`menu_id` ASC
                                    ";
                        $menu = $this->db->query($queryMenu)->result_array();
                        ?>

                        <?php foreach ($menu as $m) : ?>
                            <li class="list-divider"></li>
                            <li class="nav-small-cap"><span class="hide-menu"><?= $m['menu'] ?></span></li>

                            <?php
                            $menuId = $m['id'];
                            $querySubMenu = "Select*
                                            FROM `user_sub_menu` 
                                            WHERE `menu_id`=$menuId
                                            AND `is_active`=1
                            ";
                            $subMenu = $this->db->query($querySubMenu)->result_array();
                            ?>

                            <?php foreach ($subMenu as $sm) : ?>

                                <li class="sidebar-item"> <a class="sidebar-link" href="<?= base_url($sm['url']) ?>" aria-expanded="false"><i class="<?= $sm['icon']; ?>" style="color:#52B8DB"></i><span class="hide-menu"><?= $sm['title'] ?>
                                        </span></a>
                                </li>

                            <?php endforeach; ?>

                        <?php endforeach; ?>

                        <li class="list-divider"></li>
                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="<?= base_url('login/logout') ?>" aria-expanded="false"><i data-feather="log-out" class="feather-icon"></i><span class="hide-menu">Logout</span></a></li>
                        <li class="list-divider"></li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-lg-10 col-lg-push-2 align-self-center">
                        <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">
                            <?php
                            //ubah timezone menjadi jakarta
                            date_default_timezone_set("Asia/Jakarta");

                            //ambil jam, menit dan detik
                            $jam = date('H:i:s');

                            $data['salam'] = $this->db->get('status')->result();
                            $salam = $data['salam'];
                            foreach ($salam as $s) {
                                if ($jam > $s->jam_datang && $jam < $s->jam_pulang) {
                                    //tampilkan pesan
                                    echo 'Selamat ' . $s->status . ', ' . $user['name'] . '!';
                                }
                            }
                            ?>
                        </h3>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item"><a href="index.html"><?= $title ?></a>
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="col-lg-2 col-lg-pull-10 align-self-center p-0 pt-3">
                        <div class="customize-input">
                            <h3 class="custom-select-set form-control bg-white border-0 custom-shadow custom-radius d-flex justify-content-center">
                                <?php
                                //tampilkan pesan
                                echo
                                '<row>
                                <col>' . tgl_indo(date('Y-m-d')) . '</col>
                                <br><br><col><p id="ontime""></p></col>
                                </row>';
                                ?>
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->