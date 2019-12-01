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

function alertError( $msg ) {
    echo "<script>console.log({$msg});</script>";
}


?>