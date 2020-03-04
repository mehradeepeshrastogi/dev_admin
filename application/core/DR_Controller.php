<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DR_Controller extends CI_Controller {

	public $class;
	public $method;
	public $controller_type;
	public $lang_id;
	public $data;
	public $controllerName;
	public $controllerFor;
	public $defaultImage;
	public $current_datetime;
	
	public function __construct(){
		parent::__construct();
		$this->class = $this->router->fetch_class();
		$this->method = $this->router->fetch_method();
		$this->current_datetime = date("Y-m-d H:i:s");
		$this->data['defaultImage'] = base_url('assets/images/no-image.jpg');
		$this->data['languages'] = $this->LanguageModel->language();
		$this->load->helper('program');
	}



	public function template($page, $data=[], $return = false)
	{  
		$html = "";
		$template = $this->controllerName.'/layouts/';
		if($return){
			$html .= $this->load->view($template.'/header',$data,$return);
			$html .= $this->load->view($page,$data,$return);
			$html .= $this->load->view($template.'/footer',$return);
			return $html;
		}else{
			$this->load->view($template.'header',$data,$return);
			$this->load->view($page,$data,$return);
			$this->load->view($template.'footer',$return);
		}
		
	}
	

	public function sendMailAttach($from,$to,$from_name,$subject,$message,$attachFile=null)
	{
		$email_config = array(
							'protocol'  => 'smtp',
							'smtp_host' => 'smtp.sendgrid.net',
							'smtp_port' => '587',
							'smtp_user' => 'sushant.infodev',
							'smtp_pass' => 'sushant@2345',
							'mailtype'  => 'html',
							'starttls'  => true,
							'newline'   => "\r\n"
						);
		$this->email->initialize($email_config);
		$this->email->from($from,$from_name);
		$this->email->to($to);
		$this->email->subject($subject);
		$this->email->message($message);
		
		if(!empty($attachFile) && is_array($attachFile))
		{
			for($i=0;$i<count($attachFile);$i++){
				$this->email->attach($attachFile[$i]);
			}
		}elseif(!empty($attachFile)){
			$this->email->attach($attachFile);
		}
		$this->email->set_mailtype("html");
		if ($this->email->send()) {
			$this->email->clear(TRUE);
			return "sent";
		} else {
			// echo $this->email->print_debugger(); die;
			return "not";
		}
	}
}
