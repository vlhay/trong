<?php
session_start();
$title = 'Chuyển đổi văn bản HTML sang TEXT và ngược lại';
include '../b/head.php';
echo '<div class="header">'.$title.'</div>';

echo '
<div class="item">
<form method="post">
<p>Nhập Văn Bản</p>
<p><textarea rows="5" name="nd" style="width:98%" >'.$nd1.'</textarea></p>

<p><input type="submit" name="html" value="Sang HTML" >       <input type="submit" name="text" value="Sang TEXT" ></p></form></div>';


if ($_POST['html']){
$nd1 =$_POST['nd'];
$nd = htmlentities(html_entity_decode($_POST['nd']));
$nd2 = html_entity_decode(html_entity_decode($_POST['nd']));

echo '
<div class="item">Thành Công <a href="#copy" style="color:red;font-weight:bold;">Copy Văn Bản</a></div>
<div class="item">
<p id="copy"><span style="color:red;font-weight:bold;" >Kết Quả Chạy PHP</span></p></div>
<div class="item">';
 $nd1 ;
echo '</div>';
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