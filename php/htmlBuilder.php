<?php

function table_headings($headings, $classY="") {
    $table_headings = "";
    foreach( $headings as $heading ) {
        $table_headings .= th($heading);
    }
    return tr($table_headings, "", $class=$classY);
}

/* HTML generator functions - return html as string*/
function table($table_data) {
    return "<table>{$table_data}</table>";
}

function tr($row_data, $id="", $class="") {
    if ($id){
        return "<tr onclick='viewDetailedIssue($id)' class='$class'>{$row_data}</tr>";
    } else
        return "<tr class='$class'>{$row_data}</tr>";
}

function td($row_cell) {
    return "<td>{$row_cell}</td>";
}

function th($heading) {
    return "<th>{$heading}</th>";
}

function options( $opList, $selected="" ) {
    $result = option("", "-- select here --");
    foreach ($opList as $value => $msg) {
        if ( (string)$value === $selected) {
            $result .= option($value, $msg, $selected=true);
        } else {
            $result .= option($value, $msg);
        }
    }
    return $result;
}

function option( $value, $msg, $selected=false ) {
    if ($selected) {
        return "<option value={$value} selected>{$msg}</option>";
    }
    return "<option value={$value}>{$msg}</option>";
}

function alertError( $msg ) {
    echo "<script>console.log({$msg});</script>";
}


?>