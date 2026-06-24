<?php
function hitung_diskon($total_unit, $total_harga)
{
    $persen = 0;
    if ($total_unit == 2){
        $persen = 5;
    } elseif ($total_unit >= 3 && $total_unit <= 4){
        $persen = 10;
    } elseif ($total_unit >= 5){
        $persen = 15;
    }

    return ($total_harga * $persen) /100;
}