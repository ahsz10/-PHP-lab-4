<?php
session_start();
$dbhost = 'localhost';
   $dbuser = 'root';
   $dbpass = '';
   $dbname = 'lab4';
   $con = mysqli_connect( $dbhost, $dbuser, $dbpass, $dbname);

if(! $con ) {
   echo 'Connected Failed';
   die('Could not connect: ' . mysqli_error($conn));
}
 
//  echo 'Connected successfully';
// mysqli_close($conn);


if(isset($_POST['delete_student']))
{
    $student_id = mysqli_real_escape_string($con, $_POST['delete_student']);

    $query = "DELETE FROM students WHERE id='$student_id' ";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['message'] = "Student Deleted Successfully";
        header("Location: index.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Student Not Deleted";
        header("Location: index.php");
        exit(0);
    }
}

if(isset($_POST['update_student']))
{
    $student_id = mysqli_real_escape_string($con, $_POST['student_id']);

    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $gender = mysqli_real_escape_string($con, $_POST['gender']);
    $mailstatus = mysqli_real_escape_string($con, $_POST['mailstatus']);

    $query = "UPDATE students SET name='$name', email='$email', gender='$gender', mailstatus='$mailstatus' WHERE id='$student_id' ";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['message'] = "Student Updated Successfully";
        header("Location: index.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Student Not Updated";
        header("Location: index.php");
        exit(0);
    }

}


if(isset($_POST['save_student']))
{
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $gender = mysqli_real_escape_string($con, $_POST['gender']);
    $mailstatus = mysqli_real_escape_string($con, $_POST['mailstatus']);

    if($mailstatus != "Yes"){
        $mailstatus = "No";
    }

    $query = "INSERT INTO students (name,email,gender,mailstatus) VALUES ('$name','$email','$gender','$mailstatus')";

    $query_run = mysqli_query($con, $query);
    if($query_run)
    {
        $_SESSION['message'] = "Student Created Successfully";
        header("Location: student-create.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Student Not Created";
        header("Location: student-create.php");
        exit(0);
    }
}

// mysqli_close($con);

?>


<?php
    if(isset($_SESSION['message'])) :
?>

    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Operation Successful:  </strong> <?= $_SESSION['message']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

<?php 
    unset($_SESSION['message']);
    endif;
?>