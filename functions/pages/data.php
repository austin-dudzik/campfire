<?php
if (isset($_POST["submit"])) {
    $db = new mysqli($host, $username, $password, $dbname);
    $query = $db->query("SELECT * FROM responses WHERE campaignId=$_GET[campaign] ORDER BY id DESC");
    $delimiter = ",";
    $filename = "campfire_$_GET[campaign]_" . date('Y-m-d') . ".csv";
    $f = fopen('php://memory', 'w');
    $fields = ['ID', 'Email', 'Rating', 'Message', 'IP Address', 'Created'];
    fputcsv($f, $fields, $delimiter);
    while ($row = $query->fetch_assoc()) {
        $lineData = [$row['id'], $row['email'], $row['rate'], $row['message'], $row['ip'], $row['created']];
        fputcsv($f, $lineData, $delimiter);
    }
    fseek($f, 0);
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '";');
    fpassthru($f);
    exit;
}

if (isset($_POST["uploadImport"])) {
    if (pathinfo($_FILES['csv_data']['name'], PATHINFO_EXTENSION) == 'csv') {
        $arrFileName = explode('.', $_FILES['csv_data']['name']);
        if ($arrFileName[1] == 'csv') {
            $handle = fopen($_FILES['csv_data']['tmp_name'], "r");
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $item1 = escape($data[1]);
                $item2 = escape($data[2]);
                $item3 = escape($data[3]);
                $item4 = escape($data[4]);
                $item5 = escape($data[5]);

                $import = "INSERT INTO responses (campaignId, email, message, rate, ip, created) values ('$_GET[campaign]', '$item1', '$item2', '$item3', '$item4', '$item5')";
                if ($item1 != 'Email' || $item2 != 'Rating' || $item3 != 'Message' || $item4 != 'IP Address' || $item5 != 'Created') {
                    $error = "Import failed. Please check your file and try again.";
                } else {
                    query($import);
                    $success = "Success, feedback responses were imported successfully.";
                }
            }
            fclose($handle);
        }
    } else {
        $error = "Import failed. File must be of type .csv";
    }
}
