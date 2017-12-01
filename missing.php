<?php
require_once 'dbconnect.php';

$page_name = $_SERVER['HTTP_REFERER'];
$page_name_array = explode("/",$page_name);
unset($page_name_array[0]);
unset($page_name_array[1]);
unset($page_name_array[2]);
$page_name = implode('/',$page_name_array);


//echo '<pre>';
$files = glob('*.php');
//print_r($files);
foreach($files as $file){
	$file = chop($file,'.php');
	//echo $file.'<br>';
	
	similar_text($file,$page_name,$percent);
	
	$similar_files[$percent] = $file;
	//echo $percent.'<br>';
}
ksort($similar_files);
//print_r($similar_files);
$redirect_location = end($similar_files);
$likeness = key($similar_files);

if($likeness >= 75){
	header('Location: '.$redirect_location);
}else{

	$page = '404 Page';
	if( isset($_SESSION['id']) ){
		require_once 'header.php';
	}
	require_once 'requires_echo.php';
	
	
	$page_name = $_SERVER['HTTP_REFERER'];
	$page_name_array = explode("/",$page_name);
	unset($page_name_array[0]);
	unset($page_name_array[1]);
	unset($page_name_array[2]);
	$page_name = implode('/',$page_name_array);
	?>
	<html>
		<head>
			<title id='title'>Sorry This Page Was Not Found <?php echo $TabTitle ?></title>
		</head>
		<body>
			<style>
				@font-face {
					font-family: Albertus;
					src: url(Albertus.ttf);
				}
				body{
					background-color:#990000;
					font-family:Albertus;
				}
				h1{
					font-family:Albertus;
					font-size:5vh;
					color:white;
				}
			</style>
			<h1>Well this is emabaressing.<br><?php echo $page_name; ?> was not found.</h1>
		</body>
	</html>
<?php
}
?>
