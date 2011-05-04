<?
/**
 * Signup Gate
 * 
 * @version $Id: index.php 87 2007-10-08 00:31:23Z mimait04 $
 * @copyright 
 * @author 
 *  
 */
chdir('..');
$_GET['action'] = 'dosignup';

#echo 'action:'.$_GET['action'];
$currentStage = 'dosignup';

#echo '$currentStage:'.$currentStage;

include_once("index.php");
?>