<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $student_name = $_POST['student_name'];
    $student_password = $_POST['student_password'];
    $confirm_password = $_POST['confirm_password'];
    $mobile = $_POST['mobile'];
    $course = $_POST['course'];
    $hobbies = isset($_POST['hobbies']) ? $_POST['hobbies'] : [];
    $address = $_POST['address'];
    $city = $_POST['city'];

    // Validation flags
    $errors = [];

    // 1. All fields must be filled
    if (empty($student_name) || empty($student_password) || empty($confirm_password) || empty($mobile) || empty($course) || empty($address) || empty($city)) {
        $errors[] = "All fields must be filled.";
    }

    // 2. Password must be at least 8 characters long
    if (strlen($student_password) < 8) {
        $errors[] = "Password must be at least 8 characters long.";
    }

    // 3. Password and confirm password must match
    if ($student_password !== $confirm_password) {
        $errors[] = "Passwords do not match.";
    }

    // 4. Mobile number must contain only digits
    if (!ctype_digit($mobile)) {
        $errors[] = "Mobile number must contain only digits.";
    }

    // 5. Must select at least one hobby
    if (empty($hobbies)) {
        $errors[] = "You must select at least one hobby.";
    }

    // Check for errors
    if (empty($errors)) {
        // If no errors, display student data in tabular form
        echo "<h2>Student Registration Successful</h2>";
        echo "<table border='1'>
                <tr><th>Field</th><th>Value</th></tr>
                <tr><td>Student Name</td><td>" . htmlspecialchars($student_name) . "</td></tr>
                <tr><td>Mobile No</td><td>" . htmlspecialchars($mobile) . "</td></tr>
                <tr><td>Course</td><td>" . htmlspecialchars($course) . "</td></tr>
                <tr><td>Hobbies</td><td>" . htmlspecialchars(implode(", ", $hobbies)) . "</td></tr>
                <tr><td>Address</td><td>" . htmlspecialchars($address) . "</td></tr>
                <tr><td>City</td><td>" . htmlspecialchars($city) . "</td></tr>
              </table>";
    } else {
        // If there are errors, display them
        echo "<h2>Errors</h2><ul>";
        foreach ($errors as $error) {
            echo "<li>" . htmlspecialchars($error) . "</li>";
        }
        echo "</ul>";
        echo "<a href='Registration1.php'>Go back to the form</a>";
    }
}
?>
