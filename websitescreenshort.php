<?php

	header('Content-Type: text/html; charset=utf-8');
	/** Error reporting */
	error_reporting(E_ALL);
	ini_set('display_errors', TRUE);
	ini_set('display_startup_errors', TRUE);
	date_default_timezone_set("Asia/Karachi");
	header("access-control-allow-origin: *");

	if (PHP_SAPI == 'cli')
		die('This program should only be run from a Web Browser');
 
 
$sites = "https://github.com
http://www.php-fig.org/psr/psr-4/
http://www.radiomirchi.com/audio/murga/150";
 
$sites = preg_split('/\r\n|\r|\n/', $sites);

echo "
<style>
img {float: left; margin: 15px; }
</style>
";
 
foreach($sites as $site) 
{
		$image = file_get_contents("https://www.googleapis.com/pagespeedonline/v1/runPagespeed?url=$site&screenshot=true");
		$image = json_decode($image, true); 
		$image = $image['screenshot']['data'];
		$image = str_replace(array('_','-'),array('/','+'),$image); 

		echo "<img src=\"data:image/jpeg;base64,".$image."\" border='1' />";
 
}

phpinfo();

?>
