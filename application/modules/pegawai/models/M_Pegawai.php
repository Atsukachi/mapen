<?php
defined('BASEPATH') or exit('No direct access allowed');

class M_Pegawai extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
    }

    public function getDataPresensi()
    {
        if ($this->session->userdata('role_id') == 1) {
            $this->db->select('presensi.*,status.status,user.name,user.role_id,user.user_id');
            $this->db->from('presensi');
            $this->db->join('status', 'presensi.status = status.id_status', 'left');
            $this->db->join('user', 'presensi.user_id = user.user_id', 'left');
            $this->db->order_by('presensi.id', 'ASC');
            return $this->db->get();
        } else if ($this->session->userdata('role_id') == 2) {
            $this->db->select('presensi.*,status.status,user.name,user.role_id,user.user_id');
            $this->db->from('presensi');
            $this->db->join('status', 'presensi.status = status.id_status', 'left');
            $this->db->join('user', 'presensi.user_id = user.user_id', 'left');
            $this->db->order_by('presensi.id', 'ASC');
            $this->db->where('presensi.user_id!=1');
            return $this->db->get();
        } else {
            $data = $this->session->userdata('name');
            $this->db->select('presensi.*,user.name,user.role_id,user.user_id');
            $this->db->from('presensi');
            $this->db->join('user', 'presensi.user_id = user.user_id', 'left');
            $this->db->order_by('presensi.id', 'ASC');
            $this->db->where('user.name=', $data);
            return $this->db->get();
        }
    }

    function getPresensibyBulan()
    {
        $user_id = $this->session->userdata('user_id');
        $tahun = date("Y");
        $query = "SELECT id_bulan, nama_bulan as bln, tepatwaktu, terlambat from bulan 
        LEFT JOIN( 
            SELECT MONTH(date) AS name, COUNT(id) AS tepatwaktu
            FROM presensi 
            WHERE YEAR(date) = '$tahun' AND cek_presensi = 1 AND user_id = $user_id
            GROUP BY MONTH(date)
            ) 
        tw ON (bulan.id_bulan=tw.name)
         LEFT JOIN( 
            SELECT MONTH(date) AS name, COUNT(id) AS terlambat
            FROM presensi 
            WHERE YEAR(date) = '$tahun' AND cek_presensi = 2 AND user_id = $user_id
            GROUP BY MONTH(date)
            ) 
        tl ON (bulan.id_bulan=tl.name) ORDER BY bulan.id_bulan ASC";
        return $this->db->query($query);
    }

    public function getUserExport()
    {
        if ($this->session->userdata('role_id') == 1) {
            $this->db->select('*');
            $this->db->from('user');
            return $this->db->get();
        } else if ($this->session->userdata('role_id') == 2) {
            $this->db->select('*');
            $this->db->from('user');
            $this->db->where('user.role_id!=1');
            return $this->db->get();
        } else {
            $data = $this->session->userdata('name');
            $this->db->select('*');
            $this->db->from('user');
            $this->db->where('user.name=', $data);
            return $this->db->get();
        }
    }

    public function getDataPresensiCek()
    {
        $tgl = date("Y-m-d");
        $this->load->helper('mapen_helper');
        $data = $this->session->userdata('user_id');
        $query = "SELECT riwayat.*, status.*, 
        (SELECT COUNT(id) FROM presensi WHERE user_id = '$data' AND date = '$tgl' AND presensi.riwayat = riwayat.id_riwayat) as cek_p,
        (SELECT COUNT(riwayat) FROM presensi WHERE user_id = '$data' AND date = '$tgl' AND riwayat.riwayat = 'Jam Datang') as p_cek
        FROM riwayat LEFT JOIN status ON riwayat.status_id = status.id_status WHERE status.status = '" . salam_jam() . "'";
        return $this->db->query($query);
    }

    public function getDataCekPresensi($id_riwayat)
    {
        $tgl = date("Y-m-d");
        $this->load->helper('mapen_helper');
        $data = $this->session->userdata('user_id');
        $query = "SELECT riwayat.*, status.*, 
        (SELECT COUNT(id) FROM presensi WHERE user_id = '$data' AND date = '$tgl' AND presensi.riwayat = riwayat.id_riwayat) as cek_p,
        (SELECT COUNT(riwayat) FROM presensi WHERE user_id = '$data' AND date = '$tgl' AND riwayat.riwayat = 'Jam Datang') as p_cek
        FROM riwayat LEFT JOIN status ON riwayat.status_id = status.id_status WHERE riwayat.id_riwayat = '$id_riwayat' AND status.status = '" . salam_jam() . "'";
        return $this->db->query($query);
        var_dump($this->db->query($query));
    }

    public function getDataEditPresensi($id)
    {
        $data = array(
            'presensi.id' => $id,
        );
        $this->db->select('presensi.*, riwayat.id_riwayat, riwayat.riwayat, status.id_status, status.status, kerja.metode, user.name');
        $this->db->from('presensi');
        $this->db->join('user', 'presensi.user_id = user.user_id', 'left');
        $this->db->join('riwayat', 'presensi.riwayat = riwayat.id_riwayat', 'left');
        $this->db->join('status', 'presensi.status = status.id_status', 'left');
        $this->db->join('kerja', 'presensi.kerja = kerja.id_kerja', 'left');
        $this->db->where($data);
        return $this->db->get();
    }
    public function getPresensiId($id)
    {
        $this->db->get('presensi');
        $this->db->where('id=', $id);
        return $this->db->get();
    }

    public function getPresensiAll()
    {
        $this->db->select('presensi.*, riwayat.riwayat as jenis_riwayat, kerja.metode, status.status as jenis_status,user.name,user.role_id,user.user_id');
        $this->db->from('presensi');
        $this->db->join('status', 'presensi.status = status.id_status', 'left');
        $this->db->join('user', 'presensi.user_id = user.user_id', 'left');
        $this->db->join('riwayat', 'presensi.riwayat = riwayat.id_riwayat', 'left');
        $this->db->join('kerja', 'presensi.kerja = kerja.id_kerja', 'left');
        return $this->db->get();
    }

    public function getPresensiById($id)
    {
        $this->db->select('presensi.*, riwayat.riwayat as jenis_riwayat, kerja.metode, status.status as jenis_status,user.name,user.role_id,user.user_id');
        $this->db->from('presensi');
        $this->db->join('status', 'presensi.status = status.id_status', 'left');
        $this->db->join('user', 'presensi.user_id = user.user_id', 'left');
        $this->db->join('riwayat', 'presensi.riwayat = riwayat.id_riwayat', 'left');
        $this->db->join('kerja', 'presensi.kerja = kerja.id_kerja', 'left');
        $this->db->order_by('presensi.id', 'ASC');
        if ($id == '') {
            return $this->db->get();
        }
        $this->db->where('user.user_id=', $id);
        return $this->db->get();
    }

    public function getPresensi()
    {
        $this->load->helper('mapen_helper');
        $query = "SELECT riwayat.*, status.*
        FROM riwayat
        LEFT JOIN status ON riwayat.status_id = status.id_status
        WHERE status.status = '" . salam_jam() . "'";
        return $this->db->query($query);
    }

    public function getStatusRiwayat($id_riwayat)
    {
        $this->load->helper('mapen_helper');
        $this->db->select('riwayat.*,status.*');
        $this->db->from('riwayat');
        $this->db->join('status', 'riwayat.status_id=status.id_status');
        $this->db->where('id_riwayat=', $id_riwayat);
        $this->db->where('status.status=', salam_jam());
        return $this->db->get();
    }

    public function getRiwayatId($id_riwayat)
    {
        $this->db->select('riwayat.*');
        $this->db->from('riwayat');
        $this->db->where('id_riwayat=', $id_riwayat);
        return $this->db->get();
    }

    public function getAllRiwayat()
    {
        $this->load->helper('mapen_helper');
        $this->db->select('riwayat.*,status.*');
        $this->db->from('riwayat');
        $this->db->join('status', 'riwayat.status_id=status.id_status');
        $this->db->where('status.status=', salam_jam());
        return $this->db->get();
    }

    public function getAllStatus()
    {
        $this->load->helper('mapen_helper');
        $this->db->select('*');
        $this->db->from('status');
        return $this->db->get();
    }

    public function getDataKerja()
    {
        return $this->db->get('kerja');
    }

    public function getJumlahPresensi()
    {
        $tgl = date("Y-m-d");
        $data = $this->session->userdata('user_id');
        $query = "SELECT COUNT(id) AS jml_presensi FROM presensi WHERE user_id = '$data' AND date = '$tgl'";
        return $this->db->query($query);
    }

    public function getTotalPresensi()
    {
        $tgl = date("m");
        $data = $this->session->userdata('user_id');
        $query = "SELECT COUNT(id) AS jml_p FROM presensi WHERE user_id = '$data' AND month(date) = '$tgl'";
        return $this->db->query($query);
    }

    public function getTotal()
    {
        $data = $this->session->userdata('user_id');
        $query = "SELECT COUNT(id) AS tot_p FROM presensi WHERE user_id = '$data'";
        return $this->db->query($query);
    }

    public function getJumlahPresensiById($id)
    {
        $tgl = date("Y-m-d");
        $query = "SELECT COUNT(id) AS jml_presensi FROM presensi WHERE user_id = '$id' AND date = '$tgl'";
        return $this->db->query($query);
    }

    public function getTotalPresensiById($id)
    {
        $tgl = date("m");
        $query = "SELECT COUNT(id) AS jml_p FROM presensi WHERE user_id = '$id' AND month(date) = '$tgl'";
        return $this->db->query($query);
    }

    public function getTotalById($id)
    {
        $query = "SELECT COUNT(id) AS tot_p FROM presensi WHERE user_id = '$id'";
        return $this->db->query($query);
    }

    public function delete_pegawai($id)
    {
        $this->db->where(['id' => $id]);
        return $this->db->delete('presensi');
    }
    // public function getDataEvent()
    // {
    //     if ($this->session->userdata('role_id') == 1) {
    //         $this->db->select('event.*, categories.categories,user.name,user.role_id');
    //         $this->db->from('event');
    //         $this->db->join('categories', 'event.category_id = categories.id', 'left');
    //         $this->db->join('user', 'event.author = user.id', 'left');
    //         $this->db->order_by('event.id', 'ASC');
    //         return $this->db->get();
    //     } else {
    //         $data = $this->session->userdata('name');
    //         $this->db->select('event.*, categories.categories,user.name,user.role_id');
    //         $this->db->from('event');
    //         $this->db->join('categories', 'event.category_id = categories.id', 'left');
    //         $this->db->join('user', 'event.author = user.id', 'left');
    //         $this->db->order_by('event.id', 'ASC');
    //         $this->db->where('user.name=', $data);
    //         return $this->db->get();
    //     }
    // }
    // public function getLastEvent($bulan, $tahun, $code)
    // {
    //     $this->db->select('event.event_id');
    //     $this->db->from('event');
    //     $this->db->join('user', 'event.author = user.id', 'left');
    //     $this->db->join('eventcode', 'user.is_active = eventcode.id', 'left');
    //     $this->db->order_by('event.event_id', 'DESC');
    //     $this->db->where('eventcode.event_code=', $code);
    //     $this->db->where('MONTH(tgl_event)', $bulan);
    //     $this->db->where('YEAR(tgl_event)', $tahun);
    //     $this->db->limit(1);
    //     return $this->db->get();
    // }
    // public function delete_event($event_id)
    // {

    //     $this->db->where('event_id', $event_id);
    //     return $this->db->delete('event');
    //     return $this->db->delete('galery');
    // }
    // public function getDataEditEvent($id)
    // {
    //     $data = array(
    //         'event.id' => $id,
    //     );
    //     $this->db->select('event.*, categories.categories,user.*');
    //     $this->db->from('event');
    //     $this->db->join('categories', 'event.category_id = categories.id');
    //     $this->db->join('user', 'event.author = user.id');
    //     $this->db->where($data);
    //     return $this->db->get();
    // }
    // public function getJmlEvent()
    // {
    //     $query = "SELECT COUNT(event_id) as jml FROM event 
    //     ";
    //     return $this->db->query($query)->result_array();
    // }
    // public function getJmlStatusTutup()
    // {
    //     $query = "SELECT COUNT(status) as statusf FROM event where status=1";
    //     return $this->db->query($query)->result_array();
    // }
    // public function getJmlStatusTersedia()
    // {
    //     $query = "SELECT COUNT(status) as statuss FROM event where status=0";
    //     return $this->db->query($query)->result_array();
    // }
    // public function getJmlStatusEvent()
    // {
    //     $bulan = date("m");
    //     $query = "SELECT COUNT(event_id) as jmlb FROM event where month(tgl_event)=" . $bulan;
    //     return $this->db->query($query)->result_array();
    // }
}
