<?php
// retrieve info for adding the record
$tNam = filter_input(INPUT_GET, 'tNam');

$cnn = mysqli_connect("localhost", "root", "", "To-List") or exit(mysqli_connect_errno());

$query = 'delete from task where tNam=?';

$stmt = mysqli_stmt_init($cnn);
mysqli_stmt_prepare($stmt, $query) or exit("There exists a query error");

mysqli_stmt_bind_param($stmt, 's', $tNam);
mysqli_stmt_execute($stmt) or exit("Query error");  // mysqli_stmt_errno()

if (mysqli_stmt_affected_rows($stmt) > 0)
    echo "Record Deleted";
else
    echo "Record Not found";


mysqli_stmt_close($stmt);
mysqli_close($cnn);
header("Refresh:2; url=main.php");
?>