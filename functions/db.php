<?php 
// $link = mysqli_connect('localhost', 'root', 'root', 'certifi'); // Local
// $link = mysqli_connect('localhost', 'immuneeh_comp205', 'comp205', 'immuneeh_certifi');    //LIVE
$link = mysqli_connect('192.185.39.248', 'immuneeh_comp205', 'comp205', 'immuneeh_certifi');    //Testing

/* I took a course, which suggested rewriting some database functions. In the event you are using a different
type of database, like postgres, mongoDB, etc, you can just change these functions and not your entire code. */

//shorthand escape function.
function escape($string) {
    global $link;
    $string = trim($string);

    return mysqli_real_escape_string($link, $string);
}

//shorthand query function
function query($query) {
    global $link; 

    return mysqli_query($link, $query);
}

//shorthand confirm function.
function confirm($result) {
    global $link;
    
    if (!$result) {
        die("Query failed" . mysqli_error($link));
    }
}

//shorthand fetch_array function
function fetch_array($result) {
    global $link;
    return mysqli_fetch_array($result);
}

function fetch_row($result) {
    global $link;
    return mysqli_fetch_row($result);
}

//Count the records
function row_count($result) {
    return mysqli_num_rows($result);
}

?>