<?php

function test($data) {
    $eight = 0;
    foreach ($data as $value) {
        echo $value;
        $eight++;
        if ($eight % 8 === 0) {
            echo "&nbsp;";
        }
    }
    echo "<br />";
}