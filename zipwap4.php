<?php
//Copy Xin Ghi Nguồn: Nguyenpro
function delete($dir){
if($handle=opendir($dir)){
while(false!==($item=readdir($handle))) {
if($item!="."&&$item!=".."){
if(is_dir("$dir/$item")){
delete("$dir/$item");
}else{
unlink("$dir/$item");
}}}
closedir($handle);
rmdir($dir);
}}
$dir='./cache';
if($_POST){
$email=$_POST['email'];
$pass=$_POST['pass'];
$site=$_POST['id'];
$cookie='';
$ua='UCWEB/2.0 (Java; U; MIDP-2.0; vi; NokiaE71-1) U2/1.0.0 UCBrowser/9.4.1.377 U2/1.0.0 Mobile UNTRUSTED/1.0';    
$ch=curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);    
curl_setopt($ch, CURLOPT_USERAGENT, $ua);
curl_setopt($ch, CURLOPT_URL, 'http://wap4.co/');    
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);    
$nguyenpro=array('email' => $email, 'pass' =>$pass);    
curl_setopt($ch, CURLOPT_POST,count($nguyenpro));
curl_setopt($ch, CURLOPT_POSTFIELDS,$nguyenpro);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);    
$nd=curl_exec($ch);
curl_setopt($ch, CURLOPT_URL,'http://wap4.co/site/'.$site.'/');
$source=curl_exec($ch);
preg_match('#<div>Custom data<b class="icon icon-link">(.*?)<div>Preview site<b class="icon icon-link">#is',$source,$html);
preg_match('#"http://(.*?)">#is',$html[1],$domain);
if($domain[1]){
delete("$dir");
mkdir("$dir");
file_put_contents("$dir/index.php",'');
mkdir("$dir/$site");
$zip=new ZipArchive();
$fpath="$dir/$domain[1].zip";
$zip->open($fpath, ZipArchive::CREATE);
if($_POST['assets']){
preg_match('#<div class="menu-title">Assets</div>(.*?)<div class="menu-title">Files</div>#is',$source,$preg);
preg_match_all('#<a class="multiline" href="(.*?)">#is', $preg[1],$link);
foreach($link[1] as $l){
curl_setopt($ch, CURLOPT_URL,'http://wap4.co'.$l);
$html=curl_exec($ch);
preg_match('#<h2 class="crumb">(.*?)</h2>#is',$html,$name);
$preg=explode('Files',$html);
preg_match_all('#<div>/(.*?)<b class="icon icon-link">#is',$preg[1],$link);
foreach($link[1] as $l){
mkdir("$dir/$site/$name[1]");
$link="http://$domain[1]/$name[1]/$l";
copy($link, "$dir/$site/$name[1]/$l");
$zip->addFile("$dir/$site/$name[1]/$l","$name[1]/$l");
}}}
$preg=explode('Files',$source);
preg_match_all('#<a class="multiline" href="(.*?)">#is',$preg[1],$link);
foreach($link[1] as $l){   
curl_setopt($ch, CURLOPT_URL,'http://wap4.co'.$l);
$source=curl_exec($ch);
preg_match('#<h2 class="crumb">(.*?)</h2>#is',$source,$name);
curl_setopt($ch, CURLOPT_URL,'http://wap4.co'.$l.'?action=settings&download=download');
$result=curl_exec($ch);
$fp=fopen("$dir/$site/$name[1]",'x');
fwrite($fp,$result);
fclose($fp);
$zip->addFile("$dir/$site/$name[1]",$name[1]);
}
$zip->close();
curl_close($ch);
delete("$dir/$site");
if(file_exists($fpath)){
header("Location: $fpath");
exit;
}else{
echo 'Nén zip không thành công!';
}}else{
echo 'Thông tin đăng nhập không chính xác!';
}}else{
echo 'Vui lòng nhập thông tin đăng nhập';
}
echo '<form class="menu" method="post">
Email:<br/>
<input type="email" name="email" value=""><br/>
Mật khẩu:<br/>
<input type="password" name="pass" value=""><br/>
ID:<br/>
<input type="id" name="id" value=""><br/>
<input type="radio" name="assets" value="checkbox"/> Nén Css, Images, Js<br/>
<input type="submit" value="Nén Zip">
</form>';
?>