<?php
If($_GET['submit']){
$pass=$_GET['pass'];
$email=$_GET['email'];
$site=$_GET['id'];
$cookie='';
$ua = 'UCWEB/2.0 (Java; U; MIDP-2.0; vi; NokiaE71-1) U2/1.0.0 UCBrowser/9.4.1.377 U2/1.0.0 Mobile UNTRUSTED/1.0'; 
$ch = curl_init(); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
curl_setopt($ch, CURLOPT_USERAGENT, $ua); 
curl_setopt($ch, CURLOPT_URL, 'http://wap4.co/'); 
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie); 
$bkit =array('email' => $email, 'pass' =>$pass); 
curl_setopt($ch, CURLOPT_POST,count($bkit)); 
curl_setopt($ch, CURLOPT_POSTFIELDS,$bkit); 
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie); 
$nd=curl_exec($ch); 

curl_setopt($ch, CURLOPT_URL,'http://wap4.co/site/'.$site.'/custom_data'); 
$source = curl_exec($ch); 
$preg=explode('Filter by key',$source);

preg_match_all('/id: (.*?),/is', $preg[1],$link);

foreach($link[1] as $l){
curl_setopt($ch, CURLOPT_URL,'http://wap4.co/site/'.$site.'/custom_data/edit/'.$l.'?act=remove'); 
curl_exec($ch); 
}
curl_close($ch); 
}
?>
<form method="get"><input type="text" name="email" value="email"/><input type="text" name="pass" value="password"/><input type="text" name="id" value="id site"/><input type="submit" name="submit" value="xoá hết custom data"/></form>
