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

        unset($_SESSION['setmsg']);
    }
}

function process_registration()
{
    if (isset($_POST['submit_registration'])) {

        //echo 'is send';

        $raw_name = clean($_POST['name']);
        $raw_sex =  clean($_POST['sex']);
        $raw_email = clean($_POST['email']);
        $raw_password = clean($_POST['password']);

        $cl_name = sanitize($raw_name);
        $cl_sex = sanitize($raw_sex);
        $cl_email = val_email($raw_email);
        $cl_password = sanitize($raw_password);

        //Hashed Password
        $hashed_password = hash_pwd($cl_password);

        //Check for right format image
        $allowed_image = array('png', 'jpeg', 'jpg', 'bmp');

        $raw_image = $_FILES['image']['name'];

        $image_ext = pathinfo($raw_image, PATHINFO_EXTENSION);

        if (!in_array($image_ext, $allowed_image)) {

            redirect('register.php');

            set_msg('<div class="alert alert-danger">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Warning!</strong> Sorry, the file type is not allowed. Please try again!
          </div>');
        } else {
            //attach random value bettween from 1000 to 1000000 to the file
            $new_image = rand(1000, 100000) . "_" . $_FILES['image']['name'];

            //Temporary folder for file
            $temp_folder = $_FILES['image']['tmp_name'];

            // Will change the filename to lower cases
            $new_image_name = strtolower($new_image);

            //Final image in for of a string
            $cl_image = str_replace('', '_', $new_image_name);

            $folder = "uploaded_image/";

            require_once('pdo.php');
            //Instanciating our object from the dbase class
            $db = new dbase;

            //Check if user already exist
            $db->query('SELECT * FROM users WHERE email = :email');

            $db->bind(':email', $cl_email, PDO::PARAM_STR);

            $get_user = $db->fetchSingle();

            if ($get_user > 0) {

                redirect('login.php');

                set_msg('<div class="alert alert-danger text-center" >
                    <a href="#" class="close" data-dismiss="alert" ariel-label="close">&times</a>
                    <strong>Hi !</strong> You have already registered or your email is already taken. Please go to Login or try register with different mail. Thank You.
                  </div>');
            } elseif (move_uploaded_file($temp_folder, $folder . $cl_image)) {



                $db->query('INSERT INTO users(id, fullname, sex, password, image, email) VALUES(NULL, :fullname, :sex, :password, :image, :email)');


                $db->bind(':fullname', $cl_name, PDO::PARAM_STR);
                $db->bind(':sex', $cl_sex, PDO::PARAM_STR);
                $db->bind(':password', $hashed_password, PDO::PARAM_STR);
                $db->bind(':image', $cl_image, PDO::PARAM_STR);
                $db->bind(':email', $cl_email, PDO::PARAM_STR);
                print_r($db);

                $run = $db->execute();

                if ($run) {

                    redirect('login.php');

                    set_msg('<div class="alert alert-success text-center">
                    <a href="#" class="close" data-dismiss="alert" ariel-label="close">&times;</a>
                    <strong>Success!</strong> Registration successfull. Please Login.
                  </div>');
                } else {
                    echo '<div class="alert alert-danger text-center" >
                    <a href="#" class="close" data-dismiss="alert" ariel-label="close">&times</a>
                    <strong>Sorry!</strong> Registration not successfull. Please try again.
                  </div>';
                }
            }
        }
    }
}
