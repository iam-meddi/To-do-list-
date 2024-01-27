<?php
    $tNam = filter_input(INPUT_POST, 'tNam');
    $tDes = filter_input(INPUT_POST, 'tDes');
    $dDate = filter_input(INPUT_POST, 'dDate');
    $stat = filter_input(INPUT_POST, 'stat');
    $pLvl = $_POST['pLvl'];
    $cat = $_POST['cat'];
    
    $cnn = mysqli_connect("localhost", "root", "", "To-List") or exit(mysqli_connect_errno());
    $query = 'insert into task(tNam,tDes,dDate,pLvl,stat,cat) values(?,?,?,?,?,?)';
    
    $stmt = mysqli_stmt_init($cnn);
    mysqli_stmt_prepare($stmt, $query) or exit("There exists a query error");
    
    mysqli_stmt_bind_param($stmt, 'ssssss', $tNam, $tDes, $dDate, $pLvl,$stat,$cat);
    mysqli_stmt_execute($stmt) or exit("Query error"); 

    if (mysqli_stmt_affected_rows($stmt) > 0)
        echo "Record Saved";
    else
        echo "Door is opened";


    mysqli_stmt_close($stmt);
    mysqli_close($cnn);
    header("Refresh:2; url=add.html");


?>