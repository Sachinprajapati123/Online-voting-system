<?php
    session_start();
    include('connectivity.php');
    $mobile=$_POST['mobile'];
    $password=$_POST['pass'];
    $role=$_POST['role'];

    $check=mysqli_query($conn,"select * from VOTE where mobile='$mobile' AND password='$password' AND role='$role'");

    if(mysqli_num_rows($check)>0){
        $userdata = mysqli_fetch_array(($check));
        $groups=mysqli_query($conn,"select * from VOTE where role=2");
        $groupsdata=mysqli_fetch_all($groups,MYSQLI_ASSOC);

        $_SESSION['userdata']= $userdata;
        $_SESSION['groupdata']=$groupsdata;

        echo '
        <script>
            window.location = "../routes/Dahboard.php";
        </script>
    ';

    }
    else{
        echo '
        <script>
            alert("Invalid credentials or user not found!");
            window.location = "../";
        </script>
    ';
    }

?>