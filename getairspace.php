<?php
$countries=[];
require_once("../db_inc.php");
$mysqli=new mysqli($dbserver,$username,$password,$database);
$bounds=json_decode($_POST['bounds'],true);
$bounds=json_decode($_POST['bounds'],true);
$box="POLYGON((".$bounds['north']." ".$bounds['west'].",".$bounds['north']." ".$bounds['east'].",".$bounds['south']." ".$bounds['east'].",".$bounds['south']." ".$bounds['west'].",".$bounds['north']." ".$bounds['west']."))";
$sql="SET @bbox=GeomFromText('".$box."')";
$mysqli->query($sql);
echo  "{\n\"polygons\": [";
$result = $mysqli->query("SELECT base,AsText(outline) FROM geopoly WHERE INTERSECTS(outline,@bbox)");
$started= false;
if($result->num_rows !==0) {
   while($polyinfo=$result->fetch_row()) {
   if($started) {
   echo ",";
   }
   $started="true";
    echo  "\n{\n\"base\": $polyinfo[0],\n";
     // not very readable but much faster than regex
    echo str_replace(")","}]}",str_replace(" ",",\"lng\": ",str_replace(",","},{\"lat\":", str_replace("LINESTRING(","\"coords\":[{\"lat\":",$polyinfo[1]))));
     }
}
$result->close();
echo "],\n";
echo "\"circles\": [\n";
$circledata = $mysqli->query("SELECT base,AsText(centre),radius FROM geocircle WHERE INTERSECTS(mbr,@bbox)");
if($circledata->num_rows !==0)  {
    $circlestarted=false;
    while($circleinfo=$circledata->fetch_row())  {
       if($circlestarted) {
       echo ",\n";
       }
      $circlestarted=true;
     $centre=str_replace(")","}",str_replace(" ",",\"lng\":",str_replace("POINT(", "{\"lat\":",$circleinfo[1])));
    echo "{\n\"base\":$circleinfo[0],\n\"centre\":$centre,\n\"radius\":$circleinfo[2]\n}";
    }
}
$circledata->close();
echo "]}";
$mysqli->close();
?>
