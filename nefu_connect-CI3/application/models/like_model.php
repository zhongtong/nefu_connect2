<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/27
 * Time: 13:13
 */
class Like_model extends CI_Model{

    public function get_msgId_by_user($user_id){
        $sql = "select * from t_like WHERE user_id = $user_id";
        return $this -> db -> query($sql) -> result();
    }
    public function save_like($msg_id,$user_id){
        $this -> db -> insert('t_like',array(
            'msg_id' => $msg_id,
            'user_id' => $user_id
        ));
        return $this -> db -> affected_rows();
    }
    public function delete_like($msg_id,$user_id){
        $this->db->delete('t_like', array(
            'msg_id' => $msg_id,
            'user_id' => $user_id
        ));
        return $this -> db -> affected_rows();
    }

}