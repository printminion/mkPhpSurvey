<?php
/**
 * Abstract class GraphAbstract
 *
 * @version $Id: class.GraphAbstract.php 138 2007-11-25 05:43:57Z mimait04 $
 * @package mkSurvey.Graph
 */

include_once(JPGRAPH_CLASS_PATH.'/jpgraph.php');
include_once(JPGRAPH_CLASS_PATH.'/jpgraph_log.php');
include_once(JPGRAPH_CLASS_PATH.'/jpgraph_utils.inc.php');

class GraphAbstract{

   /**
    * GraphID
    *
    * @var string
    */
   var $graphID;

   /**
    * Enter description here...
    *
    * @param string $graphId
    * @return GraphAbstract
    */
   function GraphAbstract($graphId){
      if ($graphId == ''){
         trigger_error(get_class($this).': required parameter graphID is not set');
      }
      $this->graphID = $graphId;
   }

    
   /**
    * Redender Graph
    * @access public
    * @param GraphDataAbstract $dataObj
    */
   function redenderData(&$dataObj){
      //debug_sql("redenderData(&\$dataObj)");

      //throw warning graph
      $this->_imageControlNotReadyYet($this->graphID);
   }

   /**
    * flush errorouos Image
    *
    * @param string $controlId
    */
   function _imageControlNotReadyYet($controlId){
      header("Content-type: image/png");
      $im = @imagecreate(350, 200) or die("Cannot Initialize new GD image stream");
      $background_color = imagecolorallocate($im, 255, 255, 255);
      $text_color = imagecolorallocate($im, 233, 14, 91);
      imagestring($im, 16, 5, 5,  "Graph $controlId - Not ready yet", $text_color);
      imagepng($im);
      imagedestroy($im);
   }
}
?>