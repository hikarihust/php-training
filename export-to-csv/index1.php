<?php
    $conn = new mysqli("localhost", "root", "", "export");

    $allData = "";
    $sql = $conn->query("SELECT * FROM country");
    while($data = $sql->fetch_assoc())
        $allData .= $data['id'] . ',' . $data['name'] . ',' . $data['countryCode'] . "\n";

    $response = "data:text/csv;charset=utf-8,ID,NAME,COUNTRY CODE\n";
    $response .= $allData;

    echo '<a href="' . $response . '" download="country.csv">Download</a>';
?>
