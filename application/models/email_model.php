<?php
if ( !defined( 'BASEPATH' ) )
	exit( 'No direct script access allowed' );
class email_model extends CI_Model
{
	public function emailer($htmltext,$subject,$toemail,$toname)
  {

					$query=$this->db->query("SELECT * FROM `emailer`")->row();
					$username=$query->username;
					$password=$query->password;
					$url = 'https://api.sendgrid.com/';
					$user=base64_decode($username);
					$pass=base64_decode($password);
					$params = array(
							'api_user'  => $user,
							'api_key'   => $pass,
							'to'        => $toemail,
							'subject'   => $subject,
							'html'      => $htmltext,
							'text'      => 'GS Entertainment',
							'from'      => 'jsw@gsentertainment.com',
							'fromname'      => 'GS Entertainment'
						);
					$request =  $url.'api/mail.send.json';
					$session = curl_init($request);
					curl_setopt ($session, CURLOPT_POST, true);
					curl_setopt ($session, CURLOPT_POSTFIELDS, $params);
					curl_setopt($session, CURLOPT_HEADER, false);
					curl_setopt($session, CURLOPT_SSL_VERIFYPEER, false);//New line
					curl_setopt($session, CURLOPT_SSL_VERIFYHOST, false);//New line
					curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
					$response = curl_exec($session);
					// print everything out
					////var_dump($response,curl_error($session),curl_getinfo($session));
	       print_r($response);
					curl_close($session);
  }
}
?>
