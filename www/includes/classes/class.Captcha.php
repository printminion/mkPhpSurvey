<?php
/*
 * @version $Id: class.Captcha.php 133 2007-11-25 01:49:43Z mimait04 $
 * @package mkSurvey.UiComponents
 */

include_once(CLASSES_PATH.'/hn_captcha/hn_captcha.class.x1.php');

class Captcha extends ObjectLogger{

   var $CAPTCHA_INIT;
   
   /**
    * local instance of hn_captcha_X1
    *
    * @var hn_captcha_X1
    */
   var $_captchaObj;
   
   function Captcha(){

      $this->setRequiredDefinitions(array('TEMP_PATH','TTF_PATH','CAPTCHA_SECRETSTRING','CAPTCHA_PREFIX'));
      $this->_initialize();
      
      
   }

   function _initialize(){
      $error = $this->_validateRequiredDefinitions();
      if (!$error){
         // ConfigArray
         $this->CAPTCHA_INIT = array(
            'tempfolder'     => TEMP_PATH,   // string: absolute path (with trailing slash!) to a writeable tempfolder which is also accessible via HTTP!
			'TTF_folder'     => TTF_PATH,    // string: absolute path (with trailing slash!) to folder which contains your TrueType-Fontfiles.
         //mixed (array or string): basename(s) of TrueType-Fontfiles
			'TTF_RANGE'      => array('COMIC.TTF','JACOBITE.TTF','LYDIAN.TTF','MREARL.TTF','RUBBERSTAMP.TTF','ZINJARON.TTF'),
         //	'TTF_RANGE'      => 'COMIC.TTF',

            'chars'          => 5,       // integer: number of chars to use for ID
            'minsize'        => 20,      // integer: minimal size of chars
            'maxsize'        => 30,      // integer: maximal size of chars
            'maxrotation'    => 25,      // integer: define the maximal angle for char-rotation, good results are between 0 and 30

            'noise'          => TRUE,    // boolean: TRUE = noisy chars | FALSE = grid
            'websafecolors'  => TRUE,    // boolean
            'refreshlink'    => TRUE,    // boolean
            'lang'           => 'de',    // string:  ['en'|'de']
            'maxtry'         => 3,       // integer: [1-9]

            'badguys_url'    => '/',     // string: URL
            'secretstring'   => CAPTCHA_SECRETSTRING,//'A very, very secret string which is used to generate a md5-key!',
            'secretposition' => 24,      // integer: [1-32]

            'debug'          => FALSE,


			'counter_filename'		=> '',              // string: absolute filename for textfile which stores current counter-value. Needs read- & write-access!
			'prefix'				=> CAPTCHA_PREFIX,   // string: prefix for the captcha-images, is needed to identify the files in shared tempfolders
			'collect_garbage_after'	=> 20,             // integer: the garbage-collector run once after this number of script-calls
			'maxlifetime'			=> 60              // integer: only imagefiles which are older than this amount of seconds will be deleted

         );

      }

      return $error;
   }
   
   /**
    * Validate token. Returns true if ok
    *
    * @param string $publicKey
    * @param string $privateKey
    * @return bool
    */
   function validateToken($publicKey,$privateKey){
      
      $this->_captchaObj =& new hn_captcha_X1($this->CAPTCHA_INIT);
      $response = $this->_captchaObj->check_captcha($publicKey,$privateKey);
      
      if ($response == 1) {
         return true;
      }else{
         //trigger_error(get_class($this).':validateToken do not forget to remove next retrn true');
         //return true;
      }
      
      return false;      
   }
   
   function getNewCaptchaPublicKey(){
      $this->_captchaObj =& new hn_captcha_X1($this->CAPTCHA_INIT);

      if($this->_captchaObj->garbage_collector_error){
         // Error! (Counter-file or deleting lost images)
         echo "<p><br><b>An ERROR has occured!</b><br>Here you might send email-notification to webmaster or something like that.</p>";
      }

      $this->_captchaObj->make_captcha();
      //$this->setFormValue('ctoken',$this->_captchaObj->public_key);
      //debug_obj($this->_captchaObj,'$captcha');
      return $this->_captchaObj->public_key;
            
//      $captchaResult = $this->_captchaObj->validate_submit();
//      debug_sql($captchaResult,'$captchaResult');
//      switch($captchaResult){
//         case 1: // was submitted and has valid keys
//            // PUT IN ALL YOUR STUFF HERE //
//            //echo "<p><br>Congratulation. You will get the resource now.";
//            //echo "<br><br><a href=\"".$_SERVER['PHP_SELF']."?download=yes&id=1234\">New DEMO</a></p>";
//            return true;
//            break;
//         case 2: // was submitted with no matching keys, but has not reached the maximum try's
//            //echo $this->_captchaObj->display_form();
//            //$this->_captchaObj->flush_captcha_image();
//            $this->_captchaObj->make_captcha();
//            //$this->setFormValue('ctoken',$this->_captchaObj->public_key);
//            debug_obj($this->_captchaObj,'$captcha');
//            return $this->_captchaObj->public_key;
//            break;
//         case 3: // was submitted, has bad keys and also reached the maximum try's
//            //if(!headers_sent() && isset($this->_captchaObj->badguys_url)) header('location: '.$this->_captchaObj->badguys_url);
//            echo "<p><br>Reached the maximum try's of ".$this->_captchaObj->maxtry." without success!";
//            echo "<br><br><a href=\"".$_SERVER['PHP_SELF']."?download=yes&id=1234\">New DEMO</a></p>";
//            break;
//         default: // was not submitted, first entry
//            //echo $this->_captchaObj->display_form();
//            $this->_captchaObj->flush_captcha_image();
//            $this->_captchaObj->make_captcha();
//            //$this->setFormValue('ctoken',$this->_captchaObj->public_key);
//            debug_obj($this->_captchaObj,'$captcha');
//            return $this->_captchaObj->public_key;
//
//            break;
//
//      }

   }

}
?>