<?php


function get_subjects($con){

    $sql = "select * from subjects";
    return mysqli_query($con,$sql);
}

function get_students(){

}

function get_localities($con){
    $sql = "select distinct locality from students";
    return mysqli_query($con,$sql);
}

function get_subject($con,$student_id){
    $sql = "SELECT name FROM `subjects` WHERE id in ( select `subject_id` from `student_subject` where `student_id` =  $student_id )";
    $list = mysqli_query($con,$sql); 
    

    while( $subject = $list->fetch_row() ){
        echo $subject[0] ."<br/>";
    }

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
    // print_r($subject);exit;
    
    $target_dir = "uploads/";
    $target_file = $target_dir . $_FILES["image"]["name"];
    $tempname = $_FILES["image"]["tmp_name"];  

 
    if (move_uploaded_file($tempname, $target_file)) {
        $image = $target_file;
    }
    
    $sql = "insert into students( `name` ,`rollno`,`locality`,`image` ) values ('$name','$rollno','$locality','$image')";
    mysqli_query($con,$sql);
     $student_id = $con->insert_id;

    foreach($subjects as $subject){
        $sql = "insert into student_subject( `student_id`,`subject_id`) values ('$student_id','$subject')";
        mysqli_query($con,$sql);
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
    
    $sql = "insert into subjects( `name` ,`marks`,`image` ) values ('$name','$marks','$image')";
    mysqli_query($con,$sql);
}