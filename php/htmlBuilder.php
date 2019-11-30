<?php

function table_headings($headings) {
    $table_headings = "";
    foreach( $headings as $heading ) {
        $table_headings .= th($heading);
    }
    return tr($table_headings);
}

/* HTML generator functions - return html as string*/
function table($table_data) {
    return "<table>{$table_data}</table>";
}

function tr($row_data) {
    return "<tr>{$row_data}</tr>";
}

function td($row_cell) {
    return "<td>{$row_cell}</td>";
}

function th($heading) {
    return "<th>{$heading}</th>";
}

function options($optionList) {
    $options = "<option value selected disabled hidden>--select option--</option>";
    foreach ($optionList as $value => $display) {
        $options .= option($value, $display);
    }
    return $options;
}

function option($value, $display) {
    return "<option value={$value}>{$display}</option>";
}

function alertError( $msg ) {
    echo "<script>console.log({$msg});</script>";
}


?>