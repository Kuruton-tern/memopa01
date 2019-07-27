<?php

$arr = array(
    array(
        'name' => 'yamada',
        'age'  => '20'
    ),
    array(
        'name' => 'satou',
        'age'  => '20'
    ),
    array(
        'name' => 'suzuki',
        'age'  => '30'
    ),
    array(
        'name' => 'tanaka',
        'age'  => '40'
    )
);

$category = array(
    array(
            "id" => "10",
            "name" => "test",
            "user_id" => "45",
            "delete_flg" => "0",
            "create_date" => "2019-07-19 10:01:26",
            "update_date" => "2019-07-19 10:01:26"
    ),

    array(
            "id" => "13",
            "name" => "ああああ",
            "user_id" => "45",
            "delete_flg" => "0",
            "create_date" => "2019-07-19 22:48:59",
            "update_date" => "2019-07-19 22:48:59"
    ),

    array(
            "id" =>" 10",
            "name" => "やらないこと",
            "user_id" => "45",
            "delete_flg" => "0",
            "create_date" => "2019-07-19 22:49:43",
            "update_date" => "2019-07-19 22:49:43"
    ),

    array(
            "id" => "13",
            "name" => "todo",
            "user_id" => "45",
            "delete_flg" => "0",
            "create_date" => "2019-07-19 22:54:11",
            "update_date" => "2019-07-19 22:54:11"
    ),

    array(
            "id" =>" 14",
            "name" => "食べたいもの",
            "user_id" => "45",
            "delete_flg" => "0",
            "create_date" => "2019-07-19 22:55:08",
            "update_date" => "2019-07-19 22:55:08"
    ),

    array(
            "id" =>" 10",
            "name" => "かいたいもの",
            "user_id" => "45",
            "delete_flg" => "0",
            "create_date" => "2019-07-19 22:56:05",
            "update_date" => "2019-07-19 22:56:05"
        )
        );


function groupArray($category, $key) {
    $retval = array();

    foreach($category as $value) {
        $group = $value[$key];

        if (!isset($retval[$group])) {
            $retval[$group] = array();
        }

        $retval[$group][] = $value;
    }

    return $retval;
  }
  var_dump('$retvalの中身：'.$retval);

var_dump(groupArray($castegory, 'id'));
echo "<br />";
print_r(groupArray($category, 'id'));



function getgroupArray($arr, $key)  //関数の宣言
{
    $retval = array();  // $retval配列の初期化

    foreach ($arr as $value) {  //$arrの$valueを取り出す。
        $group = $value[$key];  //$value[$key]で、特定の値を$groupに代入する

        if (!isset($retval[$group])) {  //$retval配列の中の$group変数が空でなければ、
            $retval[$group] = array();  //配列を初期化
        }

        $retval[$group][] = $value;  //
    }

    return $retval;  //
}

?>