<?php
session_start();

$error=0;
require ("connect.php");
$conn = CreateHandle();

if (!isset($_SESSION['name'])){    
    header('location: index.php');
}

if(isset($_POST['changename'])){
    $newName = $_POST['changename'];
    $userID = $_SESSION['userID'];
    $updatenamequery = "UPDATE users SET name = '$newName' WHERE userID = '$userID'";
    $result = $conn->query($updatenamequery);
    $error = 11;
    
    $namesessionquery = "SELECT name FROM users WHERE userID = '$userID'";
    $result = $conn->query($namesessionquery);
    $newnamesession = $result->fetch_array(MYSQLI_NUM);
    $_SESSION['name'] = $newnamesession[0];
}

if(isset($_POST['changepass'])){
    
    $newPass = $_POST['changepass'];
    $verifyPass = $_POST['verifypass'];
    $newPass = $conn->real_escape_string($newPass);
    $verifyPass = $conn->real_escape_string($verifyPass);
    $userID = $_SESSION['userID'];
    
    $sqlquerypass = "SELECT password FROM users WHERE userID = '$userID'";
    $result = $conn->query($sqlquerypass);
    $dbpass = $result->fetch_array(MYSQLI_NUM);
    
    
    if(password_verify($verifyPass, $dbpass[0])){
        $newPassHash = password_hash($newPass, PASSWORD_DEFAULT);
        $updatepassquery = "UPDATE users SET password = '$newPassHash' WHERE userID = '$userID'";
        $result = $conn->query($updatepassquery);
        $error = 10;
    } else {
        $error = 1; //password doesnt match one in db
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>ListR Profile </title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- My Custom CSS-->
    <link rel="stylesheet" href="style.css">
    
    <!-- Fonts, Commented out in CSS - go uncomment them there to try them out -->
    <link href="https://fonts.googleapis.com/css?family=Caveat|Indie+Flower&display=swap" rel="stylesheet">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

</head>

<body>

    <div class="d-flex" id="wrapper"> <!-- Page Wrapper-->

        <!-- Sidebar -->
        <div class="collapse" id="sidebar-collapse">

        <div class="bg-light border-right" id="sidebar-wrapper">
            <a id="mainpagelink" href="user.php"><h5 class="pt-3 pb-2 text-center"><?php echo $_SESSION['name']?>'s ListR </h5></a>


            <div class="list-group list-group-flush ">
                <a href="user.php" class="list-group-item list-group-item-action bg-light "><i class="fas fa-plus mr-2"></i> <b>New list</b></a>
                <?php
        $listsqlquery = "SELECT * FROM lists WHERE createdBy = " . $_SESSION['userID'];
                $result = $conn ->query($listsqlquery);
                
                if ($result -> num_rows > 0){
        while($row = $result -> fetch_assoc()){
            echo " <a href=\"user.php?listID=" .$row['listID']."\" class=\"list-group-item list-group-item-action bg-light\">";
                if($row['public']==0){echo "<i class=\"fas fa-eye-slash\"></i> ";}else{echo"<i class=\"fas fa-eye\"></i> ";}
            echo $row["title"]."</a>";
            }
        }
                ?>

                <!--<a href="#" class="list-group-item list-group-item-action bg-light">List-1</a>-->
            </div>
        </div>
                    </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">

            <!-- Top Navbar -->
            <nav class="navbar navbar-expand-md navbar-light bg-light border-bottom" id="navbarmain">
                <button class="btn btn-outline-dark" type="button" data-toggle="collapse" data-target="#sidebar-collapse" aria-controls="sidebar-collapse" aria-expanded="false" aria-label="Toggle navigation">  <i class="fas fa-tasks"></i>
                </button> <!-- Sidebar Collapse Button -->

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarMainCollapse" aria-controls="navbarMainCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarMainCollapse">
                <ul class="nav navbar-nav ml-auto">

                    <?php if(isset($_GET['saved'])){
                    echo "List has been saved";
                    } ?>
                    <li class="nav-item">
                        <a class="btn btn-blue ml-1 mr-1" href="marketplace.php" role="button"> Marketplace <i class="fas fa-tasks"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-blue ml-1 mr-1" href="profile.php" role="button"> Profile <i class="fas fa-user-alt"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-blue ml-1 mr-1" href="logout.php" role="button"> Logout <i class="fas fa-sign-out-alt"></i></a>
                    </li>
                    <li class="nav-item">
                        <div class="dropdown dropleft">

                            <a class="btn btn-blue ml-1 mr-1" href="#" role="button" id="dropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Settings<i class="fas fa-wrench"></i></a>

                            <div class="dropdown-menu" aria-labelledby="dropdownMenu">



                                <button class="dropdown-item disabled" type="button">Colour Themes</button>
                                <div class="dropdown-divider"></div>

                                <button class="dropdown-item" type="button" onclick="lightmode();">Light Mode</button>
                                <button class="dropdown-item" type="button" onclick="darkmode();">Dark Mode</button>
                                <div class="dropdown-divider"></div>

                                <button class="dropdown-item disabled" type="button">Backgrounds</button>
                                <div class="dropdown-divider"></div>
                                <button class="dropdown-item" type="button" onclick="spacebg();">Space</button>
                                <button class="dropdown-item" type="button" onclick="woodboardsbg()">Wooden Boards</button>
                                <button class="dropdown-item" type="button" onclick="moderndeskbg();">Modern Desk</button>
                                <button class="dropdown-item" type="button" onclick="woodbg()">Wood</button>
                                <div class="dropdown-divider"></div>

                            </div>

                        </div>
                    </li>

                </ul>
                </div>
            </nav>

            <!-- Customisable Bacground for the Page -->
            <div id="outerpage">

                <!-- The 'Page'/ Paper -->
                <div class="container-fluid text-center" id="page">

                    <h1 class=" pt-4 pb-4" contenteditable="true" id="title">Your Profile</h1>
                    

                    <p>Currently, your name is set as : <b><?php echo $_SESSION['name']?></b></p>
                    <form class="form-inline d-flex justify-content-center my-sm-2" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                        <input class="form-control mr-sm-2 " type="input" placeholder="Insert New Name here" aria-label="changename" id="changename" name="changename" required>
                        <button class="btn btn-outline-green my-2 my-sm-0" type="submit" >Confirm new Name</button>

                    </form>
                    <p> If you want to change your password, you can do that below</p>
                    <form class="form-inline d-flex justify-content-center my-sm-2" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                        <input class="form-control mr-sm-2 " type="password" placeholder="New Password Here" aria-label="changepass" id="changepass" name="changepass">
                        <input class="form-control mr-sm-2 " type="password" placeholder="Verify Current Password" aria-label="verifypass" id="verifypass" name="verifypass">
                        <button class="btn btn-outline-green my-2 my-sm-0" type="submit">Confirm new Password</button>

                    </form>
                    <p><b>Note you can only do one at a time!</b></p>

                    <?php if($error==1){
                    echo "<div class=\"alert alert-warning\" role=\"alert\">
                              Password verification failed - Passwords do not match.
                        </div>";}
                    
                    if($error==10){
                    echo "<div class=\"alert alert-success\" role=\"alert\">
                              Password Has Been Changed.
                        </div>";}
                    
                    if($error==11){
                    echo "<div class=\"alert alert-success\" role=\"alert\">
                              Name Has Been Changed.
                        </div>";}
                    
                    ?>


                </div>
            </div>

        </div>
        <!-- /#page-content-wrapper -->

    </div>



    <!-- Javascript -->
    <script src="addinput.js" type="text/javascript"></script>
    <script src="settings.js" type="text/javascript"></script>

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>



</body>

</html>
