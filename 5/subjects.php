<?php
require_once "config.php";



if (isset($_POST['submit'])) {
    handle_subjects($con);
}
if (isset($_GET['del'])) {
    handle_delete_subject($con, $_GET['del']);
}
if (isset($_GET['edit'])) {
    $data = handle_edit_subject($con, $_GET['edit']);
}


$subjects = get_subjects($con);
?>
<?php get_header();  ?>
<h1>Manage Subjects</h1>
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

                <label>Marks: </label><input class="form-control" type="number" name="marks" value="<?php echo $data['marks']; ?>" />
            </div>
            <div class="form-group">

                <label>Image: </label>
                <?php if ($data['image']) {
                    echo "<img width='50' height='50' src='" . $data['image'] . "' />";
                } ?>
                <input type="file" class="form-control" name="image" /><br />
            </div>
            <div class="form-group">

                <input type="submit" name="submit" class="btn btn-primary" value="Save" />
            </div>
        </form>
    </div>
    <div class="col">

        <?php if (mysqli_num_rows($subjects)) { ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Marks</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <?php
                while ($subject  = $subjects->fetch_row()) {
                ?>
                    <tr>
                        <td><?php echo $subject[2] ? "<img width='50' height='50' src='$subject[2]' />" : ""; ?></td>
                        <td><?php echo $subject[1]; ?></td>
                        <td><?php echo $subject[3]; ?></td>
                        <td><a class="btn btn-danger" href="?del=<?php echo $subject[0]; ?>">Delete</a> | <a class="btn btn-info" href="?edit=<?php echo $subject[0]; ?>">Edit</a></td>
                    </tr>
                <?php
                }

                ?>
            </table>
        <?php } ?>
    </div>
</div>

<?php get_footer();  ?>