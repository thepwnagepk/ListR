<?php
session_start();
session_unset();

$error=0;
require ("connect.php");
$conn = CreateHandle();
//login start
if (isset($_POST['loginSubmit'])){

$loginEmail = isset($_POST['loginEmail']) ? $_POST['loginEmail'] : "";
$loginPass = isset($_POST['loginPass']) ? $_POST['loginPass'] : "";
    
$loginEmail = $conn->real_escape_string($loginEmail);
$loginPass = $conn->real_escape_string($loginPass);    
    
$sqlquery = "SELECT * FROM users WHERE email = '$loginEmail'";
    
    if (isset($conn)){
    $result = $conn->query($sqlquery);
    $userdetails = $result->fetch_array(MYSQLI_NUM);
        
        if(isset($userdetails)){
            
            if(password_verify($loginPass, $userdetails[2])){
                $_SESSION['name'] = $userdetails[3];
                $_SESSION['email'] = $userdetails[1];
                $_SESSION['userID'] = $userdetails[0];
                header('location: user.php');
                
            }else{
               $error=2; //password wrong
            }
            
        }else{
            $error=1; //email wrong
        }
    }

} //login end

//register
if (isset($_POST['registerSubmit'])){
    $registerEmail = isset($_POST['registerEmail']) ? $_POST['registerEmail'] : "";
    $name = isset($_POST['name']) ? $_POST['name'] : "";
    $registerPass = isset($_POST['registerPass']) ? $_POST['registerPass'] : "";
    $registerPass2 = isset($_POST['registerPass2']) ? $_POST['registerPass2'] : "";
    
    $registerEmail = $conn->real_escape_string($registerEmail);
    $name = $conn->real_escape_string($name);
    $registerPass = $conn->real_escape_string($registerPass);
    $registerPass2 = $conn->real_escape_string($registerPass2);
    
    if($registerPass == $registerPass2){
        $registerHash = password_hash($registerPass, PASSWORD_DEFAULT);
        
              
        $sqlquery2 = "SELECT email FROM users WHERE email = '$registerEmail'";
        
        
        $result2 = $conn ->query($sqlquery2);
        
        
            if(mysqli_num_rows($result2) == 0){
                
                    if (isset($conn)){
                        $sqlquery = "INSERT INTO users (email, password, name) VALUES ('$registerEmail', '$registerHash', '$name')";  
                        $result1 = $conn->query($sqlquery);
                        $sqlquery3 = "SELECT * FROM users WHERE email = '$registerEmail'";
                        $result3 = $conn->query($sqlquery3);
                        $userdetails = $result3->fetch_array(MYSQLI_NUM);
                        $_SESSION['userID'] = $userdetails[0];
                        $conn->close();
                        $_SESSION['name'] = $name;
                        $_SESSION['email'] = $registerEmail;
                        header('location: user.php');
                    }
            }else{                
                $error = 3; //account already created
            }
    }else{
        $error = 4; //passwords dont match
    }
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>ListR</title>

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

<body onload="addrow();">

    <div class="d-flex" id="wrapper">

        <!-- Sidebar -->
        <div class="collapse-sm" id="sidebar-collapse">
        <div class="bg-light border-right" id="sidebar-wrapper">
            <div class="sidebar-heading text-center">To save and view your lists, Login here! </div>
            
            <div class="list-group list-group-flush">
                
                <!-- Login Form -->
                <form class="form-signin" id="loginDetails" name="loginDetails" action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
                <br>
                <h3 class="text-center" id="loginTitle"><u>Login!</u></h3>
                <br>
                <input class="form-control" type="email" id="loginEmail" name="loginEmail" required="" autofocus="" placeholder="Email" value="" />
                <br>
                <input class="form-control" type="password" id="loginPass" name="loginPass" required="" placeholder="Password" />
                
                <?php
                    if($error == 1){
                        echo "<p>Email is wrong or account does not exist</p>";
                    }
                  if($error == 2){
                        echo "<p>Wrong Password</p>";
                    }
                  if(isset($_GET['redirect']) &&  $_GET['redirect'] == 1){
                        echo "<p>You need to be logged in</p>";
                    }
                ?>
                <br>
                <button class="btn btn-lg btn-blue btn-block" type="submit" id="loginSubmit" name="loginSubmit" value="sign in">Login</button>           
                
            </form>
                
                <!-- Register Form -->
            <form class="form-signin" id="registerDetails" name="registerDetails" action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
                <br>
                <h3 class="text-center" id="registerTitle"><u>Register!</u></h3>
                <br>
                <input class="form-control" type="email" id="registerEmail" name="registerEmail" required="true" autofocus="true" placeholder="Email" value="" />
                <br>
                <input class="form-control" type="name" id="name" name="name" required="true" autofocus="true" placeholder="Name" value="" />
                <br>
                <input class="form-control" type="password" id="registerPass" name="registerPass" required="true" placeholder="Password" />
                <br>
                <input class="form-control" type="password" id="registerPass2" name="registerPass2" required="true" placeholder="Password Again" />
                
                <?php
                    if($error == 3){
                        echo "<br>
                            <div class=\"alert alert-danger\" role=\"alert\">
                            User already exists!
                            </div>
                            ";
                    }
                  if($error == 4){
                        echo "<br>
                        <div class=\"alert alert-danger\" role=\"alert\">
                        Passwords do not match!
                        </div>";
                    }
                ?>
                <br>
                <button class="btn btn-lg btn-blue btn-block" type="submit" id="registerSubmit" name="registerSubmit" value="sign in">Register</button>
            </form>    
                
                <!--<a href="#" class="list-group-item list-group-item-action bg-light">List-1</a>
                <a href="#" class="list-group-item list-group-item-action bg-light">List-2</a>
                <a href="#" class="list-group-item list-group-item-action bg-light">List-3</a>
                <a href="#" class="list-group-item list-group-item-action bg-light">List-4</a>
                <a href="#" class="list-group-item list-group-item-action bg-light">List-5</a>
                <a href="#" class="list-group-item list-group-item-action bg-light">List-6</a>-->
            </div>
        </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">

            <!-- Top Navbar -->
            <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom" id=>

                <ul class="nav navbar-nav ml-auto">

                    <li class="nav-item">
                        <a class="btn btn-blue ml-1 mr-1" href="#loginTitle" role="button"> Login <i class="fas fa-sign-in-alt"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-blue ml-1 mr-1" href="#registerTitle" role="button" > Register <i class="fas fa-user-plus"></i></a>
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
            </nav>

            <!-- Customisable Bacground for the Page -->
            <div id="outerpage">

                <!-- The 'Page'/ Paper -->
                <div class="container-fluid" id="page">
                    <h1 class="text-center pt-4 pb-4"> List Title</h1>

                    <div class="container-fluid borders">
                        <!-- Fieldset for the Lists -->
                        <fieldset id="buildyourform">
                            
                        </fieldset>
                    </div>

                    <!--<div class="container">
                        <img id="add" class="addrow" src="icons/plus.svg" alt="Add Row" style="height: 3rem;">
                    </div>-->


                </div>
            </div>

        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->



    <!-- Javascript -->
    <script src="addinput.js" type="text/javascript"></script>
    <script src="settings.js" type="text/javascript"></script>

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

    
<script src="addinput.js" type="text/javascript"></script>

</body>

</html>
