<?php
require_once('../DataProvider.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the InvoiceID and status from the AJAX request
    $invoiceID = $_POST['InvoiceID'];
    $status = $_POST['status'];

    // Update the invoice status in the database
    $sqlUpdate = "UPDATE Invoice SET Status = '$status' WHERE InvoiceID = '$invoiceID'";

    if (DataProvider::executeQuery($sqlUpdate)) {
        echo 'Success';
    } else {
        echo 'Error';
    }
}
?>
