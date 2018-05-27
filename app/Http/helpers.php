<?php

function formatDate($date)
{
    return $date->format('d-M-Y');
}

function formatDateTime($date)
{
    return $date->format('Y-M-d h:i:s A');
}

function formatDayDateTime($date)
{
    return $date->toDayDateTimeString();
}

function formatCurrency($amount)
{
    return number_format($amount,2);
}

function prettify_field($field)
{
    return title_case(snake_case(camel_case($field), ' '));
}

?>