<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    function __construct() {
        parent::__construct();
    }


    /*
    *
    *
    *                 _    _ _______ _    _
    *            /\  | |  | |__   __| |  | |
    *           /  \ | |  | |  | |  | |__| |
    *          / /\ \| |  | |  | |  |  __  |
    *         / ____ \ |__| |  | |  | |  | |
    *        /_/    \_\____/   |_|  |_|  |_|
    *
    *
    *
    */

    function generatePassword() {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 8; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    function encryptPassword($pwd){
        $md5 = md5("taesa%#@2%^#" . $pwd . "2345#$%@3e");
        $hash = sha1($md5);
        return $hash;
    }

    function sendMail($email,$msg,$subject){
        //https://myaccount.google.com/lesssecureapps
        //In Gmail: configuration -> pop/imap -> enable pop
        $config['protocol']    = 'smtp';
        $config['smtp_host']    = 'ssl://smtp.googlemail.com';//'ssl://smtp.gmail.com';
        $config['smtp_port']    = '465';
        //$config['smtp_timeout'] = '7';
        $config['smtp_user']    = '***REMOVED***';
        $config['smtp_pass']    = '***REMOVED***';
        $config['charset']    = 'utf-8';
        $config['newline']    = "\r\n";
        $config['mailtype'] = 'html'; // text or html
        $config['validation'] = TRUE; // bool whether to validate email or not

        $this->email->initialize($config);

        $this->email->from('***REMOVED***', "SMK Ma'arif NU 1 Sumpiuh");
        $this->email->to($email);

        $this->email->subject($subject);
        $this->email->message($msg);

        if($this->email->send()){
            return true;
        }

        //echo $this->email->print_debugger();
    }

    function isLoggedin() {
        $session = $this->session->all_userdata();

        if (isset($session['loggedin'])){
            return true;
        }

        return false;
    }

}
