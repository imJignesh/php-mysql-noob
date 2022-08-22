<?php

require_once "config.php";



if(isset($_POST['submit'])){
    handle_students($con);
}
if(isset($_GET['del'])){
    handle_delete_student($con,$_GET['del']);
}

$subjects  = get_subjects($con);
$students = get_students($con);

?>

<?php get_header();  ?>

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





<?php if(mysqli_num_rows($students)){ ?>
<table border="1">
    <thead>
        <tr>
            <th>Photo</th>
            <th>Name</th>
            <th>Roll No</th>
            <th>Locality</th>
            <th>Actions</th>
        </tr>
    </thead>
<?php
while( $student  = $students->fetch_row() ){
    ?>
    <tr>
        <td><?php echo $student[4]?"<img width='50' height='50' src='$student[4]' />":""; ?></td>
        <td><?php echo $student[1]; ?></td>
        <td><?php echo $student[2]; ?></td>
        <td><?php echo $student[3]; ?></td>
        <td><a href="?del=<?php echo $student[0]; ?>">Delete</a></td>
student
    </tr>
    <?php
}

?>
</table>
<?php } ?>
<?php get_footer();  ?>