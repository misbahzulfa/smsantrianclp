<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Zenziva extends CI_Controller {

	public function __construct(){ 
		parent ::__construct(); 
		//load model
		$this->load->model('model_sms');  
	}

	public function index()
	{
		$data = array( 
			'title' 	=> 'SMS Antrian Cilacap'
		//	'data_survey'	=> $this->model_survey->get_all() 
		);  

		$this->load->view('sms_antrian', $data );
	}


	public function tambah()
	{
		$data = array( 
			'title' 	=> 'Tambah Data Buku' 
		);

		$this->load->view('input_survey', $data);
	}

	public function sendmsg()
	{	    
	    $userkey = 'mdcdux5mv72xybdyw963';
		$passkey = '6d2b204284838b094bcb303c';
		$telepon = '082227589400';
		$message = 'Yth Bpk/ibu NoAntrian Anda:018#RABU#04-12-2019#Jam:09.00-10.00#Bawa berkas asli & fotokopi 2x#WAJIB Tunjukan SMS ke CSO#Apabila terlewat hrp SMS antrian ulang';
		$url = 'http://bpjstkcilacap.zenziva.co.id/api/sendsms/';
		$curlHandle = curl_init();
		curl_setopt($curlHandle, CURLOPT_URL, $url);
		curl_setopt($curlHandle, CURLOPT_HEADER, 0);
		curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curlHandle, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($curlHandle, CURLOPT_TIMEOUT,30);
		curl_setopt($curlHandle, CURLOPT_POST, 1);
		curl_setopt($curlHandle, CURLOPT_POSTFIELDS, array(
		    'userkey' => $userkey,
		    'passkey' => $passkey,
		    'nohp' => $telepon,
		    'pesan' => $message
		));
		$results = curl_exec($curlHandle);

      	if (curl_errno($curlHandle)) {
	        echo "error". curl_error($curlHandle);
	    }
	    curl_close($curlHandle);

	    echo $results; 

	      //echo "<script>alert('pesan berhasil di kirim');</script>";
	     
  	} 

  	public function getSms()
	{	   
		$this->load->model('model_sms');   
	   	$url = 'http://bpjstkcilacap.zenziva.co.id/api/getinbox/?userkey=mdcdux5mv72xybdyw963&passkey=6d2b204284838b094bcb303c&start_date=18/12/2019&end_date=18/12/2019';
		$curlHandle = curl_init();
		curl_setopt($curlHandle, CURLOPT_URL, $url);
		curl_setopt($curlHandle, CURLOPT_HEADER, 0);
		curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curlHandle, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($curlHandle, CURLOPT_TIMEOUT,30); 
		     
		$results = curl_exec($curlHandle);


      	if (curl_errno($curlHandle)) {
	        echo "error". curl_error($curlHandle);
	    }
	    curl_close($curlHandle);

	   	$data = json_decode($results, true);
	   	$jumlahsms = $data['msg-count'];
	   	//$inboxSMS = json_decode($data['msg']);

	   	foreach ($data['msg'] as $item) {
	   		 
            //input data sms inbox zenziva ke table sms inbox mysql 

            $daftar = explode("#", $item['isiPesan'])[0];

            //cek format DAFTAR#NAMA#NIK#TGLLHIR(dd-mm-yyyy)#KPJ
            
            if($daftar == "DAFTAR"){
            	$nama = explode("#", $item['isiPesan'])[1];
            	$nik = explode("#", $item['isiPesan'])[2];
            	$tgllahir = explode("#", $item['isiPesan'])[3];

            	$smsmasuk =
		   		[
	                'messageId' => $item['messageId'],
	                'date' => $item['date'],
	                'dari' => $item['dari'],
	                'isiPesan' => strtoupper($item['isiPesan']),
	                'cabang' => 'CILACAP'
	            ]; 
            	//cek nama alfabet semua atau tidak
            	if(preg_match('/[A-Za-z]/', $nama)){ 
            		//echo "CLP : NAMA ->".$nama. " ";  
            		if(strlen($nik)==16){
            			//echo "NIK ->".$nik;
            			if(strlen($tgllahir)==10){
            				//echo "TGL LAHIR ->".$tgllahir;
            				//input ke database
            				$this->model_sms->simpan($smsmasuk); 

 							$jadwalkosong =  $this->model_sms->getantriankosong();
 							foreach ($jadwalkosong->result() as $row)
							  {
							        echo $row->idantrian; 
							  } 
            			}else{
            				echo "format tgl lahir salah ->".$tgllahir;
            				//kirim sms format salah
            				$this->model_sms->simpanSmsValid($smsmasuk); 
            			}
            		}else{
            			echo "NIK Kurang atau lebih dari 16 digit";
            			//kirim sms format salah 
            			$this->model_sms->simpanSmsValid($smsmasuk); 
            		}            		
            	}else{
            		echo "=== Nama gk boleh ada no yah!!!";
            		//kirim sms format salah
            		$this->model_sms->simpanSmsValid($smsmasuk); 
            	} 
            	
            }else if($daftar == "KBM"){
            	//cek format KBM#NAMA#NIK#TGLLHIR(dd-mm-yyyy)#KPJ 
            	$nama = explode("#", $item['isiPesan'])[1];
            	$nik = explode("#", $item['isiPesan'])[2];
            	$tgllahir = explode("#", $item['isiPesan'])[3];

            	$smsmasuk =
		   		[
	                'messageId' => $item['messageId'],
	                'date' => $item['date'],
	                'dari' => $item['dari'],
	                'isiPesan' => strtoupper($item['isiPesan']),
	                'cabang' => 'KEBUMEN'
	            ]; 
            	//cek nama alfabet semua atau tidak
            	if(preg_match('/[A-Za-z]/', $nama)){ 
            		//echo "KBM : NAMA ->".$nama. " ";  
            		if(strlen($nik)==16){
            			//echo "NIK ->".$nik;
            			if(strlen($tgllahir)==10){
            				//echo "TGL LAHIR ->".$tgllahir;
            				//input ke database
            				$this->model_sms->simpan($smsmasuk);
            				//$this->model_sms->updateantrian($nama, $item['dari']);
            			}else{
            				//echo "format tgl lahir salah ->".$tgllahir;
            				//kirim sms format salah
            				$this->model_sms->simpanSmsValid($smsmasuk); 
            			}
            		}else{
            			//echo "NIK Kurang atau lebih dari 16 digit";
            			//kirim sms format salah 
            			$this->model_sms->simpanSmsValid($smsmasuk); 
            		}            		
            	}else{
            		//echo "=== Nama gk boleh ada no yah!!!";
            		//kirim sms format salah
            		$this->model_sms->simpanSmsValid($smsmasuk); 
            	} 
            }else{
            	$smsmasuk =
		   		[
	                'messageId' => $item['messageId'],
	                'date' => $item['date'],
	                'dari' => $item['dari'],
	                'isiPesan' => strtoupper($item['isiPesan']),
	                'cabang' => '---'
	            ]; 
            	$this->model_sms->simpan($smsmasuk);
            	echo "#  salah  #" ;
            }
	   	}  
  	} 

  	public function geturl(){
  		echo 'Hello ' . htmlspecialchars($_GET["name"]) . '!';
  	}

  	public function generateAntrian()
	{	    
	    $shift1 = 15;
	    $shift2 = 15;
	    $shift3 = 10;
	    $shift4 = 5;

	    //http://localhost/surveyarsip2/zenziva/generateAntrian/?tanggal=30-12-2019
	    $tgl = htmlspecialchars($_GET["tanggal"]);
	    //$s1 = htmlspecialchars($_GET["shift1"]);

	    for ($i = 1; $i <= $shift1; $i++) {
	    	$antrian =
	    	[
	    		'tanggal' => $tgl,
	    		'shift' => '08:00-09:00',
	    		'noantrian' => $i ,
	    		'nama' => '-',
	    		'telfon' => '-'
	    	];
	    	$this->model_sms->generateAntrian($antrian);
		    echo $i."\n";
		    //echo $s1;
		}
		for ($i = 1; $i <= $shift2; $i++) {
			$antrian =
	    	[
	    		'tanggal' => $tgl,
	    		'shift' => '09:00-10:00',
	    		'noantrian' => $shift2+$i ,
	    		'nama' => '-',
	    		'telfon' => '-'
	    	];
	    	$this->model_sms->generateAntrian($antrian);
		    echo $i."\n";
		}
		for ($i = 1; $i <= $shift3; $i++) {
			$antrian =
	    	[
	    		'tanggal' => $tgl,
	    		'shift' => '10:00-11:00',
	    		'noantrian' => $shift1+$shift2+$i ,
	    		'nama' => '-',
	    		'telfon' => '-'
	    	];
	    	$this->model_sms->generateAntrian($antrian);
		    echo $i."\n";
		}
		for ($i = 1; $i <= $shift4; $i++) {
			$antrian =
	    	[
	    		'tanggal' => $tgl,
	    		'shift' => '11:00-12:00',
	    		'noantrian' => $shift1+$shift2+$shift3+$i ,
	    		'nama' => '-',
	    		'telfon' => '-'
	    	];
	    	$this->model_sms->generateAntrian($antrian);
		    echo $i."\n";
		}
  	} 

  	public function generateAntriankcp()
	{	    
	    $shift1 = 15;
	    $shift2 = 15;
	    $shift3 = 10;
	    $shift4 = 5;

	    //http://localhost/surveyarsip2/zenziva/generateAntrian/?tanggal=30-12-2019
	    $tgl = htmlspecialchars($_GET["tanggal"]);
	    //$s1 = htmlspecialchars($_GET["shift1"]);

	    for ($i = 1; $i <= $shift1; $i++) {
	    	$antrian =
	    	[
	    		'tanggal' => $tgl,
	    		'shift' => '08:00-09:00',
	    		'noantrian' => $i ,
	    		'nama' => '-',
	    		'telfon' => '-'
	    	];
	    	$this->model_sms->generateAntrianKCP($antrian);
		    echo $i."\n";
		    //echo $s1;
		}
		for ($i = 1; $i <= $shift2; $i++) {
			$antrian =
	    	[
	    		'tanggal' => $tgl,
	    		'shift' => '09:00-10:00',
	    		'noantrian' => $shift2+$i ,
	    		'nama' => '-',
	    		'telfon' => '-'
	    	];
	    	$this->model_sms->generateAntrianKCP($antrian);
		    echo $i."\n";
		}
		for ($i = 1; $i <= $shift3; $i++) {
			$antrian =
	    	[
	    		'tanggal' => $tgl,
	    		'shift' => '10:00-11:00',
	    		'noantrian' => $shift1+$shift2+$i ,
	    		'nama' => '-',
	    		'telfon' => '-'
	    	];
	    	$this->model_sms->generateAntrianKCP($antrian);
		    echo $i."\n";
		}
		for ($i = 1; $i <= $shift4; $i++) {
			$antrian =
	    	[
	    		'tanggal' => $tgl,
	    		'shift' => '11:00-12:00',
	    		'noantrian' => $shift1+$shift2+$shift3+$i ,
	    		'nama' => '-',
	    		'telfon' => '-'
	    	];
	    	$this->model_sms->generateAntrianKCP($antrian);
		    echo $i."\n";
		}
  	} 


  	public function readSms()
	{	    
	    $url = 'http://bpjstkcilacap.zenziva.co.id/api/readsms/?userkey=mdcdux5mv72xybdyw963&passkey=6d2b204284838b094bcb303c';
		$curlHandle = curl_init();
		curl_setopt($curlHandle, CURLOPT_URL, $url);
		curl_setopt($curlHandle, CURLOPT_HEADER, 0);
		curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curlHandle, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($curlHandle, CURLOPT_TIMEOUT,30); 
		     
		$results = curl_exec($curlHandle);

      	if (curl_errno($curlHandle)) {
	        echo "error". curl_error($curlHandle);
	    }
	    curl_close($curlHandle);

	    ?>
	       <!--<br>respon ID Mobile : <?php echo $results; ?> pesan sukses di kirim</br> -->
	    <?php
	      //echo "<script>alert('pesan berhasil di kirim');</script>";
	    //header('Content-Type: application/json');
	    echo $results;
  	} 

  	public function getsmsvalid()
  	{
  		$id = "67782";
  		
  		$data = $this->model_sms->getSmsValidMySQL($id);

  		print_r($data);
  	}
}
