<?php
// retrieve info for adding the record
$tNam = filter_input(INPUT_POST, 'tNam');
$tDes = filter_input(INPUT_POST, 'tDes');
$dDate = filter_input(INPUT_POST, 'dDate');
$pLvl = filter_input(INPUT_POST, 'pLvl');
$stat= filter_input(INPUT_POST, 'stat');
$cat = filter_input(INPUT_POST, 'cat');

$cnn = mysqli_connect("localhost", "root", "", "To-List") or exit(mysqli_connect_errno());

$query = 'update task set tDes=?, dDate=?, pLvl=?, stat=?, cat=? where tNam=?';

$stmt = mysqli_stmt_init($cnn);
mysqli_stmt_prepare($stmt, $query) or exit("There exists a query error");

mysqli_stmt_bind_param($stmt, 'ssssss', $tDes, $dDate, $pLvl, $stat, $cat, $tNam);
mysqli_stmt_execute($stmt) or exit("Query error");  // mysqli_stmt_errno()

if (mysqli_stmt_affected_rows($stmt) > 0)
    echo "Record Updated";
else
    echo "There is a problem";


mysqli_stmt_close($stmt);
mysqli_close($cnn);
header("Refresh:2; url=main.php");