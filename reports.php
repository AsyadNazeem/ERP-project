<?php global $mysqli;
include "connection.php"; ?>

<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get the form data
    $start_date = $_POST["startDate"];
    $end_date = $_POST["endDate"];

    // Validate the data (optional, you can add more validation here)
    if (empty($start_date) || empty($end_date)) {
        $errorMessage = "Please select both start and end dates.";
    } else {
        // Prepare the SQL query to retrieve invoices within the specified date range
        $sql = "SELECT i.invoice_no ,i.date, c.first_name, c.middle_name, c.last_name, c.district, i.item_count, i.amount 
                FROM invoice AS i 
                JOIN customer AS c ON i.id = c.id 
                WHERE i.date BETWEEN ? AND ?";

        // Prepare the statement
        $stmt = $mysqli->prepare($sql);

        // Bind the date range values to the prepared statement
        $stmt->bind_param("ss", $start_date, $end_date);

        // Execute the query
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();

        $currentDate = date("Y-m-d");
        // Check if any rows were returned
        if ($result->num_rows > 0) {
            // Display the invoice report table
            echo "<h3>Invoice Report for $start_date to $end_date</h3>";
            echo "<table>";
            echo "<tr><th>Invoice Number</th><th>Current Date</th><th>Invoiced Date</th><th>Customer</th><th>Customer District</th><th>Item Count</th><th>Amount</th></tr>";

            // Loop through the rows and display the invoice data
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["invoice_no"] . "</td>";
                echo "<td>" . $currentDate . "</td>";
                echo "<td>" . $row["date"] . "</td>";
                echo "<td>" . $row["first_name"] . " " . $row["middle_name"] . " " . $row["last_name"] . "</td>";
                echo "<td>" . $row["district"] . "</td>";
                echo "<td>" . $row["item_count"] . "</td>";
                echo "<td>" . $row["amount"] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            // If no rows were returned display a message
            echo "No invoices found.";
        }
    }
        // Close the statement and connection
        $stmt->close();
        $mysqli->close();

}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Invoice Report</title>
    <link rel="stylesheet" type="text/css" href="style/index.css">
</head>
<body>
<?php //include "index.php"; ?>
<h2>Invoice Report</h2>
<?php
// Display error message if there's any validation error or database error
if (isset($errorMessage)) {
    echo "<p class='error-message'>$errorMessage</p>";
}
?>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" onsubmit="return validateInvoiceReport()">
    <label for="startDate">Start Date:</label>
    <input type="date" id="startDate" name="startDate" required><br><br>

    <label for="endDate">End Date:</label>
    <input type="date" id="endDate" name="endDate" required><br><br>

    <input type="submit" value="Generate Report">
</form>

<script>
    function validateInvoiceReport() {
        const startDate = document.getElementById("startDate").value;
        const endDate = document.getElementById("endDate").value;

        // Check if both start date and end date are selected
        if (startDate === "" || endDate === "") {
            alert("Please select both start and end dates.");
            return false; // Prevent form submission
        }
        return true; // Allow form submission
    }
</script>
</body>
</html>
