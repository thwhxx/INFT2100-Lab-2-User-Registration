<?php
require ('./includes/header.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = array();

    // Validate form fields (you can add more validation as needed)
    $phoneNumber = $_POST['PhoneNumber'];
    $email = $_POST['EmailAddress'];
    $firstName = $_POST['FirstName'];
    $lastName = $_POST['LastName'];

    // Check if fields are not empty
    if (empty($phoneNumber) || empty($email) || empty($firstName) || empty($lastName)) {
        $errors[] = "All fields are required.";
    }

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    if (empty($errors)) {
        $conn = pg_connect("host=".DB_HOST." user=".DB_USER." password=".DB_PASSWORD." dbname=".DB_NAME);

        // Create a new client
        $sql = "INSERT INTO clients (EmailAddress, FirstName, Lastname, PhoneNumber)
                VALUES ('$email', '$firstName', '$lastName', '$phoneNumber')";

        $result = pg_query($conn, $sql);

        if ($result) {
            $_SESSION['message'] = "Client created successfully!";
            redirect('clients.php');
        } else {
            echo "Error: " . pg_last_error($conn);
        }

        pg_close($conn);
    } else {
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
    }
}
?>
    <form method="POST" action="" class="form-signin">
        <h1 class="h3 mb-3 font-weight-normal">Create Clients</h1>
        <?php echo display_form_clients(); ?>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Create</button>
    </form>

    <?php
        if(isset($_SESSION['message'])) {
            echo $_SESSION['message'];
            unset($_SESSION['message']); // Clear the error message
        }
        if(isset($_SESSION['message'])) {
            echo $_SESSION['message'];
            unset($_SESSION['message']); // Clear the success message
        }
?>

<?php 
require_once "./includes/footer.php";
?>