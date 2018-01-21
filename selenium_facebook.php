<?php
/*
 *Script path 
 * public_html/php-webdriver/selenium_facebook.php
 *
This code is designed to run with the php-webdriver for Selenium.

1. Visit url https://www.facebook.com/
2. Try to login to the site
3. In case of wrong email or password throw the error. You can check in header and footer blocks

*/

error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once('lib/__init__.php');


$host = 'http://localhost:4444/wd/hub';

//Setting up browser, Commonly firefox
$capabilities = array(WebDriverCapabilityType::BROWSER_NAME => 'firefox');

//Loading selenium server Drivers
$driver = RemoteWebDriver::create($host, $capabilities, 5000);

/* Url to visit */
$url = 'https://www.facebook.com/';
$driver->get($url);
echo "Visiting ... ".$url;

$driver->get($url);

// Putting informations and then getting result with screen short I have made a directory in my web-drivers folder images
// public_html/php-webdriver/images/
try {
  $driver->findElement(WebDriverBy::cssSelector("[name='email']"))->sendKeys("nonuser@you.com");
     $driver->findElement(WebDriverBy::cssSelector("[name='pass']"))->sendKeys("wrongpasswd");
     $driver->findElement(WebDriverBy::cssSelector("[type='submit']"))->click();
     
     $error_message = '';
     if($driver->findElement(WebDriverBy::cssSelector("[class='pam login_error_box uiBoxRed']"))) {
      $error_message = $driver->findElement(WebDriverBy::cssSelector("[class='pam login_error_box uiBoxRed']"))->getText();
  }
     file_put_contents('./images/screenshot1.png', $driver->takeScreenshot());
     echo '<img src="./images/screenshot1.png" >';
     if($error_message){
      echo "<br>".$error_message; 
     } else {
      echo "<br> You are login successfully";
     }

} catch (Exception $ex){
  echo '<h1 style="color:red;">error</h1> ' .$ex->getMessage();
} 

// close the Firefox
// $driver->quit();

?>
