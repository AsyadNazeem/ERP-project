<?php include 'functions.php'; ?>

<div class="sidebar">
    <a href="components/registerCustomer.php" <?php if (isLinkActive('registerCustomer.php')) echo 'class="active"'; ?>>Customer</a>
    <a href="components/registerItem.php" <?php if (isLinkActive('registerItem.php')) echo 'class="active"'; ?>>Items</a>
    <a>Reports</a>
    <div class="sub-menu">
        <a href="components/reports.php" <?php if (isLinkActive('reports.php')) echo 'class="active"'; ?>>Invoice Report</a>
        <a href="components/invoiceItemReport.php" <?php if (isLinkActive('invoiceItemReport.php')) echo 'class="active"'; ?>>Invoice Item Report</a>
        <a href="components/itemReport.php" <?php if (isLinkActive('itemReport.php')) echo 'class="active"'; ?>>Item Report</a>
    </div>
</div>
