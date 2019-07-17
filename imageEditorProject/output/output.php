<?php
const HELP_FILE_NAME="help.txt";
function showHelp()
{
    $handler=fopen(HELP_FILE_NAME,'r');
    while(!feof($handler))
    {
       echo fgets($handler);
    }

}
function showError(string $errorText)
{
    echo $errorText;
}