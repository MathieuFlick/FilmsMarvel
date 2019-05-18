<?php
/**
 * Useful function for project
 */

if(!file_exists($_SERVER['DOCUMENT_ROOT']."/resources/movies")) {
    @mkdir($_SERVER['DOCUMENT_ROOT']."/resources/movies", 0777, true);
}
if(!file_exists($_SERVER['DOCUMENT_ROOT']."/resources/filecount.txt")) {
    $handle = fopen($_SERVER['DOCUMENT_ROOT']."/resources/filecount.txt", "w+");
    fwrite($handle, "0");
    fclose($handle);
}
if(file_exists($_SERVER['DOCUMENT_ROOT']."/resources/movies/.directory")) {
    unlink($_SERVER['DOCUMENT_ROOT']."/resources/movies/.directory");
}