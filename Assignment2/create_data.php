<?php
// Function to read and clean file contents into arrays
function readFileToArray($filename, $line_delimiter = "\n", $item_delimiter = null) {
    $content = file_get_contents($filename);    // Read the contents of the file into a string
    $lines = array_filter(array_map('trim', explode($line_delimiter, trim($content))));   // Split the content by the specified line delimiter and trim extra spaces
    if ($item_delimiter) {
        $items = [];
        foreach ($lines as $line) {
            $items = array_merge($items, array_map('trim', explode($item_delimiter, $line)));
        }
        return $items;    // Return the merged items
    }
    return $lines;    // Return the lines if no item delimiter is specified
}

// Function to read domains and split correctly
function readDomains($filename) {
    $content = file_get_contents($filename);
    $lines = array_filter(array_map('trim', explode('.', trim($content))));
    $domains = [];   // Prepare an array to store domains
    for ($i = 0; $i < count($lines); $i += 2) {
        if (isset($lines[$i + 1])) {    // Pair the lines to form domains (e.g., "hotmail.com")
            $domains[] = $lines[$i] . '.' . $lines[$i + 1];
        }
    }
    return array_unique($domains); // Ensure unique domains
}

// Function to read CSV file into an array
function readCSV($filename) {
    $rows = [];
    if (($handle = fopen($filename, "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $rows[] = array_map('trim', $data); // Read all columns
        }
        fclose($handle);
    }
    return $rows;
}

// Data initialization
$first_names = readCSV('first_names.csv');
$last_names = readFileToArray('last_names.txt');
$domains = readDomains('domains.txt');
$street_names = readFileToArray('street_names.txt', "\n", ':'); // Splitting street names by colons and lines
$street_types = readFileToArray('street_types.txt', ';');

// Display arrays
echo "<h2>First Names</h2><pre>"; print_r($first_names); echo "</pre>";
echo "<h2>Last Names</h2><pre>"; print_r($last_names); echo "</pre>";
echo "<h2>Domains</h2><pre>"; print_r($domains); echo "</pre>";
echo "<h2>Street Names</h2><pre>"; print_r($street_names); echo "</pre>";
echo "<h2>Street Types</h2><pre>"; print_r($street_types); echo "</pre>";

// Function to generate random unique customers
function generateCustomerData($first_names, $last_names, $domains, $street_names, $street_types, $count = 25) {
    $customers = [];
    $used_names = [];
    $used_addresses = [];

    // Shuffle arrays to ensure randomness
    shuffle($first_names);
    shuffle($last_names);
    shuffle($street_names);
    shuffle($street_types);

    for ($i = 0; $i < $count; $i++) {
        $first_name = $first_names[$i % count($first_names)];
        $last_name = $last_names[$i % count($last_names)];
        
        // Ensure unique names
        $full_name = "$first_name $last_name";
        while (in_array($full_name, $used_names)) {
            $first_name = $first_names[array_rand($first_names)];
            $last_name = $last_names[array_rand($last_names)];
            $full_name = "$first_name $last_name";
        }
        $used_names[] = $full_name;

        // Generate unique address
        do {
            $street_number = rand(1, 999);
            $street_name = $street_names[array_rand($street_names)];
            $street_type = $street_types[array_rand($street_types)];
            $address = "$street_number $street_name $street_type";
        } while (in_array($address, $used_addresses));
        $used_addresses[] = $address;

        // Generate email
        $domain = $domains[array_rand($domains)];
        $email = strtolower("$first_name.$last_name@$domain");

        // Store customer
        $customers[] = [
            'first_name' => $first_name,
            'last_name' => $last_name,
            'address' => $address,
            'email' => $email
        ];
    }
    return $customers;
}

// Generate customer data
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
