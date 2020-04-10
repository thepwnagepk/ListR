<?php
session_start();

$error=0;
require ("connect.php");
$conn = CreateHandle();

if (!isset($_SESSION['name'])){    
    header('location: index.php');
}


if(isset($_GET['previewID'])){
        $previewlistid1 = $_GET['previewID'];
        $previewlistsqlquery = "SELECT * FROM lists WHERE listID = " . $previewlistid1;
                $result2 = $conn ->query($previewlistsqlquery);
        $listdetails = $result2->fetch_array(MYSQLI_NUM);
    
    
    
    
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>ListR Marketplace</title>

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
  <?php if(isset($_GET['previewID'])) {       
            echo "loadpreview();";
        } else {
            echo "";
        }
      
              ?>
              ">



    <div class="d-flex" id="wrapper">
        <!-- Page Wrapper -->

        <!-- Sidebar -->
        <div class="collapse" id="sidebar-collapse">

            <div class="bg-light border-right" id="sidebar-wrapper">
                <a id="mainpagelink" href="user.php">
                    <h5 class="pt-3 pb-2 text-center"><?php echo $_SESSION['name']?>'s ListR </h5>
                </a>


                <div class="list-group list-group-flush">
                    <a href="user.php" class="list-group-item list-group-item-action bg-light"><i class="fas fa-plus mr-2"></i> <b>New list</b></a>
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

                </div>
            </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">

            <!-- Top Navbar -->
            <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom" id=>
                <button class="btn btn-outline-dark" type="button" data-toggle="collapse" data-target="#sidebar-collapse" aria-controls="sidebar-collapse" aria-expanded="false" aria-label="Toggle navigation"><i class="fas fa-tasks"></i>
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

            <!-- Customisable Background for the Page -->
            <div id="outerpage">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">


                                <form class="form-inline d-flex justify-content-between my-2" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="get">
                                    <!-- Sort Button & Dropdown -->

                                    <div class="btn-group">
                                        <button type="button" class="btn btn-blue dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Sort by:
                                        </button>
                                        <div class="dropdown-menu">
                                            <div class="dropdown-divider"></div>
                                            <button class="dropdown-item" type="submit" name="newest" value="newest">Newest</button>
                                            <button class="dropdown-item" type="submit" name="oldest" value="oldest">Oldest</button>
                                            <button class="dropdown-item" type="submit" name="ascending" value="ascending">List name, Ascending</button>
                                            <button class="dropdown-item" type="submit" name="descending" value="descending">List name, Descending</button>

                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="marketplace.php">Reset</a>
                                        </div>
                                    </div>
                                    <!-- Search Bar and Button -->
                                    <input class="form-control ml-2" type="input" placeholder="Search lists by title" aria-label="Search" id="search" name="search" value="<?php isset($_GET['search']) ? print(htmlspecialchars($_GET['search'])) : "";  ?>">
                                    <button class="btn btn-green my-2 my-sm-0" type="submit">Search</button>

                                </form>



                                <?php

            
            if(isset($_GET['search'])){
            $listsqlquery = "SELECT DISTINCT lists.listID,lists.title,lists.createdBy,users.name,lists.dateCreated FROM lists INNER JOIN users ON lists.createdBy = users.userID WHERE lists.public = 1 AND title LIKE '%".$_GET['search']."%'";
            } else {
            $listsqlquery = "SELECT DISTINCT lists.listID,lists.title,lists.createdBy,users.name,lists.dateCreated FROM lists INNER JOIN users ON lists.createdBy = users.userID WHERE lists.public = 1";
            }
            
            if(isset($_GET['ascending'])){
                $asc = " ORDER BY title ASC";
                $result2 = $conn ->query($listsqlquery .= $asc);
            } else if(isset($_GET['descending'])){
                $desc = " ORDER BY title DESC";
                $result2 = $conn ->query($listsqlquery .= $desc);
            } else if(isset($_GET['newest'])){
                $dasc = " ORDER BY dateCreated ASC";
                $result2 = $conn ->query($listsqlquery .= $dasc);
            } else if(isset($_GET['oldest'])){
                $ddesc = " ORDER BY dateCreated DESC";
                $result2 = $conn ->query($listsqlquery .= $ddesc);
            } else {                
            $result2 = $conn ->query($listsqlquery);
            }
    
                                
        if ($result2 -> num_rows > 0){
            while($row2 = $result2 -> fetch_assoc()){
                echo "<div class=\"px-1 col-md-6\"><div class=\" mb-1 p-2 bg-light marketplace-border\"><h6>".$row2['title']."</h6><p>Created By: ".$row2['name']."</p><p>Created On: ".$row2['dateCreated']."</p><button type=\"button\" class=\"btn btn-blue btn-sm \" id=\"clonebutton\" onclick=\"clonelist(".$row2['listID'].");\" " ;
                if($row2['name'] == $_SESSION['name']){ echo "disabled";} else { echo "";}
                echo ">Clone</button><button type=\"button\" class=\"btn btn-blue btn-sm \" id=\"previewbutton\" onclick=\"refreshtopreview(".$row2['listID'].");\">Preview</button></div></div> ";
                }
        }
        
                ?>


                            </div> <!-- end of row -->
                        </div><!-- end of left half -->

                        <div class="col-md">
                            <div class="container">
                                <div class="row">
                                    <div class="col">
                                        <div class="container-fluid border" id="page">
                                            <div class="row">
                                                <div class="col">
                                                    <h1 class="text-center pt-4 pb-4" contenteditable="false" id="listtitle">Click 'Preview' to see a list!</h1>

                                                    <fieldset id="buildyourform">

                                                    </fieldset>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end of right half -->
                    
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->



    <!-- Javascript -->
    <script src="previewlist.js" type="text/javascript"></script>
    <script src="settings.js" type="text/javascript"></script>


    <script>
        function clonelist(listID) {
            clonequery = "clonelist.php?userID=" + <?php echo $_SESSION['userID'] ?> +"&listID=" + listID;
            window.location.replace(clonequery);
        }

    </script>
    <script>
        function refreshtopreview(listID) {
            var previewquery = "marketplace.php?previewID=" + listID;
            window.location.replace(previewquery);
        }

        function loadpreview() {
            var gettitlefromphp = '<?php isset($listdetails) ? print($listdetails[5]) : ""; ?>';
            document.getElementById('listtitle').innerHTML = gettitlefromphp;
            var getlistfromphp = '<?php isset($listdetails) ? print($listdetails[1]) : ""; ?>';
            console.log(getlistfromphp);
            var list = JSON.parse(getlistfromphp);
            console.log(list);

            for (i = 0; i < Object.keys(list).length; i++) {
                addrow();
                document.getElementById(i).value = list[i].value;
                if (list[i].type == "checked") {
                    document.getElementById("c" + i).checked = true;
                }
            }

        }

    </script>

    <script>
        //code that can be used to attempt AJAX calls for the preview for a future improvement
        function previewlistajax(listID2) {

            if (window.XMLHttpRequest) {
                // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else {
                // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("page").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", "getpreivew.php?listID=" + listID2, true);
            xmlhttp.send();
        }

    </script>


    <!-- jQuery full file with AJAX -->
    <script src="jquery.js"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

</body>

</html>
