<?php
require_once("includes/classes.php");
$page = new AllPagesOperation();
$page->head("Login | Kardan E-Study");


if(isset($_SESSION['Sess_user_name'])){
//    header('location:Chapter.php');
    echo '<script>window.history.back()</script>';
}
?>

<body class="dmchapterBody" style="background-image: url('img/bg.jpg'); background-blend-mode: multiply;!important; background-color: #333;">

<?php
//Menu Items
/*$page->logo();*/
?>
<div class="container">
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="row">
                    <div class="col-lg-12 pl-5 pt-5 mb-3" style="padding-left: 45%;">
                        <a href="index.php"> <img src="Img/logo.png" width="80px"class=" d-inline-block animated fadeInDown"></a>

                        <h1 class="animated fadeInRight d-inline-block" style="color: #fff;">Kardan University, <b style="color: #fff;">E-Study!</b> </h1>
                    </div>
                </div>
                <div class="row animated rotateInUpLeft">
                    <div class="col-lg-4"></div>
                <div class="col-lg-4 p-3 text-center textwhite" style="color:black;background-color: rgba(255,255,255,0.5);padding-left: 20%;">
                    <h3>Login</h3>
                   <hr>

                        <?php
                        if(isset($_GET['id'])){
                            $error_id = $_GET['id'];
                            if($error_id ==1 ){
                                echo "<div class=\"alert alert-danger\" id=\"errors\"><b>Ooops...Seems like you need to login to access material.</b></div>";
                            }else if($error_id ==3 ){
                                echo "<div class=\"alert alert-danger\" id=\"errors\"><b>Login Failed, Maybe ID or passwrd is wrong!</b></div>";
                            }
                        }
                        ?>

                    <form class="form animated rotateInUpLeft delay-02s " method="post" action="includes/classes.php">
                        <div class="form-group">
                            <label><b>Student ID *:</b></label>
                            <input type="number"  required id="stId" placeholder="Student ID" name="student_id" class="form-control">
                            <small>Ex: 2011809060</small>
                        </div>
                        <div class="form-group">
                            <label><b>Student Password *:</b></label>
                            <input type="password"  required id="stPass" placeholder="Password" name="student_pass" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="submit" id="submit" onclick="" value="Submit" name="submit" class="btn btn-success">
                        </div>
                    </form>
                    <p>Not Registered? <a href="register.php">Register Here</a> </p>

                </div>
                    <div class="col-lg-4"></div>
                </div>
            </div>

        </div>
    </div>
</div>




    </div>
<div class="footer col-lg-12 mt-5">
</div>

<!--end of row -->

<!-- Javascript -->
<?php
/*$page->footer();
*/?>

</body>

<script src="js/jquery-3.4.1.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap.bundle.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>



