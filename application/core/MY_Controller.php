<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    public $curl_data = array(
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_HTTPHEADER => array(
            "content-type: application/x-www-form-urlencoded",
            "key: ***REMOVED***"
        ));

    public function __construct()
    {
        parent::__construct();
    }

    function get_curl($curl_data){
        $curl = curl_init();
        curl_setopt_array($curl, $curl_data);
        $curl_response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        // $data = json_decode($curl_response, true);
        return json_decode($curl_response, true);
    }   

    function notif_data($notif_data){
        $this->session->set_tempdata('notif.'.$_SESSION['id_user'], 'true', 3);
        $this->session->set_tempdata('notif_header.'.$_SESSION['id_user'], $notif_data['header'], 3);
        $this->session->set_tempdata('notif_message.'.$_SESSION['id_user'], $notif_data['message'], 3);
        $this->session->set_tempdata('notif_duration.'.$_SESSION['id_user'], $notif_data['duration'], 3);
        $this->session->set_tempdata('notif_theme.'.$_SESSION['id_user'], $notif_data['theme'], 3);
        $this->session->set_tempdata('notif_sticky.'.$_SESSION['id_user'], $notif_data['sticky'], 3);
        $this->session->set_tempdata('notif_container.'.$_SESSION['id_user'], $notif_data['container'], 3);
        $this->session->set_tempdata('notif_group.'.$_SESSION['id_user'], $notif_data['group'], 3);
    }

    function notif_data_admin($notif_data){
        $this->session->set_tempdata('notif.'.$_SESSION['id_admin'], 'true', 3);
        $this->session->set_tempdata('notif_header.'.$_SESSION['id_admin'], $notif_data['header'], 3);
        $this->session->set_tempdata('notif_message.'.$_SESSION['id_admin'], $notif_data['message'], 3);
        $this->session->set_tempdata('notif_duration.'.$_SESSION['id_admin'], $notif_data['duration'], 3);
        $this->session->set_tempdata('notif_theme.'.$_SESSION['id_admin'], $notif_data['theme'], 3);
        $this->session->set_tempdata('notif_sticky.'.$_SESSION['id_admin'], $notif_data['sticky'], 3);
        $this->session->set_tempdata('notif_container.'.$_SESSION['id_admin'], $notif_data['container'], 3);
        $this->session->set_tempdata('notif_group.'.$_SESSION['id_admin'], $notif_data['group'], 3);
    }


    // function generatePassword() {
    //     $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    //     $charactersLength = strlen($characters);
    //     $randomString = '';
    //     for ($i = 0; $i < 8; $i++) {
    //         $randomString .= $characters[rand(0, $charactersLength - 1)];
    //     }
    //     return $randomString;
    // }

    function encryptPassword($pwd){
        $md5 = md5("taesa%#@2%^#" . $pwd . "2345#$%@3e");
        $hash = sha1($md5);
        return $hash;
    }

    function sendMail($email,$msg,$subject){
        //https://myaccount.google.com/lesssecureapps
        //In Gmail: configuration -> pop/imap -> enable pop
        $config['protocol']    = 'smtp';
        $config['smtp_host']    = 'ssl://74.125.195.108';//'ssl://smtp.gmail.com';
        $config['smtp_port']    = '465';
        //$config['smtp_timeout'] = '7';
        $config['smtp_user']    = '***REMOVED***';
        $config['smtp_pass']    = '***REMOVED***';
        $config['charset']    = 'utf-8';
        $config['newline']    = "\r\n";
        $config['mailtype'] = 'html'; // text or html
        $config['validation'] = TRUE; // bool whether to validate email or not


        $this->email->initialize($config);
        $this->email->set_newline("\r\n");

        $this->email->from('no-reply@marketplacekombas.com', "Marketplace Kombas");
        $this->email->to($email);

        $this->email->subject($subject);
        $this->email->message($msg);

        if($this->email->send()){
            return true;
        }else{
            $this->email->print_debugger();            
        }

        // echo $this->email->print_debugger();
    }

    function isLoggedin() {
        $session = $this->session->all_userdata();

        if (isset($session['loggedin'])){
            return true;
        }

        return false;
    }

}
