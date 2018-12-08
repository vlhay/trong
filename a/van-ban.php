<?php
session_start();
$title = 'Sửa Văn Bản Online';
include '../b/head.php';
echo '<div class="header">'.$title.'</div>';

$aaa = '<p>Tìm Từ (phân biệt chữ hoa, chữ thường)
<input type="text" name="a" placeholder="Nhập Từ Cần Tìm" style="width:98%" value="" /></p>
<p>Thay Thế Bằng Từ (Để trống để xóa từ)<input type="text" style="width:98%" name="b" placeholder="Nhập Từ Cần Thay Thế" value="" /></p>
<p><input type="submit" value="Sửa" ></p>';
if (!isset($_POST['nd']))
{
echo '<div class="item">
<form method="post">
<p>Nhập Văn Bản</p>
<p><textarea rows="20" name="nd" style="width:98%" ></textarea></p>
'.$aaa.'</form></div>';
}
else
{

$nd = htmlentities($_POST['nd']);
$a = htmlentities($_POST['a']);
$b = htmlentities($_POST['b']);
$nd = str_replace($a,$b,$nd);
$lay = $nd;


if ($b=='')
{$thanhcong = 'Đã Xóa Thành Công <span style="color:orange;font-weight:bold;">'.$a.'</span>';
}
else
{$thanhcong = 'Đã Sửa Thành Công <span style="color:orange;font-weight:bold;">'.$a.'</span> thành <span style="color:green;font-weight:bold;">'.$b.'<span>';
$lay = str_replace($b,'<span style="color:#FF00EB;font-weight:bold;">'.$b.'</span>',$lay);
}

echo '
<div class="item">Thành Công <a href="#copy" style="color:red;font-weight:bold;">Copy Văn Bản</a></div>
<div class="item">  '.$thanhcong.' </div><div class="item"><code>'.$lay.'</code></div><div class="item">
<p id="copy" style="color:red;font-weight:bold;" >Copy Văn Bản </p>
<p><textarea rows="20" name="nd" style="width:98%" >'.$nd.'</textarea></p>
</div>';
}
include '../b/end.php';
?>