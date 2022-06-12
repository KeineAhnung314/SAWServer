<?php 

function sanitationint($value)
{
//Sanitate value

    $value = str_replace(['+', '-'], '', filter_var($value, FILTER_SANITIZE_NUMBER_INT)); //sanitize input

    return $value; 
}

function sanitationfloat($value)
{
//Sanitate value

    $value = str_replace([','],'.',$value);
    $value = filter_var($value, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION); //sanitize input
    
    return $value; 
}

function sanitationstring($value)
{
//Sanitate value

    $value = str_replace(['+', '-'], '', filter_var($value, FILTER_SANITIZE_STRING)); //sanitize input

    return $value; 
}