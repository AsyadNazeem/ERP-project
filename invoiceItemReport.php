<?php
global $mysqli;
include "Connection.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $start_date = $_POST["startDate"];
    $end_date = $_POST["endDate"];

    if (empty($start_date) || empty($end_date)) {
        $errorMessage = "Please select both start and end dates.";
    } else {
        $sql = "SELECT i.invoice_no, i.date AS invoiced_date, c.first_name, c.middle_name ,c.last_name, 
                it.item_name, it.item_code, it.item_category, it.unit_price
                FROM invoice AS i
                JOIN customer AS c ON i.id = c.id
                JOIN item AS it ON c.id = it.id
                WHERE i.date BETWEEN ? AND ?";

        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("ss", $start_date, $end_date);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "<h3>Invoice Item Report for $start_date to $end_date</h3>";
            echo "<table>";
            echo "<tr><th>Invoice Number</th><th>Invoiced Date</th><th>Customer Name</th><th>Item Code and Name</th><th>Item Category</th><th>Item Unit Price</th></tr>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["invoice_no"] . "</td>";
                echo "<td>" . $row["invoiced_date"] . "</td>";
                echo "<td>" . $row["first_name"] . " " . $row["middle_name"] . " " . $row["last_name"] . "</td>";
                echo "<td>" . $row["item_code"] . " " . $row["item_name"] . "</td>";
                echo "<td>" . $row["item_category"] . "</td>";
                echo "<td>" . $row["unit_price"] . "</td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "No invoice items found for the selected date range.";
        }

        $stmt->close();
        $mysqli->close();
    }
}
?>
<!DOCTYPE html>
<html lang="eng">
<head>
    <link rel="stylesheet" type="text/css" href="style/index.css">
    <title>Invoice Item Report</title>
</head>
<body>
<?php include "sidebar.php"; ?>
<div class="invoice-report">
    <h2>Invoice Item Report</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"
          onsubmit="return validateInvoiceItemReport()">
        <label for="startDate">Start Date:</label>
        <input type="date" id="startDate" name="startDate" required><br><br>

        <label for="endDate">End Date:</label>
        <input type="date" id="endDate" name="endDate" required><br><br>

        <input type="submit" value="Generate Report">
    </form>
</div>

<script>
    function validateInvoiceItemReport() {
        const startDate = document.getElementById("startDate").value;
        const endDate = document.getElementById("endDate").value;

        if (startDate === "" || endDate === "") {
            alert("Please select both start and end dates.");
            return false;
        }

        return true;
    }
</script>
</body>
</html>
