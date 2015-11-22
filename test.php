<?php

function test($data,$split_num) {
    $split = 0;
    foreach ($data as $value) {
        echo $value;
        $split++;
        if ($split % $split_num === 0) {
            echo "&nbsp;";
        }
    }
    echo "<br />";
}
