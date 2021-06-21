<?php

function getCurrentDate() {
    $tz = 'Europe/Amsterdam';
    $timestamp = time();
    $dt = new DateTime("now", new DateTimeZone($tz)); //first argument "must" be a string
    $dt->setTimestamp($timestamp); //adjust the object to correct timestamp

    return $dt->format('Y-m-d H:i:s');
}