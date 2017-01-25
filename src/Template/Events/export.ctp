<?php
echo 'NAME,';
echo 'PLACE,';
echo 'DATE,';
echo 'TYPE,';
echo 'CUSTOMER,';
echo 'PHONE,';
echo 'SCORE,';
echo 'DATE,';
echo 'MODIFIED,';
echo "\n";



function str_putcsv($data) {
  //print_r($data);
  foreach ($data as $item) {
    echo '"'.$item->name.'",';
    echo '"'.$item->place.'",';
    echo '"'.$item->date.'",';
    echo '"'.$item->type.'",';
    echo '"'.$item->customer.'",';
    echo '"'.$item->phone.'",';
    echo '"'.$item->score.'",';
    echo '"'.$item->created.'",';
    echo '"'.$item->modified.'",';
    echo "\n";

  }
}

$list = str_putcsv($data);

//echo $list;


 ?>
