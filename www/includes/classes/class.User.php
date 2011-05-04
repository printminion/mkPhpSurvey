<?php
//error_reporting(E_ALL);
/**
 *
 * @version $Id: class.User.php 134 2007-11-25 04:10:22Z mimait04 $
 *
 * @date 04.10.2007 19:28:12
 * @package mkSurvey
 *
 */

define('TABLE_USERS',DB_PREFIX.'users');
define('TABLE_USERS_INCOMING',DB_PREFIX.'users_incoming');


class User extends ObjectLogger {

   var $id;        // KEY ATTR. WITH AUTOINCREMENT

   var $name;                 //varchar(50)
   var $username;                 //varchar(25)
   var $email;                 //varchar(100)
   var $password;                 //varchar(100)
   var $usertype = 'user';                 //enum('administrator','superadministrator','user')
   var $block;                 //tinyint(4)
   var $sendEmail;                 //tinyint(4)
   var $gid = 1;                 //tinyint(3) unsigned
   var $initPassword; //uncoded pass

   var $register_date; //needed for while regisration
   var $optin;         //needed for while regisration
   

   function User($id = null,$table = TABLE_USERS){

      if ($id==null){

      }else{
         $this->_loadDataById($id,$table);
      }

   }

   #######################################################################
   # GETTER


   /**
    * Enter description here...
    *
    * @return integer
    */
   function getId(){
      return $this->id;
   }


   /**
    * Enter description here...
    *
    * @return string
    */
   function getName(){
      return $this->name;
   }


   /**
    * Enter description here...
    *
    * @return string
    */
   function getUsername(){
      return $this->username;
   }


   /**
    * Enter description here...
    *
    * @return string
    */
   function getEmail(){
      return $this->email;
   }


   /**
    * Enter description here...
    *
    * @return string
    */
   function getPassword(){
      return $this->password;
   }


   /**
    * Enter description here...
    *
    * @return string
    */
   function getInitPassword(){
      return $this->initPassword;
   }
   /**
    * Enter description here...
    *
    * @return enum
    */
   function getUsertype(){
      return $this->usertype;
   }


   /**
    * Enter description here...
    *
    * @return tinyint
    */
   function getBlock(){
      return $this->block;
   }


   /**
    * Enter description here...
    *
    * @return tinyint
    */
   function getSendEmail(){
      return $this->sendEmail;
   }


   /**
    * Enter description here...
    *
    * @return tinyint
    */
   function getGid(){
      return $this->gid;
   }

  /**
     * Short description of method setOptin
     *
     * @access public
     * @author Mischa Matiyenko-Kupriyanov, <m@kupriyanov.de>
     * @param string $optin
     * @return void
     */
   function setOptin($optin = null){

         $this->optin = $optin;

   }

   /**
     * Short description of method getOptin
     *
     * @access public
     * @author Mischa Matiyenko-Kupriyanov, <m@kupriyanov.de>
     * @return string
     */
   function getOptin(){
      return $this->optin;
   }

   #######################################################################
   # SETTER



   /**
    * Enter description here...
    *
    * @param integer $id
    * @return boolean
    */
   function setId($id){
      $this->_lastError = null;

      /*
       //add your validation here
       if($id == "") {
       $this->_lastError = ERROR_REQUIRED_SETPARAMETER_IS_NULL;
       return false;
       }*/

      $this->id = $id;

      return true;
   }


   /**
    * Enter description here...
    *
    * @param string $name
    * @return boolean
    */
   function setName($name){
      $this->_lastError = null;


      //add your validation here
      if($name == '') {
         $this->_lastError = ERROR_REQUIRED_SETPARAMETER_NAME_IS_NULL;
         return false;
      }

      $this->name = $name;

      return true;
   }


   /**
    * Enter description here...
    *
    * @param string $username
    * @return boolean
    */
   function setUsername($username){
      $this->_lastError = null;

      /*
       //add your validation here
       if($username == "") {
       $this->_lastError = ERROR_REQUIRED_SETPARAMETER_IS_NULL;
       return false;
       }*/

      $this->username = $username;

      return true;
   }


   /**
    * Enter description here...
    *
    * @param string $email
    * @return boolean
    */
   function setEmail($email){
      //$this->_lastError = null;


      //add your validation here
      if($email == '') {
         //$this->_lastError = ERROR_REQUIRED_SETPARAMETER_EMAIL_IS_NULL;
         $this->_addError(ERROR_REQUIRED_SETPARAMETER_EMAIL_IS_NULL);
         return false;
      }

      $this->email = $email;

      return true;
   }


   /**
    * Enter description here...
    *
    * @param string $password
    * @return boolean
    */
   function setPassword($password){
      //$this->_lastError = null;


      //add your validation here
      if($password == "") {
         //$this->_lastError = ERROR_REQUIRED_SETPARAMETER_PASSWORD_IS_NULL;
         $this->_addError(ERROR_REQUIRED_SETPARAMETER_PASSWORD_IS_NULL);
         return false;
      }

      $this->password = $password;

      return true;
   }

   /**
    * Enter description here...
    *
    * @param string $initPassword
    * @return boolean
    */
   function setInitPassword($initPassword){
      $this->initPassword = $initPassword;

      return true;
   }


   /**
    * Enter description here...
    *
    * @param enum $usertype
    * @return boolean
    */
   function setUsertype($usertype){
      $this->_lastError = null;

      /*
       //add your validation here
       if($usertype == "") {
       $this->_lastError = ERROR_REQUIRED_SETPARAMETER_IS_NULL;
       return false;
       }*/

      $this->usertype = $usertype;

      return true;
   }


   /**
    * Enter description here...
    *
    * @param tinyint $block
    * @return boolean
    */
   function setBlock($block){
      $this->_lastError = null;

      /*
       //add your validation here
       if($block == "") {
       $this->_lastError = ERROR_REQUIRED_SETPARAMETER_IS_NULL;
       return false;
       }*/

      $this->block = $block;

      return true;
   }


   /**
    * Enter description here...
    *
    * @param tinyint $sendEmail
    * @return boolean
    */
   function setSendEmail($sendEmail){
      $this->_lastError = null;

      /*
       //add your validation here
       if($sendEmail == "") {
       $this->_lastError = ERROR_REQUIRED_SETPARAMETER_IS_NULL;
       return false;
       }*/

      $this->sendEmail = $sendEmail;

      return true;
   }


   /**
    * Enter description here...
    *
    * @param tinyint $gid
    * @return boolean
    */
   function setGid($gid){
      $this->_lastError = null;

      /*
       //add your validation here
       if($gid == "") {
       $this->_lastError = ERROR_REQUIRED_SETPARAMETER_IS_NULL;
       return false;
       }*/

      $this->gid = $gid;

      return true;
   }

   #######################################################################
   # SELECT

   function _loadDataById($id,$table = TABLE_USERS){
      $this->_lastError = null;

      if($id == "") {
         $this->_lastError = ERROR_REQUIRED_PARAMETER_IS_NULL;
         return false;
      }

      $sqlQuery = "SELECT * FROM ".$table."
                            WHERE id = $id;";

      $sqlQueryResult = tep_db_reader_query($sqlQuery);
       
      if($result = tep_db_fetch_array($sqlQueryResult)){
         $this->id = $result['id'];
         $this->name = $result['name'];
         $this->username = $result['username'];
         $this->email = $result['email'];
         $this->password = $result['password'];
         $this->usertype = $result['usertype'];
         $this->block = $result['block'];
         $this->sendEmail = $result['sendEmail'];
         $this->gid = $result['gid'];
         $this->register_date = $result['register_date'];
         $this->optin = $result['optin'];
         return true;
      }
   }

   #######################################################################
   # DELETE

   function _delete($id,$table = TABLE_USERS){
      $this->_lastError = null;

      if($id == "") {
         $this->_lastError = ERROR_REQUIRED_PARAMETER_IS_NULL;
         return false;
      }


      $sqlQuery = "DELETE FROM ".$table."
                                    WHERE id = $id;";
      $sqlQueryResult = tep_db_reader_query($sqlQuery);

      return true;

   }

   #######################################################################
   # INSERT

   /**
    * Insert User to database into defined $table
    *
    * @param string $table
    * @return bool
    */
   function _insert($table = TABLE_USERS){
      $this->id = ""; // clear key for autoincrement

      if ($table == TABLE_USERS){
      $sqlQuery = "INSERT INTO ".$table." (
                               id,
                               name,
                               username,
                               email,
                               password,
                               usertype,
                               block,
                               sendEmail,
                               gid 
                               )
                               VALUES ( 
                               '$this->id',
                               '$this->name',
                               '$this->username',
                               '$this->email',
                               '$this->password',
                               '$this->usertype',
                               '$this->block',
                               '$this->sendEmail',
                               '$this->gid')";
      }else{
            $this->optin = md5(mktime());
            
               $sqlQuery = "INSERT INTO ".$table." (
                               id,
                               name,
                               username,
                               email,
                               password,
                               usertype,
                               block,
                               sendEmail,
                               gid,
                               register_date,
                               optin
                               )
                               VALUES ( 
                               '$this->id',
                               '$this->name',
                               '$this->username',
                               '$this->email',
                               '$this->password',
                               '$this->usertype',
                               '$this->block',
                               '$this->sendEmail',
                               '$this->gid',
                               NOW(),
                               '$this->optin')";
      
      }
      //debug_sql($sqlQuery);
      //return true;

      tep_db_writer_query($sqlQuery);
      $this->id = tep_db_insert_id();

      return true;
   }

   #######################################################################
   # UPDATE

   function _update($id,$table = TABLE_USERS){
      $this->_lastError = null;

      if($id == "") {
         $this->_lastError = ERROR_REQUIRED_PARAMETER_IS_NULL;
         return false;
      }

      $sqlQuery = " UPDATE ".$table." SET
                           id = '$this->id',
                           name = '$this->name',
                           username = '$this->username',
                           email = '$this->email',
                           password = '$this->password',
                           usertype = '$this->usertype',
                           block = '$this->block',
                           sendEmail = '$this->sendEmail',
                           gid = '$this->gid'
                     WHERE id = $id ";

      tep_db_writer_query($sqlQuery);;



      return true;
   }
}

?>