<?php

require_once "config.php";



if(isset($_POST['submit'])){
    $query = handle_search($con);
}

$subjects  = get_subjects($con);
$localities  = get_localities($con);


?>

<?php get_header();  ?>
<h1>Search Students</h1>
<form action="" method="post">

Search Keyword: <input type="text" name="keyword" /> Locality: <select name="locality" id="">
<option  value ="" >Select </option>
    <?php 

while( $subject = $localities->fetch_row() ){
        ?>
        <option  value ="<?php echo $subject[0] ; ?>" > <?php echo $subject[0]; ?></option>
        <?php
    }
    ?>
</select> Subjects :
<?php 
foreach($subjects as $subject){
    ?>
    <label><input type="checkbox" name="subject[]" value ="<?php echo $subject['id'] ; ?>"  /> <?php echo $subject['name'] ; ?></label>
    <?php
}
?>
<input type="submit" name="submit" value="Search">
 
</form>

<?php if(mysqli_num_rows($query)){ ?>
<table border="1">
    <thead>
        <tr>
            <th>Photo</th>
            <th>Name</th>
            <th>Roll No</th>
            <th>Locality</th>
            <th>Subject</th>
        </tr>
    </thead>
<?php
while( $students  = $query->fetch_row() ){
    ?>
    <tr>
        <td><?php echo $students[4]?"<img width='50' height='50' src='$students[4]' />":""; ?></td>
        <td><?php echo $students[1]; ?></td>
        <td><?php echo $students[2]; ?></td>
        <td><?php echo $students[3]; ?></td>
        <td><?php echo join(",", get_subject($con,$students[0])); ?></td>
        
    </tr>
    <?php
}

?>
</table>
<?php } ?>

<?php get_footer();  ?>