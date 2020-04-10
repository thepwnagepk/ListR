<?php
session_start();

$error=0;
require ("connect.php");
$conn = CreateHandle();

if (!isset($_SESSION['name'])){    
    header('location: index.php');
}


if(isset($_GET['listID'])){
        $listid1 = $_GET['listID'];
        $listsqlquery2 = "SELECT * FROM lists WHERE listID = " . $listid1;
                $result2 = $conn ->query($listsqlquery2);
        $listdetails = $result2->fetch_array(MYSQLI_NUM);
    
    
    
    
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
    <!-- My Custom CSS -->
    <link rel="stylesheet" href="style.css">
    <!-- Fonts, Commented out in CSS - go uncomment them there to try them out -->
    <link href="https://fonts.googleapis.com/css?family=Caveat|Indie+Flower&display=swap" rel="stylesheet">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

</head>

<body onload=" 
<?php 
    if(isset($listdetails))
    {
        if($listdetails[3] == $_SESSION['userID'])
        {
            echo "loadlist(); addrow()";
        }
        else 
        {
            $error=2;
        }
    }
    else 
    {
        echo "addrow();";
    }
    
    
?>
              
">



    <div class="d-flex" id="wrapper">

        <!-- Sidebar -->
        <div class="collapse" id="sidebar-collapse">
        <div class="bg-light border-right" id="sidebar-wrapper">
            <a id="mainpagelink" href="user.php"><h5 class="pt-3 pb-2 text-center"><?php echo $_SESSION['name']?>'s ListR </h5></a>


            <div class="list-group list-group-flush">
                <a href="user.php" class="list-group-item list-group-item-action bg-light"> <i class="fas fa-plus mr-2"></i> <b>New list</b></a>
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
                <button class="btn btn-outline-dark" type="button" data-toggle="collapse" data-target="#sidebar-collapse" aria-controls="sidebar-collapse" aria-expanded="false" aria-label="Toggle navigation"><i class="fas fa-tasks"></i>
                </button> <!-- Sidebar Collapse Button -->
                
                 
                
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarMainCollapse" aria-controls="navbarMainCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarMainCollapse">
                <ul class="nav navbar-nav ml-auto">

                    
                   
                    <li class="nav-item">
                        <a class="btn btn-primary btn-blue ml-1 mr-1" href="marketplace.php" role="button"> Marketplace <i class="fas fa-tasks"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-primary btn-blue ml-1 mr-1" href="profile.php" role="button"> Profile <i class="fas fa-user-alt"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-primary btn-blue ml-1 mr-1" href="logout.php" role="button"> Logout <i class="fas fa-sign-out-alt"></i></a> 
                    </li>
                    <li class="nav-item">
                        <div class="dropdown dropleft">

                            <a class="btn btn-primary btn-blue ml-1 mr-1" href="#" role="button" id="dropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Settings<i class="fas fa-wrench"></i></a>

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
                <div class="container-fluid" id="page">
                    <div class="row">
                    <div class="col">
                    <h1 class="text-center pt-4 pb-4" contenteditable="true" id="listtitle">List Title</h1> 

                    <div class="container-fluid borders">
                        <div class="row">
                    <div class="col">
                        <!-- Fieldset for the Lists -->
                        <fieldset id="buildyourform">

                        </fieldset>

                        <?php 
                        if($error==2){
                            echo "you do not have permission to view this list";
                        };//not allowed to view, wrong user
                        ?>
                        
                        <hr>
                        <?php if(isset($_GET['saved'])){
                    echo "<div class=\"alert text-center alert-success\" role=\"alert\" id=\"listsavealert\">  Your list has been saved! </div>";
                    } ?>
                        <?php
                        if (isset($listdetails)){
                        echo "<p class=\"text-center\">";
                        if($listdetails[4] == 0){    
                                    echo "Visibility: <b>Private</b>";
                                    }
                            else if($listdetails[4] == 1){
                                    echo "Visibility: <b>Public</b>";
                                    }
                            else {
                                    echo "Visibility: <b>Unknown</b>";
                                    }
                        }
                        echo "</p>";
                        ?>
                        
                        
                        <div class="row">
                            
    
                        <!-- Buttons -->
                        <!-- <div class="btn-group"role="group"> -->
                        <!-- Save Button -->
                            <div class="col">
                                <div class="row">
                        <button type="button" class="btn btn-block btn-green" onclick="<?php if(isset($_GET['listID'])){ echo "updatelist(".$_GET['listID'].");"; }else {echo "savetodb();";} ?>">                       
                            <?php if(isset($_GET['listID'])){ echo "Update "; }else {echo "Save New List";} ?> <i class="fas fa-save"></i> </button>
                                </div>
                                </div>
                        <!-- Button trigger delete modal -->
                                <div class="col">
                                    <div class="row">
                        <?php if(isset($_GET['listID'])){ echo "<button type=\"button\" class=\"btn btn-block btn-red\" data-toggle=\"modal\" data-target=\"#deleteModal\">Delete <i class=\"fas fa-trash-alt\"></i></button>";} ?>
                                    </div>
                                    </div>
                        <!-- Visibility Buttons -->
                        <div class="col">
                            <div class="row">
                        <?php                           
                        if(isset($_GET['listID'])){
                        echo "<button type=\"button\" class=\"btn btn-block btn-yellow\" onclick=\"makepublicprivate();\">
                            Go "; 
                        
                        if(isset($listdetails)){ 
                            if($listdetails[4] == 0){
                                echo "Public";
                                }
                        else{
                            echo "Private";
                        }
                        }
                        echo " <i class=\"fas fa-exchange-alt\"></i></button>";
                        }
                            
                        ?>
                        
                        <!--</div>-->
                                                

                        </div>                                    
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="#deleteModallabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModallabel">Are you sure you want to delete this list?</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Listr stores no backups, so if you chose to delete a list, its gone for good. Make sure you choose carefully.</p>
                                    </div>
                                    <div class="modal-footer">
                                        <a role="button" class="btn btn-red" id="deletebutton" onclick="deletelist();">Yes, Delete this list</a>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No, Keep the list</button>                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>    
                    
                        
                    </div>
                    </div>
                    </div><!--end of list -->

                    <!--<div class="container">
                        <img id="add" class="addrow" src="icons/plus.svg" alt="Add Row" style="height: 3rem;">
                    </div>-->
</div>
</div>
                </div><!-- end of page-->
            </div>

        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->



    <!-- Javascript -->
    <script src="addinput.js" type="text/javascript"></script>
    <script src="settings.js" type="text/javascript"></script>
    
    <script>
        function loadlist() {
            var gettitlefromphp = '<?php isset($listdetails) ? print($listdetails[5]) : ""; ?>';
            document.getElementById('listtitle').innerHTML = gettitlefromphp;
            var getlistfromphp = '<?php isset($listdetails) ? print($listdetails[1]) : ""; ?>';
            list = JSON.parse(getlistfromphp);
            json = getlistfromphp;
            console.log(json);

            for (i = 0; i < Object.keys(list).length; i++) {
                addrow();
                document.getElementById(i).value = list[i].value;
                if(list[i].type == "checked"){
                document.getElementById("c" + i).checked = true;
                }
            }

        }
        
        function deletelist(){
            console.log('delete clicked')
            if(<?php echo $error ?>!=2){
                var deletequery = "deletelist.php?listID=" + <?php echo $_GET['listID'] ?> ;
                window.location.replace(deletequery);
            }
        }
        
        function makepublicprivate(){
            var publicstatus = '<?php isset($listdetails) ? print($listdetails[4]) : ""; ?>';
            if(publicstatus == 0){
                publicstatus = 1;
            }else{
                publicstatus = 0;
            }
            var getlistfromphp = '<?php isset($listdetails) ? print($listdetails[1]) : ""; ?>';
            var publicprivatequery = "changepublicprivate.php?listID=" + <?php echo $_GET['listID'] ?> + "&newpublicprivate=" + publicstatus; 
            window.location.replace(publicprivatequery);
        }
        

    </script>


    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

</body>

</html>
