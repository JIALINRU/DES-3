<!DOCTYPE html>
<?php
//init tables
//IP:
$table_IP = [57, 49, 41, 33, 25, 17, 9, 1,
    59, 51, 43, 35, 27, 19, 11, 3,
    61, 53, 45, 37, 29, 21, 13, 5,
    63, 55, 47, 39, 31, 23, 15, 7,
    56, 48, 40, 32, 24, 16, 8, 0,
    58, 50, 42, 34, 26, 18, 10, 2,
    60, 52, 44, 36, 28, 20, 12, 4,
    62, 54, 46, 38, 30, 22, 14, 6
];

//IP^-1:
$table_IP_1 = [39, 7, 47, 15, 55, 23, 63, 31,
    38, 6, 46, 14, 54, 22, 62, 30,
    37, 5, 45, 13, 53, 21, 61, 29,
    36, 4, 44, 12, 52, 20, 60, 28,
    35, 3, 43, 11, 51, 19, 59, 27,
    34, 2, 42, 10, 50, 18, 58, 26,
    33, 1, 41, 9, 49, 17, 57, 25,
    32, 0, 40, 8, 48, 16, 56, 24];

//E:
$table_E = [31, 0, 1, 2, 3, 4,
    3, 4, 5, 6, 7, 8,
    7, 8, 9, 10, 11, 12,
    11, 12, 13, 14, 15, 16,
    15, 16, 17, 18, 19, 20,
    19, 20, 21, 22, 23, 24,
    23, 24, 25, 26, 27, 28,
    27, 28, 29, 30, 31, 0];

//P:
$table_P = [15, 6, 19, 20, 28, 11, 27, 16,
    0, 14, 22, 25, 4, 17, 30, 9,
    1, 7, 23, 13, 31, 26, 2, 8,
    18, 12, 29, 5, 21, 10, 3, 24];

//S:
$box_S = [
    //S1:
    [[14, 4, 13, 1, 2, 15, 11, 8, 3, 10, 6, 12, 5, 9, 0, 7],
        [0, 15, 7, 4, 14, 2, 13, 1, 10, 6, 12, 11, 9, 5, 3, 8],
        [4, 1, 14, 8, 13, 6, 2, 11, 15, 12, 9, 7, 3, 10, 5, 0],
        [15, 12, 8, 2, 4, 9, 1, 7, 5, 11, 3, 14, 10, 0, 6, 13]
    ],
    //S2:
    [[15, 1, 8, 14, 6, 11, 3, 4, 9, 7, 2, 13, 12, 0, 5, 10],
        [3, 13, 4, 7, 15, 2, 8, 14, 12, 0, 1, 10, 6, 9, 11, 5],
        [0, 14, 7, 11, 10, 4, 13, 1, 5, 8, 12, 6, 9, 3, 2, 15],
        [13, 8, 10, 1, 3, 15, 4, 2, 11, 6, 7, 12, 0, 5, 14, 9]
    ],
    //S3:
    [[10, 0, 9, 14, 6, 3, 15, 5, 1, 13, 12, 7, 11, 4, 2, 8],
        [13, 7, 0, 9, 3, 4, 6, 10, 2, 8, 5, 14, 12, 11, 15, 1],
        [13, 6, 4, 9, 8, 15, 3, 0, 11, 1, 2, 12, 5, 10, 14, 7],
        [1, 10, 13, 0, 6, 9, 8, 7, 4, 15, 14, 3, 11, 5, 2, 12]],
    //S4:
    [[7, 13, 14, 3, 0, 6, 9, 10, 1, 2, 8, 5, 11, 12, 4, 15],
        [13, 8, 11, 5, 6, 15, 0, 3, 4, 7, 2, 12, 1, 10, 14, 9],
        [10, 6, 9, 0, 12, 11, 7, 13, 15, 1, 3, 14, 5, 2, 8, 4],
        [3, 15, 0, 6, 10, 1, 13, 8, 9, 4, 5, 11, 12, 7, 2, 14]],
    //S5:
    [[2, 12, 4, 1, 7, 10, 11, 6, 8, 5, 3, 15, 13, 0, 14, 9],
        [14, 11, 2, 12, 4, 7, 13, 1, 5, 0, 15, 10, 3, 9, 8, 6],
        [4, 2, 1, 11, 10, 13, 7, 8, 15, 9, 12, 5, 6, 3, 0, 14],
        [11, 8, 12, 7, 1, 14, 2, 13, 6, 15, 0, 9, 10, 4, 5, 3]],
    //S6:
    [[12, 1, 10, 15, 9, 2, 6, 8, 0, 13, 3, 4, 14, 7, 5, 11],
        [10, 15, 4, 2, 7, 12, 9, 5, 6, 1, 13, 14, 0, 11, 3, 8],
        [9, 14, 15, 5, 2, 8, 12, 3, 7, 0, 4, 10, 1, 13, 11, 6],
        [4, 3, 2, 12, 9, 5, 15, 10, 11, 14, 1, 7, 6, 0, 8, 13]],
    //S7:
    [[4, 11, 2, 14, 15, 0, 8, 13, 3, 12, 9, 7, 5, 10, 6, 1],
        [13, 0, 11, 7, 4, 9, 1, 10, 14, 3, 5, 12, 2, 15, 8, 6],
        [1, 4, 11, 13, 12, 3, 7, 14, 10, 15, 6, 8, 0, 5, 9, 2],
        [6, 11, 13, 8, 1, 4, 10, 7, 9, 5, 0, 15, 14, 2, 3, 12]],
    //S8:
    [[13, 2, 8, 4, 6, 15, 11, 1, 10, 9, 3, 14, 5, 0, 12, 7],
        [1, 15, 13, 8, 10, 3, 7, 4, 12, 5, 6, 11, 0, 14, 9, 2],
        [7, 11, 4, 1, 9, 12, 14, 2, 0, 6, 10, 13, 15, 3, 5, 8],
        [2, 1, 14, 7, 4, 10, 8, 13, 15, 12, 9, 0, 3, 5, 6, 11]]
];

//PC1:
$table_PC1 = [56, 48, 40, 32, 24, 16, 8,
    0, 57, 49, 41, 33, 25, 17,
    9, 1, 58, 50, 42, 34, 26,
    18, 10, 2, 59, 51, 43, 35,
    62, 54, 46, 38, 30, 22, 14,
    6, 61, 53, 45, 37, 29, 21,
    13, 5, 60, 52, 44, 36, 28,
    20, 12, 4, 27, 19, 11, 3];

//PC2:
$table_PC2 = [13, 16, 10, 23, 0, 4, 2, 27,
    14, 5, 20, 9, 22, 18, 11, 3,
    25, 7, 15, 6, 26, 19, 12, 1,
    40, 51, 30, 36, 46, 54, 29, 39,
    50, 44, 32, 46, 43, 48, 38, 55,
    33, 52, 45, 41, 49, 35, 28, 31];

//steps of move to left:
$table_move_steps = [1, 1, 2, 2, 2, 2, 2, 2, 1, 2, 2, 2, 2, 2, 2, 1];

//functions:
//hex to binary:
function HexToBin($input_data) {
    $bin_data = [];
    for ($i = 0; $i < count($input_data); $i++) {
        $bin_data [$i] = base_convert($input_data[$i], 16, 2);
        //add 0 in front of data:
        if (strlen($bin_data [$i]) < 8) {
            $num_of_zero = 8 - strlen($bin_data [$i]);
            $bin_data[$i] = AddZero($bin_data[$i], $num_of_zero);
        }
    }
    return $bin_data;
}

//bin to array:
function BinToArray($bin_data) {
    $data = [];
    foreach ($bin_data as $bin_data_value) {
        $temp = str_split($bin_data_value, 1);
        foreach ($temp as $temp_value) {
            array_push($data, $temp_value);
        }
    }
    return $data;
}

//add 0 in front of data:
function AddZero($string, $num) {
    for ($j = 0; $j < $num; $j++) {
        $string = "0" . $string;
    }
    return $string;
}

//deal with key:
function getKs($key) {
    //globals:
    global $table_PC1, $table_PC2, $table_move_steps;
    //use PC1 to get 56 long's array:
    $key_after_PC1 = [];
    for ($i = 0; $i < 56; $i++) {
        $key_after_PC1[$i] = $key[$table_PC1[$i]];
    }
    //get 28 long's array C,D:
    $key_C1 = [];
    $key_C2 = [];
    for ($i = 0; $i < 28; $i++) {
        $key_C1[$i] = $key_after_PC1[$i];
        $key_C2[$i] = $key_after_PC1[$i + 28];
    }
    //get 16 Ks:
    $key_Ks = [];
    for ($i = 0; $i < 16; $i++) {
        $merge_C_D = array_merge(MoveLeft($key_C1, $table_move_steps[$i]), MoveLeft($key_C2, $table_move_steps[$i]));
        //use PC2:
        for ($j = 0; $j < 48; $j++) {
            $key_Ks[$i][$j] = $merge_C_D[$table_PC2[$j]];
        }
    }
    return $key_Ks;
}

//move left:
function MoveLeft($array, $step) {
    $new_array = [];
    for ($i = 0; $i < count($array); $i++) {
        $old_index = $i + $step;
        if ($old_index > count($array) - 1) {
            $old_index-=count($array);
        }
        $new_array[$i] = $array[$old_index];
    }
    return $new_array;
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>DES 加密和解密</title>
    </head>
    <body>
        <!--input-->
        <div>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <lable>Input data:<br />
                    0x<input name="data[]" type="text" size="4" value="31" />
                    0x<input name="data[]" type="text" size="4" value="31" />
                    0x<input name="data[]" type="text" size="4" value="31" />
                    0x<input name="data[]" type="text" size="4" value="31" />
                    0x<input name="data[]" type="text" size="4" value="31" />
                    0x<input name="data[]" type="text" size="4" value="31" />
                    0x<input name="data[]" type="text" size="4" value="31" />
                    0x<input name="data[]" type="text" size="4" value="31" />
                </lable>
                <br />
                <label>Input key:<br />
                    0x<input name="key[]" type="text" size="4" value="30" />
                    0x<input name="key[]" type="text" size="4" value="30" />
                    0x<input name="key[]" type="text" size="4" value="30" />
                    0x<input name="key[]" type="text" size="4" value="30" />
                    0x<input name="key[]" type="text" size="4" value="30" />
                    0x<input name="key[]" type="text" size="4" value="30" />
                    0x<input name="key[]" type="text" size="4" value="30" />
                    0x<input name="key[]" type="text" size="4" value="30" />
                </label>
                <br />
                <input type="submit" value="加密" />
            </form></div>
        <br />
        <!--result-->
        <div>
            <?php
            //handle the input:
            $input_data = $input_key = [];
            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                $input_data = $_POST["data"];
                $input_key = $_POST["key"];
            }
            if (count($input_data) !== 0 && count($input_key) !== 0) {
                //8*8 datas and 8*8 keys:
                $bin_data = HexToBin($input_data);
                $bin_key = HexToBin($input_key);
                //get 64 long's array:
                $data = BinToArray($bin_data);
                $key = BinToArray($bin_key);
                print_r($key);
                //deal with key:
                $key_Ks = getKs($key);

                //deal with 64 data:
            }//end if
            ?>
        </div>
    </body>
</html>
