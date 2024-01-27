<!DOCTYPE html>
<html lang="en">
<head>
<style>
      body {
        background: hsl(290, 21%, 59%);
        color: rgb(16, 23, 22);
      }
      tbody td {
    /* 1. Animate the background-color
       from transparent to white on hover */
    background-color: rgba(255,255,255,0);
    transition: all 0.2s linear; 
    transition-delay: 0.3s, 0s;
    /* 2. Animate the opacity on hover */
    opacity: 0.6;
  }
  tbody tr:hover td {
    background-color: rgb(191, 61, 61);
    transition-delay: 0s, 0s;
    opacity: 1;
    font-size: 2em;
  }
  
  td {
    /* 3. Scale the text using transform on hover */
    transform-origin: center left;
    transition-property: transform;
    transition-duration: 0.4s;
    transition-timing-function: ease-in-out;
  }
  tr:hover td {
    transform: scale(1.1);
  }
  
  
  
  
  
  /* Codepen styling */
  * { box-sizing: border-box }
  
  table {
    width: 90%;
    margin: 0 5%;
    text-align: left;
  }
  th, td {
    padding: 0.5em;
  }
      </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>
<?php
$cnn = mysqli_connect("localhost", "root", "", "To-List") or exit(mysqli_connect_errno());

$query = 'select * from task ';
$tNam = filter_input(INPUT_POST, 'tNam');
$tDes = filter_input(INPUT_POST, 'tDes');
$tNam = strtoupper(trim($tNam));
$tDes = strtoupper(trim($tDes));

if (strlen($tNam) > 0 || strlen($tDes > 0))
    $query .= 'where ';

$modifier = '';

if (strlen($tNam) > 0) {
    $query .= '(tNam like ?)';
    $modifier .= 's';
    $nn = $tNam . '%';
}

if (strlen($tDes) > 0) {
    if (strlen($tNam) > 0) $query .= ' and ';
    $query .= '(tDes like ? )';
    $modifier .= 's';
    $snn = $tDes . '%';
}

$stmt = mysqli_stmt_init($cnn);
mysqli_stmt_prepare($stmt, $query) or exit("There exists a query error");
if (strlen($tNam) > 0 && strlen($tDes) == 0)
    mysqli_stmt_bind_param($stmt, $modifier, $nn);
if (strlen($tDes) > 0 && strlen($tNam) == 0)
    mysqli_stmt_bind_param($stmt, $modifier, $snn);
if (strlen($tDes) > 0 && strlen($n) > 0)
    mysqli_stmt_bind_param($stmt, $modifier, $nn, $snn);



mysqli_stmt_execute($stmt) or exit("Query error");  // mysqli_stmt_errno()
mysqli_stmt_bind_result($stmt, $tNam, $tDes, $dDate, $pLvl, $stat, $cat);
echo '<table border="1">';
echo "<tr><th>Click to delete</th><th>Task Name</th><th>Task Description</th><th>Due Date</th><th>Priority Level</th><th>Task Status</th><th>Category</th></tr>";
while (mysqli_stmt_fetch($stmt)) {
    echo "<tr>";
    echo '<td>';
    echo '<a href="del1.php?tNam=' . $tNam . '" onclick=\'return confirm("Are you sure?");\'>' . $tNam . '</a>';
    echo '</td>';
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
