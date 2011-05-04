<?php
/**
 * Graph generator
 * @version $Id: class.GraphTXD.php 138 2007-11-25 05:43:57Z mimait04 $
 * @package mkSurvey.Graph
 */

include_once(JPGRAPH_CLASS_PATH.'/jpgraph_bar.php');
include_once(JPGRAPH_CLASS_PATH.'/jpgraph_line.php');

class GraphTXD extends GraphAbstract {

   function GraphTXD($graphId){

      //parent::GraphAbstract($graphId);

   }

   /**
    * Redender Graph
    * @access public
    * @param GraphDataTXD $graphDataObj
    */


   function redenderData(&$graphDataObj){
      $this->_redenderDataGraph($graphDataObj);
   }

   /**
    * Redender RadarGraph
    * @access private
    * @param GraphDataTXD $graphDataObj
    */
   function _redenderDataGraph(&$graphDataObj){

      $months = $graphDataObj->getKeysArray();


      $dataArr = $graphDataObj->graphDataArr;
      $dataMaxKeyValue = $graphDataObj->getMaxKeyValue();

      //debug_sql($dataMaxKeyValue,'$dataMaxKeyValue');

      //create array prefilled with "x"
      $dataNewArr = array_fill(0, $dataMaxKeyValue + 2, 'x');

      //debug_obj($dataArr);
      //debug_obj($dataNewArr);

      foreach((array)$dataArr as $key => $value){
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


      $graph->SetScale("lin",0,$graphDataObj->getMaxDataValue() + 2,0,$graphDataObj->getMaxKeyValue() + 1);
      //$graph->SetScale("intlin",0,$graphDataObj->getMaxDataValue() + 2,0,$graphDataObj->getMaxKeyValue());
      //$graph->yscale->SetAutoMin(0);


      $graph->SetMarginColor('white');

      // Adjust the margin slightly so that we use the
      // entire area (since we don't use a frame)
      //$graph->SetMargin(30,1,20,5);

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
      $tickPositions = array(0,1);
      $minTickPositions  = array(0,2);

      //$graph->yaxis->SetTickPositions($tickPositions,$minTickPositions);//,$graphDataObj->getKeysArray());


      //$graph->xaxis->SetTickLabels($months);
      //$graph->xaxis->SetTickLabels($graphDataObj->getKeysArray());
      $graph->xaxis->SetFont(FF_ARIAL,FS_NORMAL,8);
      $graph->xaxis->SetLabelAngle(45);

      $graph->yaxis->SetFont(FF_ARIAL,FS_NORMAL,8);
      $graph->yaxis->HideZeroLabel();
      $graph->xaxis->HideZeroLabel();


      /*
       // Create a bar pot
       $bplot = new BarPlot($ydata);
       $bplot->SetWidth(0.6);
       $fcol='#440000';
       $tcol='#FF9090';

       $bplot->SetFillGradient($fcol,$tcol,GRAD_LEFT_REFLECTION);

       // Set line weigth to 0 so that there are no border
       // around each bar
       $bplot->SetWeight(0);

       //$graph->Add($bplot);
       */
      // Create filled line plot
      //$lplot = new LinePlot($ydata2);
      //debug_obj($graphDataObj->getKeysArray());

      //debug_obj($graphDataObj->getDataArray());
      //debug_obj($graphDataObj);

      //$lplot = new LinePlot($graphDataObj->getDataArray());
      //$lplot = new LinePlot($graphDataObj->graphDataArr);


      //      $dataArr[0] = 1;
      //      $dataArr[1] = NULL;
      //      $dataArr[10] = 1.5;

      //$dataArr = new array();


      //$lplot = new LinePlot($dataArr);
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


}
?>