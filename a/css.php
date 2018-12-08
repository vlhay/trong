<?php
session_start();
$title = 'Sửa Css Online';
include '../b/head.php';
echo '<div class="header">'.$title.'</div>';

if (!$_POST['xong'])
if (!$_POST['submit'])
{echo' <div class="item"> <font color="blue">Tool sửa css online được tạo ra để hỗ trợ các bạn sửa css một cách dễ dàng hơn, các bạn dùng máy java max 5000 kí tự sẽ không phải lo lắng về việc sửa css nữa , css được chia theo từng khung, mỗi khung là một class riêng. Cuối cùng sau khi xong sẽ ra một khung text duy nhất các bạn copy là xong</font></div><div class="item"><form method="post">
<p><input type="radio" name="xx" value="1" checked="checked"/>Thông Qua Url: </p><p>
<input name="url" type="text" value="'.$_POST['url'].'"></p><p>
<input type="radio" name="xx" value="2" > Nhập Văn Bản Vào Đây (nhớ tính vào nhé)</p>
<p><textarea rows="20" name="nd" style="width:98%" ></textarea></p>
<p><input type="submit" name="submit" value="Tiếp"/></p>
</form></div>';}
else
{
    
$td = 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) coc_coc_browser/45.0 Chrome/39.0.2171.95 Safari/537.36';
 $xx = $_POST['xx'] ;
if($xx==1){
$url = $_POST['url'];
$url = preg_replace('#(https://|http://)(.*)#i', '$1$2', $url);
$curl = curl_init();
curl_setopt ($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_USERAGENT, $td);
curl_setopt ($curl, CURLOPT_RETURNTRANSFER, 1);
$lay = curl_exec($curl);
}
if($xx==2){$lay = $_POST['nd'];}


$lay =  str_replace('<br />','',$lay);
$lay = explode('}',$lay);
$dem = count($lay);
echo '<div class="item" style="font-weight:bold;color:red">Sửa Theo Từng class</div><div class="item"><form method="post"><input type="hidden" name="dem" value="'.($dem-1).'">';
for ($i=0; $i < ($dem-1) ; $i++) { 
echo '<p><textarea name="style'.$i.'" rows="4" style="width:98%">'.trim($lay[$i]).'}</textarea></p>';
}
echo '<p><input type="submit" name="xong" value="Tiếp"/></p></form></div>';
}

else {

$shh = '';
for ($i=0; $i <= $_POST['dem']; $i++) { 
$_POST['style'.$i] =  str_replace('}','}

',$_POST['style'.$i]);
$shh = $shh.$_POST['style'.$i];
}

$ran = mt_rand(1000, 10000);
$fp = @fopen('../style/style'.$ran.'.css', "w");
if (!$fp) {
    echo 'Mở file không thành công';}
else
{ // Ghi file
    fwrite($fp, $shh);
   // Đóng file
    fclose($fp);
echo '<div class="item">Bạn có thể <a href="/style/style'.$ran.'.css" style="font-weight:bold;color:red;margin: 50px 0px 50px 0px;padding: 5px;border: 0px solid #ffc2d2;
box-shadow: 0 3px 7px rgba(0, 0, 0, 0.3);">Tải về </a>(file chỉ tồn tại trong thời gian ngắn) hoặc copy khung bên dưới </div>';}


echo '<div class="item" style="font-weight:bold;color:red"> Sửa Thành Công </div><div class="item"><textarea name="sty" rows="20" style="width:98%">';
for ($i=0; $i <= $_POST['dem']; $i++) { 
$_POST['style'.$i] =  str_replace('}','}<br />',$_POST['style'.$i]);
echo preg_replace('#<br\s*/?>#i', "\n",$_POST['style'.$i]);
}
echo '</textarea></div>';

}
include '../b/end.php';
?>