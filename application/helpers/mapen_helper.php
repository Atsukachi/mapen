<?php
function is_logged_in()
{
    $ci = get_instance();
    if (!$ci->session->userdata('email')) {
        redirect('login');
    } else {
        $role_id = $ci->session->userdata('role_id');
        $menu = $ci->uri->segment(1);
        $queryMenu = $ci->db->get_where('user_menu', ['menu' => $menu])->row_array();
        $menu_id = $queryMenu['id'];

        $userAccess = $ci->db->get_where('user_access_menu', [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ]);
        if ($userAccess->num_rows() < 1) {
            redirect('login/blocked');
        }
    }
}

function is_present_in()
{
    $ci = get_instance();
    if (!$ci->session->userdata('email')) {
        redirect('login');
    } else {
        $menu = $ci->uri->segment(3);
        $sj = salam_jam();

        $query = "SELECT riwayat.*, status.*
        FROM riwayat LEFT JOIN status ON riwayat.status_id = status.id_status 
        WHERE riwayat.id_riwayat = '$menu' AND status.status = '$sj'";
        $hasil = $ci->db->query($query);

        if ($hasil->num_rows() < 1) {
            redirect('pegawai/blocked');
        }
    }
}

function is_riwayat_in()
{
    $ci = get_instance();
    if (!$ci->session->userdata('email')) {
        redirect('login');
    } else {
        $tgl = date("Y-m-d");
        $data = $ci->session->userdata('user_id');
        $menu = $ci->uri->segment(3);
        $sj = salam_jam();

        $query = "SELECT riwayat.*, status.*, 
        (SELECT COUNT(riwayat) FROM presensi WHERE user_id = '$data' AND date = '$tgl' AND riwayat.riwayat = 'Jam Datang') as p_cek
        FROM riwayat LEFT JOIN status ON riwayat.status_id = status.id_status WHERE status.status = '$sj' AND riwayat.id_riwayat = '$menu'";
        $hasil = ($ci->db->query($query)->row_array());
        $cek = $hasil['p_cek'];
        if ($cek = '1') {
            var_dump($cek);
        };

        // if ($hasil->num_rows() < 1) {
        //     redirect('pegawai/blocked');
        // }
    }
}

function is_user_in()
{
    $ci = get_instance();
    if (!$ci->session->userdata('email')) {
        redirect('login');
    } else {
        $inirole = $ci->session->userdata('role_id');
        if ($inirole == '2') {
            $menu = $ci->uri->segment(4);
            $admin = '1';
            $queryMenu = $ci->db->get_where('user', ['role_id' => $admin])->row_array();
            $user = $queryMenu['user_id'];

            $userAccess = $ci->db->get_where('user', [
                'user_id' => $menu,
                'role_id' => $user
            ]);
            if ($userAccess->num_rows() > 0) {
                redirect('pegawai/blocked');
            }
        }
    }
}

function is_history_in()
{
    $ci = get_instance();
    if (!$ci->session->userdata('email')) {
        redirect('login');
    } else {
        $inirole = $ci->session->userdata('role_id');
        if ($inirole == '1') {
            $ci->session->set_flashdata('check', '<div class="alert alert-primary" role="alert"><i class="fas fa-info-circle"></i> You are <strong>"Super Admin"</strong>!</div>');
        } else if ($inirole == '2') {
            $menu = $ci->uri->segment(3);
            $admin = '1';
            $queryMenu = $ci->db->get_where('user', ['role_id' => $admin])->row_array();
            $user = $queryMenu['user_id'];
            $userAccess = $ci->db->get_where('user', [
                'user_id' => $menu,
                'role_id' => $user
            ]);
            if ($userAccess->num_rows() > 0) {
                redirect('pegawai/blocked');
            }
        } else if ($inirole != '1' || $inirole != '2') {
            $iniuser = $ci->session->userdata('user_id');
            $menu = $ci->uri->segment(3);
            if ($menu != $iniuser) {
                redirect('pegawai/blocked');
            }
        }
    }
}

function cek_role_id($role_id)
{
    $ci = get_instance();
    $ci->db->where('role_id', $role_id);
}

function check_access($role_id, $menu_id)
{
    $ci = get_instance();

    $ci->db->where('role_id', $role_id);
    $ci->db->where('menu_id', $menu_id);
    $result = $ci->db->get('user_access_menu');

    if ($result->num_rows() > 0) {
        return "checked='checked'";
    }
}

if (!function_exists('tgl_indo')) {
    function tgl_indo($tanggal)
    {
        $bulan = array(
            1 =>   'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );
        $pecahkan = explode('-', $tanggal);

        // variabel pecahkan 0 = tanggal
        // variabel pecahkan 1 = bulan
        // variabel pecahkan 2 = tahun

        return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
    }
}

if (!function_exists('time_ago')) {

    /**
     * Time Ago helper for CodeIgniter.
     *
       
     */
    function time_ago($time)
    {
        $periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
        $lengths = array("60", "60", "24", "7", "4.35", "12", "10");

        $now = time();

        $difference     = $now - $time;
        $tense         = "ago";

        for ($j = 0; $difference >= $lengths[$j] && $j < count($lengths) - 1; $j++) {
            $difference /= $lengths[$j];
        }

        $difference = round($difference);

        if ($difference != 1) {
            $periods[$j] .= "s";
        }

        return "$difference $periods[$j] ago ";
    }
}

if (!function_exists('format_indo')) {
    function format_indo($date)
    {
        date_default_timezone_set('Asia/Jakarta');
        // array hari dan bulan
        $Hari = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu");
        $Bulan = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

        // pemisahan tahun, bulan, hari, dan waktu
        $tahun = substr($date, 0, 4);
        $bulan = substr($date, 5, 2);
        $tgl = substr($date, 8, 2);
        $hari = date("w", strtotime($date));
        $result = $Hari[$hari] . ", " . $tgl . " " . $Bulan[(int)$bulan - 1] . " " . $tahun . " ";

        return $result;
    }
}

if (!function_exists('waktu_indo')) {
    function waktu_indo($date)
    {
        date_default_timezone_set('Asia/Jakarta');
        // $waktu = substr($date, 11, 5);
        $waktu = substr($date, 11);

        $result = $waktu;

        return $result;
    }
}

function salam_jam()
{
    //ubah timezone menjadi jakarta
    date_default_timezone_set("Asia/Jakarta");

    //ambil jam, menit dan detik
    $jam = date('H:i:s');

    //atur salam menggunakan IF
    if ($jam > '07:00:00' && $jam < '10:00:00') {
        $salam = 'Pagi';
    } elseif ($jam >= '10:00:00' && $jam < '15:00:00') {
        $salam = 'Siang';
    } elseif ($jam < '18:00:00') {
        $salam = 'Sore';
    } else {
        $salam = 'Malam';
    }
    return $salam;
}

function cek_jam()
{
    //ubah timezone menjadi jakarta
    date_default_timezone_set("Asia/Jakarta");

    //ambil jam, menit dan detik
    $jam = date('H:i:s');

    //atur salam menggunakan IF
    if ($jam > '07:00:00' && $jam < '10:00:00') {
        $cek = '1';
    } elseif ($jam >= '10:00:00' && $jam < '15:00:00') {
        $cek = '2';
    } elseif ($jam < '18:00:00') {
        $cek = '3';
    } else {
        $cek = '4';
    }
    return $cek;
}
