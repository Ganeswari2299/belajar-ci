<?php

if (!function_exists('hitung_ppn')) {
    function hitung_ppn($total_harga)
    {
        return $total_harga * 0.12;
    }
}

if (!function_exists('hitung_biaya_admin')) {
    function hitung_biaya_admin($total_harga)
    {
        if ($total_harga <= 15000000) {
            return $total_harga * 0.005;
        } elseif ($total_harga <= 35000000) {
            return $total_harga * 0.007;
        } else {
            return $total_harga * 0.009;
        }
    }
}

if (!function_exists('hitung_diskon_kupon')) {
    function hitung_diskon_kupon($total_harga, $kupon_code)
    {
        $kupon = strtoupper(trim($kupon_code));

        switch ($kupon) {
            case 'HEMAT20':
                return $total_harga * 0.20;

            case 'HEMAT30':
                return $total_harga * 0.30;

            case 'MEMBER25':
                return $total_harga * 0.25;

            default:
                return 0;
        }
    }
}