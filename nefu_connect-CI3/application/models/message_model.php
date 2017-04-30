<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/23
 * Time: 16:53
 */
class Message_model extends CI_Model{

    public function get_message(){
        $sql = "select m.*,u.username,u.sex,u.portrait from t_message m,t_user u where m.user_id = u.user_id order by msg_id DESC ";
        return $this -> db -> query($sql) -> result();
    }
    public function get_message_details($msg_id,$user_id){
        $sql="select msg.*,u.username,u.sex,u.portrait from t_message msg,t_user u where msg.msg_id=$msg_id and  u.user_id=$user_id";
        return $this->db->query($sql)->result();
    }
    public function get_comment_details($msg_id){
        $sql="SELECT com.* ,u.username,u.portrait
FROM t_comment com,t_user u
WHERE com.msg_id=$msg_id and com.com_sender=u.user_id";
        return $this->db->query($sql)->result();
    }
    public function add_like($ids){
        $sql = "update t_message set love_num = (love_num + 1) where msg_id = $ids;";
        $this->db->query($sql);
        return $this->db->affected_rows();
    }
    public function reduce_like($ids){
        $sql = "update t_message set love_num = (love_num - 1) where msg_id = $ids;";
        $this->db->query($sql);
        return $this->db->affected_rows();
    }
    public function save_message($content,$anonymity,$user_id){
        $this -> db -> insert('t_message',array(
            'content' => $content,
            'user_id' => $user_id,
            'is_anonymity' => $anonymity
        ));
        return $this -> db -> affected_rows();
    }
    public function add_com_num($msg_id){
        $sql="update t_message set com_num = (com_num+1) where msg_id=$msg_id";
        $this->db->query($sql);
        return $this->db->affected_rows();
    }
}