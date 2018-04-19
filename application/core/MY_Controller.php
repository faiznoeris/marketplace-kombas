<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('M_address','M_banks','M_category','M_confirmation','M_messages','M_products','M_reseller_pending_approval','M_reviews','M_seller_pending_approval','M_shop','M_stok_notification','M_transaction_cancelled','M_transaction_history','M_transaction_history_product','M_transaction_history_seller','M_user_level','M_users','M_withdrawal'));
    }





    function cek_kabupaten(){

        $id = $this->uri->segment(3);

        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => "http://api.rajaongkir.com/starter/city?province=$id",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "key: e5629870cbd922e9156805e0ffe6625c"
        ),
      ));

        if (!isset($id) || !is_numeric($id)){
            $reponse = array('success' => FALSE);
        }else {


            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            $data = json_decode($response, true);
            $options = "";
            for ($i=0; $i < count($data['rajaongkir']['results']); $i++) { 
                $options .= "<option value='".$data['rajaongkir']['results'][$i]['city_id']."'>".$data['rajaongkir']['results'][$i]['city_name']."</option>";
            }

            $response = array(
                'success' => TRUE,
                'options' => $options
            );

        }

        header('Content-Type: application/json');
        echo json_encode($response);

    }

    function get_alamat(){
        $this->load->model(array("m_address"));

        $id = $this->uri->segment(3);

        if (!isset($id) || !is_numeric($id)){
            $reponse = array('success' => FALSE);
        }else {

            $row = $this->m_address->select("address",$id)->row();

            $options = '
            <h4 class="card-title">'.$row->namaalamat.'</h4>
            <h6 class="card-subtitle mb-2 text-muted">a.n '.$row->atasnama.'</h6>
            <p class="card-text"><b>Alamat:</b><br>'.$row->alamat.'<br><br><b>Telephone:</b><br>'.$row->telephone.'</p>';

            $response = array(
                'success' => TRUE,
                'options' => $options
            );

        }

        header('Content-Type: application/json');
        echo json_encode($response);

    }


    function get_ongkir(){
        $this->load->model(array("m_address"));

        $kurir = $this->uri->segment(3);
        $asal = $this->uri->segment(4);
        $kabupaten = $this->uri->segment(5);
        $berat = $this->uri->segment(6);     
        $id_prod = $this->uri->segment(7);   

        if (!isset($kurir)){
            $reponse = array('success' => FALSE);
        }else {

            $curl = curl_init();
            curl_setopt_array($curl, array(
             CURLOPT_URL => "http://api.rajaongkir.com/starter/cost",
             CURLOPT_RETURNTRANSFER => true,
             CURLOPT_ENCODING => "",
             CURLOPT_MAXREDIRS => 10,
             CURLOPT_TIMEOUT => 30,
             CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
             CURLOPT_CUSTOMREQUEST => "POST",
             CURLOPT_POSTFIELDS => "origin=".$asal."&destination=".$kabupaten."&weight=".$berat."&courier=".$kurir,
             CURLOPT_HTTPHEADER => array(
                 "content-type: application/x-www-form-urlencoded",
                 "key: e5629870cbd922e9156805e0ffe6625c"
             ),
         ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            $data = json_decode($response, true);
            $options = "";
            for ($i=0; $i < count($data['rajaongkir']['results']); $i++) {
               for ($j=0; $j < count($data['rajaongkir']['results'][$i]['costs']); $j++) {
                   $options .= '<input class="tipepaket form-check-input" type="radio" name="tipepaket'.$id_prod.'" value="'.$data['rajaongkir']['results'][$i]["costs"][$j]["service"].'|'.$data['rajaongkir']['results'][$i]["costs"][$j]["cost"][$i]["value"].'"> '.$data['rajaongkir']['results'][$i]["costs"][$j]["service"]."\n"; 
                   $options .=  "(".$data['rajaongkir']['results'][$i]["costs"][$j]["description"].")\n"; 
                   $options .=  "Rp. ". number_format($data['rajaongkir']['results'][$i]["costs"][$j]["cost"][$i]["value"], 0, ',', '.')."<br>";
               }
           }

           $response = array(
            'success' => TRUE,
            'options' => $options
        );

       }

       header('Content-Type: application/json');
       echo json_encode($response);

   }







   function uploadfoto($id,$up_path,$name,$element_name,$model){
    $this->load->model(array('m_products','m_transaction_history','m_promo_headers','m_confirmation'));

    $config = array(
        'upload_path' => $up_path,
        'allowed_types' => "*",
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
        $fotopath               =   substr($fotopath, 31);

            // unlink('.'.$this->session->userdata('ava_path')); 

        if($model == "product"){
            if($this->m_products->updatesampulpath($fotopath, $id)){
                return true;
            }else{
                return false;
            }
        }if($model == "product-edit"){

            $sampul_path = $this->m_products->getproduct($id)->row()->sampul_path;
            unlink('.'.$sampul_path); 
            
            if($this->m_products->updatesampulpath($fotopath, $id)){
                return true;
            }else{
                return false;
            }
        }else if($model == "product-gallery-edit"){

            $sampul_path = $this->m_products->getproduct($id)->row()->sampul_path;
            unlink('.'.$sampul_path); 

            if($this->m_products->updategaleripath($fotopath.",", $id)){
                return true;
            }else{
                return false;
            }

        }else if($model == "product-gallery"){

            $row = $this->m_products->getproduct($id)->row();

            if($this->m_products->updategaleripath($row->galeri_path.$fotopath.",", $id)){
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
        }else if($model == "promo_headers"){
            if($this->m_promo_headers->updateheaderpath($fotopath, $id)){
                return true;
            }else{
                return false;
            }
        }else if($model == "confirmation"){
            if($this->m_confirmation->updatebuktipath($fotopath, $id)){
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

        echo $this->email->print_debugger();
    }

    function isLoggedin() {
        $session = $this->session->all_userdata();

        if (isset($session['loggedin'])){
            return true;
        }

        return false;
    }

}
