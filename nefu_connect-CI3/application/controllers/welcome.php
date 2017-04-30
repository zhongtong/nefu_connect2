<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function test(){
		$this->load->view('test');
	}
	public function index()
	{
		$loginedUser=$this->session->userdata("loginedUser");
		if($loginedUser){
			$this -> load -> model('message_model');
			$this -> load -> model('like_model');
			$message = $this -> message_model -> get_message();
			$result = $this -> like_model -> get_msgId_by_user($loginedUser->user_id);
			$this->load->view('index',array(
					'messages' => $message,
					'results' => $result
			));
		}else{
			$this -> load -> model('message_model');
			$message = $this -> message_model -> get_message();
			$this->load->view('index',array(
					'messages' => $message,
					'results' => ''
			));
		}

	}
	public function save_message(){
		$loginedUser=$this->session->userdata("loginedUser");
		$content=$this->input->post("content");
		$anonymity=$this->input->post("anonymity");
		$this -> load -> model('message_model');
		$results=$this->message_model->save_message($content,$anonymity,$loginedUser->user_id);
		if($results>0){
			redirect("welcome/index");
		}
	}
	public function user()
	{
		$loginedUser=$this->session->userdata("loginedUser");
		if($loginedUser) {
			$this->load->model('user_model');
			$msg_count = $this->user_model->get_message_count($loginedUser->user_id);
			$com_count = $this->user_model->get_comment_count($loginedUser->user_id);
			$this->load->view('user', array(
					"msg_counts" => $msg_count,
					"com_counts" => $com_count
			));
		}else{
			$this->load->view('login');
		}
	}
	public function login()
	{
		$this->load->view('login');
	}
	public function reg(){
		$name=$this->input->post("name");
		$password=$this->input->post("password");
		$portrait="assets/img/default.jpg";
		$sex=$this->input->post("sex");
		$this->load->model("user_model");
		$results=$this->user_model->save($name,$password,$portrait,$sex);
		if($results>0){
			redirect("welcome/login");
		}
	}
	public function do_login(){
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
	public function exit_login(){
		$this->session->unset_userdata("loginedUser");
		$this->load->view('login');
	}
	public function details(){
        $loginedUser=$this->session->userdata("loginedUser");
        if($loginedUser){
            $msg_id=$this->input->get("msg_id");
            $user_id=$this->input->get("user_id");
            $this->load->model('message_model');
            $result=$this->message_model->get_message_details($msg_id,$user_id);
            $comment=$this->message_model->get_comment_details($msg_id);
            $is_login=1;
            $this->load->view("details",array(
                'details'=>$result,
                'comments'=>$comment,
                'is_login'=>$is_login
            ));
        }else{
            $msg_id=$this->input->get("msg_id");
            $user_id=$this->input->get("user_id");
            $this->load->model('message_model');
            $result=$this->message_model->get_message_details($msg_id,$user_id);
            $comment=$this->message_model->get_comment_details($msg_id);
            $is_login=0;
            $this->load->view("details",array(
                'details'=>$result,
                'comments'=>$comment,
                'is_login'=>$is_login
            ));
        }

	}
	public function add_like(){
		$loginedUser=$this->session->userdata("loginedUser");
		if($loginedUser){
			$ids = $this->input->get('ids');
			$this -> load -> model('message_model');
			$this -> load -> model('like_model');
			$rows_1 = $this->message_model->add_like($ids);
			$rows_2 = $this->like_model->save_like($ids,$loginedUser->user_id);
			if($rows_1 && $rows_2){
				echo 'success';
			}else{
				echo 'fail';
			}
		}else{
			echo 'fail';
		}
	}
	public function reduce_like(){
		$loginedUser=$this->session->userdata("loginedUser");
		$ids = $this->input->get('ids');
		$this -> load -> model('message_model');
		$this -> load -> model('like_model');
		$rows_1 = $this->message_model->reduce_like($ids);
		$rows_2 = $this->like_model->delete_like($ids,$loginedUser->user_id);
		$rows = $rows_1 && $rows_2;
		if($rows){
			echo 'success';
		}else{
			echo 'fail';
		}
	}
    public function add_comment(){
        $loginedUser=$this->session->userdata("loginedUser");
        /*$opts=$this->input->get('ids');
        $content=$opts['comment'];
        $msg_id=$opts['msg_id'];*/
        $content=$this->input->post("comment");
        $msg_id=$this->input->post("hid_msg_id");
        $this->load->model("comment_model");
        $this->load->model("message_model");
        $this->message_model->add_com_num($msg_id);
        $this->comment_model->add_com($content,$msg_id,$loginedUser->user_id);
        redirect("welcome/index");
    }
}
