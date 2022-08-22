<?php
require_once "config.php";

if(isset($_POST['submit'])){
    handle_subjects($con);
}
?>
<center>
<a href="index.php"> Search</a> | <a href="students.php"> Add Student</a> | <a href="subjects.php"> Add Subject</a> 
</center>
<h1>Add Subjects</h1>
<form action="" method="post" enctype="multipart/form-data">
<label>Name: </label><input type="text" name="name"/><br/>
<label>Marks: </label><input type="number" name="marks" /><br/>
<label>Image: </label><input type="file" name="image"/><br/>
<input type="submit" name="submit" />
</form>