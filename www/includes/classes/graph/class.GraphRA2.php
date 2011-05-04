<?php
/**
 * Graph generator
 * @version $Id: class.GraphRA2.php 133 2007-11-25 01:49:43Z mimait04 $
 * @package mkSurvey.Graph
 * 
 */
class GraphRA2 extends GraphAbstract {
    
   function GraphRA2($graphId){

      //parent::GraphAbstract($graphId);

   }
   /**
    * Redender PieGraph
    *
    * @param GraphDataRA2 $graphDataObj
    */
   function redenderData(&$graphDataObj){
      $this->_redenderDataPieGraph($graphDataObj);
   }

   /**
    * Redender PieGraph
    * @access private
    * @param GraphDataRA2 $graphDataObj
    */
   function _redenderDataPieGraph(&$graphDataObj){
      //debug_obj($graphDataObj,'redenderData');
      
      // Some data
      $data = $graphDataObj->getDataArray();
      //debug_obj($data,'$data');

      // Create the Pie Graph.
      $graph = new PieGraph(350,200,"auto");
      //$graph->SetShadow();
      
      // No frame around the image
      $graph->SetFrame(false);
      

      // Set A title for the plot
      //$graph->title->Set("Example 3 3D Pie plot");
      //$graph->title->SetFont(FF_VERDANA,FS_BOLD,18);
      //$graph->title->SetColor("darkblue");
      $graph->legend->Pos(0.1,0.1);
      //$graph->legend->SetFont(FF_ARIAL,FS_NORMAL,8);
      
      // Create 3D pie plot
      $p1 = new PiePlot3d($data);
      $p1->SetTheme("water");
      $p1->SetCenter(0.4);
      $p1->SetSize(80);
      $p1->SetSliceColors(array('#BBCCFF','#EFEFEF'));
      

      // Adjust projection angle
      $p1->SetAngle(45);

      // As a shortcut you can easily explode one numbered slice with
      $p1->ExplodeSlice(3);

      // Setup the slice values
      $p1->value->SetFont(FF_ARIAL,FS_NORMAL,8);
      $p1->value->SetColor("navy");
      //$p1->value->SetColor('#EFEFEF@0.5');
      //'#EFEFEF@0.5','#BBCCFF@0.5'
      $p1->SetEdge("navy");

      $p1->SetLegends($graphDataObj->graphTitlesArr);

      $graph->Add($p1);
      $graph->Stroke();
   }
}
?>