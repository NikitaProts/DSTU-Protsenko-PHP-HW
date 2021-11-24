<?php
    error_reporting(E_ALL);
   
    class Session {
        protected $name;
        protected $val;
       
        public function __construct() {
            if(!isset($_SESSION)) 
            { 
                session_start(); 
            } 
        }
       
        public function setSession($name, $val) {
            $this->name = $name;
            $this->val = $val;
            return $_SESSION[$this->name] = $this->val;
        }
       
        public function getSessionName($name) {
            return $_SESSION[$name];
        }
       
        public function checkSession($name) {
            if(isset($_SESSION[$name])) {
                return true;
            }
            return false;
        }
       
        public function delSession($name) {
             unset($_SESSION[$name]);
        }
    }
   
    class Flash {
        protected $saveSession;
       
        public function __construct() {
            $this->saveSession = new Session();
        }
       
        public function setMessage($id, $mess) {
            $this->saveSession->setSession($id, $mess);
        }
       
        public function getMessage($name) {
            if($this->saveSession->checkSession($name)) {
                return $this->saveSession->getSessionName($name);
            }
        }
    }

    // задача 3
   $session_test = new Session();
   $session_test-> setSession('login', 'pass');

   $session_login = new Session();
   $session_login-> setSession('user_name', 'admin;');

   $session_pass = new Session();
   $session_pass-> setSession('user_pass', 'pass;');

   
    //echo $message->getMessage('login1');

   if ($session_pass->checkSession('user_pass') and $session_login->checkSession('user_name')){
        $message = new Flash;
        $message->setMessage('message_1', 'OK!');
        echo $message->getMessage('message_1');
   };
   //echo $session_test-> getSessionName('123');
   //echo $session_test-> checkSession('123');
   $session_test-> delSession('123');

    // задача 4
    
   
   
   
?>