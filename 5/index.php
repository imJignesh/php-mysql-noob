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
<hr />
<div class="row d-flex flex-row ">
    <div class="col-md-4">
        <form action="" method="post">

            <div class="form-group">
                <label>Search By Name: </label>
                <input class="form-control" type="text" name="keyword" placeholder="Search Keyword" />
            </div>
            <div class="form-group">
                <label>Select Locality</label>
                <select class="form-control" name="locality" id="">
                    <option value="">Select Locality: </option>
                    <?php 
while( $subject = $localities->fetch_row() ){
        ?>
                    <option value="<?php echo $subject[0] ; ?>"> <?php echo $subject[0]; ?></option>
                    <?php
    }
    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="">Selected Subjects:</label> <br />
                <?php 
foreach($subjects as $subject){
    ?>
                <label><input type="checkbox" name="subject[]" value="<?php echo $subject['id'] ; ?>" />
                    <?php echo $subject['name'] ; ?></label>
                <?php
}
?>
            </div>
            <div class="form-group">
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </div>
        </form>

    </div>
    <div class="col">
        <?php if(mysqli_num_rows($query)){ ?>
        <table class="table">
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
    </div>
</div>
<?php get_footer();  ?>