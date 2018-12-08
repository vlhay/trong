<?php
$old = file_get_contents('view.txt');
$view = ($old+1);
file_put_contents('view.txt',$view);
$view = file_get_contents('view.txt');
echo $view;
?>