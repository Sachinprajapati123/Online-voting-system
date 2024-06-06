<?php
    session_start();

    if(!isset($_SESSION['userdata'])){
        header("location:../");
        exit();
    }
    $userdata = $_SESSION['userdata'];
    $groupdata = $_SESSION['groupdata'];
    if($userdata['status'] == 0){
        $status = '<b style="color:red">Not voted</b>';
    } else {
        $status = '<b style="color:green">Voted</b>';
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #007BFF;
            color: white;
            padding: 10px 20px;
        }
        .container h1 {
            margin: 0;
        }
        button {
            height: 35px;
            padding: 0 10px;
            margin: 5px;
            background-color: #28a745;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button a {
            color: white;
            text-decoration: none;
        }
        .boySection {
            display: flex;
            padding: 20px;
            margin: 20px;
            gap: 20px;
        }
        #Profile, #Group {
            border: 2px solid black;
            background-color: white;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        #Profile {
            width: 40%;
        }
        #Group {
            width: 60%;
        }
        img {
            border-radius: 50%;
            display: block;
            margin: 0 auto;
        }
        #Group img {
            border-radius: 0;
        }
        #Group div {
            overflow: hidden;
        }
        .vote-button {
            width: 100%;
            background-color: #dc3545;
            border: none;
            color: white;
            padding: 10px;
            text-align: center;
            cursor: pointer;
            border-radius: 4px;
        }
        #voted{
    padding: 5px;
    font-size: 15px;
    background-color: green;
    color: white;
    border-radius: 5px;
    width: 200px;
}
    </style>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="mainSection">
        <div class="container">
            <button id="backbtn"><a href="../">Back</a></button>
            <h1>Online Voting System</h1>
            <button id="logbtn"><a href="logout.php">Logout</a></button>
        </div>
    </div>
    <hr>
    <div class="boySection">
        <div id="Profile">
            <center>
                <img src="../uploads/<?php echo $userdata['photo'] ?>" alt="Profile Picture" height="100px" width="100px">
            </center>
            <br><br>
            <b>Name:</b> <?php echo $userdata['name'] ?><br><br>
            <b>Mobile:</b> <?php echo $userdata['mobile'] ?><br><br>
            <b>Address:</b> <?php echo $userdata['address'] ?><br><br>
            <b>Status:</b> <?php echo $status ?><br><br>
        </div>
        <div id="Group">
            <?php
                if($groupdata){
                    for($i = 0; $i < count($groupdata); $i++){
                        ?>
                        <div style="padding: 10px; border-bottom: 1px solid #ccc;">
                            <img style="float: right; margin-left: 20px;" src="../uploads/<?php echo $groupdata[$i]['photo'] ?>" alt="Group Picture" height="100px" width="100px">
                            <div style="float: left;">
                                <b>Group Name:</b> <?php echo $groupdata[$i]['name'] ?><br><br>
                                <b>Votes:</b> <?php echo $groupdata[$i]['votes'] ?><br><br>
                                <form action="../API/vote.php" method="post">
                                    <input type="hidden" name="gvotes" value="<?php echo $groupdata[$i]['votes'] ?>">
                                    <input type="hidden" name="gid" value="<?php echo $groupdata[$i]['id'] ?>">
                                    <?php if($_SESSION['userdata']['status']==0) {

                                        ?>
                                            <button type="submit" name="votebtn" value="vote" class="vote-button">Vote</button>
                                            <?php
                                        }
                                        else{
                                            ?>
                                            <button type="button" disabled name="votebtn" value="vote" id='voted'  >Voted</button>
                                            <?php
                                        }
                                   ?> 
                                </form>
                            </div>
                        </div>
                        <?php
                    }
                }
            ?>
        </div>
    </div>
</body>
</html>
