<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    function __construct() {
        parent::__construct();
    }



    function uploadfoto($id,$up_path,$name,$element_name,$model){
        $this->load->model(array('m_products','m_transaction_history'));

        $config = array(
            'upload_path' => $up_path,
            'allowed_types' => "gif|jpg|png|jpeg",
            'overwrite' => TRUE,
            'max_size' => 2048, // Can be set to particular file size , here it is 2 MB(2048 Kb)
            // 'max_height' => "1920",
            // 'max_width' => "1080",
            'file_name' => $name."-". $id . "-" . rand(0,1000)
        );

        $this->upload->initialize($config);

        if($_FILES[$element_name]['size'] == 0){
            return false;
        }else if($this->upload->do_upload($element_name)){
            $fotopath               =   $this->upload->data();
            $fotopath               =   $fotopath["full_path"];
            $fotopath               =   substr($fotopath, 26);

            if($model == "product"){
                if($this->m_products->updatesampulpath($fotopath, $id)){
                    return true;
                }else{
                    return false;
                }
            }else if($model == "transaction_history"){
                if($this->m_transaction_history->updatesampulpath($fotopath, $id)){
                    return true;
                }else{
                    return false;
                }
            }

        }else{
            return false;
        }
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
