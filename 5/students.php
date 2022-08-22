<?php

require_once "config.php";



if (isset($_POST['submit'])) {
    handle_students($con);
}
if (isset($_GET['del'])) {
    handle_delete_student($con, $_GET['del']);
}

if (isset($_GET['edit'])) {
    $data = handle_edit_student($con, $_GET['edit']);
}


$subjects  = get_subjects($con);
$students = get_students($con);

?>

<?php get_header();  ?>

<h1>Manage Students</h1>
<hr />
<div class="row d-flex flex-row-reverse ">
    <div class="col-md-4">

        <form action="" method="post" enctype="multipart/form-data">
            <?php if (isset($_GET['edit'])) { ?>
                <input type="hidden" value="<?php echo $data['id']; ?>" name="id" />
            <?php } ?>
            <div class="form-group">
                <label>Name: </label><input class="form-control" type="text" name="name" value="<?php echo $data['name']; ?>" />

            </div>
            <div class="form-group">
                <label>Roll No: </label><input class="form-control" type="number" name="rollno" value="<?php echo $data['rollno']; ?>" />
            </div>
            <div class="form-group">
                <label>Locality: </label><input class="form-control" type="text" name="locality" value="<?php echo $data['locality']; ?>" />
            </div>
            <div class="form-group">
                <label>Image: </label>
                <?php if ($data['image']) {
                    echo "<img width='50' height='50' src='" . $data['image'] . "' />";
                } ?>
                <input type="file" class="form-control" name="image" />
            </div>
            <div class="form-group">
                <label>Subjects: </label>
                <?php
                if ($data['id']) $sub = get_subject($con, $data['id']);

                foreach ($subjects as $subject) {
                    $checked = '';
                    if (in_array($subject['name'], $sub)) {
                        $checked = " checked=checked ";
                    }
                ?>
                    <label><input type="checkbox" <?php echo $checked; ?> name="subject[]" value="<?php echo $subject['id']; ?>" /> <?php echo $subject['name']; ?></label>
                <?php
                }
                ?>
            </div>
            <div class="form-group">
                <input type="submit" name="submit" class="btn btn-primary" />
            </div>
        </form>

    </div>
    <div class="col">



        <?php if (mysqli_num_rows($students)) { ?>
            <table class="table">
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
                while ($student  = $students->fetch_row()) {
                ?>
                    <tr>
                        <td><?php echo $student[4] ? "<img width='50' height='50' src='$student[4]' />" : ""; ?></td>
                        <td><?php echo $student[1]; ?></td>
                        <td><?php echo $student[2]; ?></td>
                        <td><?php echo $student[3]; ?></td>
                        <td><a class="btn btn-danger" href="?del=<?php echo $student[0]; ?>">Delete</a> | <a class="btn btn-info" href="?edit=<?php echo $student[0]; ?>">Edit</a></td>

                    </tr>
                <?php
                }

                ?>
            </table>
        <?php } ?>
    </div>
</div>
<?php get_footer();  ?>