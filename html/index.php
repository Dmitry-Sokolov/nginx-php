<!DOCTYPE HTML>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
	<meta name="format-detection" content="telephone=no">
	<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0">
	<title><?=$_SERVER['COMPUTERNAME']?></title>
	<style type="text/css">
		body{
			font-family: "Lucida Sans Unicode";
			max-width: 98%;
		}
		.container{
			display: -webkit-flex;
			-webkit-flex-direction: row;
			-webkit-flex-wrap: wrap;
		}
		a{
			display: -webkit-box;
			-webkit-box-pack: center;
			-webkit-box-align: center;
			text-align: center;
			color: white;
			text-decoration: none;
			background: #2673ec;
			width: 100px;
			height: 100px;
			padding: 5px;
			margin: 5px;
			white-space: pre-line;
		}
		a:hover{
			background: #56cfff;
		}
		a.all{
			background: transparent;
			color: #333333;
		}
		a.all:hover{
			color: #2673ec;
		}
	</style>
</head>
<body>
<?php
$baseURL = str_replace('?'.$_SERVER['QUERY_STRING'], '', $_SERVER['REQUEST_URI']);

$number = ($_REQUEST['number']) ? $_REQUEST['number'] : 10;
$showAll = ($_REQUEST['all']) ? $_REQUEST['all'] : false;
$search = ($_REQUEST['search']) ? strtolower($_REQUEST['search']) : '';
$replaceSymbols = ['_', '-'];
$i = 0;
$files = array();
?>
<form>
	<label for="search">Search:</label>
	<input id="search" type="search" name="search" value="<?=$search?>" />
</form>
<div class="container">
<?if ($handle = opendir('.')) {
	while (false !== ($file = readdir($handle))) {
		if ($file != "." && $file != ".." && is_dir($file) && $file != ".git") {
			if($search){
				if(strpos($file, $search) === false) continue;
			}
			$files[filemtime($file)] = $file;
			$i++;
		}
	}
	closedir($handle);
}
krsort($files);

$length = count($files);
if (!$showAll) {
	if ($length > $number) {
		$length = $number;
	}
}else{
	asort($files);
}
$keyFiles = array_keys($files);
for ($i = 0; $i < $length; $i++) {
	?>
	<a href="<?=$baseURL.$files[$keyFiles[$i]] ?>/"><?= str_replace($replaceSymbols, " ", $files[$keyFiles[$i]]) ?></a>
	<?
}
if (!$showAll) {
	?>
	<a class="all" href="<?=$baseURL?>?&all=true&search=<?=$search?>">see all ...</a>
	<?
}
?>
</div>
</body>
</html>