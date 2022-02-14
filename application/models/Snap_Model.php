<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Snap_Model extends CI_Model
{
    public $table = 'pembayaran_midtrans';
    public $primaryKey = 'id';
    
    public function __construct(){
        parent::__construct();
    }

    public function insert($data)
    {
        return $this->db->insert($this->table,$data);
    }
    public function getEventId($id)
    {
      $this->db->select('event.*, categories.categories,user.*');
      $this->db->from('event');
      $this->db->join('categories', 'event.category_id = categories.id');
      $this->db->join('user', 'event.author = user.id');
      $this->db->order_by('event.id', 'desc');
      $this->db->where('event.event_id', $id);
      return $this->db->get()->row_array();
    }
    public function getOrderId($id)
    {
      $this->db->select('event.*, pembayaran_midtrans.*');
      $this->db->from('pembayaran_midtrans');
      $this->db->join('event', 'pembayaran_midtrans.event=event.event_id');
      $this->db->where('pembayaran_midtrans.id', $id);
      return $this->db->get()->row_array();
    }
    
}