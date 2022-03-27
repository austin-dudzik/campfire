<?php
if (isset($_POST["submit"])) {
    $db = new mysqli($host, $username, $password, $dbname);
    $query = $db->query("SELECT * FROM responses WHERE campaignId=$_GET[campaign] ORDER BY id DESC");
    $delimiter = ",";
    $filename = "campfire_$_GET[campaign]_" . date('Y-m-d') . ".csv";
    $f = fopen('php://memory', 'w');
    $fields = array('Id', 'Email', 'Rating', 'Message', 'IP Address', 'Created');
    fputcsv($f, $fields, $delimiter);
    while ($row = $query->fetch_assoc()) {
        $lineData = array($row['id'], $row['email'], $row['rate'], $row['message'], $row['ip'], $row['created']);
        fputcsv($f, $lineData, $delimiter);
    }
    fseek($f, 0);
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '";');
    fpassthru($f);
    exit;
}
if (isset($_POST["uploadImport"])) {
    error_reporting(0);
    if ($_FILES['csv_data']['name']) {
        $arrFileName = explode('.', $_FILES['csv_data']['name']);
        if ($arrFileName[1] == 'csv') {
            $handle = fopen($_FILES['csv_data']['tmp_name'], "r");
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $item1 = mysqli_real_escape_string($conn, $data[1]);
                $item2 = mysqli_real_escape_string($conn, $data[3]);
                $item3 = mysqli_real_escape_string($conn, $data[2]);
                $item4 = mysqli_real_escape_string($conn, $data[4]);
                $item5 = mysqli_real_escape_string($conn, $data[5]);
                $import = "INSERT INTO responses (campaignId, email, message, rate, ip, created) values ('$_GET[campaign]', '$item1', '$item2', '$item3', '$item4', '$item5')";
                if ($item1 == "Email") {
                    $import = "";
                }
                mysqli_query($conn, $import);
            }
            fclose($handle);
        }
    }
}
