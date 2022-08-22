<?php

require_once "config.php";

$sql = "select * from subjects";
$subjects  = mysqli_query($con,$sql);

$sql = "select distinct locality from students";
$localities  = mysqli_query($con,$sql);
// print_r( mysqli_fetch_re $localities);

if(isset($_POST['submit'])){
    $keyword = $_POST['keyword'];
    $locality = $_POST['locality'];
    $subject= implode(",",$_POST['subject']);


    $sql = "select * from students where name like '%$keyword%'";
    if($locality) $sql .= " and locality = '$locality'";
   

    if($subject)  $sql .= " and id in( SELECT student_id FROM `student_subject` WHERE subject_id in ($subject))";


    $query = mysqli_query($con,$sql);
}

function get_subject($con,$student_id){
    $sql = "SELECT name FROM `subjects` WHERE id in ( select `subject_id` from `student_subject` where `student_id` =  $student_id )";
    $list = mysqli_query($con,$sql); 
    

    while( $subject = $list->fetch_row() ){
        echo $subject[0] ."<br/>";
    }

}
?>

<center>
<a href="index.php"> Search</a> | <a href="students.php"> Add Student</a> | <a href="subjects.php"> Add Subject</a> 
</center>
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
        <td><?php get_subject($con,$students[0]); ?></td>
        
    </tr>
    <?php
}

?>
</table>
<?php } ?>