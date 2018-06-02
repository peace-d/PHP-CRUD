<?php
/**
 * Created by PhpStorm.
 * User: Optimus Prime
 * Date: 2018/06/03
 * Time: 01:45 AM
 * Description:
 * Copyright: This system/file is owned by Peace Dube. Unauthorised copying is prohibited
 */

function selectOptions($optionsArray, $selectedOption=null)
{
    $selectOptions = '';
    foreach ($optionsArray as $key=>$val)
    {
        if ($selectedOption && ($key == $selectedOption)) $selected = 'selected';
        else $selected = '';
        $selectOptions .= "<option value='$key' $selected>$val</option>";
    }
    return $selectOptions;
}