<?php
include('controller.php');
$cl = new Controller("localhost", "scot1", "root", "");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" style="text/css" href="style.css">
    <title>Uren registaratie</title>
    
</head>
<body>
    <div class="container">
        <h1>Uren registaratie</h1>

        <form method="POST">
            <select id="employee" name="employee">
                <option>--- Select your name ---</option>
                <?php $cl->show_employees();?>
            </select></br>
            <select id="project" name="project">
                <option>--- Select project ---</option>
                <?php $cl->show_projects();?>
            </select></br>
            <label for="date" class="label">Day </label>
            <input type="date" name="date"></br>
            <label for="timeStart" class="label">Time start </label>
            <input type="time" name="timeStart"></br>
            <label for="timeEnd" class="label">Time end </label>
            <input type="time" name="timeEnd"></br>
            <input type="submit" name="btnOk" value="OK">
        <form>

        <?php
    
    if(isset($_POST['btnOk']))
    {
        $name = $_POST['employee'];
        $project = $_POST['project'];
        $date = $_POST['date'];
        $timeStart = strtotime($_POST['timeStart']);
        $timeEnd = strtotime($_POST['timeEnd']);
        $calculate = $timeEnd - $timeStart;
        $total = $calculate/60;
        $cl->calculate_hours($calculate);
        ?>
        <form method="POST">
            <h4>Project code: </h4><input type='text' name='txtPcode' value='<?php $cl->getProjectCode($project).$project;?>' readonly>
            <h4>Project title: </h4><input type='text' name='txtPtitle' value='<?php echo $project;?>' readonly>
            <h4>Employee number: </h4><input type='text' name='txtEcode' value='<?php $cl->getId($name);?>' readonly>
            <h4>Employee name: </h4><input type='text' name='txtEname' value='<?php echo $name;?>' readonly>
            <h4>Date: </h4><input type='text' name='txtDate' value='<?php echo $date;?>' readonly>
            <h4>Gewerkte uren: </h4><input type='text' name='txtHours' value='<?php  $cl->calculate_hours($calculate);?>' readonly>
            <input type='hidden' name='txtTotal' value='<?php echo $total;?>' readonly>
            <input type="submit" name="btnSave" value="Opslaan">
        </form>
        <?php
    }   

    if(isset($_POST['btnSave']))
    {
        $projectCode = $_POST['txtPcode'];
        $employeeNo = $_POST['txtEcode'];
        $date = $_POST['txtDate'];
        $total = $_POST['txtTotal'];

        $cl-> register($projectCode, $employeeNo, $date, $total);
    }
    ?>
    </div>

    
    
</body>
</html>