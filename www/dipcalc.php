<?

$fi = $_GET['fi'];
$width = $_GET['width'];
$height = $_GET['height'];

if ($fi == ""){$fi=0;}
if ($width == ""){$width=400;}
if ($height == ""){$height=300;}

$fi = (float)$fi;

$fi_old = $fi;

if (($fi <= -360)||($fi >= 360)){
   $fi = $fi%360;
   echo "$fi_old = $fi";   
}
?>
<br>
<?
echo "sin($fi) =".abs(round(sin($fi),2));
echo "<br>cos($fi) =".abs(round(cos($fi),2));

if ($fi/90 == 1){
$c1 = $width;
$c2 = $height;

$width2  = $c2 * sin($fi) + $c1*cos($fi);
$height2 = $c1 * sin(90-$fi) + $c2*cos($fi);
}else{
   
}

?>

<form action="">
   <input type="text" name="fi" value="<?=$fi?>"><br>
   <input type="text" name="width" value="<?=$width?>"> x <input type="text" name="height" value="<?=$height?>"><br>
   <input type="submit">
</form>


<?=$width2?> x <?=$height2?><br>