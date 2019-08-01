<?php
const HELP_FILE_NAME="help.txt";

function showHelp()
{
    $helpOutput=file_get_contents(HELP_FILE_NAME);
    echo $helpOutput.PHP_EOL;
}

function showError(string $errorText)
{
    echo $errorText;
}

function showSuccess(string $path)
{
   // echo 'Your image have been successfully edited. You can find it at: '.$path.'<br>';
}