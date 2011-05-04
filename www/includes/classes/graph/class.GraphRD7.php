<?php
/**
 * Graph generator
 * @version $Id: class.GraphRD7.php 133 2007-11-25 01:49:43Z mimait04 $
 * @package mkSurvey.Graph
 */
class GraphRD7 extends GraphAbstract {

   function GraphRD7($graphId){

      //parent::GraphAbstract($graphId);

   }

   /**
    * Redender Graph
    * @access pubic
    * @param GraphDataRD7 $graphDataObj
    */
   function redenderData(&$graphDataObj){
      //return _redenderDataPieGraph(&$graphDataObj);
      return $this->_redenderDataRadarGraph(&$graphDataObj);
   }

   /**
    * Redender PieGraph
    * @access private
    * @param GraphDataRD7 $graphDataObj
    */
   function _redenderDataPieGraph(&$graphDataObj){
      // Some data
      //$data = array(20,27,45,75,90);
      $data = $graphDataObj->graphDataArr;

      // Create the Pie Graph.
      $graph = new PieGraph(350,200,"auto");
      //$graph->SetShadow();

      // Set A title for the plot
      //$graph->title->Set("Example 3 3D Pie plot");
      //$graph->title->SetFont(FF_VERDANA,FS_BOLD,18);
      //$graph->title->SetColor("darkblue");
      //$graph->legend->Pos(0.1,0.2);
      //$graph->legend->SetFont(FF_ARIAL,FS_NORMAL,8);

      // Create 3D pie plot
      $p1 = new PiePlot3d($data);
      $p1->SetTheme("sand");
      $p1->SetCenter(0.4);
      $p1->SetSize(80);

      // Adjust projection angle
      $p1->SetAngle(45);

      // As a shortcut you can easily explode one numbered slice with
      $p1->ExplodeSlice(3);

      // Setup the slice values
      $p1->value->SetFont(FF_ARIAL,FS_NORMAL,8);
      $p1->value->SetColor("navy");

      //$legendCaptionsArr = array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct");

      $p1->SetLegends($graphDataObj->graphTitlesArr);

      $graph->Add($p1);
      $graph->Stroke();
   }


   /**
    * Redender RadarGraph
    * @access private
    * @param GraphDataRD7 $graphDataObj
    */
   function _redenderDataRadarGraph(&$graphDataObj){
      //   include ("../jpgraph_radar.php");

      //debug_obj($graphDataObj);

      // Create the basic radar graph
      $graph = new RadarGraph(350,200,"auto");
      //$graph->img->SetAntiAliasing();
      $graph->SetFrame(false);


      // Set background color and shadow
      //$graph->SetColor("white");
      //$graph->SetShadow();

      // Position the graph
      $graph->SetCenter(0.45,0.50);

      // Setup the axis formatting
      $graph->axis->SetFont(FF_FONT1,FS_NORMAL,8);

      // Setup the grid lines
      $graph->grid->SetLineStyle("dotted");
      $graph->grid->SetColor("navy");
      $graph->grid->Show();
      $graph->HideTickMarks();
      $graph->SetScale("lin",0,$graphDataObj->getValuesCount());
      //$graph->ShowMinorTickmarks();

      // Setup graph titles
      //$graph->title->Set("Quality result");
      //$graph->title->Set("Answers:".$graphDataObj->valuesCount);
      //$graph->title->SetFont(FF_FONT1,FS_BOLD);


      $graph->SetTitles($graphDataObj->graphTitlesArr);


      // Create the first radar plot
      //$plot = new RadarPlot(array(70,80,60,90,71,81,47));
      //$plot->SetLegend("Goal");
      //$plot->SetColor("red","lightred");
      //$plot->SetFill(false);
      //$plot->SetLineWeight(2);

      // Create the second radar plot
      $grephDataArr = $graphDataObj->graphDataArr;

      $plot2 = new RadarPlot($grephDataArr);
      //   $plot2->SetLegend("Answers:".$graphDataObj->valuesCount);
      $plot2->SetLineWeight(2);
      $plot2->SetColor("red");
      //$plot2->SetColor("#BBCCFF");

      $plot2->SetFill(true);
      //$plot2->SupressTickMarks();

      // Add the plots to the graph
      $graph->Add($plot2);
      //$graph->Add($plot);

      //debug_obj($graph,'$graph');
      // And output the graph
      $graph->Stroke();
   }
}
?>