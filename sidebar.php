<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
<?php include 'functions.php'; ?>

<div class="sidebar">
    <a href="index.php" <?php if (isLinkActive('index.php')) echo 'class="active"'; ?>>Customer</a>
    <a href="registerItem.php" <?php if (isLinkActive('registerItem.php')) echo 'class="active"'; ?>>Items</a>
    <a>Reports</a>
    <div class="dropdown-menu">
        <a href="reports.php" <?php if (isLinkActive('reports.php')) echo 'class="active"'; ?>>Invoice Report</a>
        <a href="invoiceItemReport.php" <?php if (isLinkActive('invoiceItemReport.php')) echo 'class="active"'; ?>>Invoice Item Report</a>
        <a href="itemReport.php" <?php if (isLinkActive('itemReport.php')) echo 'class="active"'; ?>>Item Report</a>
    </div>
</div>
