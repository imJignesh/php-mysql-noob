<?php


function get_subjects($con ,$limit = 5){
    $sql = "select * from subjects" . helper_get_page($limit);
    return mysqli_query($con,$sql);
}

function get_students($con,$limit = 5){
    $sql = "select * from students"  . helper_get_page($limit);
    return mysqli_query($con,$sql);
}

function get_localities($con){
    $sql = "select distinct locality from students";
    return mysqli_query($con,$sql);
}

function get_subject($con,$student_id){
    $sql = "SELECT name FROM `subjects` WHERE id in ( select `subject_id` from `student_subject` where `student_id` =  $student_id )";
    $list = mysqli_query($con,$sql); 
    

    while( $subject = $list->fetch_row() ){
        $subjects[] = $subject[0];
    }
    return $subjects;
}


function handle_search($con){
    $keyword = $_POST['keyword'];
    $locality = $_POST['locality'];
    $subject= implode(",",$_POST['subject']);


    $sql = "select * from students where name like '%$keyword%'";
    if($locality) $sql .= " and locality = '$locality'";
   

    if($subject)  $sql .= " and id in( SELECT student_id FROM `student_subject` WHERE subject_id in ($subject))";


    $query = mysqli_query($con,$sql);
    return $query;
}


function handle_students($con){
    $name = $_POST['name'];
    $rollno = $_POST['rollno'];
    $locality = $_POST['locality'];
    $subjects = $_POST['subject'];
    $image = '';
    $target_dir = "uploads/";
        $target_file = $target_dir . $_FILES["image"]["name"];
        $tempname = $_FILES["image"]["tmp_name"];  

        if (move_uploaded_file($tempname, $target_file)) {
            $image = $target_file;
        }
    if(!isset($_POST['id'])){
        
        
        $sql = "insert into students( `name` ,`rollno`,`locality`,`image` ) values ('$name','$rollno','$locality','$image')";
        mysqli_query($con,$sql);
        $student_id = $con->insert_id;

        foreach($subjects as $subject){
            $sql = "insert into student_subject( `student_id`,`subject_id`) values ('$student_id','$subject')";
            mysqli_query($con,$sql);
        }
    }else{
         $id = $_POST['id'];
         $sql = "update students set `name` = '$name',`rollno`='$rollno',`locality`='$locality', `image` ='$image' where id=$id";
         mysqli_query($con,$sql); 
        
         $sql = "delete from student_subject where student_id=" . $id;
         mysqli_query($con,$sql); 

         foreach($subjects as $subject){
            $sql = "insert into student_subject( `student_id`,`subject_id`) values ('$id','$subject')";
            mysqli_query($con,$sql);
        }
         
    }
}


function handle_subjects($con){
    $name = $_POST['name'];
    $marks = $_POST['marks'];
     
    $image = '';
    
    $target_dir = "uploads/";
    $target_file = $target_dir . $_FILES["image"]["name"];
    $tempname = $_FILES["image"]["tmp_name"];  

 
    if (move_uploaded_file($tempname, $target_file)) {
        $image = $target_file;
    }
    if(!isset($_POST['id'])){
    $sql = "insert into subjects( `name` ,`marks`,`image` ) values ('$name','$marks','$image')";
    mysqli_query($con,$sql);
    }else{
        $id = $_POST['id'];
        $sql = "update subjects set `name`= '$name',`marks`='$marks',`image`= '$image' where id=$id";
        mysqli_query($con,$sql);
    }
}


function get_header(){
    include "header.php";
}



function get_footer(){
    include "footer.php";
}



function handle_delete_subject($con,$id){
    $sql = "delete from subjects where id=$id";
    mysqli_query($con,$sql);
    $sql = "delete from student_subject where subject_id=$id";
    mysqli_query($con,$sql);
}

function handle_delete_student($con,$id){
    $sql = "delete from students where id=$id";
    mysqli_query($con,$sql);
    $sql = "delete from student_subject where student_id=$id";
    mysqli_query($con,$sql);
}


function handle_edit_student($con,$id){
    $sql = "select *  from students where id=$id";
    return mysqli_fetch_all( mysqli_query($con,$sql), MYSQLI_ASSOC)[0];
}

function handle_edit_subject($con,$id){
    $sql = "select * from subjects where id=$id";
    return mysqli_fetch_all( mysqli_query($con,$sql), MYSQLI_ASSOC)[0];
}



function helper_get_page($limit = 5){
    if (!isset ($_GET['page']) ) {  
        $page_number = 1;  
    } else {  
        $page_number = $_GET['page'];  
    } 
    $initial_page = ($page_number-1) * $limit;  
    return " limit " . $initial_page."," . $limit;
}

function paginate($result,$limit = 5){
    $total_rows = mysqli_num_rows($result);    
    $total_pages = ceil ($total_rows / $limit);    
    echo '<ul class="pagination justify-content-center">';
for($page_number = 1; $page_number<= $total_pages +1; $page_number++) {  
    $active = "";
    if($page_number==$_GET['page']) $active = "active";
    echo '<li class="page-item '.$active.'"><a class="page-link" href = "?page=' . $page_number . '">' . $page_number . ' </a></li>';  
}    
    echo '</ul>';


}