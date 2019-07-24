<?php
session_start();
include "constants.php";
/**
 * @param string $path
 * @return string
 */
function readFormatDataFromFile(string $path):string
{
    return file_get_contents($path);
}

/**
 * Decode file from json and return it as an array
 *
 * @param string $content
 * @return array
 */
function decodeFile(string $content):array
{
    return json_decode($content, true);
}

/**
 * Extract folder path for using it when loading the image
 * @param string $filePath
 * @return string
 */
function getFolderPath(string $filePath):string
{
    preg_match('/(?<folderPath>.*\/)/',$filePath,$match);
    return $match['folderPath'];
}