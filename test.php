<?php
$connection = new mysqli('localhost', 'root', 'root', 'test');
$file = fopen("files/test.txt", "r");

while (!feof($file)) {
	$content = fget($file);
	$connection->query($sql);
}
fclose($file);