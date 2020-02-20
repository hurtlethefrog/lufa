<?php
$order = array("40", array("quantity", 5.0, "volume", 12000.0), "33", array("quantity", 6.0, "volume", 2500.0), "35", array("quantity", 3.0, "volume", 1500.0), "41", array("quantity", 1.0, "volume", 1500.0), "34", array("quantity", 3.0, "volume", 500.0), "45", array("quantity", 1.0, "volume", 500.0));

$args = array_shift($argv);

function orderFilled($o) {
    $array = array();
    foreach ($o as $ids) {
        $array[] = $ids
    }
    $isZero = Func(function ($ele = null) {
        if ($ele === 0.0) {
            return true;
        }
    });
    if (is(call_method($array, "every", $isZero))) {
        return true;
    } else {
        return false;
    };
};

echo (orderFilled($order));