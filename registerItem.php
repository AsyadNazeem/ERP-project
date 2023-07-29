<!DOCTYPE html>
<html lang="eng">
<head>
    <title>Item Registration Form</title>
</head>
<body>
<h2>Item Registration Form</h2>
<form action="/submit_item" method="post" onsubmit="return validateForm()">
    <label for="itemCode">Item Code:</label>
    <input type="text" id="itemCode" name="itemCode" required><br><br>

    <label for="itemName">Item Name:</label>
    <input type="text" id="itemName" name="itemName" required><br><br>

    <label for="itemCategory">Item Category:</label>
    <select id="itemCategory" name="itemCategory" required>
        <option value="" disabled selected>Select Item Category</option>
        <option value="Category 1">Category 1</option>
        <option value="Category 2">Category 2</option>
        <option value="Category 3">Category 3</option>
        <!-- Add more categories as needed -->
    </select><br><br>

    <label for="itemSubCategory">Item Sub Category:</label>
    <select id="itemSubCategory" name="itemSubCategory" required>
        <option value="" disabled selected>Select Item Sub Category</option>
        <option value="Sub Category 1">Sub Category 1</option>
        <option value="Sub Category 2">Sub Category 2</option>
        <option value="Sub Category 3">Sub Category 3</option>
        <!-- Add more sub categories as needed -->
    </select><br><br>

    <label for="quantity">Quantity:</label>
    <input type="number" id="quantity" name="quantity" min="1" required><br><br>

    <label for="unitPrice">Unit Price:</label>
    <input type="number" id="unitPrice" name="unitPrice" min="0" step="0.01" required><br><br>

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

        // Additional custom validation can be added here

        return true; // Allow form submission
    }
</script>
</body>
</html>
