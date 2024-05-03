<?php
require_once("includes/classes.php");
$page = new AllPagesOperation();
$page->head("Register | Kardan E-Study");

?>

<body class="dmchapterBody" style=" background-color: #333;">

<?php
//Menu Items
/*$page->logo();*/
?>
<div class="container">
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="row">
                    <div class="col-lg-12 pl-5 pt-5 mb-3" style="padding-left: 45%;">
                        <a href="index.php"> <img src="img/logo.png" width="80px"class=" d-inline-block animated fadeInDown"></a>

                        <h1 class="animated fadeInRight d-inline-block" style="color: #fff;">Kardan University, <b style="color: #fff;">E-Study!</b> </h1>
                    </div>
                </div>
                <div class="row animated rotateInUpLeft">
                    <div class="col-lg-3"></div>
                <div class="col-lg-6 p-3 text-left textwhite" style="color:black;background-color: rgba(255,255,255,0.5);padding-left: 20%;">
                    <h3>Register</h3>
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

                    <form class="form registerationform animated rotateInUpLeft delay-02s" method="post" action="includes/classes.php">
                        <table class="table table-borderless">
                            <tr>
                                <td width="25%"><label><b>Student ID *: &nbsp;</b></label></td>
                                <td> <input type="number"  required id="stId" placeholder="Student ID" name="Reg_id" class="col-md-6 form-control">
                                    <small>&nbsp; Ex: 2011809060</small></td>
                            </tr>
                            <tr>
                                <td>   <label><b>Student Name *:&nbsp;</b></label></td>
                                <td>  <input type="text"  required id="stName" placeholder="Name" name="Reg_name" class="form-control">
                                    <small>&nbsp;Ex: Mohammad Ahmad</small></td>
                            </tr>

                            <tr>
                                <td> <label><b>Email Address *:&nbsp;</b></label></td>
                                <td> <input type="email"  required id="stEmail" placeholder="Email Address" name="Reg_email" class="form-control">
                                    <small>&nbsp;Ex: ahmad@gmail.com</small></td>
                            </tr>

                            <tr>
                                <td> <label><b>Password *:&nbsp;</b></label></td>
                                <td> <input type="password"  required id="password" placeholder="Password" name="Reg_password" class="form-control">
                                    </td>
                            </tr>
                            <tr>
                                <td> <label><b>Confirm Password *:&nbsp;</b></label></td>
                                <td> <input type="password"  required id="confpassword" placeholder="Password" name="Reg_password" class="form-control">
                                    <small id="passError"></small> </td>
                            </tr>

                            <tr>
                                <td>   <label><b>Faculty:</b></label></td>
                                <td><select name="Reg_faculty" class="form-control">
                                        <option value="BBA">Bachelor Business Administration</option>
                                        <option value="BBA">Bachelor Computer Science</option>
                                        <option value="BBA">Bachelor Civil Engineering</option>
                                    </select></td>
                            </tr>

                            <tr>
                                <td> <label><b>Semester:</b></label></td>
                                <td><select name="Reg_semester" class="form-control col-md-3">
                                        <option value="1">1st</option>
                                        <option value="2">2nd</option>
                                        <option value="3">3rd</option>
                                        <option value="4">4th</option>
                                        <option value="5">5th</option>
                                        <option value="6">6th</option>
                                        <option value="7">7th</option>
                                        <option value="8">8th</option>
                                    </select></td>
                            </tr>

                            <tr>
                                <td> <label><b>Date of Birth:</b></label></td>
                                <td>  <input type="date" id="dob" placeholder="Date of Birth" name="Reg_dob" class="form-control col-md-6">
                                    <small>Ex: 01/01/1994</small></td>
                            </tr>
                            <tr>
                                <td> <label><b>Gender:&nbsp;</b></label></td>
                                <td><input type="radio" checked name="Reg_gender"value="Male" class="form-check-inline"> Male
                                    <input type="radio" name="Reg_gender" value="Female" class="form-check-inline"> Female
                                </td>
                            </tr>
                        </table>
                        <div class="form-group text-center">
                            <input type="button" id="Register" value="Register" name="Register" class="btn btn-dark">
                            <p>Already Registerd? <a href="login.php">Login Here</a> </p>
                        </div>
                    </form>


                </div>
                    <div class="col-lg-3"></div>
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

<script>
    function checkpass($curernt, $confirm) {
        if ($current != $confirm) {
            $('#passError').html("Password Does not match!");
            return false;
        } else {
            $('#passError').html("Password match!");
            return true;
        }
    }
$(document).on('change', '#confpassword', function () {
    $current = $('#password').val();
    $confirm = $('#confpassword').val();
    checkpass($current, $confirm);

});
    $(document).on('click', '#Register', function () {
        current = $('#password').val();
        confirm = $('#confpassword').val();
        res =checkpass(current, confirm);
        if(res == true){
            $.ajax({
                url:"includes/classes.php",
                method: "post",
                data : $('.registerationform').serialize(),
                success: function (data) {
                    $id = $('#stId').val();
                    if(data  == $id) {
                        alert(data +" Has been registered!");
                        document.location.reload();
                    }else {
                        alert(data);
                    }

                }
            })
        }else if (res==false) {
            alert("Please Confirm Password!");
        }else {
            alert("check!");
        }
            })
</script>

