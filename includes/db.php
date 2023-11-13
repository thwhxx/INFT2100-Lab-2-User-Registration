<?php

$connection = pg_connect("host=".DB_HOST." user=".DB_USER." password=".DB_PASSWORD." dbname=".DB_NAME);

function db_connect() {
    $connection = pg_connect("host=".DB_HOST." user=".DB_USER." password=".DB_PASSWORD." dbname=".DB_NAME);
    return $connection;
}

$getuser = pg_prepare($connection, "getuser", "SELECT * FROM users WHERE email = $1");

function user_select($email) {
    $connection = db_connect();
    $query = "SELECT * FROM users WHERE email = $1";
    $result = pg_prepare($connection, "user_select", $query);
    $result = pg_execute($connection, "user_select", array($email));
    
    $user = pg_fetch_assoc($result);

    if ($user) {
        return $user;
    } else {
        return false;
    }
}
    function user_authenticate($email, $password) {
        $connection = db_connect();
        $query = pg_prepare($connection, "user_authenticate", "SELECT * FROM users WHERE email = $1 AND password_hash = $2");
        if (!$query) {
            echo "Prepare failed: " . pg_last_error($connection);
            exit;
        }
        $result = pg_execute($connection, "user_authenticate", array($email, $password));

        return $result;
    }
    
function is_succesful($email) {
    if (user_select($email)) {
        return true;
    } else {
        return false;
    }
}

function create_salesperson($first_name, $last_name, $email, $phone_extension, $password) {
    $conn = pg_connect("host=".DB_HOST." user=".DB_USER." password=".DB_PASSWORD." dbname=".DB_NAME);

    $result = pg_execute($conn, "getuser", array($email));

    if(pg_num_rows($result) > 0) {
        $_SESSION['message'] = "Email already exist";
    } else {

        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        $created_time = date("Y-m-d h:i:sa");
        $last_login_time = date("Y-m-d h:i:sa");
        $user_type = "s";

        $query = pg_prepare($conn,"create_salespeople", "INSERT INTO users (email, first_name, last_name, password_hash, created_time, last_login_time, phone_extension, user_type) VALUES ($1, $2, $3, $4, $5, $6, $7, $8)");

        if (!$query) {
            die("Connection failed: " . pg_last_error());
        }

        $result = pg_execute($conn,"create_salespeople", array($email, $first_name, $last_name, $password_hash, $created_time, $last_login_time, $phone_extension, $user_type));
    
        if ($result) {
            echo "New record created successfully";
        } else {
            echo "Error: " . pg_last_error($conn);
        }
    
        pg_close($conn);
    }

}



?>