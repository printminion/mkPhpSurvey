<?php

include("resources/class.database.php");
$database = new Database();

$generatorName = "mkPhpDbClassGenerator";
$generatorVer = "0.3";


function getNameCapitalized($variableName){
   $varKeyCapitalized = str_replace("_", " ", $variableName);
   $varKeyCapitalized = ucwords($varKeyCapitalized);
   $varKeyCapitalized = str_replace(" ", "", $varKeyCapitalized);
   return $varKeyCapitalized;
}

function getVariableJavaLike($varValue){
   if ($varValue=="") return false;
   
   $varTemp = getNameCapitalized($varValue);
   $varTemp = strtolower(substr($varTemp,0,1)).substr($varTemp,1,strlen($varTemp));
   return $varTemp;
   
}



if($_REQUEST["f"]=="")
{
?>

<font face="Arial" size="3"><b>PHP MYSQL Class Generator</b></font>

<font face="Arial" size="2"><b>

<form action="generator.php" method="POST" name="FORMGEN">

1) Select Table Name: 
<br>

<select name="tablename">

<?php
$database->OpenLink();
$tablelist = mysql_list_tables($database->database, $database->link);
while ($row = mysql_fetch_row($tablelist)) {
   print "<option value=\"$row[0]\">$row[0]</option>";
}
?>
</select>

<p>
2) Type Class Name (ex. "test"): <br>
<input type="text" name="classname" size="50" value="">
<p>
3) Type Name of Key Field:
<br>
<input type="text" name="keyname" value="" size="50">
<br>
<font size=1>
(Name of key-field with type number with autoincrement!)
</font>
<table border=0 width=800 cellpadding=2 cellspacing=0>
   <tr>
      <td colspan=2>
         <label class="lbl">Class Author:</label><INPUT style="width:300px;" type="text" id="saveas" name="input[CLASS_AUTHOR_NAME]" value="<?=$_SESSION['CLASS_AUTHOR_NAME']?>">	<label class="lbl">E-Mail:</label><INPUT style="width:200px;" type="text" id="saveas" name="input[CLASS_AUTHOR_EMAIL]" value="<?=$_SESSION['CLASS_AUTHOR_EMAIL']?>"><BR>
      </td>
   </tr>
   <tr>
      <td colspan=2>
   <!--<label class="lbl">Add class header:<label><input type="checkbox" name="input[addHeaderClass]" value="1"><br>
   <label class="lbl">make javaLikeVariables:</label><input type="checkbox" name="input[varJavaLike]" value="1"><br>-->
   <!--<label class="lbl">Add inputValidator:</label><input type="checkbox" name="input[addValidation]" value="1"><br>-->
   <label class="lbl">Add FunctionPrefix:</label><INPUT type="text" id="saveas" name="input[functionPrefix]"><BR>
      </td>
   </tr>
</table>



<INPUT type="reset">
<input type="submit" name="s1" value="Generate Class">
<input type="hidden" name="f" value="formshowed">

</form>

</b>
</font>



<?php
} else {

// fill parameters from form
$table = $_REQUEST["tablename"];
$ftk_table_constant = "TABLE_".strtoupper($table);
$ftk_table_definition = "define('$ftk_table_constant','$table');";


$class = $_REQUEST["classname"];
#$key   = $_REQUEST["keyname"];
$key[0] = $_REQUEST["keyname"];
$key['getNameCapitalized'] = getVariableJavaLike($key[0]);
$key['getVariableJavaLike'] = getVariableJavaLike($key[0]);

$dir = dirname(__FILE__);

$filename = $dir . "/generated_classes/" . "class." . $class . ".php";

// if file exists, then delete it
if(file_exists($filename)){
   unlink($filename);
}

// open file in insert mode
$file = fopen($filename, "w+");
$filedate = date("d.m.Y");

$c = "";

$c = "<?php
//error_reporting(E_ALL);
/**
 * de.mksurvey - classes\class.$class.php
 *   
 * @version \$Id:\$
 * 
 *
 * Copyright (c) ".date("Y")." M.Kupriyanov
 * @author ".$_POST['input']['CLASS_AUTHOR_NAME'].", <".$_POST['input']['CLASS_AUTHOR_EMAIL'].">
 * @date ".date("d.m.Y H:i:s")."
 * @generator $generatorName v.$generatorVer
 * @package classes
 * @mailto ".$input['CLASS_AUTHOR_EMAIL']."
 *
 */

$ftk_table_definition

class $class{

   var $".$key['getVariableJavaLike'].";        // KEY ATTR. WITH AUTOINCREMENT
   var \$_lastError;   // Last Error in the Class
";

$sql = "SHOW COLUMNS FROM $table;";
$database->query($sql);
$result = $database->result;


while ($row = mysql_fetch_row($result)) {
   
//   echo "<pre>";
//   print_r($row);
//   echo "</pre>";
   
$col = $row[0];
$colProperties[$col] = $row;
$colProperties[$col] = array(
                              $row[0],
                              $row[1],
                              $row[2],
                              $row[3],
                              $row[4],
                              $row[5],
                              'getNameCapitalized'  => getNameCapitalized($col),
                              'getVariableJavaLike' => getVariableJavaLike($col)
                             );



   if($col!=$key[0]){
   
   $c.= "
      var $".$colProperties[$col]['getVariableJavaLike'].";                 //".$colProperties[$col][1];
   
   
   } // endif
//"print "$col";
} // endwhile

//echo "<pre>";
//print_r($colProperties);
//echo "</pre>";


#$cdb = "$" . "database";
#$cdb2 = "database";
$c.="

";

$cthis = "$" . "this->";
#$thisdb = $cthis . $cdb2 . " = " . "new Database();";

$c.= "

   function $class(\$".$key['getVariableJavaLike']." = null){
      
      if (\$".$key['getVariableJavaLike']."==null){
      
      }else{
         \$this->_loadDataById(\$".$key['getVariableJavaLike'].");
      }

   }
";

#######################################################################
# GETTER
$c.="
#######################################################################
# GETTER
";

//$database->query($sql);
//$result = $database->result;

#while ($row = mysql_fetch_row($result)) {
foreach($colProperties as $col => $colData){
   #$col=$row[0];
   $mname = "get" . $input['functionPrefix'].$colProperties[$col]['getNameCapitalized'] . "()";
   $mthis = "$" . "this->" . $colProperties[$col]['getVariableJavaLike'];

$c.="

   function $mname{
      return $mthis;
   }
";
}

#######################################################################
# SETTER

$c.="

#######################################################################
# SETTER

";
// SETTER
//$database->query($sql);
//$result = $database->result;
#while ($row = mysql_fetch_row($result)) {
#   $col=$row[0];

foreach($colProperties as $col => $colData){
   #$val = "$" . "val";
   #$val = getVariableJavaLike($col);
   $val = $colProperties[$col]['getVariableJavaLike'];
   #$mname = "set" . $input['functionPrefix'].getNameCapitalized($col) . "($" . "val)";
   #$mname = "set" . $input['functionPrefix'].getNameCapitalized($col) . "($".$val.")";
   $mname = "set" . $input['functionPrefix'].$colProperties[$col]['getNameCapitalized'] . "($".$val.")";
   #$mthis = "$" . "this->" . $col . " = ";
   $mthis = "$" . "this->" . $val . " =";
   
$c.="
   function $mname{
      \$this->_lastError = null;
      
      /*
      //add your validation here
      if(\$$val == \"\") {
         \$this->_lastError = ERROR_REQUIRED_SETPARAMETER_IS_NULL;
         return false;
      }*/
      
      $mthis $$val;
      
      return true;
   }
";
}

#######################################################################
# SELECT
$sql = "$" . "sql = ";
$id = "$" . "id";
#$thisdb = "$" . "this->" . "database";
#$thisdbquery = "$" . "this->" . "database->query($" . "sql" . ")";
$result = "$" . "result = ";
$row = "$" . "row";
$result1 = "$" . "result";
$res = "$" . "result = $" . "this->database->result;";

$c.="
#######################################################################
# SELECT
   /**
    * Load data from DB by ID
    *
    * @param string $id
    * @return bool
    */
   function _loadDataById($id){
      global \$database;
      \$this->_lastError = null;
      
      if(\$id == \"\") {
         \$this->_lastError = ERROR_REQUIRED_PARAMETER_IS_NULL;
         return false;
      }

      \$sqlQuery = \"SELECT * FROM \".".$ftk_table_constant.".\" 
                            WHERE ".$key[0]." = $id;\";

      #\$sqlQueryResult = tep_db_reader_query(\$sqlQuery);
      \$sqlQueryResult = \$database->openConnectionWithReturn(\$sqlQuery);
   
      #if(\$result = tep_db_fetch_array(\$sqlQueryResult)){
      if(\$result = mysql_fetch_array(\$sqlQueryResult)){
";

//$sql = "SHOW COLUMNS FROM $table;";
//$database->query($sql);
//$result = $database->result;
//while ($row = mysql_fetch_row($result)) 
//{
//$col=$row[0];

foreach($colProperties as $col => $colData){
   
$cthis = "$" . "this->" . $colProperties[$col]['getVariableJavaLike'] . " = $" . "result['" . $col. "']";

$c.="       $cthis;
";

}



$c.="
      return true;
      }
   }
";


$zeile1 = "
      $" . "sqlQuery" . " = \"DELETE FROM \".".$ftk_table_constant.".\"
                                    WHERE ".$key[0]." = $id;\"";

#tep_db_writer_query($sqlQuery);

#$zeile2 = "$" . "result = $" . "this->database->query($" . "sql);";
#$zeile2 = "\$sqlQueryResult = tep_db_reader_query(\$sqlQuery);";
$zeile2 = '$sqlQueryResult = $database->openConnectionNoReturn($sqlQuery);';


$c.="
#######################################################################
# DELETE
   /**
    * Remove Item from DB By Primary Key
    *
    * @param String $id
    * @return boolean
    */
   function _delete($id){
      global \$database;
      \$this->_lastError = null;
      
      if(\$id == \"\") {
         \$this->_lastError = ERROR_REQUIRED_PARAMETER_IS_NULL;
         return false;
      }
      
      $zeile1;
      $zeile2
      
      return true;
";
$c.="
   }
";


$zeile1 = "$" . "this->".$key['getVariableJavaLike']." = \"\"";
$zeile2 = "INSERT INTO \".".$ftk_table_constant.".\" (";
$zeile5= ")"; 
$zeile3 = "";
$zeile4 = "";
$zeile6 = "VALUES (";

//$sql = "SHOW COLUMNS FROM $table;";
//$database->query($sql);
//$result = $database->result;
//while ($row = mysql_fetch_row($result)) 
//{
//$col=$row[0];
foreach($colProperties as $col => $colData){
if($col!=$key){
$zeile3.= "                               $col" . ",\n";
$zeile4.= "                               '$" . "this->" .$colProperties[$col]['getVariableJavaLike']. "',\n";
//$zeile3 = rtrim($zeile3);
//$zeile4 = rtrim($zeile4);
//$zeile3 = str_replace(",", " ", $zeile3);
//$zeile4 = str_replace(",", " ", $zeile4);



}

}

$zeile3 = substr($zeile3, 0, -2);#remove comma after last
$zeile4 = substr($zeile4, 0, -2);#remove comma after last
$sql = "$" . "sqlQuery =";
#$zeile7 = "$" . "result = $" . "this->database->query($" . "sqlQuery);";
#$zeile7 = "tep_db_writer_query(\$sqlQuery);";
$zeile7 = "\$result = \$database->openConnectionNoReturn(\$sqlQuery);";

$zeile8 = "$" . "row";
$zeile9 = "$" . "result";

#$zeile10 = "$" . "this->$key = " . "mysql_insert_id($" . "this->database->link);";
#$zeile10 = "$" . "this->".$key['getVariableJavaLike']." = " . "tep_db_insert_id();";
$zeile10 = "$" . "this->".$key['getVariableJavaLike']." = " . "mysql_insert_id();";

$c.="
#######################################################################
# INSERT
   /**
    * Insert new Item to DB
    *
    * @return boolean
    */
   function _insert(){
      global \$database;
      $zeile1; // clear key for autoincrement

      $sql \"$zeile2 
$zeile3 
                               $zeile5
                               $zeile6 
$zeile4 
             $zeile5\";
      $zeile7
      $zeile10

      return true;
   }
";


// UPDATE ----------------------------------------

$zeile1 = "$" . "this->".$key['getVariableJavaLike']." = \"\"";
$zeile2 = "UPDATE \".".$ftk_table_constant.".\" SET ";
$zeile5= ")"; 
$zeile3 = "";
$zeile4 = "";
$zeile6 = "VALUES (";

$upd = "";

//$sql = "SHOW COLUMNS FROM $table;";
//$database->query($sql);
//$result = $database->result;
//while ($row = mysql_fetch_row($result)) 
//{
//$col=$row[0];
foreach($colProperties as $col => $colData){
if($col!=$key){
#$zeile3.= "$col" . ",";
#$zeile4.= "$" . "this->$col" . ",";

$zeile3.= "$col" . ",\n";
$zeile4.= "                               '$" . "this->" .$colProperties[$col]['getVariableJavaLike']. "',\n";

$upd.= "                           " . "$col = '\$this->".$colProperties[$col]['getVariableJavaLike']. "',\n";
//$zeile3 = rtrim($zeile3);
//$zeile4 = rtrim($zeile4);
//$zeile3 = str_replace(",", " ", $zeile3);
//$zeile4 = str_replace(",", " ", $zeile4);



}

}

#$zeile3 = substr($zeile3, 0, -1);
#$zeile4 = substr($zeile4, 0, -1);
#$upd = substr($upd, 0, -1);
$zeile3 = substr($zeile3, 0, -2);#remove comma after last
$zeile4 = substr($zeile4, 0, -2);#remove comma after last
$upd = substr($upd, 0, -2);#remove comma after last

$sql = "$" . "sqlQuery = \"";
#$zeile7 = "$" . "result = $" . "this->database->query($" . "sql)";
#$zeile7 = "$" . "result = tep_db_writer_query($" . "sqlQuery)";
$zeile7 = "$" . "result = \$database->openConnectionNoReturn($" . "sqlQuery)";

$zeile8 = "$" . "row";
$zeile9 = "$" . "result";
$zeile10 = "$" . "this->".$key['getVariableJavaLike']." = $" . "row->$key";
$id = "$" . "id";
$where = "WHERE " . "".$key[0]." = $" . "id";

$c.="
#######################################################################
# UPDATE
   /**
    * Update item values in DB by PrimaryKey
    *
    * @param string $id
    * @return bool
    */
   function _update($id){
      global \$database;
      \$this->_lastError = null;
      
      if(\$id == \"\") {
         \$this->_lastError = ERROR_REQUIRED_PARAMETER_IS_NULL;
         return false;
      }
      
      $sql $zeile2
$upd
                     $where \";
      
      $zeile7;


";

$c.="
      return true;
   }
";


$c.="
   /**
     * gives back getLastError
     *
     * @access public
     * @author Mischa Kupriyanov, <m@kupriyanov.com>
     * @return string
     */
   function getLastError(){
      \$returnValue = (string) '';

      \$returnValue = \$this->_lastError;
      \$this->_lastError = null;

      return (string) \$returnValue;
   }";


$c.= "

}

?>";
fwrite($file, $c);


header("Content-Type: text/html");
highlight_string($c);
die();



print "
<font face=\"Arial\" size=\"3\"><b>
PHP MYSQL Class Generator
</b>
<p>
<font face=\"Arial\" size=\"2\"><b>
Class '$class' successfully generated as file '$filename'!
<p>
<a href=\"javascript:history.back();\">
back
</a>

</b></font>

";


?>

<?php
} // endif
?>