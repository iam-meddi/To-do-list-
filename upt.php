<!DOCTYPE html>
<html lang="en">

<head>
<style>
        h1 {
        font-family: 'apple chancery';
        text-align: center;
        font-size: 50px;
        align-items: center;
        justify-content: center;
      }
      h2 {
        font-family: 'times new roman';
        text-align: center;
        font-size: 30px;
        align-items: center;
        justify-content: center;
      }
      select {
      width: 10%;
      padding: 16px 20px;
      border: none;
      border-radius: 4px;
      background-color: #f1f1f1;
      }
    
      input[type=text] {
      width: 10%;
      padding: 8px 10px;
      margin: 8px 0;
      box-sizing: border-box;
      border: 3px solid #ccc;
      -webkit-transition: 0.5s;
      transition: 0.5s;
      outline: none;
    }
    
    input[type=text]:focus {
      border: 3px solid #555;
    }
    
      body {
        background: hsl(290, 21%, 59%);
        color: rgb(16, 23, 22);
      }

      button {
    background-color: rgb(168, 162, 162);
    color: rgb(255, 255, 255);
    border: 2px solid #e7e7e7;
  }
  
  button:hover {background-color: #0d0c0c;}

  button {
    border: none;
    color: white;
    border-radius: 20px;
    padding: 8px 16px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 10px;
    margin: 4px 2px;
    transition-duration: 0.4s;
    cursor: pointer;
  }
      </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    /****************************************** */
    $cnn = mysqli_connect("localhost", "root", "", "To-List") or exit(mysqli_connect_errno());

    $query = 'select tNam,tDes,dDate,pLvl,stat,cat from task where tNam=?';

    $stmt = mysqli_stmt_init($cnn);
    mysqli_stmt_prepare($stmt, $query) or exit("There exists a query error");

    $tNam = filter_input(INPUT_POST, 'tNam');
    mysqli_stmt_bind_param($stmt, 's', $tNam);

    mysqli_stmt_execute($stmt) or exit("Query error");  // mysqli_stmt_errno()
    mysqli_stmt_bind_result($stmt, $tNam, $tDes, $dDate, $pLvl, $stat, $cat);
    if (!mysqli_stmt_fetch($stmt)) {
        mysqli_stmt_free_result($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($cnn);
        header("location:upt.html");
        exit("tNam not found");
    }

    mysqli_stmt_free_result($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($cnn);

    /****************************************** */
    ?>
    <div>
            <form method="post" action="upt1.php">
                Task Name:<input type="text" name="tNam" max="20" readonly="" value="<?php echo $tNam; ?>"><br>
                Task Description: <input type="text" name="tDes" maxlength="200"readonly="" value="<?php echo $tDes; ?>"><br>
                Task Due Date: <input type="date" name="dDate" value="<?php echo $dDate; ?>"><br>
                Priority Level:<select name="pLvl">
                <option value="high">High</option>
                <option value="med">Medium</option>
                <option value="low" selected>Low</option>
                </select><br>
                Task Status:<select name="stat">
                <option value="completed">Completed</option>
                <option value="in progress">In progress</option>
                <option value="uncompleted" selected>Uncompleted</option>
                </select><br>
                Category: <input type="text" name="cat" maxlength="20"readonly="" value="<?php echo $cat; ?>">
                <hr>
                <input type="reset" value="Clear" name="clear" >
                <input type="submit" value="Update Task" name="submit" >
            </form>
    </div>
</body>

</html>