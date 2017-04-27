<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		$this -> load -> model('message_model');
		$message = $this -> message_model -> get_message();
		$this->load->view('index',array(
			'messages' => $message
		));
	}
	public function user()
	{
        $this->load->library('session');
	    $loginedUser=$this->session->userdata("loginedUser");
        $this->load->model('user_model');
        $msg_count=$this->user_model->get_message_count($loginedUser->user_id);
        $com_count=$this->user_model->get_comment_count($loginedUser->user_id);
		$this->load->view('user',array(
		    "msg_counts"=>$msg_count,
            "com_counts"=>$com_count
        ));
	}
	public function login()
	{
        $this->load->view('login');

	}
	public function reg(){
        $name=$this->input->post("name");
        $password=$this->input->post("password");
        $portrait="assets/img/default.jpg";
        $this->load->model("user_model");
        $results=$this->user_model->save($name,$password,$portrait);
        if($results>0){
            redirect("welcome/login");
        }
    }
    public function do_login(){
        $this->load->library('session');
        $name=$this->input->post("name");
        $password=$this->input->post("password");
        $this->load->model('user_model');
        $row=$this->user_model->get_by_name_pwd($name,$password);
        if($row){
            $this->session->set_userdata("loginedUser",$row);
            redirect("welcome/user");
        }else{
            redirect("welcome/login");
        }
    }
    public function details(){
        $msg_id=$this->input->get("msg_id");
        $user_id=$this->input->get("user_id");
        $this->load->model('message_model');
        $result=$this->message_model->get_message_details($msg_id,$user_id);
        $comment=$this->message_model->get_comment_details($msg_id);
        $this->load->view("details",array(
            'details'=>$result,
            'comments'=>$comment
        ));
    }

}
