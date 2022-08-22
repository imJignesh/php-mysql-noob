<?php

require_once "config.php";

if(isset($_POST['submit'])){
    
    $name = $_POST['name'];
    $rollno = $_POST['rollno'];
    $locality = $_POST['locality'];
    $subjects = $_POST['subject'];
    $image = '';
    // print_r($subject);exit;
    
    $target_dir = "uploads/";
    $target_file = $target_dir . $_FILES["image"]["name"];
    $tempname = $_FILES["image"]["tmp_name"];  

 
    if (move_uploaded_file($tempname, $target_file)) {
        $image = $target_file;
    }
    
    $sql = "insert into students( `name` ,`rollno`,`locality`,`image` ) values ('$name','$rollno','$locality','$image')";
    mysqli_query($con,$sql);
     $student_id = $con->insert_id;

    foreach($subjects as $subject){
        $sql = "insert into student_subject( `student_id`,`subject_id`) values ('$student_id','$subject')";
        mysqli_query($con,$sql);
    }
    

    
}

$sql = "select * from subjects";
$subjects  = mysqli_query($con,$sql);

?>

<center>
<a href="index.php"> Search</a> | <a href="students.php"> Add Student</a> | <a href="subjects.php"> Add Subject</a> 
</center>

<h1>Add Students</h1>
<form action="" method="post" enctype="multipart/form-data">
<label>Name: </label><input type="text" name="name"/><br/>
<label>Roll No: </label><input type="number" name="rollno" /><br/>
<label>Locality: </label><input type="text" name="locality" /><br/>
<label>Image: </label><input type="file" name="image"/><br/>
<label>Subjects: </label>
<?php 
foreach($subjects as $subject){
    ?>
    <label><input type="checkbox" name="subject[]" value ="<?php echo $subject['id'] ; ?>"  /> <?php echo $subject['name'] ; ?></label>
    <?php
}
?>
<br/>
<input type="submit" name="submit" />
</form>