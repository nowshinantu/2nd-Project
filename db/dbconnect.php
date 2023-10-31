<?php


function getDataFromDB($sql)
{
  $newdb = mysqli_connect('localhost', 'root', '', 'antu');
  $result = mysqli_query($newdb,$sql) or die(mysqli_error($newdb));
  $container = array();

  while ($a = mysqli_fetch_assoc($result)) {
    $container[] = $a;
  }
  return $container;
}

?>