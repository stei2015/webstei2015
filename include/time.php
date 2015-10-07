<?php

// https://gist.github.com/mattytemple/3804571, translated by nathanchrs

function getRelativeTime($timestamp){
    return htmlspecialchars(str2RelativeTime($timestamp));
}

function str2RelativeTime($ts) {
    if(!ctype_digit($ts)) {
        $ts = strtotime($ts);
    }
    $diff = time() - $ts;
    if($diff == 0) {
        return 'saat ini';
    } elseif($diff > 0) {
        $day_diff = floor($diff / 86400);
        if($day_diff == 0) {
            if($diff < 60) return 'beberapa detik yang lalu';
            if($diff < 120) return 'semenit yang lalu';
            if($diff < 3600) return floor($diff / 60) . ' menit yang lalu';
            if($diff < 7200) return 'sejam yang lalu';
            if($diff < 86400) return floor($diff / 3600) . ' jam yang lalu';
        }
        if($day_diff == 1) { return 'kemarin'; }
        if($day_diff < 7) { return $day_diff . ' hari yang lalu'; }
        if($day_diff < 31) { return ceil($day_diff / 7) . ' minggu yang lalu'; }
        if($day_diff < 60) { return 'bulan lalu'; }
        return date('F Y', $ts);
    } else {
        $diff = abs($diff);
        $day_diff = floor($diff / 86400);
        if($day_diff == 0) {
            if($diff < 120) { return 'dalam satu menit'; }
            if($diff < 3600) { return 'dalam '.floor($diff / 60) . ' menit'; }
            if($diff < 7200) { return 'dalam satu jam'; }
            if($diff < 86400) { return 'dalam ' . floor($diff / 3600) . ' jam'; }
        }
        if($day_diff == 1) { return 'besok'; }
        if($day_diff < 4) { return date('l', $ts); }
        if($day_diff < 7 + (7 - date('w'))) { return 'minggu depan'; }
        if(ceil($day_diff / 7) < 4) { return 'dalam ' . ceil($day_diff / 7) . ' minggu'; }
        if(date('n', $ts) == date('n') + 1) { return 'bulan depan'; }
        return date('F Y', $ts);
    }
}

?>