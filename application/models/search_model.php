<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class search_model Extends CI_Model  
{  
   
    function __construct()  
    {  
        parent::__construct();  
        $this->load->database();  
    }  
  
    function get_result_expert($name)  
    {  
     
        $name = $this->db->escape_str($name);             
        $sql = "SELECT name FROM users where users.name = ?  ";
	$query = $this->db->query( $sql, array($name) ); 
        return $query->result();
    }  

    function get_result_professions($key_word)  
    {  
     	$key_word = $this->db->escape_str($key_word);
        $sql = "SELECT users.name,users.surname FROM users 
        inner join users_has_professions  on users_has_professions.users_id  = users.id 
        inner join professions on users_has_professions.professions_id  = professions.id  
        where professions.key_word = ?  ";
	$query = $this->db->query( $sql, array($key_word) ); 
        return $query->result();
         
    } 
}  

?>
