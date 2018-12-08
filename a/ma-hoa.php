<?php
session_start();
$title = 'Mã Hóa Md5/Sha1';
include '../b/head.php';
echo '<div class="header">'.$title.'</div>';

echo '
<div class="item">
<form method="post">
<p>Nhập Văn Bản</p>
<p><textarea rows="5" name="nd" style="width:98%" ></textarea></p>

<p><input type="submit" name="md5" value="Mã Hóa Md5" >       <input type="submit" name="sha1" value="Mã Hóa Sha1" ></p></form></div>';


if ($_POST['md5']){
$nd1 =$_POST['nd'];
$nd = md5($_POST['nd']);
echo '
<div class="item">Thành Công <a href="#copy" style="color:red;font-weight:bold;">Copy Văn Bản</a></div>
<div class="item">
<p id="copy"><span style="color:red;font-weight:bold;" >Đã Mã Hóa Md5 </span> ('.$nd1.')</p>
<p><textarea rows="5" name="nd" style="width:98%" >'.$nd.'</textarea></p></div>';
}
elseif ($_POST['sha1']){
$nd1 =$_POST['nd'];
$nd = sha1($_POST['nd']);
echo '
<div class="item">Thành Công <a href="#copy" style="color:red;font-weight:bold;">Copy Văn Bản</a></div>
<div class="item">
<p id="copy"><span style="color:red;font-weight:bold;" >Đã Mã Hóa Sha1</span> ('.$nd1.')</p>
<p><textarea rows="5" name="nd" style="width:98%" >'.$nd.'</textarea></p></div>';
}
include '../b/end.php';
?>