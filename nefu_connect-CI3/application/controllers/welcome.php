<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function test(){
		$this->load->view('test');
	}
	/*首页功能开始*/
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
					'results' => $result,
					'is_login' => 'yes'
			));
		}else{
			$this -> load -> model('message_model');
			$message = $this -> message_model -> get_message();
			$this->load->view('index',array(
					'messages' => $message,
					'results' => '',
					'is_login' => 'no'
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
	public function details(){
		$loginedUser=$this->session->userdata("loginedUser");
		$msg_id=$this->input->get("msg_id");
		$this->load->model('message_model');
		$this->load->model('comment_model');
		$detail=$this->message_model->get_message_details($msg_id);
		$comment=$this->comment_model->get_comment_details($msg_id);
		if($loginedUser){
			$is_login=1;
		}else{
			$is_login=0;
		}
		$this->load->view("details",array(
				'detail'=>$detail,
				'comments'=>$comment,
				'is_login'=>$is_login
		));
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
		$content=$this->input->post("comment");
		$msg_id=$this->input->post("hid_msg_id");
		$this->load->model("comment_model");
		$this->comment_model->add_com_num($msg_id);
		$this->comment_model->add_com($content,$msg_id,$loginedUser->user_id);
		redirect("welcome/details?msg_id=$msg_id");
	}
	/*首页功能结束*/
	/*用户页功能开始*/
	public function user()
	{
		$loginedUser=$this->session->userdata("loginedUser");
		if($loginedUser) {
			$this->load->model('user_model');
			$msg_count = $this->user_model->get_message_count($loginedUser->user_id);
			$com_count = $this->user_model->get_love_count($loginedUser->user_id);
            $real_name=$this->user_model->get_realname_portrait($loginedUser->user_id);
			$this->load->view('user', array(
					"msg_counts" => $msg_count,
					"com_counts" => $com_count,
                    "real_name_portrait"=>$real_name
			));
		}else{
			$this->load->view('login',array(
                'is_logined'=>true
            ));
		}
	}
	public function login()
	{
		$this->load->view('login',array(
            'is_logined'=>true
        ));
	}
	public function no_login(){
        $this->load->view('login',array(
            'is_logined'=>false
        ));
    }
	public function check_reg_name(){
		$name=$this->input->get("str");
		$this->load->model('user_model');
		if($name){
			$row = $this->user_model->get_name($name);
			if(strstr($name,"<script>")){
				echo 'fail';
			}else if($row){
				echo 'repeat_fail';
			}else{
				echo 'success';
			}
		}
	}
	public function check_reg_realname(){
		$realname =$this->input->get("str");
		if($realname){
			if(preg_match('/^[\x{4e00}-\x{9fa5}]+$/u', $realname)>0){
				echo 'success';
			}else{
				echo "fail";
			}
		}
	}
	public function check_reg_pass(){
		$pass =$this->input->get("str");
		$low_pass = array('asdfgh',123456,666666,333333,222222,111111,999999,888888,'qwerty','zxcvbn',123456789,1234567);
		if(strstr($pass,"<script>")){
			echo 'xss_fail';
		}else{
			$flag = 'fail';
			foreach($low_pass as $pas){
				if($pass == $pas){
					$flag = 'fail';
					break;
				}else{
					$flag = 'success';
				}
			}
			echo $flag;
		}
	}
	public function reg(){
		$name=$this->input->post("name");
		$realname =$this->input->post("realname");
		$password=$this->input->post("password");
		$portrait="assets/img/default.jpg";
		$sex=$this->input->post("sex");
		$this->load->model("user_model");
		$results=$this->user_model->save($name,$realname,$password,$portrait,$sex);
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
			redirect("welcome/no_login");
		}
	}
	public function exit_login(){
		$this->session->unset_userdata("loginedUser");
		$this->load->view('login',array(
            'is_logined'=>true
        ));
	}
	public function your_msg(){
		$loginedUser=$this->session->userdata("loginedUser");
		$this->load->model('message_model');
		$this -> load -> model('like_model');
		$message=$this->message_model->get_your_msg($loginedUser->user_id);
		$result = $this -> like_model -> get_msgId_by_user($loginedUser->user_id);
		$this->load->view('page',array(
				'messages'=>$message,
				'results'=>$result
		));
	}
	public function your_love(){
		$loginedUser=$this->session->userdata("loginedUser");
		$this->load->model('message_model');
		$this -> load -> model('like_model');
		$message=$this->message_model->get_your_love($loginedUser->user_id);
		$result = $this -> like_model -> get_msgId_by_user($loginedUser->user_id);
		$this->load->view('love',array(
				'messages'=>$message,
				'results'=>$result
		));
	}
	/*用户页功能结束*/
	/*修改资料，密码功能开始*/
	public function update_info(){
        $loginedUser=$this->session->userdata("loginedUser");
	    $this->load->model('user_model');
        $list=$this->user_model->get_realname_portrait($loginedUser->user_id);
	    $this->load->view('update_info',array(
	        'list'=>$list
        ));
    }
    public function update_realname(){
        $loginedUser=$this->session->userdata("loginedUser");
        $realname=$this->input->post('realname');
        $this->load->model('user_model');
        $this->user_model->update_realname($loginedUser->user_id,$realname);
        redirect('welcome/user');
    }
    public function upload_portrait(){
        $loginedUser=$this->session->userdata("loginedUser");
        $config['upload_path']='./assets/img/user_portrait/';//设置上传路径
        $config['allowed_types']='gif|jpg|png|jpeg';//设置上传文件的格式
        $config['max-size']='3072';//设置文件的大小
        $config['file_name']=date("YmdHis").'_'.rand(10000,99999);//设置文件的文件名
        $this->load->library('upload',$config);
        $this->upload->do_upload('up_portrait');//表单里的name属性值
        $upload_data=$this->upload->data();

        if($upload_data['file_size']>0){
            $photo_url="assets/img/user_portrait/".$upload_data['file_name'];
            $this->load->model("user_model");
            $rows=$this->user_model->update_portrait($photo_url,$loginedUser->user_id);
            if($rows>0){
                redirect("welcome/user");
            }
        }
    }
    public function update_pass(){
        $this->load->view('update_pass');
    }
    public function check_update_pass(){
        $loginedUser=$this->session->userdata("loginedUser");
        $pass=$this->input->get('str');
        $this->load->model('user_model');
        $password=$this->user_model->check_update_pass($loginedUser->user_id);
        if($pass == $password->password){
            echo 'success';
        }else{
            echo 'fail';
        }
    }
    public function new_pass(){
        $loginedUser=$this->session->userdata("loginedUser");
        $new_pass=$this->input->post('new_password');
        $this->load->model('user_model');
        $this->user_model->new_pass($loginedUser->user_id,$new_pass);
        redirect('welcome/user');
    }
    /*修改资料，密码功能结束*/

}
