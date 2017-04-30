<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Comment_model extends CI_Model{
    public function add_com($content,$msg_id,$user_id){
        $this->db->insert("t_comment",array(
            'content_com'=>$content,
            'com_sender'=>$user_id,
            'msg_id'=>$msg_id
        ));
        return $this->db->affected_rows();
    }
}