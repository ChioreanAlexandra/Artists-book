<?php
function validateEmail(string $email):bool
{
    return filter_var($email,FILTER_VALIDATE_EMAIL);
}

/**
 * @param string $date
 * @return bool
 */
function validateDate(string $date)
{
    if(empty($date))
        return false;
    preg_match(DATE_PATTERN,$date,$maches);
    $year=(int) $maches['year'];
    $day=(int) $maches['day'];
    $month=(int) $maches['month'];
    $now=date("Y-m-d");
    preg_match(DATE_PATTERN,$now,$maches);
    $yearNow=(int) $maches['year'];
    $dayNow=(int) $maches['day'];
    $monthNow=(int) $maches['month'];
    if($year>$yearNow)
        return false;
    if($month>$monthNow)
        return false;
    if($day>$dayNow)
        return false;
    return true;
}

/**
 * @param string $price
 * @return bool
 */
function validateEmptyFields(): string
{
    $errors='';
    if ($_POST && $_FILES) {
        if (empty($_POST['imageTitle']) || empty($_POST[IMAGE_DESCR]) || empty($_POST[ARTIST_NAME])
            || empty($_POST[ARTIST_EMAIL]) || empty($_POST[CAMERA_SPECS]) || empty($_POST[PRICE_IMAGE])
            || empty($_POST[DATE]) || empty($_FILES[IMAGE_TAG]['name'])) {
            $errors = 'All fields are mandatory';
            return $errors;
        }
    }
    return $errors;
}

function validatePrice(string $price):bool
{
    $value=(float) $price;

    return  is_numeric($price) && $value>0;
}

/**
 * @param array $tags
 * @return bool
 */
function validateTags(array $tags):bool
{
    foreach ($tags as $value)
    {
        if(!in_array($value,TAGS))
        {
            return false;
        }
    }
    return true;
}

/**
 * @param array $inputValues
 * @return array
 */
function validateInput(array $inputValues):array
{
    $errors=[];
    if(!validateEmail($inputValues[ARTIST_EMAIL]))
    {
        $errors[ARTIST_EMAIL]='Give a valid email type';
    }
    if(!validatePrice($inputValues[PRICE_IMAGE]))
    {
        $errors[PRICE_IMAGE]='Invalid price';
    }
    /*if(!validateTags($inputValues[TAG]))
    {
        $errors[TAG]='Choose one of the given tags';
    }*/
    if(!validateDate($inputValues[DATE]))
    {
        $errors[DATE]='Give a valid date';
    }
    /*if(!validateExtension($inputValues[FILE_NAME]))
    {
        $errors[FILE_NAME]='Your file does not have a valid extension';
    }*/
    return $errors;
}