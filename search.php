<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    /****************************************** */
    $cnn = mysqli_connect("localhost", "root", "", "To-List") or exit(mysqli_connect_errno());

    $query = 'select tNam,tDes,dDate,pLvl,cat from task where tNam=?';

    $stmt = mysqli_stmt_init($cnn);
    mysqli_stmt_prepare($stmt, $query) or exit("There exists a query error");

    $tNam = filter_input(INPUT_POST, 'tNam');
    mysqli_stmt_bind_param($stmt, 's', $tNam);

    mysqli_stmt_execute($stmt) or exit("Query error");  // mysqli_stmt_errno()
    mysqli_stmt_bind_result($stmt, $tNam, $tDes, $dDate, $pLvl, $cat);
    if (!mysqli_stmt_fetch($stmt)) {
        mysqli_stmt_free_result($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($cnn);
        header("location:upt.html");
        exit("tNam not found");
    }
    mysqli_stmt_bind_result($stmt, $tNam, $tDes, $dDate, $pLvl, $cat);
    echo '<table border="1">';
    echo "<tr><th>Task Name</th><th>Task Description</th><th>Due Date</th><th>Priority Level</th><th>Category</th></tr>";
    while (mysqli_stmt_fetch($stmt)) {
        echo "<tr>";
        echo '<td>' . $tNam . '</td>';
        echo '<td>' . $tDes . '</td>';
        echo '<td>' . $dDate . '</td>';
        echo '<td>' . $pLvl . '</td>';
        echo '<td>' . $cat . '</td>';
        echo "</tr>";
    }
    echo "</table>";

    mysqli_stmt_free_result($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($cnn);

    /****************************************** */
    ?>
</body>

</html>