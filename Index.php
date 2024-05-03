<?php
require_once("includes/classes.php");
$page = new AllPagesOperation();
$page->head("Home | QuizTime");
?>

<body class="homepageBody animated fadeIn">

<?php
//Menu Items
$page->logo();
?>
<div class="container">
    <div class="container-fluid">
        <div class="container-fluid">

        </div>
    </div>
</div>

    <div class="row">

        <div class="col-lg-9 p-5 mt-5" style="color: #085766;">

            <img src="img/logo.png" width="150px"  class="animated fadeInDown" style="margin-left: 15%;">
            <h1 style="text-transform: uppercase;" class="animated fadeInDown delay-02s">Kardan University,</h1>
            <h1 class="animated fadeInleftBig" >Welcomes you To <b style="color: #661a5f;">E-Study!</b> </h1>
            <h3 class="animated fadeInleftBig delay-02s" style="color: #555;">Select your faculty and subject below:</h3>
            <br>
            <!-- Example single danger button -->



            <?php
            $page->FacultyTabs();
            ?>

            </div>






            <div class="footer col-lg-12 mt-5 mb-0">
                <p>Copyright © 2020 | Digital Marketing Project for Kardan University
                    </p>
                <p><b>Designed and Implemented by: </b>Hasina, Saeed, Hanif</p>
            </div>
        </div>


    </div>

<!--end of row -->

<!-- Javascript -->
<?php
/*$page->footer();
*/?>

</body>
<script src="js/jquery-3.4.1.js"></script>
<script src="js/bootstrap.bundle.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/bootstrap.min.js"></script>
