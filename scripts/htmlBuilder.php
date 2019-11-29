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

function alertError( $msg ) {
    echo "<script>alert({$msg})</alert>";
}


?>