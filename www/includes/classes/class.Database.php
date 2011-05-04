<?php
/**
 * @version $Id: class.Database.php 133 2007-11-25 01:49:43Z mimait04 $
 * @package mkSurvey.Connector
 */

class database {
   var $bConnected;
   var $_dbLink = null;
   var $_bDebugOn;

   function database(){

      //      debug_sql(DB_HOST.", ".DB_USER.", ".DB_PASSWORD.", ".DB_DBNAME,'database constructor');

      $this->getConnection();

   }

   function isConnected(){
      if($this->_dbLink){
         return true;
      }
      return true;
   }

   function _connect(){
      //      debug_sql("mysql_connect(DB_HOST, DB_USER, DB_PASSWORD)",'_connect');
      $this->_dbLink = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
      mysql_select_db(DB_DBNAME) or die("Connection failed with error: ".mysql_error());

   }

   function getConnection(){
      //        if($this->isConnected()){
      //            return true;
      //        }

      $this->_connect();

      return true;
   }

   /**
    * Make DB query with response
    *
    * @param string $query
    * @return Resource
    */
   function openConnectionWithReturn($query){
      //      debug_sql(DB_HOST.", ".DB_USER.", ".DB_PASSWORD.", ".DB_DBNAME,'database');

      $this->getConnection();
      
      //echo "$query\n";
      //echo mysql_error();
      
      if(!$this->_bDebugOn){
         $result=mysql_query($query) or die("Query failed with error\n");
      }else{
         $result=mysql_query($query) or die("Query failed with error: ".mysql_error()."\n".$query);
      }

      //$result = mysql_query($query) or $this->onError(&$query);
       
      //   if ($bError){
      //      $this->onError($query);
      //      die("Query failed with error");
      //   }

      if($result == null){
         die("Query failed with error");
      }

      return $result;
   }

   function openConnectionNoReturn($query){
      $this->getConnection();
      if(!$this->_bDebugOn){
         mysql_query($query) or die("Query failed with error");
      }else{
         mysql_query($query) or die("Query failed with error: ".$query.mysql_error()."\n".$query);
      }
   }
    
   function setDebugOn($value){
      $this->_bDebugOn = $value;
   }

   function sqlTimestampToMktime($sqlTimestamp){
      return mktime(substr($sqlTimestamp, 8, 2),
      substr($sqlTimestamp, 10, 2),
      substr($sqlTimestamp, 12, 2),
      substr($sqlTimestamp, 4, 2),
      substr($sqlTimestamp, 6, 2),
      substr($sqlTimestamp, 0, 4));

   }

   /**
    * Converts 2006-10-14 16:22:06 to 1160835726
    *
    * @param string $sqlTimestamp
    * @return string
    */
   function sqlTimestampToMktime2($sqlTimestamp){
      return (float)mktime(substr($sqlTimestamp, 11, 2),
      substr($sqlTimestamp, 14, 2),
      substr($sqlTimestamp, 17, 2),
      substr($sqlTimestamp, 5, 2),
      substr($sqlTimestamp, 8, 2),
      substr($sqlTimestamp, 0, 4));

   }
    
   /**
    * Gets Now() equialent for mysql Datetime
    *
    * @return string
    */
   function getNowMySqlDateTime(){
      return date("y/m/d : H:i:s", Time());
   }


   function onError(&$query){
      $filename = ABSOLUTE_PATH.'\_logs\sqlErrors.txt';
      $somecontent = "\n=================================\n".
      $query.mysql_error().
      "\n---------------------------------\n".
      "\n$query\n\n";

      //      die($filename);
      // Let's make sure the file exists and is writable first.
      if (is_writable($filename)) {

         // In our example we're opening $filename in append mode.
         // The file pointer is at the bottom of the file hence
         // that's where $somecontent will go when we fwrite() it.
         if (!$handle = fopen($filename, 'a')) {
            //            echo "Cannot open file ($filename)";
            return false;
            #exit;
         }

         // Write $somecontent to our opened file.
         if (fwrite($handle, $somecontent) === FALSE) {
            //           echo "Cannot write to file ($filename)";
            return false;
            #exit;
         }

         //       echo "Success, wrote ($somecontent) to file ($filename)";

         fclose($handle);
         return true;

      } else {
         //       echo "The file $filename is not writable";
         return false;
      }

   }
}
?>