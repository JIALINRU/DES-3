<!DOCTYPE html>
<?php
include 'test.php';
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
    //S0:
    [[14, 4, 13, 1, 2, 15, 11, 8, 3, 10, 6, 12, 5, 9, 0, 7],
        [0, 15, 7, 4, 14, 2, 13, 1, 10, 6, 12, 11, 9, 5, 3, 8],
        [4, 1, 14, 8, 13, 6, 2, 11, 15, 12, 9, 7, 3, 10, 5, 0],
        [15, 12, 8, 2, 4, 9, 1, 7, 5, 11, 3, 14, 10, 0, 6, 13]
    ],
    //S1:
    [[15, 1, 8, 14, 6, 11, 3, 4, 9, 7, 2, 13, 12, 0, 5, 10],
        [3, 13, 4, 7, 15, 2, 8, 14, 12, 0, 1, 10, 6, 9, 11, 5],
        [0, 14, 7, 11, 10, 4, 13, 1, 5, 8, 12, 6, 9, 3, 2, 15],
        [13, 8, 10, 1, 3, 15, 4, 2, 11, 6, 7, 12, 0, 5, 14, 9]
    ],
    //S2:
    [[10, 0, 9, 14, 6, 3, 15, 5, 1, 13, 12, 7, 11, 4, 2, 8],
        [13, 7, 0, 9, 3, 4, 6, 10, 2, 8, 5, 14, 12, 11, 15, 1],
        [13, 6, 4, 9, 8, 15, 3, 0, 11, 1, 2, 12, 5, 10, 14, 7],
        [1, 10, 13, 0, 6, 9, 8, 7, 4, 15, 14, 3, 11, 5, 2, 12]],
    //S3:
    [[7, 13, 14, 3, 0, 6, 9, 10, 1, 2, 8, 5, 11, 12, 4, 15],
        [13, 8, 11, 5, 6, 15, 0, 3, 4, 7, 2, 12, 1, 10, 14, 9],
        [10, 6, 9, 0, 12, 11, 7, 13, 15, 1, 3, 14, 5, 2, 8, 4],
        [3, 15, 0, 6, 10, 1, 13, 8, 9, 4, 5, 11, 12, 7, 2, 14]],
    //S4:
    [[2, 12, 4, 1, 7, 10, 11, 6, 8, 5, 3, 15, 13, 0, 14, 9],
        [14, 11, 2, 12, 4, 7, 13, 1, 5, 0, 15, 10, 3, 9, 8, 6],
        [4, 2, 1, 11, 10, 13, 7, 8, 15, 9, 12, 5, 6, 3, 0, 14],
        [11, 8, 12, 7, 1, 14, 2, 13, 6, 15, 0, 9, 10, 4, 5, 3]],
    //S5:
    [[12, 1, 10, 15, 9, 2, 6, 8, 0, 13, 3, 4, 14, 7, 5, 11],
        [10, 15, 4, 2, 7, 12, 9, 5, 6, 1, 13, 14, 0, 11, 3, 8],
        [9, 14, 15, 5, 2, 8, 12, 3, 7, 0, 4, 10, 1, 13, 11, 6],
        [4, 3, 2, 12, 9, 5, 15, 10, 11, 14, 1, 7, 6, 0, 8, 13]],
    //S6:
    [[4, 11, 2, 14, 15, 0, 8, 13, 3, 12, 9, 7, 5, 10, 6, 1],
        [13, 0, 11, 7, 4, 9, 1, 10, 14, 3, 5, 12, 2, 15, 8, 6],
        [1, 4, 11, 13, 12, 3, 7, 14, 10, 15, 6, 8, 0, 5, 9, 2],
        [6, 11, 13, 8, 1, 4, 10, 7, 9, 5, 0, 15, 14, 2, 3, 12]],
    //S7:
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
    50, 44, 32, 47, 43, 48, 38, 55,
    33, 52, 45, 41, 49, 35, 28, 31];

//steps of move to left:
$table_move_steps = [1, 1, 2, 2, 2, 2, 2, 2, 1, 2, 2, 2, 2, 2, 2, 1];

//functions:
//hex to binary:
function HexToBin($input_data) {//input an array
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

//dec to bin:
function DecToBin($input_data) {//input a data
    $bin_data = base_convert($input_data, 10, 2);
    //add 0 in front of data:
    if (strlen($bin_data) < 4) {
        $num_of_zero = 4 - strlen($bin_data);
        $bin_data = AddZero($bin_data, $num_of_zero);
    }
    return $bin_data;
}

//bin to array:
function BinToArray($bin_data) {
    $data = [];
    if (!is_array($bin_data)) {
        $temp = str_split($bin_data, 1);
        foreach ($temp as $temp_value) {
            array_push($data, $temp_value);
        }
        return $data;
    } else {
        foreach ($bin_data as $bin_data_value) {
            $temp = str_split($bin_data_value, 1);
            foreach ($temp as $temp_value) {
                array_push($data, $temp_value);
            }
        }
        return $data;
    }
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
    $key_C = [];
    $key_D = [];
    for ($i = 0; $i < 28; $i++) {
        $key_C[$i] = $key_after_PC1[$i];
        $key_D[$i] = $key_after_PC1[$i + 28];
    }
    //get 16 Ks:
    $key_Ks = [];
    for ($i = 0; $i < 16; $i++) {
        $merge_C_D = array_merge(MoveLeft($key_C, $table_move_steps[$i]), MoveLeft($key_D, $table_move_steps[$i]));
        //use PC2:
        for ($j = 0; $j < 48; $j++) {
            $key_Ks[$i][$j] = $merge_C_D[$table_PC2[$j]];
        }
    }
    return $key_Ks;
}

//move left:
function MoveLeft(&$array, $step) {
    $new_array = [];
    for ($i = 0; $i < count($array); $i++) {
        $old_index = $i + $step;
        if ($old_index > count($array) - 1) {
            $old_index-=count($array);
        }
        $new_array[$i] = $array[$old_index];
    }
    $array = $new_array;
    return $new_array;
}

//deal with data:
function Encrypt($data, $key_Ks) {
    //globals:
    global $table_IP, $table_IP_1;
    //use IP:
    $data_after_IP = [];
    for ($i = 0; $i < 64; $i++) {
        $data_after_IP[$i] = $data[$table_IP[$i]];
    }
    //get L,R:
    $data_L = [];
    $data_R = [];
    for ($i = 0; $i < 32; $i++) {
        $data_L[$i] = $data_after_IP[$i];
        $data_R[$i] = $data_after_IP[$i + 32];
    }
    for ($i = 0; $i < 16; $i++) {
        ChangeDataByKeys($data_L, $data_R, $key_Ks[$i]);
    }

    //combine R and L by IP^-1
    $data_before_IP_1 = [];
    foreach ($data_R as $value) {
        array_push($data_before_IP_1, $value);
    }
    foreach ($data_L as $value) {
        array_push($data_before_IP_1, $value);
    }

    $enc_data = []; //data after IP^-1
    for ($i = 0; $i < count($table_IP_1); $i++) {
        $enc_data[$i] = $data_before_IP_1[$table_IP_1[$i]];
    }
    return $enc_data;
}

function Decrypt($data, $key_Ks) {
    //globals:
    global $table_IP, $table_IP_1;
    //use IP:
    $data_after_IP = [];
    for ($i = 0; $i < 64; $i++) {
        $data_after_IP[$i] = $data[$table_IP[$i]];
    }
    //get L,R:
    $data_L = [];
    $data_R = [];
    for ($i = 0; $i < 32; $i++) {
        $data_L[$i] = $data_after_IP[$i];
        $data_R[$i] = $data_after_IP[$i + 32];
    }
    for ($i = 15; $i >= 0; $i--) {
        ChangeDataByKeys($data_L, $data_R, $key_Ks[$i]);
    }

    //combine R and L by IP^-1
    $data_before_IP_1 = [];
    foreach ($data_R as $value) {
        array_push($data_before_IP_1, $value);
    }
    foreach ($data_L as $value) {
        array_push($data_before_IP_1, $value);
    }

    $dec_data = []; //data after IP^-1
    for ($i = 0; $i < count($table_IP_1); $i++) {
        $dec_data[$i] = $data_before_IP_1[$table_IP_1[$i]];
    }
    return $dec_data;
}

//use 16 key_Ks change data:
function ChangeDataByKeys(&$data_L, &$data_R, $key) {
    global $table_E, $table_P;
    //use E to expand R:
    $data_R_after_E = [];
    for ($i = 0; $i < 48; $i++) {
        $data_R_after_E[$i] = $data_R[$table_E[$i]];
    }
    //E xor K:
    $temp_R = [];
    for ($i = 0; $i < 48; $i++) {
        $temp_R[$i] = AxorB($data_R_after_E[$i], $key[$i]);
    }
    //get 8 Bs:
    $temp_B = [[]];
    for ($i = 0; $i < 8; $i++) {
        for ($j = 0; $j < 6; $j++) {
            $temp_B[$i][$j] = $temp_R[$i * 6 + $j];
        }
    }
    //use S to change B:
    S_box($temp_B);
    //combine B0~7,and use P:
    $new_temp_B = [];
    foreach ($temp_B as $temp_B_j) {
        foreach ($temp_B_j as $temp_B_j_value) {
            array_push($new_temp_B, $temp_B_j_value);
        }
    }

    $temp_P = [];
    for ($i = 0; $i < count($table_P); $i++) {
        $temp_P[$i] = $new_temp_B[$table_P[$i]];
    }

    //R[I]=P XOR L[I-1]:
    //using temps to store R[I-1]
    $temp_R_for_L = $data_R;
    //xor:
    for ($i = 0; $i < count($temp_P); $i++) {
        $data_R[$i] = AxorB($temp_P[$i], $data_L[$i]);
    }

    //L[I]=R[I-1] :
    $data_L = $temp_R_for_L;
}

//xor:
function AxorB($a, $b) {
    $result = 0;
    if ($a == 0 && $b == 0) {
        $result = 0;
        return $result;
    } elseif ($a == 1 && $b == 1) {
        $result = 0;
        return $result;
    } elseif ($a == 1 && $b == 0) {
        $result = 1;
        return $result;
    } elseif ($a == 0 && $b == 1) {
        $result = 1;
        return $result;
    } else {
        echo "wrong at xor!";
    }
}

function ArrayToDec($data) {//64 to 8 dec numbers
    $dec_data = [];
    for ($i = 0; $i < 8; $i++) {
        $dec_data[$i] = 0;
        for ($j = 0; $j < 8; $j++) {
            $dec_data[$i] += $data[$i * 8 + $j] * pow(2, 7 - $j);
        }
    }
    return $dec_data;
}

function DecToHex($data) {
    $hex_data = [];
    for ($i = 0; $i < count($data); $i++) {
        $hex_data[$i] = base_convert($data[$i], 10, 16);
        if (strlen($hex_data[$i]) < 2) {
            $num_of_zero = 2 - strlen($hex_data[$i]);
            $hex_data[$i] = AddZero($hex_data[$i], $num_of_zero);
        }
    }
    return $hex_data;
}

//S box change B:
function S_box(&$temp_B) {
    global $box_S;
    $m = $n = 0;
    for ($j = 0; $j < 8; $j++) {
        $m = $temp_B[$j][0] * 2 + $temp_B[$j][5];
        $n = $temp_B[$j][1] * 2 * 2 * 2 + $temp_B[$j][2] * 2 * 2 + $temp_B[$j][3] * 2 + $temp_B[$j][4];
        $temp_B[$j] = BinToArray(DecToBin($box_S[$j][$m][$n]));
    }
}
?>

<!--html-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>DES 加密和解密</title>
        <style>
            #CanNotSame{
                color:red;
            }
        </style>
    </head>
    <body>
        <!--input-->
        <div>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <lable>Input data:<br />
                    0x<input name="data[]" type="text" size="4" />
                    0x<input name="data[]" type="text" size="4" />
                    0x<input name="data[]" type="text" size="4" />
                    0x<input name="data[]" type="text" size="4" />
                    0x<input name="data[]" type="text" size="4" />
                    0x<input name="data[]" type="text" size="4" />
                    0x<input name="data[]" type="text" size="4" />
                    0x<input name="data[]" type="text" size="4" />
                </lable>
                <br />
                <label>Input key1:<br />
                    0x<input name="key1[]" type="text" size="4" />
                    0x<input name="key1[]" type="text" size="4" />
                    0x<input name="key1[]" type="text" size="4" />
                    0x<input name="key1[]" type="text" size="4" />
                    0x<input name="key1[]" type="text" size="4" />
                    0x<input name="key1[]" type="text" size="4" />
                    0x<input name="key1[]" type="text" size="4" />
                    0x<input name="key1[]" type="text" size="4" />
                </label>
                <br />
                <label>Input key2:<br />
                    0x<input name="key2[]" type="text" size="4" />
                    0x<input name="key2[]" type="text" size="4" />
                    0x<input name="key2[]" type="text" size="4" />
                    0x<input name="key2[]" type="text" size="4" />
                    0x<input name="key2[]" type="text" size="4" />
                    0x<input name="key2[]" type="text" size="4" />
                    0x<input name="key2[]" type="text" size="4" />
                    0x<input name="key2[]" type="text" size="4" />
                </label>
                <span id="CanNotSame">*不能等于key1</span>
                <br />
                <label>Input key3:<br />
                    0x<input name="key3[]" type="text" size="4" />
                    0x<input name="key3[]" type="text" size="4" />
                    0x<input name="key3[]" type="text" size="4" />
                    0x<input name="key3[]" type="text" size="4" />
                    0x<input name="key3[]" type="text" size="4" />
                    0x<input name="key3[]" type="text" size="4" />
                    0x<input name="key3[]" type="text" size="4" />
                    0x<input name="key3[]" type="text" size="4" />
                </label>
                <input type="button" onclick="SameToKey1()" value="= key 1" />
                <br />
                <label><select name="mode">
                        <option value="encrypt">加密</option>
                        <option value="decrypt">解密</option>
                    </select>
                </label>
                <br />
                <input type="submit" value="提交" />
            </form>
        </div>
        <br />
        <!--result-->
        <div>
            <?php
            //handle the input:
            $input_data = $input_key = [];
            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                $input_data = $_POST["data"];
                $input_key1 = $_POST["key1"];
                $input_key2 = $_POST["key2"];
                $input_key3 = $_POST["key3"];
                $mode = $_POST["mode"];
            }
            if (count($input_data) !== 0 && count($input_key1) !== 0) {
                echo "input data:<br />";
                test($input_data, 1);
                echo "input key1:<br />";
                test($input_key1, 1);

                //8*8 datas and 8*8 keys:
                $bin_data = HexToBin($input_data);
                $bin_key1 = HexToBin($input_key1);
                //get 64 long's array:
                $data = BinToArray($bin_data);
                $key1 = BinToArray($bin_key1);
                //deal with key:
                $key_Ks1 = getKs($key1);
                if ($input_key2[0] != NULL) {
                    echo "input key2:<br />";
                    test($input_key2, 1);
                    $bin_key2 = HexToBin($input_key2);
                    $key2 = BinToArray($bin_key2);
                    $key_Ks2 = getKs($key2);
                } else {
                    $key_Ks2 = $key_Ks1;
                }
                if ($input_key3[0] != NULL) {
                    echo "input key3:<br />";
                    test($input_key3, 1);
                    $bin_key3 = HexToBin($input_key3);
                    $key3 = BinToArray($bin_key3);
                    $key_Ks3 = getKs($key3);
                } else {
                    $key_Ks3 = $key_Ks1;
                }

                if ($mode === "encrypt") {
                    //get 64 bit encrypted data:
                    $enc_data = Encrypt(Decrypt(Encrypt($data, $key_Ks1), $key_Ks2), $key_Ks3);
                    //64 to dec and dec to hex:
                    $dec_enc_data = ArrayToDec($enc_data);
                    $hex_enc_data = DecToHex($dec_enc_data);
                    echo "<br />";
                    echo "encription result:<br />";
                    test($hex_enc_data, 1);
                } elseif ($mode === "decrypt") {
                    //get 64 bit decrypted data:
                    $dec_data = Decrypt(Encrypt(Decrypt($data, $key_Ks3), $key_Ks2), $key_Ks1);
                    //64 to dec and dec to hex:
                    $dec_dec_data = ArrayToDec($dec_data);
                    $hex_dec_data = DecToHex($dec_dec_data);
                    echo "<br />";
                    echo "decription result:<br />";
                    test($hex_dec_data, 1);
                }
            }//end if
            ?>
        </div>
    </body>
    <script>
        function SameToKey1() {
            var key1 = document.getElementsByName("key1[]");
            var key3 = document.getElementsByName("key3[]");
            for (var i = 0; i < 8; i++) {
                key3[i].value = key1[i].value;
            }
        }
    </script>
</html>
