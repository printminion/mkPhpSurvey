<?php
/*
 * @version $Id: database_wrapper.php 133 2007-11-25 01:49:43Z mimait04 $
 */


/**
 * make db write query
 *
 * @param string $sqlQuery
 * @return Resource
 */

function tep_db_writer_query($sqlQuery){
   global $database;
   if($database==null){
      $database = new database();
   }

   if ($sqlQuery == ''){
      return false;
   }

   $database->openConnectionNoReturn($sqlQuery);
}

/**
 * Get last inserted ID
 *
 * @return string
 */
function tep_db_insert_id(){
   return mysql_insert_id();
}

/**
 * make db read query
 *
 * @param string $sqlQuery
 * @return Resource
 */
function tep_db_reader_query($sqlQuery){
   global $database;
   if($database==null){
      $database = new database();
   }

   if ($sqlQuery == ''){
      return false;
   }

   return $database->openConnectionWithReturn($sqlQuery);

}

function tep_db_fetch_array($db_query) {
   return mysql_fetch_array($db_query, MYSQL_ASSOC);
}

?>