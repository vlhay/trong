<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<?php
function remove_allFile($dir) {
if ($handle=opendir("$dir")) {
while (false!== ($item=readdir($handle))) {
if ($item!="."&&$item!="..") {
if (is_dir("$dir/$item")) {
remove_directory("$dir/$item");
} else {
unlink("$dir/$item");
}
}
}
closedir($handle);
}
}
remove_allFile('style');
echo '<font color="green">Đã Xóa Xong</font>';
?>