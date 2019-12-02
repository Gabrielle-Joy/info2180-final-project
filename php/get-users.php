<?php

require_once("connection.php");

$default_query = "SELECT * FROM users";

function get_users($fields) {
    $fieldStr = "*";
    if( $fields ){
        $fieldStr = $fields[0];
        foreach (array_slice($fields, 1) as $field) {
            $fieldStr .= ", {$field}";
        }
    }    

    // $query = "SELECT {$fieldStr} FROM users WHERE id!=1";
    $query = "SELECT {$fieldStr} FROM users";
    return query($query, $many=true);
}