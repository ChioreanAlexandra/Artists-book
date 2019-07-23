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
 *
 * @param string $path
 * @param string $uniqueImageName
 * @param string $extension
 * @param string $imageLocation
 */
function saveImageToDirectory(string $path, string $uniqueImageName, string $extension, string $imageLocation)
{
    move_uploaded_file($imageLocation, $path . $uniqueImageName .'.'. $extension);
}

/**
 * Save the informations given by artist intro a file in his directory in JSON format and return path.
 *
 * @param array $inputsValue
 * @param string $path
 * @param string $uniqueName
 * @return string
 */
function writeDetailsIntoFile(array $inputsValue, string $path, string $uniqueName)
{
    $contentInJSONFormat = json_encode($inputsValue);
    $composedPath = sprintf("%s%s%s", $path, $uniqueName, DATA_FILE_EXTENSION);
    $handler = fopen($composedPath, 'w');
    fwrite($handler, $contentInJSONFormat);
    return $composedPath;

}
