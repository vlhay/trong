<?php
session_start();
$title = 'Chuyển đổi văn bản HTML sang TEXT và ngược lại';
include '../b/head.php';
echo '<div class="header">'.$title.'</div>';

echo '
<div class="item">
<form method="post">
<p>Nhập Văn Bản</p>
<p><textarea rows="5" name="nd" style="width:98%" ></textarea></p>

<p><input type="submit" name="html" value="Sang HTML" >       <input type="submit" name="text" value="Sang TEXT" ></p></form></div>';


if ($_POST['html']){
$nd1 =$_POST['nd'];
$nd = htmlentities(html_entity_decode($_POST['nd']));
echo '
<div class="item">Thành Công <a href="#copy" style="color:red;font-weight:bold;">Copy Văn Bản</a></div>
<div class="item">
<p id="copy"><span style="color:red;font-weight:bold;" >Đã Chuyển sang HTML </span></p>
<p><textarea rows="5" name="nd" style="width:98%" >'.$nd.'</textarea></p></div>';
}
elseif ($_POST['text']){
$nd1 =$_POST['nd'];
$nd = htmlentities(htmlentities($_POST['nd']));
echo '
<div class="item">Thành Công <a href="#copy" style="color:red;font-weight:bold;">Copy Văn Bản</a></div>
<div class="item">
<p id="copy"><span style="color:red;font-weight:bold;" >Đã Chuyển sang TEXT</span></p>
<p><textarea rows="5" name="nd" style="width:98%" >'.$nd.'</textarea></p></div>';
}
include '../b/end.php';
?>