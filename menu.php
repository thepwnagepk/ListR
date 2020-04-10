 <?php
 
echo '
<nav id="sidebar">
            <div id="dismiss">
                <i class="fas fa-arrow-left"></i>
            </div>

            <div class="sidebar-header">
                <h3>ListR</h3>
            </div>

            <ul class="list-unstyled components">
                <li class="active">
                    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false">Lists</a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">
                        <li>
                            <a href="#">List 1</a>
                        </li>
                        <li>
                            <a href="#">List 2</a>
                        </li>
                        <li>
                            <a href="#">List 3</a>
                        </li>
                    </ul>
                </li>
                <div class="line"></div>
                <li>
                    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false">Templates</a>
                    <ul class="collapse list-unstyled" id="pageSubmenu">
                        <li>
                            <a href="#">Template 1</a>
                        </li>
                        <li>
                            <a href="#">Template 2</a>
                        </li>
                        <li>
                            <a href="#">Template 3</a>
                        </li>
                    </ul>
                </li>

            </ul>
            
<footer class="fixed-footer">
  <div class="container">
     
               
            
    <div id="formContent">    
    

        <!-- Login and Register Button form -->
        <form>          

          <button type="button" id="" class="btn btn-block btn-dark" data-toggle="modal" data-target="#loginModal">Login</button>

          <button type="button" id="" class="btn btn-block btn-dark" data-toggle="modal" data-target="#registerModal">Register</button>
        </form>

    </div>
  </div>
</footer> 
</nav>

        

            
'
    
?>