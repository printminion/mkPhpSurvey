<?
session_start();

$version = "0.10";

//print_r($_SERVER);
//
//die();

$thisScript=$_SERVER['PHP_SELF'];
$mailto="m@kupriyanov.de";
$scriptTitle = "mkClassGenerator";
$scriptDescription = "Generates PHP classes";
$siteName = "www.kupriyanov.de";
$homedir = getcwd();

$frame = $_GET['frame'];

if(!isset($frame)){
   $frame = $_POST['frame'];   
}

//echo "frame:$frame";

//include_once($homedir.);


// include the phpformatter class
//require_once ($homedir.'/phpformatter.class.php');
// create a new object
//$phpformatter = new phpformatter ();
// load PHP source code
//$code = file_get_contents ('phpformatter.class.php');
// get the formatted code
//$formatted = $phpformatter->format_string ($code);
//// As an alternative it's possible to call the class methods as static
//// phpformatter::format_string ($code);
//// phpformatter::format_file ($filename);
//
//// print the formatted code in a beautiful way
//highlight_string ($formatted);


define('CLASS_AUTHOR_NAME_DEFAULT',"Mischa Matiyenko-Kupriyanov");
define('CLASS_AUTHOR_EMAIL_DEFAULT',"m@kupriyanov.de");
define('CLASS_VARS_SEPARATOR_DEFAULT',";");

$projectName = $pName;


/*
 * Set default values
 */
if ($_SESSION['CLASS_AUTHOR_NAME']==""){
   $_SESSION['CLASS_AUTHOR_NAME'] = CLASS_AUTHOR_NAME_DEFAULT;
}

if ($_SESSION['CLASS_AUTHOR_EMAIL']==""){
   $_SESSION['CLASS_AUTHOR_EMAIL'] = CLASS_AUTHOR_EMAIL_DEFAULT;
}

if ($_SESSION['CLASS_VARS_SEPARATOR']==""){
   $_SESSION['CLASS_VARS_SEPARATOR'] = CLASS_VARS_SEPARATOR_DEFAULT;
}

#######################################
# actions stuff

if ($action=="generate"){

if ($input['CLASS_AUTHOR_NAME']!=""){
   $_SESSION['CLASS_AUTHOR_NAME'] = $input['CLASS_AUTHOR_NAME'];
}

if ($input['CLASS_AUTHOR_EMAIL']!=""){
   $_SESSION['CLASS_AUTHOR_EMAIL'] = $input['CLASS_AUTHOR_EMAIL'];
}

if ($input['CLASS_VARS_SEPARATOR']!=""){
   $_SESSION['CLASS_VARS_SEPARATOR'] = $input['CLASS_VARS_SEPARATOR'];
}


$vars = $input['vars'];

if ($vars==""){
   die("ERROR:Add Local variables...");
}

//echo "<pre>";
//$varsArr = split(";",$vars);
//echo $_SESSION['CLASS_VARS_SEPARATOR'];

//split variables
if ($_SESSION['CLASS_VARS_SEPARATOR']=="\\\\n"){
   $varsArr = split("\n",$vars);
   $i = 0;
   foreach($varsArr as $varKey){
      $varsArr[$i] = trim($varKey);

      $test = split("\\$",$varsArr[$i]);
      if(count($test)>1){
         $test = split(";",$test[1]);
         $test = trim($test[0]);
         //print_r($test);
//         echo "{".$test."}<br>";
         if($test!=""){
            $varsArr2[] = $test;
         }
      }else{
         $varsArr2[] = $test[0];
      }
      
      $i++;

   }
   $varsArr = $varsArr2;
   
}else{
   $varsArr = split($_SESSION['CLASS_VARS_SEPARATOR'],$vars);
}


//remove empty variables
unset($varsArr2);
foreach($varsArr as $varKey => $varValue){
//   echo  "$varKey => $varValue\n";
   if ($varValue != ""){
      $varsArr2[] = $varValue;
   }
}
$varsArr = $varsArr2;
   
//print_r($varsArr);
//leave only unique variables
if($input['varUnique']){
      $varsArr = array_unique($varsArr);
}
//echo "...";
//print_r($varsArr);

//do javaFormattedVariable
if($input['varJavaLike']){
   unset($varsArr2);
   foreach($varsArr as $varKey => $varValue){
//      echo "$varKey => $varValue\n";
      $varTemp = getNameCapitalized($varValue);
      $varTemp = strtolower(substr($varTemp,0,1)).substr($varTemp,1,strlen($varTemp));
      $varsArr2[] = $varTemp;
   }
      $varsArr = $varsArr2;

}
//echo "+++";
//print_r($varsArr);

$functionPrefix = $input['functionPrefix'];
$className = $input['className'];

if($input['addHeaderClass']==1){
   $classHeader = makeClassHeader("",$className,null);
}

if($input['addValidation']==1){
   $classVariables .= "   var \$_InputValidatorObj;\n";
   $classVariables .= "   var \$_lastError = null;\n\n";
}

foreach($varsArr as $varKey){
   //$classVariables .= getNameCapitalized($varKey);
   $classVariables .= "   var \$$varKey;\n";
}


###########################
# Validation stuff
if($input['addValidation']==1){

   //define validation switches to Class Constructor
   $validationVars .= "\n   //define validation swithces\n";
   foreach($varsArr as $varKey){
      $varKeyCapitalized = getNameCapitalized($varKey);
      $validationVars .= "   var \$validateInput$varKeyCapitalized = true;\n";
   }
   
   //define validation switches to Class Constructor
   $validationVars .= "\n   //define required fields\n";
   foreach($varsArr as $varKey){
      $varKeyCapitalized = getNameCapitalized($varKey);
      $validationVars .= "   var \$requiredInput$varKeyCapitalized = true;\n";
   }
   
   $validationVars .= "\n";

   //add Validator Instance to Class constructor
   if($input['addValidation']==1){
      $classConstructorBody .= "      \$this->_InputValidatorObj = new InputValidator();\n";
   }


    //add required switches to Class Constructor
   $classConstructorBody .= "\n      //set required switches\n";
   foreach($varsArr as $varKey){
      $varKeyCapitalized = getNameCapitalized($varKey);
      $classConstructorBody .= "      \$this->requiredInput$varKeyCapitalized = true;\n";
   }
   
   //add validation switches to Class Constructor
   $classConstructorBody .= "\n      //set validation swithces\n";
   foreach($varsArr as $varKey){
      $varKeyCapitalized = getNameCapitalized($varKey);
      $classConstructorBody .= "      \$this->validateInput$varKeyCapitalized = true;\n";
   }
   

   
   $classConstructorBody .= "\n";

$classVariables .= $validationVars;
}

#
#################################

############################
# make get/setter
foreach($varsArr as $varKey){
   
//   echo $varKey."<br>";
   
   $varKeyCapitalized = str_replace("_", " ", $varKey);
   $varKeyCapitalized = ucwords($varKeyCapitalized);
   $varKeyCapitalized = str_replace(" ", "", $varKeyCapitalized);
   
//   echo $varKeyCapitalized."<br>";
//   $varKeyCapitalized = getNameCapitalized($varKey);
   $functionGetSetter .= makeFunctionHeader("set","set".$functionPrefix.$varKeyCapitalized,$varKey);

   if($input['addValidation']==1){
      $functionBody = makeFuntionBodySetValidate($varKeyCapitalized,$varKey);
      $functionBody .= makeFunctionBodySetValidation($varKeyCapitalized,$varKey);
   }else{
      $functionBody = makeFunctionBodySet($varKeyCapitalized,$varKey);
   }

   $functionGetSetter .= makeFunctionSet($functionPrefix.$varKeyCapitalized,$varKey,$functionBody);

   $functionGetSetter .= "\n";

   $functionGetSetter .= makeFunctionHeader("get","get".$functionPrefix.$varKeyCapitalized,$varKey);
   $functionBody = makeFunctionBodyGet($varKeyCapitalized,$varKey);
   $functionGetSetter .= makeFunctionGet($functionPrefix.$varKeyCapitalized,$varKey,$functionBody);

   $functionGetSetter .= "\n\n\n";
}
$classBody .= $functionGetSetter;
#
############################




##################################
#  output isValid function
if($input['addValidation']==1){
   $functionBody = "";
   $functionName = "isValid";
   
   $functionIsValid .= makeFunctionHeader("",$functionName,$varKey);
   $functionBody = "\n";
   
   foreach($varsArr as $varKey){
      $varKeyCapitalized = getNameCapitalized($varKey);
      $functionBody .="    if(!\$this->set$functionPrefix$varKeyCapitalized(\$this->$varKey)) return false;\n";
   }
   
      $functionBody .="\n    return true;\n";
      $functionIsValid .= makeFunction($functionName,null,$functionBody);
   }

   $functionName = "getLastError";
   $functionIsValid .= "\n".makeFunctionHeader("",$functionName,$varKey);
   $functionBody = "      \$lastError = \$this->_lastError;\n";
   $functionBody .= "      \$this->_lastError = null;\n";
   $functionBody .= "      return \$lastError;\n";
   $functionIsValid .= makeFunction($functionName,null,$functionBody,false);



$classBody .= $functionIsValid;

$classComplete = makeClassBody($className,$classHeader,$classVariables,$classBody,$classConstructorBody);

//echo "<pre>";
header("Content-Type: text/html");
highlight_string($classComplete);
die();
}


#
####################################





if($frame == 'null'){?>
<b><?=$scriptTitle?> v.<?=$version?></b><br>
(<?=$scriptDescription?>)<br>
created by <a href="mailto:<?=$mailto?>"><?=$mailto?></a>
<?
}
else if ($frame == 'tools') {?>
<html>
<head></head>
<body style="margin:0px;">
<style type="text/css">
BODY{
  font: bold 12px  sans-serif;
}
.lbl{
   font: bold 12px sans-serif;;
   padding-right:5px;
}

input,textarea {
  font: 10px Verdana, Arial, Helvetica, sans-serif;
  color: #000000;
  background-color: #CEE7FF;
  border: 1px solid #000000;
}

.tbl1{
  border-top: 1px dotted #004E9B;   
  border-bottom: 1px dotted #004E9B;   
}
</style>
 <FORM action="<?=$thisScript?>" method="post" target="display">
<table border=0 width=100% cellpadding=2 cellspacing=0>
   <tr>
      <td colspan=2>
         <label class="lbl">Class Author:</label><INPUT style="width:300px;" type="text" id="saveas" name="input[CLASS_AUTHOR_NAME]" value="<?=$_SESSION['CLASS_AUTHOR_NAME']?>">	<label class="lbl">E-Mail:</label><INPUT style="width:200px;" type="text" id="saveas" name="input[CLASS_AUTHOR_EMAIL]" value="<?=$_SESSION['CLASS_AUTHOR_EMAIL']?>"><BR>
      </td>
   </tr>
   <tr>
      <td colspan=2>
         <label class="lbl">Add class header:<label><input type="checkbox" name="input[addHeaderClass]" value="1">
         <label class="lbl">Class name:</label><INPUT type="text" id="saveas" name="input[className]"><BR>
      </td>
   </tr>
   <tr>
      <td valign="top" >

         <table border=0 cellpadding=2 cellspacing=0 class="tbl1">
         <tr>
            <td>
               <label class="lbl">Local variables:</label>
               <label class="lbl">Separator:</label><INPUT type="text" id="saveas" name="input[CLASS_VARS_SEPARATOR]" size=5 value="<?
               if ($_SESSION['CLASS_VARS_SEPARATOR']=="\\\\n"){
                  $_SESSION['CLASS_VARS_SEPARATOR'] = "\\n";
               }
               
               echo $_SESSION['CLASS_VARS_SEPARATOR'];
               
               ?>"> use {, ; | \n} etc.<BR>
            </td>
            <td width=100%>
               <label class="lbl">Optimize varz:</label>
            </td>

         </tr>
         <tr>
            <td>
               <textarea style="width:400px;height:50px;" name="input[vars] rows="10" cols="35"></textarea>
            </td>
            <td width=100%>
                  <input type="checkbox" name="input[varUnique]" value="1" checked> make unique<br>
                  <input type="checkbox" name="input[varJavaLike]" value="1"> make javaLikeVariables
            </td>
         </tr>
         </table>

      </td>
   </tr>
   <tr>
      <td colspan=2>
   <label class="lbl">Add inputValidator:</label><input type="checkbox" name="input[addValidation]" value="1">
   <label class="lbl">Add FunctionPrefix:</label><INPUT type="text" id="saveas" name="input[functionPrefix]"><BR>
      </td>
   </tr>
   <tr>
      <td colspan=2 align=right>
         	<INPUT type="hidden" name="action" value="generate">

         	<INPUT type="reset">
         	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
         	<INPUT type="submit" value="Generate">

           
      </td>
   </tr>
</table>
 </FORM>
 <body>
 </html>
<?
}else{
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN"
   "http://www.w3.org/TR/html4/frameset.dtd">
<HTML>
<HEAD>
<TITLE><?=$scriptTitle?> v.<?=$version?> - <?=$siteName?></TITLE>
</HEAD>
  <FRAMESET rows="*, 200">
<!--  	<FRAMESET rows="*">-->
      <FRAME src="<?=$thisScript?>?frame=null" name=display>
      <FRAME src="<?=$thisScript?>?frame=tools" name=tools>
  </FRAMESET>
  <NOFRAMES>
      <P>This frameset document contains:
  </NOFRAMES>
</HTML>
<?}?>



<?php
function getNameCapitalized($variableName){
   $varKeyCapitalized = str_replace("_", " ", $variableName);
   $varKeyCapitalized = ucwords($varKeyCapitalized);
   $varKeyCapitalized = str_replace(" ", "", $varKeyCapitalized);
   return $varKeyCapitalized;
}

function makeFunctionHeader($functioType=null,$functioName=null,$functionVar=null,$variableIN = true){
global $input,$scriptTitle,$version;
//   /**
//     * Short description of method addCustomerAdress
//     *
//     * @access public
//     * @author Mischa Kupriyanov, <m@kupriyanov.com>
//     * @param CustomerAdress
//     * @return boolean
//     */
//    public function addCustomerAdress( - classes_CustomerAdress $adressObj)
//    {
//        $returnValue = (bool) false;
//
//        // section .:0000000000000844 begin
//        // section .:0000000000000844 end
//
//        return (bool) $returnValue;
//    }

      $returnValue .= "   /**\n";
      $returnValue .= "     * Short description of method $functioName\n";
      $returnValue .= "     *\n";
      $returnValue .= "     * @access public\n";
      //$returnValue .= "     * @author ".CLASS_AUTHOR_NAME.", <".CLASS_AUTHOR_EMAIL.">\n";
      $returnValue .= "     * @author ".$_SESSION['CLASS_AUTHOR_NAME'].", <".$_SESSION['CLASS_AUTHOR_EMAIL'].">\n";
      $returnValue .= "     * @generator Generated with $scriptTitle v.$version\n\n";

      if($functioType=="set"){
         $returnValue .= "     * @param string\n";
//         $returnValue .= "     * @param string\n";
         if($input['addValidation']==1){
            $returnValue .= "     * @return boolean\n";  
         }else{
            $returnValue .= "     * @return void\n";  
         }
      }

      if($functioType=="get"){
         $returnValue .= "     * @return string\n";  
      }


      $returnValue .= "     */\n";

      return $returnValue;
}

function makeClassHeader($functioType=null,$functioName=null,$functionVar=null){
global $input,$scriptTitle,$version;

   if($functioName=="")$functioName = "%add_class_name%";
   
      $returnValue .= "/*\n\n";
      $returnValue .= "   \$Id\$\n\n";
      $returnValue .= "   @description Short description of class $functioName\n\n";
      $returnValue .= "   @generator Generated with $scriptTitle v.$version\n\n";
      
      $returnValue .= "   @access public\n";
      $returnValue .= "   @author ".$_SESSION['CLASS_AUTHOR_NAME'].", <".$_SESSION['CLASS_AUTHOR_EMAIL'].">\n";
      $returnValue .= "   @return boolean\n";
      $returnValue .= "\n*/\n";

      if($input['addValidation']==1){
         $returnValue .= "\nrequire_once('classes/class.InputValidator.php');\n\n";
      }

      return $returnValue;
}

function makeFuntionBodySetValidate($functioName=null,$functionVar=null){
   $returnValue .= "      \$this->_lastError = null;\n\n";
   $returnValue .= "      //check if this value is required\n";
   $returnValue .= "      if (\$this->requiredInput$functioName){\n";
   $returnValue .= "         if($$functionVar == null){\n";
   $returnValue .= "            \$this->_lastError = ERROR_INPUT_REQUIRED_INPUT_".strtoupper($functionVar).";\n";
   $returnValue .= "            return false;\n";
   $returnValue .= "         }\n";
   $returnValue .= "      }\n";
//   $returnValue .= "      }else{\n";
//   $returnValue .= "         if(\$$functionVar == \"\"){\n";
//   $returnValue .= "            return true;\n";
//   $returnValue .= "         }\n";
//   $returnValue .= "      }\n";

   return $returnValue;
}


function makeFunctionBodySetValidation($functioName=null,$functionVar=null){
  
//      $returnValue .= "      \$returnValue = (bool) false;\n";
//      $returnValue .= "\n";
      //$returnValue .= "      if(!\$this->_InputValidatorObj->validateZeroOrOne(\$".$functionVar.")) {\n";
      //$returnValue .= "   \$_lastError = null;\n";
//      $returnValue .= "   \$this->_lastError = null;\n";
      $returnValue .= "\n";      
      $returnValue .= "      //check if validation required\n";
      $returnValue .= "      if (\$this->validateInput$functioName){\n";
      $returnValue .= "         if(!\$this->_InputValidatorObj->defaultFunction(\$".$functionVar.")) {\n";
      //$returnValue .= "         \$this->_lastError = \$this->_InputValidatorObj->getLastError();\n";
      $returnValue .= "            \$this->_lastError = \$this->_InputValidatorObj->getLastError();\n";
      //$returnValue .= "      \$_lastError = \$this->_lastError;\n";
      $returnValue .= "            return false;\n";
      $returnValue .= "         }\n";
      $returnValue .= "      }\n\n";

//      $returnValue .= "   }else{\n";
//      $returnValue .= "         \$this->$functionVar = \$".$functionVar.";\n";
//      $returnValue .= "         return true;\n";
//      $returnValue .= "   }\n\n";

      $returnValue .= "      \$this->$functionVar = \$".$functionVar.";\n";
      $returnValue .= "      return true;\n\n";
      
      
//      $returnValue .= "\n";
//      $returnValue .= "      return (bool) \$returnValue;";
      return $returnValue;
}


function makeFunctionBodySet($functioName=null,$functionVar=null){
  
      $returnValue .= "\n";      
      $returnValue .= "         \$this->$functionVar = \$".$functionVar.";\n";
      $returnValue .= "\n";      
      return $returnValue;
}

function makeFunctionBodyGet($functioName=null,$functionVar=null){
  
      $returnValue .= "      return \$this->$functionVar;\n";

      return $returnValue;
}

function makeFunctionSet($functioName=null,$functionVar=null,$functionBody=null){
//   if ($functionVar!=null){
//      $functionVarS = "\$".$functionVar." = null";
//   }
//
//
//   
//   $returnValue = "function set".$functioName."(".$functionVarS."){\n";
//
//   if ($functionBody!=null){
//      $returnValue .= $functionBody;
//   }else{
//      $returnValue .= "\n";
//   }
//   $returnValue .= "}\n";
   
//   return $returnValue;

   return makeFunction("set".$functioName,$functionVar,$functionBody);
}

function makeFunctionGet($functioName=null,$functionVar=null,$functionBody=null){
//   if ($functionVar!=null){
//      $functionVarS = "\$".$functionVar." = null";
//   }
//
//
//   
//   $returnValue = "function get".$functioName."(){\n";
//
//   if ($functionBody!=null){
//      $returnValue .= $functionBody;
//   }else{
//      $returnValue .= "\n";
//   }
//   
//   
//   $returnValue .= "}\n";
//   
//   return $returnValue;
   return makeFunction("get".$functioName,null,$functionBody);
}


function makeClassBody($className=null,
                       $classHeader=null,
                       $classVariables=null,
                       $classBody=null,
                       $classConstructorBody=null){
                        
   if ($className==null){
      $className = "%add_class_name%";
   }


   
   $returnValue .= $classHeader;
   $returnValue .= "class ".$className."{\n";
   $returnValue .= "\n".$classVariables."\n";
   $returnValue .= "   function ".$className."(){\n\n";
   if ($classConstructorBody!=""){
      $returnValue .= "\n".$classConstructorBody."\n";
   }
   $returnValue .= "\n   }\n\n";
   
   $returnValue .= $classBody;
   $returnValue .= "}";


   return $returnValue;
}

function makeFunction($functioName=null,$functionVar=null,$functionBody=null){
   if ($functionVar!=null){
      $functionVarS = "\$".$functionVar." = null";
   }


   
   $returnValue = "   function ".$functioName."($functionVarS){\n";

   if ($functionBody!=null){
      $returnValue .= $functionBody;
   }else{
      $returnValue .= "\n";
   }
   
   
   $returnValue .= "   }\n";
   
   return $returnValue;
}


?>