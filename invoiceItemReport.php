<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="style/index.css">
    <title>Invoice Item Report</title>
</head>
<body>
<?php //include "index.php"; ?>
<h2>Invoice Item Report</h2>
<form action="/generate_invoice_item_report" method="post" onsubmit="return validateInvoiceItemReport()">
    <label for="startDate">Start Date:</label>
    <input type="date" id="startDate" name="startDate" required><br><br>

    <label for="endDate">End Date:</label>
    <input type="date" id="endDate" name="endDate" required><br><br>


    <input type="submit" value="Generate Report">
</form>

<script>
    function validateInvoiceItemReport() {
        const startDate = document.getElementById("startDate").value;
        const endDate = document.getElementById("endDate").value;

        // Check if both start date and end date are selected
        if (startDate === "" || endDate === "") {
            alert("Please select both start and end dates.");
            return false; // Prevent form submission
        }

        // Additional custom validation can be added here

        return true; // Allow form submission
    }
</script>
</body>
</html>
