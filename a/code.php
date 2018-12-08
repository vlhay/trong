<?php
session_start();
$title = 'Xem Mã Nguồn Wap/Web';
include '../b/head.php';
echo '<div class="header">'.$title.'</div>';
echo '<div class="item"><form method="get"><p>Url: <input name="url" type="text" value="'.$_GET['url'].'"></p><p>
<input type="radio" name="td" value="web" checked="checked"/>Xem mã nguồn ở chế độ Web</p><p>
<input type="radio" name="td" value="android" />Xem mã nguồn bằng Smartphone Android</p><p>
<input type="radio" name="td" value="java" />Xem mã nguồn bằng điện thoại Java</p><p>
<input type="submit" value="Xem" ></p></form></div>';
if (isset($_GET['url']))

{
	if($_GET[td] == 'android')
	{
	$td = 'Mozilla/5.0 (Linux; Android 4.2.1; en-us; Nexus 4 Build/JOP40D) AppleWebKit/535.19 (KHTML, like Gecko) Chrome/18.0.1025.166 Mobile Safari/535.19';
	}
	elseif($_GET[td] == 'java')
	{
	$td = 'NokiaN97/21.1.107 (SymbianOS/9.4; Series60/5.0 Mozilla/5.0; Profile/MIDP-2.1 Configuration/CLDC-1.1) AppleWebkit/525 (KHTML, like Gecko) BrowserNG/7.1.4';
	}
	else
	{
	$td = 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) coc_coc_browser/45.0 Chrome/39.0.2171.95 Safari/537.36';
	}
$url = $_GET['url'];
$url = preg_replace('#(https://|http://)(.*)#i', '$1$2', $url);
$curl = curl_init();
curl_setopt ($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_USERAGENT, $td);
curl_setopt ($curl, CURLOPT_RETURNTRANSFER, 1);
$lay = htmlentities(curl_exec($curl));
$lay=preg_replace("~&lt;[^<>]*&gt;~iU",
"<font color=\"#0000ff\">\\0</font>",$lay);
$lay=preg_replace("~(&lt;[^\s!]*\s)([^<>]*)([/?]?&gt;)~iU",
"\\1<font color=\"#007f7f\">\\2</font>\\3",$lay);
$lay=preg_replace("~&lt;!--.*--&gt;~iU",
"<font color=\"#909090\">\\0</font>",$lay);
$lay=preg_replace("~(&quot;|&#039;)[^<>]*(&quot;|&#039;)~iU",
"<font color=\"#900000\">\\0</font>",$lay);
$lay=str_replace("\r","<br>\r\n",$lay);
curl_close($curl);
echo '<div class="item">Mã Nguồn Trang <b style="color:red">'.$url.'</b></div><div class="namon">   <code>'.$lay.'</code></div>';
}
include '../b/end.php';
?>