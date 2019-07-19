<?php
const LOCAL_PATH='/home/alexandrachiorean/Documents/uploads_artists-book/';
const INFO_FILE_NAME='info.txt';
function createDirectory(string $artistName, string $email):string
{
    $encodePath=sprintf('%s%s%s/',LOCAL_PATH,md5($artistName),md5($email));
    echo "This is my encode path".$encodePath;
    if(file_exists($encodePath))
    {
        return $encodePath;
    }
    mkdir($encodePath,0777);
    return $encodePath;

}
function saveImage(string $path, string $imageName, string $imageLocation)
{
    move_uploaded_file($imageLocation,$path.$imageName);
}
function saveFile(array $inputsValue,$path)
{
    $contentInJSONFormat=json_encode($inputsValue);
    $handler=fopen($path.INFO_FILE_NAME,'w');
    fwrite($handler,$contentInJSONFormat);

}
