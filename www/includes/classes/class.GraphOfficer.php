<?php
/*
 * @version $Id: class.GraphOfficer.php 133 2007-11-25 01:49:43Z mimait04 $
 * @package mkSurvey
 */
/*
 include_once(CLASSES_PATH.'/jpgraph/jpgraph.php');
 include_once(CLASSES_PATH.'/jpgraph/jpgraph_pie.php');
 include_once(CLASSES_PATH.'/jpgraph/jpgraph_pie3d.php');
 include_once(CLASSES_PATH.'/jpgraph/jpgraph_radar.php');
 */

include_once(JPGRAPH_CLASS_PATH.'/jpgraph.php');
include_once(JPGRAPH_CLASS_PATH.'/jpgraph_pie.php');
include_once(JPGRAPH_CLASS_PATH.'/jpgraph_pie3d.php');
include_once(JPGRAPH_CLASS_PATH.'/jpgraph_radar.php');

include_once(CLASSES_PATH.'/graph/class.GraphAbstract.php');

class GraphOfficer{

   function GraphOfficer(){


   }

   function getGraphById($graphId){

      $graphId = strtoupper($graphId);

      //      if ($graphId=='RD7'){
      //         $graphId = 'RD7_RadarGraph';
      //      }
      //      if ($graphId=='RA2'){
      //         $graphId = 'RA2_PieGraph';
      //      }
      //      if ($graphId=='RA6'){
      //         $graphId = 'RA6_PieGraph';
      //      }


      $ClassName = 'Graph'.$graphId;
      $graphClassPath = CLASSES_PATH.'/graph/class.'.$ClassName.'.php';

      //debug_sql($graphClassPath,'$graphClassPath');

      if (!file_exists($graphClassPath)){
         return new GraphAbstract($graphId);
      }

      include_once($graphClassPath);

      return new $ClassName($graphId);

   }
}
?>