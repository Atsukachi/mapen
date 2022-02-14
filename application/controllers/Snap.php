<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Snap extends CI_Controller {

	public function __construct()
    {
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Methods: PUT, GET, POST");
		header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
        parent::__construct();
        $params = array('server_key' => 'SB-Mid-server-o9_hVAqr-DA3DdRPL2lTip5f', 'production' => false);
		$this->load->library('midtrans');
		$this->midtrans->config($params);
		$this->load->model('Snap_Model','snap');
    }

    public function index($id)
    {
    	$data['title'] = "Halaman Pembayaran";
		$data['user'] = $this->db->get_where('user', ['email' =>
		$this->session->userdata('email')])->row_array();
		$data['detailbayar'] = $this->snap->getEventId($id);

		$this->load->view('templates/webs/header', $data);
    	$this->load->view('checkout_snap',$data);
		$this->load->view('templates/webs/footer');
    }

    public function token()
    {
		// Required
		$transaction_details = array(
			'order_id' => rand(),
			'gross_amount' => $this->input->post('gross_amount'), // no decimal allowed for creditcard
			'id_event' => $this->input->post('id_event') // no decimal allowed for creditcard
		  );
  
		  // Optional
		  $item1_details = array(
			
			'price' => $this->input->post('price'),
			'quantity' => $this->input->post('quantity'),
			'name' => $this->input->post('name')
		  );
  
		  // Optional
		  $billing_address = array(
			'first_name'    => "Andri",
			'last_name'     => "Litani",
			'address'       => "Mangga 20",
			'city'          => "Jakarta",
			'postal_code'   => "16602",
			'phone'         => "081122334455",
			'country_code'  => 'IDN'
		  );
  
		  // Optional
		  $shipping_address = array(
			'first_name'    => "Obet",
			'last_name'     => "Supriadi",
			'address'       => $this->input->post('event'),
			'phone'         => "08113366345",
			'country_code'  => 'IDN'
		  );
  
		  // Optional
		  $customer_details = array(
			'first_name'    => $this->input->post('nama'),
			'email'         => $this->input->post('email'),
			'phone'         => $this->input->post('telephone'),
			'event'         => $this->input->post('event')
		  );
  
		  // Data yang akan dikirim untuk request redirect_url.
		  $credit_card['secure'] = true;
		  //ser save_card true to enable oneclick or 2click
		  //$credit_card['save_card'] = true;
  
		  $time = time();
        $custom_expiry = array(
            'start_time' => date("Y-m-d H:i:s O",$time),
            'unit' => 'hour', 
            'duration'  => 24
        );
        
        $transaction_data = array(
            'transaction_details'=> $transaction_details,
            'item_details'       => $item1_details,
            'customer_details'   => $customer_details,
            'credit_card'        => $credit_card,
            'expiry'             => $custom_expiry
        );
  
		  error_log(json_encode($transaction_data));
		  $snapToken = $this->midtrans->getSnapToken($transaction_data);
		  error_log($snapToken);
		  echo $snapToken;
	  }

	  public function finish()
	  {
		  $result = json_decode($this->input->post('result_data')); 
  
		  if (isset($result->va_numbers[0]->bank)) {
			  $bank = $result->va_numbers[0]->bank;
		  }else{
			  $bank='-';
		  }
  
		  if (isset($result->va_numbers[0]->va_number)) {
			  $va_number = $result->va_numbers[0]->va_number;
		  }else{
			  $va_number='-';
		  }
		  
		  if (isset($result->bca_va_number)) {
			  $bca_va_number = $result->bca_va_number;
		  }else{
			  $bca_va_number='-';
		  }
		  
		  if (isset($result->bill_key)) {
			  $bill_key = $result->bill_key;
		  }else{
			  $bill_key='-';
		  }
  
		  if (isset($result->biller_code)) {
			  $biller_code = $result->biller_code;
		  }else{
			  $biller_code='-';
		  }
  
		  if (isset($result->permata_va_number)) {
			  $permata_va_number = $result->permata_va_number;
		  }else{
			  $permata_va_number='-';
		  }
		  $event = $this->input->post('event');
		  $nama = $this->input->post('nama');
		  $data=[
			  'event'=>$event,
			  'status_code' => $result->status_code,
			  'status_message' => $result->status_message,
			  'transaction_id' => $result->transaction_id,
			  'order_id' => $result->order_id,
			  'nama'=>$nama,
			  'gross_amount' => $result->gross_amount,
			  'payment_type' => $result->payment_type,
			  'transaction_time' => $result->transaction_time,
			  'transaction_status' => $result->transaction_status,
			  'fraud_status' => $result->fraud_status,
			  'pdf_url' => $result->pdf_url,
			  'finish_redirect_url' => $result->finish_redirect_url,
			  
			  //Pembeda Tiap bank
			  'permata_va_number' => $permata_va_number,
			  'bank' => $bank,
			  'va_number' => $va_number,
			  'bill_key' => $bill_key,
			  'biller_code' => $biller_code,
			  'bca_va_number' => $bca_va_number,
  
		  ];
  
		  $return = $this->snap->insert($data);
  
		  if ($return) {
			  echo "Request Pembayaran berhasil dilakukan silahkan segera melakukan pembayaran";
		  }else{
			  "Request Pembayaran Gagal";
		  }
  
		  $this->data['finish'] = json_decode($this->input->post('result_data')); 
		  $this->load->view('konfirmasi', $this->data);
  
	  }
  }