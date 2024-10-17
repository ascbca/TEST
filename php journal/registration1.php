/*  1.Create Following registration form. 
Student Name,Student Password,Confirm Password,Enter Mobile No,Select Course,Select Hobbies,Address,Select City 

*/

<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration</title>
</head>
<body>
    <center><h2>Registration Form</h2></center>

    <form action="process1.php" method="POST">
	<table><center>
        <label for="name">Student Name:</label><br>
        <input type="text" name="student_name" required><br><br>

        <label for="password">Student Password:</label><br>
        <input type="password" name="student_password" required><br><br>

        <label for="confirm_password">Confirm Password:</label><br>
        <input type="password" name="confirm_password" required><br><br>

        <label for="mobile">Enter Mobile No:</label><br>
        <input type="text" name="mobile" required pattern="\d+"><br><br>

        <label for="course">Select Course:</label><br>
        <select name="course" required>
            <option value="">--Select Course--</option>
            <option value="Computer Science">Computer Science</option>
            <option value="Engineering">Engineering</option>
            <option value="Information Technology">Information Technology</option>
            
        </select><br><br>

        <label>Select Hobbies:</label><br>
		<input type="checkbox" name="hobbies[]" value="writing">writing<br>
        <input type="checkbox" name="hobbies[]" value="Reading">Reading<br>
		<input type="checkbox" name="hobbies[]" value="drawing">drawing<br>
        <input type="checkbox" name="hobbies[]" value="dancing">dancing<br>
        <input type="checkbox" name="hobbies[]" value="Music">Music<br>
        
        <br><br>

        <label for="address">Address:</label><br>
        <textarea name="address" required></textarea><br><br>

        <label for="city">Select City:</label><br>
        <select name="city" required>
            <option value="">--Select City--</option>
            <option value="New York">New York</option>
            <option value="Chicago">Chicago</option>
            <option value="Los Angeles">Los Angeles</option>
           
        </select><br><br>

        <input type="submit" name="submit" value="Registration">
		</center></table>
    </form>

		
</body>
</html>
