<?
/**
 * 
 * Admin Gate
 * 
 * @version $Id: index.php 155 2008-01-13 20:01:44Z mimait04 $
 * @copyright 
 * @author 
 *  
 */
chdir('..');
$_GET['action'] = 'doadmin';

#echo 'action:'.$_GET['action'];
$currentStage = 'doadmin';

#echo '$currentStage:'.$currentStage;
include_once("index.php");
?>