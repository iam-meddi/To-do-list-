<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>To-Do List</h1>
    <hr>
<div class="container">
  <a class="button" href="add.html" style="--color:#1e9bff;">
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    Add
  </a>
  <a class="button" href="del.html" style="--color: #ff1867;">
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    Delete
  </a>
  <a class="button" href="upt.html" style="--color: #6eff3e;">
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    Update
  </a>
</div>

</body>
</html>
<?php
$cnn = mysqli_connect("localhost", "root", "", "To-List") or exit(mysqli_connect_errno());

$query = 'select tNam,tDes,dDate,pLvl, stat, cat from task order by dDate,pLvl';

$stmt = mysqli_stmt_init($cnn);
mysqli_stmt_prepare($stmt, $query) or exit("There exists a query error");


mysqli_stmt_execute($stmt) or exit("Query error");  // mysqli_stmt_errno()
mysqli_stmt_bind_result($stmt, $tNam, $tDes, $dDate, $pLvl, $stat, $cat);
echo '<table border="1">';
echo "<tr><th>Task Name</th><th>Task Description</th><th>Due Date</th><th>Priority Level</th><th>Task Status</th><th>Category</th></tr>";
while (mysqli_stmt_fetch($stmt)) {
    echo "<tr>";
    echo '<td>' . $tNam . '</td>';
    echo '<td>' . $tDes . '</td>';
    echo '<td>' . $dDate . '</td>';
    echo '<td>' . $pLvl . '</td>';
    echo '<td>' . $stat . '</td>';
    echo '<td>' . $cat . '</td>';
    echo "</tr>";
}
echo "</table>";

echo mysqli_stmt_num_rows($stmt) . ' records found<br/>';

mysqli_stmt_free_result($stmt);
mysqli_stmt_close($stmt);

mysqli_close($cnn);
?>