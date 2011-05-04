<?
/**
 * @version $Id: class.ComposeMail.php 133 2007-11-25 01:49:43Z mimait04 $
 * @package mkSurvey.Connector
 */

/*
 --------------------------------------------------------------------------------

 Sample script

 --------------------------------------------------------------------------------

 $mailer=new ComposeMail("sombody@address.com","some subject");
 $mailer->sh_fromName("You know who I am");
 $mailer->sh_fromAddr("iamhere@thisserver.com");
 $mailer->addTextPlainBodyPart("test message (plain)");
 $mailer->addHTMLBodyPart("<b>Test Message (HTML)</b>");

 // this gets some base64 encoded files from a MySQL table

 cotiz_attch Structure:
 cont_attch : LONGBLOB field, containing the base64 enconded file content
 nom_attch  : string field, with the file name
 tipo_attch : mime type of the file


 $db->select("*","cotiz_attch","id_cotiz='$id_cotiz'");
 $attachs=array();
 $tam_total=0;
 while ($data=$db->fetch_array()) {
 $mailer->addAttachFromData($data["cont_attch"],$data["nom_attch"],$data["tipo_attch"],"attachment");
 }
 $mailer->BuildAndSendMessage();
 */
class ComposeMail {

   var $to; // The mail recipient
   var $from_name; // sender's name
   var $from_addr; // sender's address
   var $subject; // mail subject
   var $bodyParts=array("text/plain"=>"","text/html"=>""); // mail body
   var $parts=array(); // attachments holder
   var $headers=array(
		"Return-path:"=>"",
		"Envelope-to:"=>"",
		"From:"=>"",
		"MIME-Version:"=>"1.0",
		"Content-Type:"=>"multipart/mixed;\n\tboundary=\"----=_NextPart_000_0001_00000001.00000001\"",
		"X-priority:"=>"3",
		"X-MSMail-Priority:"=>"Normal",
		"X-Mailer:"=>"clsImap Mail Handler 2.0" /*,
   "Content-Type:" => 'text/plain; charset="Windows-1251"'*/
   ); // headers

   var $emailEncoding;//encoding of Email
   var $_emailDefaultEncoding = "Windows-1251";	//default encoding

   var $emailMimeType;//mimetype of Email
   var $_defaultEmailMimeType= "text/plain";	//default mimetype


   /*
    This function is the class' constructor.
    */
   function ComposeMail($to, $subject) {

      $this->to            = $to;
      $this->from_addr     = $from_addr;
      $this->from_name     = $from_name;
      $this->subject       = $subject;
      $this->emailEncoding = $this->_emailDefaultEncoding;
      $this->emailMimeType = $this->_defaultEmailMimeType;

   }


   /*
    This function sets the ReturnPath header
    */
   function SH_ReturnPath($rp) {
      $this->headers["Return-Path:"]="<".$rp.">";
   }

   /*
    This function sets the EnvelopeTo header
    */
   function SH_EnvelopeTo($et) {
      $this->headers["Envelope-to:"]=$rp;
   }

   /*
    This function sets the ContentType header
    */
   function SH_ContentType($ct) {
      $this->headers["Content-Type:"]="$ct;\n\tboundary=\"----=_NextPart_000_0001_00000001.00000001\"";
   }

   /*
    This function sets the FromName header (internal)
    */
   function SH_FromName($fromName) {
      $this->from_name=$fromName;
   }

   /*
    This function sets the FromAddr header (internal)
    */
   function SH_FromAddr($fromAddr) {
      $this->from_addr=$fromAddr;
   }



   /*
    This function adds an attachment from a file
    */

   function addAttachFromFile($fullname,$ftype,$fdispos="",$fdescrip="",$fid="",$alt_fname="") {

      $fname=basename($fullname);
      if ($alt_fname!=""){
         $fname = $alt_fname;
      }
      $thePart="Content-Type: $ftype;\n\tname=\"$fname\"\n";
      $thePart.="Content-Transfer-Encoding: base64\n";
      if (!empty($fdispos)) $thePart.="Content-Disposition: $fdispos;\n\tfilename=\"$fname\"\n";
      if (!empty($fdescrip)) $thePart.="Content-Description: $fdescrip\n";
      if (!empty($fid)) $thePart.="Content-Id: <$fid>\n";
      $thePart.="\n";

      $data=base64_encode(fread(fopen($fullname,"r"),filesize($fullname)));
      $theData=$data;
      while (strlen($theData)>76) {
         $thePart.=substr($theData,0,76)."\n";
         $theData=substr($theData,76);
      }
      $thePart.=$theData."\n";
      $this->parts[]=$thePart;
   }

   /*
    This function adds an attachment from a base64 encoded string
    */
   function addAttachFromData($data,$dname,$dtype,$ddispos) {

      $thePart="Content-Type: $dtype\n\tname=\"$dname\"\nContent-Transfer-Encoding: base64\nContent-Disposition: $ddispos;\n\tfilename=\"$dname\"\n\n";

      $theData=$data;
      while (strlen($theData)>76) {
         $thePart.=substr($theData,0,76)."\n";
         $theData=substr($theData,76);
      }
      $thePart.=$theData."\n";
      $this->parts[]=$thePart;
   }

   /*
    This function adds the HTML body part
    */
   function addHtmlBodyPart($html) {
      #$this->bodyParts["text/html"]="<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\">\n<html><head><meta http-equiv=Content-Type content=\"text/html; charset="._META_CONTENTTYPE."\"></head><body>".imap_8bit($html)."</body></html>";
      $this->bodyParts["text/html"]="<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\">\n<html><head><meta http-equiv=Content-Type content=\"text/html; charset=".$this->emailEncoding."\"></head><body>".imap_8bit($html)."</body></html>";
   }

   /*
    This function adds the Plain Text body part
    */
   function addTextPlainBodyPart($text) {
      $this->bodyParts["text/plain"]=$text;
   }

   /*
    This function builds and sends the message
    */
   function BuildAndSendMessage() {

      $theMessage="This is a multi-part message in MIME format.\n";

      $theMessage.="\n------=_NextPart_000_0001_00000001.00000001\nContent-type: multipart/alternative;\n\tboundary=\"----=_NextPart_000_0001_00000001.00000011\"";
      //		$theMessage.="\n\n\n------=_NextPart_000_0001_00000001.00000011\nContent-type: text/plain;\n\tcharset=\""._META_CONTENTTYPE."\"\nContent-Transfer-Encoding: quoted-printable\n\n".$this->bodyParts["text/plain"];
      //		$theMessage.="\n------=_NextPart_000_0001_00000001.00000011\nContent-type: text/html;\n\tcharset=\""._META_CONTENTTYPE."\"\nContent-Transfer-Encoding: quoted-printable\n\n".$this->bodyParts["text/html"];

      $theMessage.="\n\n\n------=_NextPart_000_0001_00000001.00000011\nContent-type: text/plain;\n\tcharset=\"".$this->emailEncoding."\"\nContent-Transfer-Encoding: quoted-printable\n\n".$this->bodyParts["text/plain"];
      $theMessage.="\n------=_NextPart_000_0001_00000001.00000011\nContent-type: text/html;\n\tcharset=\"".$this->emailEncoding."\"\nContent-Transfer-Encoding: quoted-printable\n\n".$this->bodyParts["text/html"];





      $theMessage.="\n\n------=_NextPart_000_0001_00000001.00000011--\n";
      for ($idx=0; $idx<count($this->parts); $idx++) {
         $theMessage.="\n------=_NextPart_000_0001_00000001.00000001\n";
         $theMessage.=$this->parts[$idx];
      }
      $theMessage.="\n------=_NextPart_000_0001_00000001.00000001--\n";

      if ($this->headers["Return-Path:"]=="") $this->headers["Return-Path:"]="<".$this->from_addr.">";
      if ($this->headers["Envelope-To:"]=="") $this->headers["Envelope-To:"]=$this->to;
      if ($this->from_name!="" && $this->from_addr!="") $this->headers["From:"]="\"".$this->from_name."\" <".$this->from_addr.">";
      elseif ($this->from_addr!="") $this->headers["From:"]=$this->from_addr;
      else return "No sender specified";

      //$this->headers["BCC:"]="cr@bobram.net";

      $theHeaders="";
      reset($this->headers);
      while (list($k,$v)=each($this->headers)) {
         $theHeaders.="$k $v\n";
      }
      
      //debug_obj($theMessage,'$theMessage');
      
      $error = @mail($this->to,$this->prepareSubject($this->subject),$theMessage,chop($theHeaders));
      
      if ($error != ''){
         //echo 'ERROR:'.$error;
         return false;
      }else{
         return true;
      }
   }

   function prepareSubject($subjectToPrepare){

      return "=?".$this->emailEncoding."?B?".base64_encode($subjectToPrepare)."?=";
       
   }
}
?>
