<?php
// Function to read and clean file contents into arrays
function readFileToArray($filename, $line_delimiter = "\n", $item_delimiter = null) {
    // TO DO
}

// Function to read domains and split correctly
function readDomains($filename) {
    // TO DO
}

// Function to read CSV file into an array
function readCSV($filename) {
    // TO DO
}

// Data initialization
$first_names = readCSV('first_names.csv');
$last_names = readFileToArray('last_names.txt');
$domains = readDomains('domains.txt');
$street_names = readFileToArray('street_names.txt', "\n", ':'); // Splitting street names by colons and lines
$street_types = readFileToArray('street_types.txt', ';');

// More TO DO here

// Generate customer data and save to file
$customers = generateCustomerData($first_names, $last_names, $domains, $street_names, $street_types);
file_put_contents('customers.txt', implode("\n", array_map(fn($c) => implode(':', $c), $customers)) . "\n");

?>

<!DOCTYPE html>
<html>
<head>
    <title>Customer Data</title>
</head>
<body>
    <h2>Customer Data</h2>
    <table border='1'>
        <tr><th>First Name</th><th>Last Name</th><th>Address</th><th>Email</th></tr>
        <?php foreach ($customers as $customer): ?>
            <tr>
                <td><?= htmlspecialchars($customer['first_name']) ?></td>
                <td><?= htmlspecialchars($customer['last_name']) ?></td>
                <td><?= htmlspecialchars($customer['address']) ?></td>
                <td><?= htmlspecialchars($customer['email']) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
