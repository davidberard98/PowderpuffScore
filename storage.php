<?php
//Will store data as:
//    jrs|srs|refreshtime

//file_put_contents("storage.txt", "0|1|0");

$filename = "storage.txt";
function reading($filename)
{
  if(file_exists($filename))
  {
    $cont = file_get_contents($filename);
//    echo $cont;
    $cont_array = explode('|', $cont);
    for($i=0;$i<sizeof($cont_array); ++$i)
    {
      $cont_array[$i] = intval($cont_array[$i]);
    }
    return $cont_array;
  }
  else
    return array(0,0,0);
}
function writing($filename, $cont_array)
{
  $cont;
  foreach($cont_array as $element)
  {
    $cont .= $element . "|";
  }
  $cont = trim($cont, "|");
//  echo($cont);
  file_put_contents($filename, $cont);
}

$cont = reading($filename);
writing($filename, $cont);
$todo = $_GET['action'];

if($todo == "jrs") { echo $cont[0]; }
if($todo == "srs") { echo $cont[1]; }
if($todo == "refresh") { echo $cont[2]; }
if($todo == "set_jrs") { $cont[0] = intval($_GET['val']); writing($filename, $cont); }
if($todo == "set_srs") { $cont[1] = intval($_GET['val']); writing($filename, $cont); }
if($todo == "set_refresh") { $cont[2] = intval($_GET['val']); writing($filename, $cont); }
if($todo == "reset") { unlink("storage.txt"); };

?>
