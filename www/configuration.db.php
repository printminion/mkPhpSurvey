<?
/*
 * @version $Id:$
 */

if(IS_ONLINE){
   define('DB_PREFIX','mks_'); // Do not change unless you need to!

   define('DB_HOST','localhost'); // This is normally set to localhost
   define('DB_USER','dbo101283846'); // MySQL username
   define('DB_PASSWORD','6shKU6JH345rr'); // MySQL password
   define('DB_DBNAME','hse_iso'); // MySQL database name
   
   
   
}else{
   define('DB_PREFIX','mks_'); // Do not change unless you need to!
   
   define('DB_HOST','localhost'); // This is normally set to localhost
   define('DB_USER','root'); // MySQL username
   define('DB_PASSWORD',''); // MySQL password
   define('DB_DBNAME','hse_iso'); // MySQL database name
}

   $dbprefix = DB_PREFIX;	
   
   $host     = DB_HOST; // This is normally set to localhost
   $user     = DB_USER; // MySQL username
   $password = DB_PASSWORD; // MySQL password
   $db       = DB_DBNAME; // MySQL database name

?>