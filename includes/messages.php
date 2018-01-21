<?php

class Msg{
    
    public $msg = "no msg ";
    
    public function setMsg($msg1){
        $msg = $msg1;
    }
    
    public function getMsg(){
        echo $msg;
    }
}

$newmsg = new Msg;


?>