
<?php
include('authentication.php'); // This will enforce session checks and token validation
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <link rel="stylesheet" href="css/daytodayattendance.css">
    <title>EASC</title>
</head>

<body>
    <div class="stars">
        <?php for ($i = 0; $i < 50; $i++) echo '<div class="star"></div>'; ?>
    </div>
    <div id="container">
        <h1>DAY TO DAY ATTENDANCE</h1>
        <form method="post" id="searchbar">
            <div>
                <button><a href=" Dashboard.php" class="buttonoff">Back</a></button>
                <label id="font_">Course :</label>
<select name="course" >
    <option value="">Select</option>    
    <option value="B.Tech">B.Tech</option>
    <option value="B.Sc">B.Sc</option>
    <option value="M.Tech">M.Tech</option>
    <option value="MBA">MBA</option>
    <option value="Diploma">Diploma</option>
</select>
<label id="font_">Semester :</label>
<select name="semester">
    <option value="">Select</option>
    <option value=1>1</option>
    <option value=3>3</option>
    <option value=5>5</option>
    <option value=7>7</option>
</select>
<label id="font_">Group :</label>
<select name="groups">
    <option value="">Select</option>
    <option value=1>1</option>
    <option value=2>2</option>
    <option value=3>3</option>
    <option value=4>4</option>
    <option value=5>5</option>
    <option value=6>6</option>
    <option value=7>7</option>
    <option value=8>8</option>
    <option value=9>9</option>
    <option value=10>10</option>
</select>
                <label>Lecture :</label>
                <select name="lecture">
                    <option value="">Select</option>    
                    <option value="OS">OS</option>
                    <option value="TC">TC</option>
                    <option value="ML">ML</option>
                    <option value="CNS">CNS</option>
                    <option value="UG">UG</option>
                    <option value="SDE">SDE</option>
                </select>
                <label>Date :</label>
                <input type="date" name="date" id="date">
                <input type="submit" name="submit" id="submit_button" value="Search">
            </div>
        </form>
        <br>
        <form id="formtwo" method="post">
            <table>
                <tr>
                    <th>S.no</th>
                    <th>Date</th>
                    <th>Name</th>
                    <th>Reg no</th>
                    <th>Course</th>
                    <th>Lecture</th>
                    <th>Present</th>
                    <th>Absent</th>
                </tr>
                <?php
include('connect_1.php');

if (isset($_POST["submit"])) {
    $course = $_POST["course"];
    $semester = $_POST["semester"];
    $groups = $_POST["groups"];
    $lecture = $_POST["lecture"];
    $date = $_POST["date"];

    $sth = $con->prepare("SELECT * FROM `day_to_day_attendance` WHERE course = :course AND semester = :semester AND groups = :groups AND lecture = :lecture AND date = :date ORDER BY reg");

    $sth->bindParam(':course', $course);
    $sth->bindParam(':semester', $semester);
    $sth->bindParam(':groups', $groups);
    $sth->bindParam(':lecture', $lecture);
    $sth->bindParam(':date', $date);

    $sth->setFetchMode(PDO::FETCH_OBJ);
    $sth->execute();

    $serialnumber = 0;
    $studentData = array();

    while ($row = $sth->fetch()) {
        $reg = $row->reg;

        $sthRegister = $con->prepare("SELECT * FROM `student_register` WHERE sname = :sname AND reg = :reg AND course = :course");
        $sthRegister->bindParam(':sname', $row->sname);
        $sthRegister->bindParam(':reg', $reg);
        $sthRegister->bindParam(':course', $course);

        $sthRegister->execute();
        $rowRegister = $sthRegister->fetch(PDO::FETCH_OBJ);

        $sthPresent = $con->prepare("SELECT COUNT(*) as present_count FROM day_to_day_attendance WHERE reg = :reg AND date = :date AND lecture = :lecture AND attendance_status = 'present'");
        $sthPresent->bindParam(':reg', $reg);
        $sthPresent->bindParam(':date', $date);
        $sthPresent->bindParam(':lecture', $lecture);
        $sthPresent->execute();
        $resultPresent = $sthPresent->fetch(PDO::FETCH_ASSOC);
        $presentCount = $resultPresent ? $resultPresent['present_count'] : 0;

        $sthAbsent = $con->prepare("SELECT COUNT(*) as absent_count FROM day_to_day_attendance WHERE reg = :reg AND date = :date AND lecture = :lecture AND attendance_status = 'absent'");
        $sthAbsent->bindParam(':reg', $reg);
        $sthAbsent->bindParam(':date', $date);
        $sthAbsent->bindParam(':lecture', $lecture);
        $sthAbsent->execute();
        $resultAbsent = $sthAbsent->fetch(PDO::FETCH_ASSOC);
        $absentCount = $resultAbsent ? $resultAbsent['absent_count'] : 0;

        $studentData[$reg] = array(
            'date' => $row->date,
            'sname' => $rowRegister->sname,
            'reg' => $rowRegister->reg,
            'course' => $rowRegister->course,
            'lecture' => $row->lecture,  // Add lecture to the array
            'present' => $presentCount,
            'absent' => $absentCount
        );
    }

    foreach ($studentData as $reg => $data) {
        $serialnumber++;
        ?>
        <tr>
            <td><?php echo $serialnumber; ?></td>
            <td><?php echo $data['date']; ?></td>
            <td><?php echo $data['sname']; ?></td>
            <td><?php echo $data['reg']; ?></td>
            <td><?php echo $data['course']; ?></td>
            <td><?php echo $data['lecture']; ?></td> <!-- Display lecture data -->
            <td><?php echo $data['present']; ?></td>
            <td><?php echo $data['absent']; ?></td>
        </tr>
        <?php
    }

    if ($serialnumber == 0) {
        ?>
        <tr id="nocolour">
            <td>No records found.</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <?php
    }
}
?>


