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
        if ($ids['quantity'] != 0) {
            return false;
        };
    };
    return true;
};

function smallest_volume($o){
    $volumes = array();
    foreach ($o as $ids) {
        if ($ids['quantity'] > 0) {
            array_push($volumes, $ids['volume']);
        };
    };
    return min($volumes);
};

function box_full($max, $box, $min) {
    if ($box['vol'] + $min > $max) {
        return true;
    };
    return false;
};
?>