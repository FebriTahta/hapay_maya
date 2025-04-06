<?php
function convertToDisplayDateFormat($date)
{
    $dateObj = DateTime::createFromFormat('d/m/Y', $date);
    return $dateObj ? $dateObj->format('Y-m-d') : null;
}

function convertToDisplayDateFormatMidString($date)
{
    $dateObj = DateTime::createFromFormat('d-M-y', $date);
    return $dateObj ? $dateObj->format('Y-m-d') : null;
}