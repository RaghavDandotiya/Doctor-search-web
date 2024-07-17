<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "doctor";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: ". $conn->connect_error);
}
$reg_no = $_POST['reg_no'];
$name = $_POST['name'];
$qualification = $_POST['qualification'];
$specialization = $_POST['specialization'];
$age = $_POST['age'];
$experience = $_POST['experience'];
$fee = $_POST['fee'];
$address = $_POST['address'];
$aadhar = $_POST['aadhar'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$country = $_POST['country'];
$state = $_POST['state'];
$city = $_POST['city'];
$clinic = $_POST['clinic'];
$pincode = $_POST['pincode'];
$gender = $_POST['gender'];
$reg_no = $_POST['reg_no'];


$sql = "SELECT COUNT(*) FROM doctors WHERE reg_no =?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $reg_no);


$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$count = $row['COUNT(*)'];

if ($count > 0) {
    echo "Already Registered!";
} else {
    // Execute SQL statement
    $sql = "INSERT INTO doctors (reg_no, name, qualification, specialization, age, experience, fee, address, aadhar, email, phone, country, state, city, clinic, pincode, gender) VALUES ('$reg_no', '$name', '$qualification', '$specialization', '$age', '$experience', '$fee', '$address', '$aadhar', '$email', '$phone', '$country', '$state', '$city', '$clinic', '$pincode', '$gender')";
    $conn->query($sql);

    // Close connection
    $conn->close();
    header('Location: doc_reg.html');
}

?>