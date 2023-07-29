<!DOCTYPE html>
<html>
<head>
    <title>Customer Registration Form</title>
    <link rel="stylesheet" type="text/css" href="style/index.css">
</head>
<body>
<?php include "index.php"; ?>
<div class="register-cux">
    <h2>Customer Registration Form</h2>
    <form action="/submit_customer" method="post" onsubmit="return validateForm()">
        <label for="title">Title:</label>
        <select id="title" name="title" required>
            <option value="" disabled selected>Select Title</option>
            <option value="Mr">Mr</option>
            <option value="Mrs">Mrs</option>
            <option value="Miss">Miss</option>
            <option value="Dr">Dr</option>
        </select><br><br>

        <label for="firstName">First Name:</label>
        <input type="text" id="firstName" name="firstName" required><br><br>

        <label for="middleName">Middle Name:</label>
        <input type="text" id="middleName" name="middleName"><br><br>

        <label for="lastName">Last Name:</label>
        <input type="text" id="lastName" name="lastName" required><br><br>

        <label for="contactNumber">Contact Number:</label>
        <input type="text" id="contactNumber" name="contactNumber" required><br><br>

        <label for="district">District:</label>
        <select id="district" name="district" required>
            <option value="" disabled selected>Select District</option>
            <option value="Ampara">Ampara</option>
            <option value="Anuradhapura">Anuradhapura</option>
            <option value="Badulla">Badulla</option>
            <option value="Batticaloa">Batticaloa</option>
            <option value="Colombo">Colombo</option>
            <option value="Galle">Galle</option>
            <option value="Gampaha">Gampaha</option>
            <option value="Hambantota">Hambantota</option>
            <option value="Jaffna">Jaffna</option>
            <option value="Kalutara">Kalutara</option>
            <option value="Kandy">Kandy</option>
            <option value="Kegalle">Kegalle</option>
            <option value="Kilinochchi">Kilinochchi</option>
            <option value="Kurunegala">Kurunegala</option>
            <option value="Mannar">Mannar</option>
            <option value="Matale">Matale</option>
            <option value="Matara">Matara</option>
            <option value="Monaragala">Monaragala</option>
            <option value="Mullaitivu">Mullaitivu</option>
            <option value="Nuwara Eliya">Nuwara Eliya</option>
            <option value="Polonnaruwa">Polonnaruwa</option>
            <option value="Puttalam">Puttalam</option>
            <option value="Ratnapura">Ratnapura</option>
            <option value="Trincomalee">Trincomalee</option>
            <option value="Vavuniya">Vavuniya</option>
        </select><br><br>

        <input type="submit" value="Submit">
    </form>
</div>

<script>
    function validateForm() {
        var title = document.getElementById("title").value;
        var firstName = document.getElementById("firstName").value;
        var lastName = document.getElementById("lastName").value;
        var contactNumber = document.getElementById("contactNumber").value;
        var district = document.getElementById("district").value;

        // Check if any of the fields are empty
        if (title === "" || firstName === "" || lastName === "" || contactNumber === "" || district === "") {
            alert("Please fill in all the required fields.");
            return false; // Prevent form submission
        }

        return true; // Allow form submission
    }
</script>
</body>
</html>
