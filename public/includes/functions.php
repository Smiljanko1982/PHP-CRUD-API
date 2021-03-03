<?php

/********Start of Helper Functions***********/



//Function to trim values

function clean($value)
{

    return trim($value);  // $username = clean($_POST[˙username˙]);
};

//Function to sanitize strings

function sanitize($raw_value)
{
    return filter_var($raw_value, FILTER_SANITIZE_STRING); // $username = sanitize($_POST[˙username˙]);
};

//Function to validate email

function val_email($raw_email)
{

    return filter_var($raw_email, FILTER_VALIDATE_EMAIL);   // $clean_email = val_email($_POST[˙email˙]);
};

//function to validate int

function val_int($raw_int)
{
    return filter_var($raw_int, FILTER_VALIDATE_INT);   // $clean_age = val_int($_POST[˙age˙]);
};

//Function to hash passwords

function hash_pwd($raw_password)
{

    return md5($raw_password);  // $hased_password = hash_pwd($_POST[˙password˙]);

};
//Function to redirect

function redirect($url)
{
    return header("Location: {$url}"); // redirect(index.php)
};


//Function to display session messages

function set_msg($msg)
{ 
    if (empty($msg)) {          //"Welcome to your account";
        $msg = "";
    } else {
        $_SESSION['setmsg'] = $msg;
    }
};

function display_msg()
{
    if (isset($_SESSION['setmsg'])) {

        echo $_SESSION['setmsg'];

        unset($_SESSIO['setmsg']);
    }
}
