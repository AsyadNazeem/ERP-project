<?php global $mysqli;
include "connection.php"; ?>

<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get the form data
    $title = $_POST["title"];
    $first_name = $_POST["first_name"];
    $middle_name = $_POST["middle_name"];
    $last_name = $_POST["last_name"];
    $contact_no = $_POST["contact_no"];
    $district = $_POST["district"];

    // Validate the data (optional, you can add more validation here)
    if (empty($title) || empty($first_name) || empty($middle_name) || empty($last_name) || empty($contact_no) || empty($district)) {
        $errorMessage = "Please fill in all the required fields.";
    } else {
        // Save the data into the database
        $sql = "INSERT INTO customer (title, first_name, middle_name, last_name, contact_no, district) VALUES ('$title','$first_name','$middle_name','$last_name','$contact_no','$district')";
        $result = mysqli_query($mysqli, $sql);
        $successMessage = "New record created successfully";
    }

}else{
    echo "Error: " . mysqli_error($mysqli);
}

// Initialize an array to store the district options
$districts = array();

// Query to select all districts from the database
$sql = "SELECT district, id FROM district";

// Execute the query
$result = mysqli_query($mysqli, $sql);

// Check if the query was successful
if ($result) {
    // Loop through the query results and store the districts in the array
    while ($row = mysqli_fetch_assoc($result)) {
        $districts[$row['id']] = $row['district'];
    }

    // Free the result set
    mysqli_free_result($result);
} else {
    // Handle the query error if needed
    echo "Error: " . mysqli_error($mysqli);
}
?>


<!DOCTYPE html>
<html lang="eng">
<head>
    <title>Customer Registration Form</title>
    <link rel="stylesheet" type="text/css" href="style/index.css">
</head>
<body>
<?php include "index.php"; ?>
<div class="register-cux">
    <h2>Customer Registration Form</h2>
    <?php
    // Display success message if registration is successful
    if (isset($successMessage)) {
        echo "<p class='success-message'>$successMessage</p>";
    }

    // Display error message if there's any validation error or database error
    if (isset($errorMessage)) {
        echo "<p class='error-message'>$errorMessage</p>";
    }
    ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" onsubmit="return validateForm()>
        <label for="title">Title:</label>
        <select id="title" name="title" required>
            <option value="" disabled selected>Select Title</option>
            <option value="Mr">Mr</option>
            <option value="Mrs">Mrs</option>
            <option value="Miss">Miss</option>
            <option value="Dr">Dr</option>
        </select><br><br>

        <label for="first_name">First Name:</label>
        <input type="text" id="first_name" name="first_name" required><br><br>

        <label for="middle_name">Middle Name:</label>
        <input type="text" id="middle_name" name="middle_name" required><br><br>

        <label for="last_name">Last Name:</label>
        <input type="text" id="last_name" name="last_name" required><br><br>

        <label for="contact_no">Contact Number:</label>
        <input type="number" id="contact_no" name="contact_no" required><br><br>

        <label for="id">District:</label>
        <select id="id" name="district" required>
            <option value="" disabled selected>Select District</option>
            <?php
            // Loop through the districts array and generate the options
            foreach ($districts as $id => $district) {
                echo "<option value=\"$id\">$district</option>";
            }
            ?>
        </select><br><br>

        <input type="submit" value="Submit">
    </form>
</div>

<script>
    function validateForm() {
        const title = document.getElementById("title").value;
        const firstName = document.getElementById("first_name").value;
        const middleName = document.getElementById("middle_name").value;
        const lastName = document.getElementById("last-name").value;
        const contactNumber = document.getElementById("contact_no").value;
        const district = document.getElementById("district").value;

        // Check if any of the fields are empty
        if (title === "" || firstName === "" || middleName === "" || lastName === "" || contactNumber === "" || district === "") {
            alert("Please fill in all the required fields.");
            return false; // Prevent form submission
        }

        return true; // Allow form submission
    }
</script>

</body>
</html>
