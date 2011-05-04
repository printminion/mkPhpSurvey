<?
//error_reporting(E_ALL);
//-------------------------------------------------------------------------------------------------------
//   
// $Id: mk_debug.php 133 2007-11-25 01:49:43Z mimait04 $
// 
// Copyright (c) 2006-2007 Kupriyanov
// @author Mischa M-Kupriyanov, <@kupriyanov.de>
//
//-------------------------------------------------------------------------------------------------------
//
// @summary
//-------------------------------------------------------------------------------------------------------
//
// @description
//
//------------------------------------------------------------------------------------------------------- 

#######################################
# HINT: Replace your diplay function in Smarty.class.php with this one - and have FUN!
#
#    function display($resource_name, $cache_id = null, $compile_id = null)
#    {
#        global $messageStack, $smarty,$customerObj,$GLOBALS;
#        global $payment_modules,$array_payments;
#
#        require_once('includes/framework/error_info.php');
#
#        $this->fetch($resource_name, $cache_id, $compile_id, true);
#
#         debug_on("debug",true);
#         debug_obj($_SESSION,"_SESSION");
#         debug_obj($_POST,"_POST");
#         debug_obj($_GET,"_GET");
#         debug_obj($customerObj,"customerObj");
#         debug_obj($newCustomerObj,"newCustomerObj");
#         debug_obj($payment_modules,"payment_modules");
#         debug_obj($array_payments,"array_payments");
#         debug_obj($order,"order");
#         debug_off();
#//         debug_obj($GLOBALS,"GLOBALS");
#         debug_obj($_SESSION['navigation']->snapshot,"navigation->snapshot");
#         debug_obj($_SESSION['navigation'],"navigation");
#
#         debug_obj(get_included_files(),"get_included_files");
#         debug_obj(get_defined_constants(),"get_defined_constants");
#
#    }
#


# DO NOT EDIT AFTER THIS LINE
#########################################################################

define('FTK_DEVELOPER_ID','cr');
define('MK_DEBUG_FORCE_OUTPUT',true);
$mk_debug_on = true;

if (FTK_DEVELOPER_ID == "FTK_DEVELOPER_ID" && $mk_debug_on == true){
   die("WARNING:mk_debug.php => define FTK_DEVELOPER_ID !!!");
}



if (MK_DEBUG_FORCE_OUTPUT == true){
   define('MK_DEBUG_ENABLED',true);
}

$mkDebug_FirstRun = true;
$mkDebug_idDiv = "";
define('MKDEBUG_VERSION','2.0');

/**
 * print out help about debug commands
 * @access public
 *
 * @return null
 */
function debug_help(){
   echo "<span style='white-space: pre;'>";

   echo '
   <b>Name:</b>mkDebugToolz
   <b>Version:</b>'.MKDEBUG_VERSION.'
   <b>Implemented functions:</b>
   debug_sql($sqlString,$strTitle = "",$pre = false)
      debug_sql($_SESSION);
      debug_sql($_SESSION,"_SESSION");
   
   debug_obj($object,$strComment = null,$expanded = false)
      debug_obj($_SESSION);
      debug_obj($_SESSION,"_SESSION");
      debug_obj($_SESSION,"_SESSION",true);
      
   debug_xml($sqlString,$strTitle = "",$expanded = false)
   
   <b>Section Functions:</b>
   debug_on();
   debug_off();
   

   <b>USAGE:</b>   
     1. define your output block
        if (debug_on("String")){
           echo "output1";
           echo "output2";
           echo "output3";
           echo "output4";
           debug_off();
        }

     2. output arrays or objects, with title or without
        debug_obj($someArray);
        debug_obj($someArray,"this is some Array");
        debug_obj($someObject);
        debug_obj($someObject,"This is my object");

     3. output strings in a box, with title or without
        debug_sql($someString);
        debug_sql($someString,"someString");
   
   ';

   echo "</span>";
}

/**
 * Output object information
 *
 * @access public
 *
 * @param object $object Object to output
 * @param string $strComment Short comment for block
 * @param boolean $expanded Collapse/Expand debug block
 * @return null
 */
function debug_obj($object,$strComment = null,$expanded = false){
   global $mk_debug_on;
   if (!$mk_debug_on) return false;
   
   $arrayCount = null;
   
   if ($strComment!="") $strComment = " [".$strComment."]";

   if ($object == null){
      $expanded = false;
      $enabled = false;
   }else{
      #$expanded = false;
      $enabled = true;
   }
   if (gettype($object)=="array"){
      $arrayCount = "(".count($object).")";
      #$objectInfo = "[".count($object)."]";
   }

   if (debug_on(get_class($object)." [".gettype($object)."$arrayCount]".$strComment,$expanded,$enabled)){
      #if (debug_on("".get_class($object)." (".gettype($object).") $objectInfo".$strComment,$expanded,$enabled)){
      echo "<span style='white-space: pre;'>";
      echo dumpPrintRToString2($object);
      echo "</span>";
      debug_off();
   }


}

/**
 * Begin output block.Dont forget to close it with debug_off();
 * @access public
 * @example_disable
 * 		if (debug_on("String")){
 *        echo "output1";
 *        echo "output2";
 *      debug_off();
 *
 * @param string $strName Caption of output block
 * @param boolean $expanded Expand/Collapse Output block
 * @param boolean $enabled Enable/Disable block
 * @return null
 */
function debug_on($strName,$expanded = false,$enabled = true){
   global $mk_debug_on;
   if (!$mk_debug_on) return false;
   global $PATH_IMAGES,$mkDebug_FirstRun, $mkDebug_idDiv;
   
   $blockSymbolDisabled = null;
   
   $idDiv = getUID2(5);
   $mkDebug_idDiv = $idDiv;
   if (MK_DEBUG_ENABLED){
      _flushHTML_Style();
      if ($expanded){
         $expanded = " style='display:block' ";
         $blockSymbol = '[-]';
         $blockSymbol = '<div class="bobbel">-</div>';
      }else{
         $expanded = " style='display:hide' ";
         $blockSymbol = '[+]';
         $blockSymbol = '<div class="bobbel">+</div>';

      }

      if ($enabled){
         ?>
<div class="debug_obj" <?=$expanded?>>
<div class="debug_head debug_head_a"
	onClick="javascript:shoh('<?=$mkDebug_idDiv?>');return false;">
<div style="cursor:pointer;" class="debug_head_a" id="img<?=$idDiv?>"
	border=0><?=$blockSymbol?></div>
<span class="debug_head_a"><?=$strName?></span></div>
<div class="debug_div" id="<?=$idDiv?>" <?=$expanded?>>
<div style='margin-left:-5px;border-bottom:1px dotted #000000;'><?
}else{
   $blockSymbol = '<div class="bobbel">.</div>';
   ?>
<div class="debug_obj" <?=$expanded?>>
<div class="debug_head debug_head_a">
<div href="#" style="cursor:pointer;" id="img<?=$idDiv?>" border=0><?=$blockSymbolDisabled?></div>
<span class="debug_head_a_disabled"><?=$strName?></span></div>
<div class="debug_div" id="<?=$idDiv?>">
<div><?
}

}
return MK_DEBUG_ENABLED;
}

/**
 * Output css style for debug
 * @access private
 *
 * @return null
 */
function _flushHTML_Style(){
   global $mk_debug_on;
   if (!$mk_debug_on) return false;

   global $mkDebug_FirstRun;
   if (MK_DEBUG_ENABLED){
      if($mkDebug_FirstRun){
         $mkDebug_FirstRun=false;
         ?> <script type="text/javascript">
            function mkdfilter(id,state){
               var oElement = document.getElementById(id);
               
               if (oElement==null || oElement == 'undifined') return false;
               
               if (state == 'imgin'){
                  //oElement.innerHTML = '[-]';
                  oElement.innerHTML = '<div class="bobbel2">-</div>';
               }else{
                  //oElement.innerHTML = '[+]';
                  oElement.innerHTML = '<div class="bobbel">+</div>';
               }
            }

            //show OR hide funtion depends on if element is shown or hidden
            function shoh(id) { 
            	
            	if (document.getElementById) { // DOM3 = IE5, NS6
            	   var oElement = document.getElementById(id);
            
            		if (oElement.style.display == "none" || oElement.style.display == ""){
            			oElement.style.display = 'block';
            			mkdfilter(("img"+id),'imgin');			
            		} else {
            			mkdfilter(("img"+id),'imgout');
            			oElement.style.display = 'none';			
            		}	
            	} else { 
            		if (document.layers) {	
            			if (document.id.display == "none" || document.id.display == ""){
            				document.id.display = 'block';
            				mkdfilter(("img"+id),'imgin');
            			} else {
            				mkdfilter(("img"+id),'imgout');	
            				document.id.display = 'none';
            			}
            		} else {
            			if (document.all.id.style.visibility == "none"){
            				document.all.id.style.display = 'block';
            			} else {
            				mkdfilter(("img"+id),'imgout');
            				document.all.id.style.display = 'none';
            			}
            		}
            	}
            }

         </script>

<style>


a.collapse:hover, a.collapse:active{
   background-color:#B5B5B5;
   color:#0000ff;
   font-family:Arial,Helvetica,sans-serif;
   font-size:12px;
   text-decoration:none;
   margin-left:-10px;
}
a.collapse:link, a.collapse:visited {
   color:#0A246A;
   font-family:Arial,Helvetica,sans-serif;
   font-size:12px;
   margin-left:-10px;
}
a.collapse, a.collapseDis {
   display:block;
   font-family:Arial,Helvetica,sans-serif;
   font-size:12px;
   text-decoration:none;
   margin-left:-10px;

}


            
            .debug_div{
               display: none; 
               /*background:#FFFFDF; */
               margin-top:5px; 
               margin-left:10px; 
               margin-right:10px; 
               margin-bottom:1px; 
            }
            
            .debug_obj
            {
               border:1px dotted #737373; 
               color:black; 
               background:#C5C5C5;
               margin:1px;
               
            }
            
            .bobbel{
               float:left;
               margin:2;
               padding:1px;
               width:12px;
               height:12px;

               border-left:1px solid #FDFDFD;
               border-top:1px solid #FDFDFD;

               border-right:2px solid #000000;
               border-bottom:2px solid #000000;
               text-align:center;
               background-color:#C3C3C3;
            }
            
            .bobbel2{
               float:left;
               margin:2;
               padding:1px;
               width:12px;
               height:12px;

               border-left:2px solid #000000;
               border-top:2px solid #000000;

               border-right:1px solid #FDFDFD;
               border-bottom:1px solid #FDFDFD;
               text-align:center;
               background-color:#C3C3C3;
            }

            .pre {
               white-space: pre;
            }

            .debug_sql
            {
               border:1px dotted; 
               color:black; 
               background:#C5C5C5;
               margin:1px;
               padding:1px;
            }
            
            .debug_head
            {
               color:#000000; 
               background:#737373;

               border-left:#9A9A9A 1px solid;
               border-top:#9A9A9A 1px solid;
               height:20px;
               border-right:#3E3E3E 1px solid;
               border-bottom:#3E3E3E 1px solid;
               vertical-align:middle;
            }
            
            .debug_head_a{
               color:#000000; 
               cursor:pointer;
               /*text-decoration: underline;*/
               text-decoration: none;
               font-weight: bold; 
               vertical-align:top;
            }
            
            .debug_head_a_disabled{
               cursor:default;
               text-decoration: line-through;
               font-weight: bold; 
               vertical-align:top;
            }         
         </style>
         <?
}
}
}



/**
 * Output formatted xml string
 *
 * @param string $sqlString XML string
 * @param string $strTitle Debug Block caption
 * @param boolean $expanded Expand/collapse Debug block
 * @return null
 */
function debug_xml($sqlString,$strTitle = '',$expanded = false){
   #$sqlString = htmlspecialchars($sqlString,ENT_QUOTES);
   $sqlString = preg_replace('/></', ">\n<", $sqlString);
   #$sqlString = preg_replace('/<\/(([a-zA-z]+)(:|)([a-zA-z]+))>/', "</$1>\n", $sqlString);
   $sqlString = dumpHighlightStringToString($sqlString);
   debug_obj($sqlString,$strTitle,$expanded);
}

/**
 * Output String in pretty block
 *
 * @param string $sqlString String to output
 * @param string $strTitle caption of Debug Block
 * @param bool $pre  Use preformatted HTML tag <pre>
 * @return null
 */
function debug_sql($sqlString,$strTitle = '',$pre = false){
   global $mk_debug_on;
   if (!$mk_debug_on) return false;
   
   $preClass = null;
   
   if (is_object($sqlString)){
      $sqlString = 'WARNUNG:('.get_class($sqlString).') is object - use debug_obj';
   }
   
   if (MK_DEBUG_ENABLED){
      _flushHTML_Style();
      if ($strTitle!='') {
         $strTitle = "<b>".$strTitle.":</b>";
      }

      if ($pre == true){
         $preClass = 'pre';
         $sqlString = trim($sqlString);
      }
      
      echo "<div class='debug_sql $preClass'>$strTitle$sqlString</div>\n";
   }
}

function print_rr($arrToPrint){
   global $mk_debug_on;
   if (!$mk_debug_on) return false;

   ?><span class='white-space: pre;'><?

   print_r($arrToPrint);

   ?></span><?
}

/**
 * Close Block opened with debug_on
 *
 * @return null
 */
function debug_off(){
   global $mk_debug_on;
   if (!$mk_debug_on) return false;

   global $mkDebug_idDiv ;
   ?></div>
<a href="#<?=$mkDebug_idDiv?>" class='collapse'
	onClick="shoh('<?=$mkDebug_idDiv?>');">&nbsp;collapse</a></div>
</div>
   <?
}

/**
 * Generate UID with defined Length
 *
 * @param int $length
 * @return string
 */
function getUID2($length = 5){
   if($length>0)
   {
      $rand_id="";
      for($i=1; $i<=$length; $i++)
      {
         mt_srand((double)microtime() * 1000000);
         $num = mt_rand(1,36);
         $rand_id .= _assign_rand_value2($num);
      }
   }
   return $rand_id;
}

/**
 * Get mapping number char
 *
 * @access private
 *
 * @param int $num
 * @return string
 */
function _assign_rand_value2($num){
   // accepts 1 - 36
   switch($num)
   {
      case "1":
         $rand_value = "a";
         break;
      case "2":
         $rand_value = "b";
         break;
      case "3":
         $rand_value = "c";
         break;
      case "4":
         $rand_value = "d";
         break;
      case "5":
         $rand_value = "e";
         break;
      case "6":
         $rand_value = "f";
         break;
      case "7":
         $rand_value = "g";
         break;
      case "8":
         $rand_value = "h";
         break;
      case "9":
         $rand_value = "i";
         break;
      case "10":
         $rand_value = "j";
         break;
      case "11":
         $rand_value = "k";
         break;
      case "12":
         $rand_value = "l";
         break;
      case "13":
         $rand_value = "m";
         break;
      case "14":
         $rand_value = "n";
         break;
      case "15":
         $rand_value = "o";
         break;
      case "16":
         $rand_value = "p";
         break;
      case "17":
         $rand_value = "q";
         break;
      case "18":
         $rand_value = "r";
         break;
      case "19":
         $rand_value = "s";
         break;
      case "20":
         $rand_value = "t";
         break;
      case "21":
         $rand_value = "u";
         break;
      case "22":
         $rand_value = "v";
         break;
      case "23":
         $rand_value = "w";
         break;
      case "24":
         $rand_value = "x";
         break;
      case "25":
         $rand_value = "y";
         break;
      case "26":
         $rand_value = "z";
         break;
      case "27":
         $rand_value = "0";
         break;
      case "28":
         $rand_value = "1";
         break;
      case "29":
         $rand_value = "2";
         break;
      case "30":
         $rand_value = "3";
         break;
      case "31":
         $rand_value = "4";
         break;
      case "32":
         $rand_value = "5";
         break;
      case "33":
         $rand_value = "6";
         break;
      case "34":
         $rand_value = "7";
         break;
      case "35":
         $rand_value = "8";
         break;
      case "36":
         $rand_value = "9";
         break;
   }
   return $rand_value;
}



/**
 * Converts print_r output to string
 *
 * @access private
 * @author Mischa Kupriyanov, <mischa.kupriyanov@fotokasten.de>
 * @param mixed $variable
 * @return string
 */
function dumpPrintRToString2($variable)
{
   $returnValue = (string) '';

   // section .:00000000000007CE begin
   ob_start();
   print_r($variable);
   $returnValue = ob_get_contents();
   ob_end_clean();
   // section .:00000000000007CE end

   return (string) $returnValue;
}

/**
 * Converts var_dump output to string
 *
 * @access public
 * @author Mischa Kupriyanov, <mischa.kupriyanov@fotokasten.de>
 * @param mixed $variable
 * @return string
 */
function dumpVarDumpToString2($variable)
{
   $returnValue = (string) '';

   // section .:00000000000007D4 begin
   ob_start();
   var_dump($variable);
   $returnValue = ob_get_contents();
   ob_end_clean();

   // section .:00000000000007D4 end

   return (string) $returnValue;
}
/**
 * Converts highlight_string output to string
 *
 * @access public
 * @author Mischa Kupriyanov, <mischa.kupriyanov@fotokasten.de>
 * @param string $value
 * @return string
 */
function dumpHighlightStringToString($value)
{
   $returnValue = (string) '';

   // section .:00000000000007D4 begin
   ob_start();
   highlight_string($value);
   $returnValue = ob_get_contents();
   ob_end_clean();

   // section .:00000000000007D4 end

   return (string) $returnValue;
}

//--------------------------------------

###################################
# @TODO remove next functions
/**
 * Function to delete customer from DB
 *
 */
function mk_deleteCustomer(){
   global $mkinput, $customerOfficerObj;

   if ($mkinput['action']=="deleteCustomerById"){
      if(!$customerOfficerObj->deleteCustomerById($mkinput['customers_id'])){
         $mkError = $customerOfficerObj->getLastError();
      }
   }
   ?>
<div style="padding:3px;margin:3px;border:1px solid #D1F3C6;">
<form><label>deleteCustomerById:</label> <input type="text"
	name="mkinput[customers_id]"> <input type="hidden"
	name="mkinput[action]" value="deleteCustomerById"> <input type="submit"
	value="delete"> <label><?=$mkError?></label></form>
</div>
   <?
}
/**
 * Function to get customer Info from DB
 *
 */
function mk_getCustomerInfoById(){
   global $mkinput, $customerOfficerObj;

   if ($mkinput['action']=="getCustomerInfoById"){
      $customerInfoObj = $customerOfficerObj->getCustomerById($mkinput['customers_id']);
       
      if($customerInfoObj==null){
         $mkError2 = $customerOfficerObj->getLastError();
      }else{
         $customersAddressCollectionObj = $customerInfoObj->loadCustomersAddressCollection();
      }
   }
   ?>
<div style="padding:3px;margin:3px;border:1px solid #D1F3C6;">
<form><label>getCustomerInfoById:</label> <input type="text"
	name="mkinput[customers_id]" value="<?=$mkinput['customers_id']?>"> <input
	type="hidden" name="mkinput[action]" value="getCustomerInfoById"> <input
	type="submit" value="get info"> <label><?=$mkError2?></label></form>
</div>
   <?
   if($customerInfoObj!=null){
      debug_obj($customerInfoObj);

      foreach($customersAddressCollectionObj->addressArray as $customerAddressObj){
         debug_obj($customerAddressObj);
      }


   }
}
/**
 * Function to remove labels by orderId
 *
 */
function mk_resetOrderLabelsById(){
   global $mkinput, $customerOfficerObj;

   if ($mkinput['action']=="resetOrderLabelsById"){
      //   if(!$customerOfficerObj->deleteCustomerById($mkinput['customers_id'])){
      //      $mkError = $customerOfficerObj->getLastError();
      // UPDATE `orders_transmit` SET `print_label` = '0' WHERE `orders_id` =572304 LIMIT 1 ;

      //   }
   }
   ?>
<div style="padding:3px;margin:3px;border:1px solid #D1F3C6;">
<form><label>resetOrderLabelsById:</label> <input type="text"
	name="mkinput[orders_id]"> <input type="hidden" name="mkinput[action]"
	value="resetOrderLabelsById"> <input type="submit" value="delete"> <label><?=$mkError?></label>
</form>
</div>
   <?
}


/**
 * Dump sql queries to output file
 *
 * @param string $output SQL Query to output
 * @param strinf $comment Comment string
 * @return boolean
 */
function debug_sqldump($output,$comment = ""){
   ################################
   #
   $filename = getcwd()."/../sqllog.txt";
   //      debug_sql($filename);
   //      debug_sql($output);

   //      chmod($filename, 0766);

   if (!is_writable($filename)) {
      return false;
      //$handle = fopen($filename, "x");
   }
   //      $output = $query."\n";

   if ($comment!= ""){
      $output = $comment.":\n\t".$output;
   }

   $handle = fopen($filename, "a+");
   if (fwrite($handle, $output) === FALSE) {
      echo "Cannot write to file ($filename)";
      exit;
   }
   fclose($handle);
   #
   ###############################

}

?>