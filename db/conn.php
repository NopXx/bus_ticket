<?php

// start connect database
$GLOBALS['conn'] = mysqli_connect('localhost', 'root', '');
if (!$conn) {
    echo 'Connect Database Failed';
} else {
    mysqli_select_db($conn, "bus");
    mysqli_set_charset($conn, 'utf8');
}
// end connect database

?>