<?php
$created_order = array(

);
echo "\nPlease enter the product id follwed my the quantity required for this order then the volume of one product (ex: 40 3 12000)\nHow many item types are in your order?:";
$handle = fopen("php://stdin", "r");
$line = fgets($handle);
$order_size = $line;
    while (count($created_order) < (int)$order_size) {
        echo "Item(id quantity volume):";
        $line = fgets($handle);
        $entry = explode(" ", $line);
        $created_order[$entry[0]] = array(
        'quantity' => (int)$entry[1],
        'volume' => (int)$entry[2]
    );
    };

fclose($handle);
echo "\n";
echo "Sorting boxes...\n";
var_dump($created_order);

function order_filled($o){
    foreach ($o as $ids) {
        // echo $ids['quantity'];
        if ($ids['quantity'] != 0) {
            return false;
        };
    };
    return true;
};

function min_volume($o){
    $volumes = array();
    foreach ($o as $ids) {
        if ($ids['quantity'] > 0) {
            array_push($volumes, $ids['volume']);
        };
    };
    return min($volumes);
};

function box_full($max, $box, $min){
    if ((int)$box['volume'] + (int)$min > (int)$max) {
        return true;
    };
    return false;
};

function exe($o){
    $mod_order = $o;
    $max_vol = 15000;
    $current_box = array(
      'volume'=> 0,
      'contents'=> array()
    );
    $boxes = array();
    while (order_filled($mod_order) == false) {
        foreach ($mod_order as $ids => $val) {
            if($current_box['volume'] + min_volume($mod_order) > $max_vol) {
                array_push($boxes, $current_box['contents']);
                $current_box['volume'] = 0;
                $current_box['contents'] = array();
            } elseif ($max_vol - $current_box['volume'] >= min_volume($mod_order)) {
                if ($val['quantity'] > 0 && $current_box['volume'] + $val['volume'] <= $max_vol) {
                    $current_box['volume'] += $val['volume'];
                    $mod_order[$ids]['quantity'] -= 1;
                    if (!array_key_exists($ids, $current_box['contents'])) {
                        $current_box['contents'][$ids] = 1;
                    } else {
                        $current_box['contents'][$ids] += 1;
                    }
                }
            }
        }
    }
    array_push($boxes, $current_box['contents']);
    var_dump($boxes);
    
    return $boxes;
};


$sorted = exe($created_order);
$index = 1;
echo "\nThe order will be placed into ", count($sorted), " boxes\n";
foreach ($sorted as $box) {
  echo "\nIn box ", $index, " we will place\n";
  foreach($box as $item) {
    echo $item, " units of id: ", $box[$item];
  };
  $index ++;
};
?>
