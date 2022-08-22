<?php

require_once "config.php";

$subjects  = get_subjects($con);


if(isset($_POST['submit'])){
    handle_students($con);
}


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