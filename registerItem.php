<?php global $mysqli;
include "connection.php"; ?>

<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get the form data
    $item_code = $_POST["item_code"];
    $item_category = $_POST["item_category"];
    $item_subcategory = $_POST["item_subcategory"];
    $item_name = $_POST["item_name"];
    $quantity = $_POST["quantity"];
    $unit_price = $_POST["unit_price"];

    // Validate the data (optional, you can add more validation here)
    if (empty($item_code) || empty($item_category) || empty($item_subcategory) || empty($item_name) || empty($quantity) || empty($unit_price)) {
        $errorMessage = "Please fill in all the required fields.";
    } else {
        // Save the data into the database
        $sql = "INSERT INTO item (item_code, item_category, item_subcategory, item_name, quantity, unit_price) VALUES ('$item_code','$item_category','$item_subcategory','$item_name','$quantity','$unit_price')";
        $result = mysqli_query($mysqli, $sql);
        $successMessage = "New record created successfully";
    }

} else {
    echo "Error: " . mysqli_error($mysqli);
}

// Initialize an array to store the district options
$item_categories = array();

// Query to select all districts from the database
$sql = "SELECT id, category FROM item_category";

// Execute the query
$result = mysqli_query($mysqli, $sql);

// Check if the query was successful
if ($result) {
    // Loop through the query results and store the districts in the array
    while ($row = mysqli_fetch_assoc($result)) {
        $item_categories[$row['id']] = $row['category'];
    }

    // Free the result set
    mysqli_free_result($result);
} else {
    // Handle the query error if needed
    echo "Error: " . mysqli_error($mysqli);
}

$item_SubCategories = array();

// Query to select all districts from the database
$sql = "SELECT id, sub_category FROM item_subcategory";

// Execute the query
$result = mysqli_query($mysqli, $sql);

// Check if the query was successful
if ($result) {
    // Loop through the query results and store the districts in the array
    while ($row = mysqli_fetch_assoc($result)) {
        $item_SubCategories[$row['id']] = $row['sub_category'];
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
    <link rel="stylesheet" type="text/css" href="style/index.css">
    <title>Item Registration Form</title>
</head>
<body>
<?php //include "index.php"; ?>
<h2>Item Registration Form</h2>
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
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" onsubmit="return validateForm()">
    <label for="item_code">Item Code:</label>
    <input type="text" id="item_code" name="item_code" required><br><br>

    <label for="item_name">Item Name:</label>
    <input type="text" id="item_name" name="item_name" required><br><br>

    <label for="item_category">Item Category:</label>
    <select id="item_category" name="item_category" required>
        <option value="" disabled selected>Select Item-Category</option>
        <?php
        // Loop through the districts array and generate the options
        foreach ($item_categories as $id => $category) {
            echo "<option value=\"$id\">$category</option>";
        }
        ?>
    </select><br><br>

    <label for="item_subcategory">Item Sub Category:</label>
    <select id="item_subcategory" name="item_subcategory" required>
        <option value="" disabled selected>Select Item-Subcategory</option>
        <?php
        // Loop through the districts array and generate the options
        foreach ($item_SubCategories as $id => $subcategory) {
            echo "<option value=\"$id\">$subcategory</option>";
        }
        ?>
    </select><br><br>

    <label for="quantity">Quantity:</label>
    <input type="number" id="quantity" name="quantity" min="1" required><br><br>

    <label for="unit_price">Unit Price:</label>
    <input type="number" id="unit_price" name="unit_price" min="0" step="0.01" required><br><br>

    <input type="submit" value="Submit">
</form>

<script>
    function validateForm() {
        const itemCode = document.getElementById("itemCode").value;
        const itemName = document.getElementById("itemName").value;
        const itemCategory = document.getElementById("itemCategory").value;
        const itemSubCategory = document.getElementById("itemSubCategory").value;
        const quantity = document.getElementById("quantity").value;
        const unitPrice = document.getElementById("unitPrice").value;

        // Check if any of the fields are empty
        if (itemCode === "" || itemName === "" || itemCategory === "" || itemSubCategory === "" || quantity === "" || unitPrice === "") {
            alert("Please fill in all the required fields.");
            return false; // Prevent form submission
        }

        return true; // Allow form submission
    }
</script>
</body>
</html>
