<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Website extends CI_Model
{

  public function getnewEvent()
  {
    $this->db->select('event.*, categories.categories,user.*');
    $this->db->from('event');
    $this->db->join('categories', 'event.category_id = categories.id');
    $this->db->join('user', 'event.author = user.id');
    $this->db->order_by('event.id', 'desc');
    $this->db->limit('3');
    return $this->db->get();
  }
  public function getpriceList()
  {
    return $this->db->get('pricelist');
  }
  public function getAllEvent()
  {
    $this->db->select('event.*, categories.categories,user.role_id');
    $this->db->from('event');
    $this->db->join('categories', 'event.category_id = categories.id');
    $this->db->join('user', 'event.author = user.id');
    $this->db->order_by('event.id', 'desc');
    return $this->db->get();
  }
  public function getcatEvent($category)
  {
    $this->db->select('event.*, categories.categories,user.*');
    $this->db->from('event');
    $this->db->join('categories', 'event.category_id = categories.id');
    $this->db->join('user', 'event.author = user.id');
    $this->db->order_by('event.id', 'desc');
    $this->db->where('category_id', $category);
    return $this->db->get()->result_array();
  }
  public function getAllWrkEvent()
  {
    $query = "SELECT `event`.*, `categories`.`categories`, `user`.`name`, `user`. `role_id` FROM `event` JOIN `categories` ON `event`.`category_id` = `categories`.`id` JOIN user ON `event`.`author` = `user`.`id` WHERE `categories` = 'Workshop' ";
    return $this->db->query($query);
  }
  public function getcategory()
  {
    return $this->db->get('categories')->result_array();
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
  public function getAllTestimoni()
  {
    return $this->db->get('testimonials');
  }
  public function getAllLmbEvent()
  {
    $query = "SELECT `event`.*, `categories`.`categories`, `user`.`name`, `user`. `role_id` FROM `event` JOIN `categories` ON `event`.`category_id` = `categories`.`id` JOIN user ON `event`.`author` = `user`.`id` WHERE `categories` = 'Lomba' ";
    return $this->db->query($query);
  }
  public function getAllWebEvent()
  {
    $query = "SELECT `event`.*, `categories`.`categories`, `user`.`name`, `user`. `role_id` FROM `event` JOIN `categories` ON `event`.`category_id` = `categories`.`id` JOIN user ON `event`.`author` = `user`.`id` WHERE `categories` = 'Webinar' ";
    return $this->db->query($query);
  }

  public function getTipeEvent()
  {

    $query = "SELECT `event`.*, `categories`.`categories`, `user`.`name`, `user`. `role_id` FROM `event` JOIN `categories` ON `event`.`category_id` = `categories`.`id` JOIN user ON `event`.`author` = `user`.`id`";
    return $this->db->query($query)->result_array();
  }
  public function getharga()
  {
    $query = "SELECT DISTINCT `event`.`harga` FROM `event` WHERE harga > 0";
    return $this->db->query($query);
  }
  public function getAllBlog($limit, $start)
  {
    $this->db->select('blog.*, tags.tags_name,user.*');
    // $this->db->from('blog');
    $this->db->join('tags', 'blog.tag_id = tags.id');
    $this->db->join('user', 'blog.author = user.id');
    $this->db->order_by('blog.id', 'asc');
    return $this->db->get('blog', $limit, $start);
  }
  public function countAlldata()
  {
    return $this->db->get('blog')->num_rows();
  }
  public function getAllRecentBlog()
  {
    $this->db->select('blog.*, tags.tags_name,user.*');
    $this->db->from('blog');
    $this->db->join('tags', 'blog.tag_id = tags.id');
    $this->db->join('user', 'blog.author = user.id');
    $this->db->order_by('blog.id', 'desc');
    $this->db->limit('3');
    return $this->db->get();
  }
  public function getAlltagsBlog()
  {
    return $this->db->get('tags');
  }
  public function getBlogId($id)
  {
    $this->db->select('blog.*, tags.tags_name,user.*');
    $this->db->from('blog');
    $this->db->join('tags', 'blog.tag_id = tags.id');
    $this->db->join('user', 'blog.author = user.id');
    $this->db->order_by('blog.id', 'desc');
    $this->db->where('blog.slug', $id);
    return $this->db->get()->row_array();
  }
  public function getTagsId($id)
  {
    $this->db->select('blog.*, tags.tags_name,user.*');
    $this->db->from('blog');
    $this->db->join('tags', 'blog.tag_id = tags.id');
    $this->db->join('user', 'blog.author = user.id');
    $this->db->order_by('blog.id', 'desc');
    $this->db->where('tags.tags_name', $id);
    return $this->db->get()->result_array();
  }
}
