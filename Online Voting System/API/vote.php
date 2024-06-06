<?php
session_start();
include('connectivity.php');

if (!isset($_SESSION['userdata'])) {
    header("location:../");
    exit();
}

// Validate and sanitize inputs
$votes = isset($_POST['gvotes']) ? (int)$_POST['gvotes'] : 0;
$gid = isset($_POST['gid']) ? (int)$_POST['gid'] : 0;
$uid = $_SESSION['userdata']['id'];

// Increment total votes
$total_votes = $votes + 1;

// Update group votes
$update_votes_query = "UPDATE VOTE SET votes='$total_votes' WHERE id='$gid'";
$update_votes = mysqli_query($conn, $update_votes_query);

// Update user status
$update_user_status_query = "UPDATE VOTE SET status=1 WHERE id='$uid'";
$update_user_status = mysqli_query($conn, $update_user_status_query);

if ($update_votes && $update_user_status) {
    // Fetch updated group data
    $groups_query = "SELECT * FROM VOTE WHERE role=2";
    $groups = mysqli_query($conn, $groups_query);
    $groupsdata = mysqli_fetch_all($groups, MYSQLI_ASSOC);
    
    // Update session data
    $_SESSION['userdata']['status'] = 1;
    $_SESSION['groupdata'] = $groupsdata;
    
    echo '
    <script>
        alert("Voting successful!");
        window.location = "../routes/Dahboard.php";
    </script>
    ';
} else {
    echo '
    <script>
        alert("Some error occurred!");
        window.location = "../routes/Dahboard.php";
    </script>
    ';
}
?>
