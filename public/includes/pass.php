<?php

function get_username($file_name)
{
    $lines = file($file_name);
    $credentials = array();

    foreach ($lines as $line) {
        if (empty($line)) {
            continue;
        }

        // whole line
        $line = trim(str_replace(": ", ':', $line));
        $lineArr = explode(' ', $line);

        $username = explode(':', $lineArr[0]);
        $username = array_pop($username);
        return $username;
    }
}

function get_password($file_name)
{
    $lines = file($file_name);
    $credentials = array();

    foreach ($lines as $line) {
        if (empty($line)) {
            continue;
        }

        // whole line
        $line = trim(str_replace(": ", ':', $line));
        $lineArr = explode(' ', $line);

        // password
        $password = explode(':', $lineArr[1]);
        $password = array_pop($password);
        return $password;
    }
}
