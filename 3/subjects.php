<?php
require_once "config.php";



if(isset($_POST['submit'])){
    handle_subjects($con);
}
if(isset($_GET['del'])){
    handle_delete_subject($con,$_GET['del']);
}

$subjects = get_subjects($con);
?>
<?php get_header();  ?>
<h1>Add Subjects</h1>
<form action="" method="post" enctype="multipart/form-data">
<label>Name: </label><input type="text" name="name"/><br/>
<label>Marks: </label><input type="number" name="marks" /><br/>
<label>Image: </label><input type="file" name="image"/><br/>
<input type="submit" name="submit" />
</form>




<?php if(mysqli_num_rows($subjects)){ ?>
<table border="1">
    <thead>
        <tr>
            <th>Photo</th>
            <th>Name</th>
            <th>Marks</th>
            <th>Actions</th>
        </tr>
    </thead>
<?php
while( $subject  = $subjects->fetch_row() ){
    ?>
    <tr>
        <td><?php echo $subject[2]?"<img width='50' height='50' src='$subject[2]' />":""; ?></td>
        <td><?php echo $subject[1]; ?></td>
        <td><?php echo $subject[3]; ?></td>
        <td><a href="?del=<?php echo $subject[0]; ?>">Delete</a></td>
    </tr>
    <?php
}

?>
</table>
<?php } ?>


<?php get_footer();  ?>