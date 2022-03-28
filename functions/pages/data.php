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
    if (pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION) == 'csv') {
            $file = fopen($_FILES['file']['tmp_name'], "r");

            while ($col = fgetcsv($file, 1000) !== FALSE) {

                if ($col[1] != 'Email' || $col[2] != 'Rating' || $col[3] != 'Message' || $col[4] != 'IP Address' || $col[5] != 'Created') {
                    $error = "Import failed. Please check your file and try again.";
                } else {
                    $stmt = $conn->prepare("INSERT INTO responses (campaignId, email, message, rate, ip, created) VALUES (?, ?, ?, ?, ?, ?)");
                    $stmt->bind_param('ississ', $_GET['campaign'], $col[1], $col[2], $col[3], $col[4], $col[5]);
                    $stmt->execute();

                    if ($stmt->affected_rows > 0) {
                        $success = "Success, feedback responses were imported successfully.";
                    } else {
                        $error = "Import failed. Please try again.";
                    }

                }
            }
            fclose($file);
    } else {
        $error = "Import failed. File must be of type .csv";
    }
}
