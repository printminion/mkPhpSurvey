<?php
/**
 * Graph generator
 * @version $Id: class.GraphRA6.php 133 2007-11-25 01:49:43Z mimait04 $
 * @package mkSurvey.Graph
 */

include_once(JPGRAPH_CLASS_PATH.'/jpgraph_line.php');

class GraphRA6 extends GraphAbstract {

   function GraphRA6($graphId){

      //parent::GraphAbstract($graphId);

   }


   /**
    * Redender Graph
    * @access public
    * @param GraphDataRA6 $graphDataObj
    */
   function redenderData(&$graphDataObj){
      //$this->_redenderDataPiePlot3d($graphDataObj);
      //$this->_redenderDataLinePlot($graphDataObj);
      $this->_redenderGraph($graphDataObj);
   }

   /**
    * Redender Graph
    * @access private
    * @param GraphDataRA6 $graphDataObj
    */
   function _redenderGraph(&$graphDataObj){

      $months = $graphDataObj->getKeysArray();


      $dataArr = $graphDataObj->graphDataArr;
      $dataMaxKeyValue = $graphDataObj->getMaxKeyValue();


      //create array prefilled with "x"
      $dataNewArr = array_fill(0, $dataMaxKeyValue + 2, 'x');

      //debug_obj($dataArr);

      foreach((array)$dataArr as $key => $value){
         if ($value == 0){
            $value = 'x';
         }
         $dataNewArr[$key] = $value;
      }

      //debug_obj($dataNewArr);

      // Create the graph.
      $graph = new Graph(350,200);
      //$graph->SetScale("textlin");
      //$graph->SetScale("lin");
      //$graph->SetScale("textlin",0,2,0,1);
      //echo $graphDataObj->getMaxDataValue();
      //echo $graphDataObj->getMaxKeyValue();
      //die();


      $graph->SetScale("intlin",0,$graphDataObj->getMaxDataValue() + 2,0,6);
      //$graph->SetScale("intlin",0,$graphDataObj->getMaxDataValue() + 2,0,$graphDataObj->getMaxKeyValue());
      //$graph->yscale->SetAutoMin(0);


      $graph->SetMarginColor('white');

      // Adjust the margin slightly so that we use the
      // entire area (since we don't use a frame)
      //$graph->SetMargin(30,1,20,5);
      $graph->SetMargin(30,1,20,40);

      // Box around plotarea
      //$graph->SetBox();

      // No frame around the image
      $graph->SetFrame(false);

      // Setup the tab title
      //$graph->tabtitle->Set('Year 2003');
      //$graph->tabtitle->SetFont(FF_ARIAL,FS_BOLD,10);

      // Setup the X and Y grid
      //$graph->ygrid->SetFill(true,'#DDDDDD@0.5','#BBBBBB@0.5');
      $graph->ygrid->SetFill(true,'#EFEFEF@0.5','#BBCCFF@0.5');
      $graph->ygrid->SetLineStyle('dashed');
      $graph->ygrid->SetColor('gray');



      $graph->xgrid->Show();
      $graph->xgrid->SetLineStyle('dashed');
      $graph->xgrid->SetColor('gray');

      // Setup month as labels on the X-axis
      //$tickPositions = array(0,1,2,3);
      //$minTickPositions  = array(0,1);
      //$tickPositions = array(0,1);
      //$minTickPositions  = array(0,2);

      //$graph->yaxis->SetTickPositions($tickPositions,$minTickPositions);//,$graphDataObj->getKeysArray());


      //$graph->xaxis->SetTickLabels($months);
      //$graph->xaxis->SetTickLabels($graphDataObj->getKeysArray());
      $graph->xaxis->SetFont(FF_ARIAL,FS_NORMAL,8);
      //$graph->xaxis->SetLabelAngle(45);
      $graph->xaxis->SetTickLabels($graphDataObj->graphTitlesArr);

      $graph->xaxis->SetLabelAngle(15);
      $graph->xaxis->HideZeroLabel();

      $graph->yaxis->SetFont(FF_ARIAL,FS_NORMAL,8);
      $graph->yaxis->HideZeroLabel();

      //debug_obj($dataNewArr);
      $lplot = new LinePlot($dataNewArr);


      $lplot->SetFillColor('skyblue@0.5');
      $lplot->SetColor('navy@0.7');
      //$lplot->SetBarCenter();

      $lplot->mark->SetType(MARK_SQUARE);
      $lplot->mark->SetColor('blue@0.5');
      $lplot->mark->SetFillColor('lightblue');
      $lplot->mark->SetSize(6);

      $graph->Add($lplot);

      // .. and finally send it back to the browser
      $graph->Stroke();

   }
   /**
    * Redender PiePlot3d
    * @access private
    * @param GraphDataRA6 $graphDataObj
    */
   function _redenderDataPiePlot3d(&$graphDataObj){
      //debug_obj($graphDataObj,'redenderData');

      // Some data
      //$data = array(20,27,45,75,90);
      //$data = array(0,1);
      $data = $graphDataObj->getDataArray();
      //debug_obj($data,'$data');

      // Create the Pie Graph.
      $graph = new PieGraph(350,200,"auto");
      //$graph->SetShadow();

      // Set A title for the plot
      //$graph->title->Set("Example 3 3D Pie plot");
      //$graph->title->SetFont(FF_VERDANA,FS_BOLD,18);
      //$graph->title->SetColor("darkblue");
      $graph->legend->Pos(0.01,0.01);

      // Create 3D pie plot
      $p1 = new PiePlot3d($data);
      $p1->SetTheme("water");
      $p1->SetCenter(0.4);
      $p1->SetSize(80);

      // Adjust projection angle
      $p1->SetAngle(45);

      // As a shortcut you can easily explode one numbered slice with
      $p1->ExplodeSlice(3);

      // Setup the slice values
      //            $p1->value->SetFont(FF_ARIAL,FS_BOLD,11);
      $p1->value->SetColor("navy");

      //$legendCaptionsArr = array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct");

      //$p1->SetLegends($graphDataObj->graphTitlesArr);

      $graph->Add($p1);
      $graph->Stroke();
   }


   /**
    * Redender LinePlot
    * @access private
    * @param GraphDataRA6 $graphDataObj
    */
   function _redenderDataLinePlot(&$graphDataObj){
      /*
       //debug_obj($graphDataObj,'$graphDataObj');
       // Some data
       //$data = array(20,27,45,75,90);
       $data = $graphDataObj->getDataArray();

       // Create the Pie Graph.
       $graph = new PieGraph(350,200,"auto");
       $graph->SetShadow();

       // Set A title for the plot
       //$graph->title->Set("Example 3 3D Pie plot");
       //$graph->title->SetFont(FF_VERDANA,FS_BOLD,18);
       //$graph->title->SetColor("darkblue");
       $graph->legend->Pos(0.1,0.2);

       // Create 3D pie plot
       $p1 = new PiePlot3d($data);
       $p1->SetTheme("water");
       $p1->SetCenter(0.4);
       $p1->SetSize(80);

       // Adjust projection angle
       $p1->SetAngle(45);

       // As a shortcut you can easily explode one numbered slice with
       $p1->ExplodeSlice(3);

       // Setup the slice values
       //            $p1->value->SetFont(FF_ARIAL,FS_BOLD,11);
       $p1->value->SetColor("navy");

       //$legendCaptionsArr = array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct");

       //$p1->SetLegends($graphDataObj->graphTitlesArr);

       $graph->Add($p1);
       $graph->Stroke();
       */

      $datay1 = $graphDataObj->getDataArray();

      // Setup the graph
      $graph = new Graph(350,200);
      $graph->SetMarginColor('white');
      $graph->SetScale("textlin");
      $graph->SetFrame(false);

      //$graph->title->Set('Filled Y-grid');


      $graph->yaxis->HideZeroLabel();
      $graph->xaxis->HideZeroLabel();
      $graph->ygrid->SetFill(true,'#EFEFEF@0.5','#BBCCFF@0.5');
      $graph->xgrid->Show();


      $graph->xaxis->SetFont(FF_ARIAL,FS_NORMAL,8);
      $graph->yaxis->SetFont(FF_ARIAL,FS_NORMAL,8);

      //debug_obj($graphDataObj);

      $graph->xaxis->SetTickLabels($graphDataObj->graphTitlesArr);
      $graph->xaxis->SetLabelAngle(15);



      // Create the first line
      $p1 = new LinePlot($datay1);
      $p1->SetColor("navy");
      //$p1->SetLegend('Line 1');
      $graph->Add($p1);

      // Create the second line
      //$p2 = new LinePlot($datay2);
      //$p2->SetColor("red");
      //$p2->SetLegend('Line 2');
      //$graph->Add($p2);

      // Create the third line
      //$p3 = new LinePlot($datay3);
      //$p3->SetColor("orange");
      //$p3->SetLegend('Line 3');
      //$graph->Add($p3);

      //$graph->legend->SetShadow('gray@0.4',5);
      //$graph->legend->SetPos(0.1,0.1,'right','top');
      // Output line
      $graph->Stroke();

   }
}
?>