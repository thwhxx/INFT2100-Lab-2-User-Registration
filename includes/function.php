<?php

function redirect($url) {
    header("Location:". $url);
    ob_flush();
    exit;
}

function is_logged_in() {
    if(!isset($_SESSION['user_id'])) {
        header("Location: sign-in.php"); // Redirect to sign-in.php
        ob_flush();
        exit();
    }
}

function displayMessageOnce() {
    if(isset($_SESSION['message'])) {
        echo '<div class="alert alert-success">'.$_SESSION['message'].'</div>';
        unset($_SESSION['message']); // Clear the error message
    }
}


function generate_dynamic_nav() {
    // Check if a user is logged in
    if(isset($_SESSION['user_id'])) {
        // If user is logged in, display link to dashboard.php and logout.php
        echo '<a class="nav-link" href="dashboard.php">Dashboard</a>';
        echo '<a class="nav-link" href="logout.php">Logout</a>';
    } else {
        // If user is not logged in, display link to sign-in.php
        echo '<a class="nav-link" href="sign-in.php">Sign In</a>';
    }

    // Always display link to index.php (Home)
    echo '<a class="nav-link" href="index.php">Home</a>';
}


function log_activity($userSelected) {
    $updateFile = fopen("DATA_LOG.txt", "a");
    $text = "Sign in success at " . date('Y-m-d h:i:s') . " for user " . $userSelected['email'] . "\n";
    fwrite($updateFile, $text);
    fclose($updateFile);
}

?>

<!-- lab 2 -->

<?php

function show_create_salespeople() {
    if (isset($_SESSION['user_type']) && ($_SESSION['user_type'] == 'a' || $_SESSION['user_type'] == 's')) {
        echo '<a class="nav-link" href="salespeople.php">';
        echo '<span data-feather="layers"></span>';
        echo 'Salespeople';
        echo '</a>';
    }
}

function show_create_client() {
    if (isset($_SESSION['user_type']) && ($_SESSION['user_type'] == 'a' || $_SESSION['user_type'] == 's')) {
        echo '<a class="nav-link" href="clients.php">';
        echo '<span data-feather="layers"></span>';
        echo 'Clients';
        echo '</a>';
    }
}

function show_create_calls() {
    if (isset($_SESSION['user_type']) && ($_SESSION['user_type'] == 'a' || $_SESSION['user_type'] == 's')) {
        echo '<a class="nav-link" href="calls.php">';
        echo '<span data-feather="layers"></span>';
        echo 'Calls';
        echo '</a>';
    }
}


function display_form($formData = array()) {
    $fields = array(
        array(
            "type" => "text",
            "name" => "first_name",
            "value" => isset($formData['first_name']) ? $formData['first_name'] : "",
            "label" => "First Name"
        ),
        array(
            "type" => "text",
            "name" => "last_name",
            "value" => isset($formData['last_name']) ? $formData['last_name'] : "",
            "label" => "Last Name"
        ),
        array(
            "type" => "email",
            "name" => "email",
            "value" => isset($formData['email']) ? $formData['email'] : "",
            "label" => "Email"
        ),
        array(
            "type" => "password",
            "name" => "password_hash",
            "value" => isset($formData['password_hash']) ? $formData['password_hash'] : "",
            "label" => "Password"
        ),
        array(
            "type" => "number",
            "name" => "phone_extension",
            "value" => isset($formData['phone_extension']) ? $formData['phone_extension'] : "",
            "label" => "Extension"
        )
    );

    $formContent = '';

    foreach($fields as $field) {
        $formContent .= "

            <input class='form-control' type='{$field['type']}' id='{$field['name']}' name='{$field['name']}' value='{$field['value']}' placeholder='{$field['label']}' required>
        ";
    }

    return $formContent;
}

function display_form_clients($formData = array()) {
    $fields = array(
        array(
            "type" => "text",
            "name" => "FirstName",
            "value" => isset($formData['FirstName']) ? $formData['FirstName'] : "",
            "label" => "First Name"
        ),
        array(
            "type" => "text",
            "name" => "LastName",
            "value" => isset($formData['LastName']) ? $formData['LastName'] : "",
            "label" => "Last Name"
        ),
        array(
            "type" => "email",
            "name" => "Email",
            "value" => isset($formData['Email']) ? $formData['Email'] : "",
            "label" => "Email"
        ),
        array(
            "type" => "number",
            "name" => "PhoneNumber",
            "value" => isset($formData['PhoneNumber']) ? $formData['PhoneNumber'] : "",
            "label" => "Extension"
        )
    );

    $formContent = '';

    foreach($fields as $field) {
        $formContent .= "

            <input class='form-control' type='{$field['type']}' id='{$field['name']}' name='{$field['name']}' value='{$field['value']}' placeholder='{$field['label']}' required>
        ";
    }

    return $formContent;

}

function display_form_calls($formData = array()) {
    $fields = array(
        array(
            "type" => "datetime-local",
            "name" => "CallDateTime",
            "value" => isset($formData['CallDateTime']) ? $formData['CallDateTime'] : "",
            "label" => "Call Date and Time"
        ),
        array(
            "type" => "text",
            "name" => "Notes",
            "value" => isset($formData['Notes']) ? $formData['Notes'] : "",
            "label" => "Notes"
        ),
    );

    $formContent = '';

    foreach($fields as $field) {
        $formContent .= "

            <input class='form-control' type='{$field['type']}' id='{$field['name']}' name='{$field['name']}' value='{$field['value']}' placeholder='{$field['label']}' required>
        ";
    }

    return $formContent;

}

//             <label class='form-signin' for='{$field['name']}'>'{$field["label"]}'</label>

