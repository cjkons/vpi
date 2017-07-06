<?php
class LoginHook extends CI_Controller{
    
    public function isLogado(){
        
        $this->load->library('access');
        
        $this->access->loginCheck();
        
    }    
    
}
?>