<?php
const LOCAL_PATH = 'uploads/';
/**
 * Creats a directory for each artist based on his name and email. We hash them for security;
 * @param string $artistName
 * @param string $email
 * @return string
 */
function createDirectory(string $artistName, string $email): string
{
    $encodePath = sprintf('%s%s%s/', LOCAL_PATH, md5($artistName), md5($email));
    if (file_exists($encodePath)) {
        return $encodePath;
    }
    mkdir($encodePath, 0777);
    return $encodePath;

}

/**
 * Saves the picture uploaded by artist to his local directory
 * @param string $path
 * @param string $imageName
 * @param string $imageLocation
 */
function saveImageToDirectory(string $path, string $imageName, string $imageLocation)
{
    move_uploaded_file($imageLocation, $path . md5($imageName));
}

/**
 * Save the informations given by artist intro a file in his directory in JSON format.
 *
 * @param array $inputsValue
 * @param $path
 */
function writeDetailsIntoFile(array $inputsValue, string $path)
{
    $contentInJSONFormat = json_encode($inputsValue);

    $handler = fopen($path . md5(INFO_FILE_NAME.$inputsValue[IMAGE_FILE_NAME]).FILE_EXTENSION, 'w');
    fwrite($handler, $contentInJSONFormat);

}
