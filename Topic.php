<?php
require_once("includes/classes.php");
$page = new AllPagesOperation();
$page->head("Topics | Kardan E-Study");
if(isset($_GET['sub_id'])){
    $subid = $_GET['sub_id'];
    $fucid = $_GET['fac_id'];
}else {
    header("location:index.php");
}
?>

<body class="dmchapterBody">

<?php
//Menu Items
$page->logo();
?>
<div class="container">
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 pl-5 pt-5" style="padding-left: 45%;">
                    <a href="index.php"> <img src="img/logo.png" width="80px"class=" d-inline-block animated fadeInDown"></a>

                    <h1 class="animated fadeInRight d-inline-block" style="color: #344;">Kardan University, <b style="color: #000;">E-Study!</b> </h1>
                    <h1 class="animated fadeInUp mt-3" style="color:#fff;"><?php

                    $page->getFacultyNameByID($fucid); echo " / ";  $page->getSubjectNamebyID($subid);
                    ?>
                    </h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 p-4" >
                    <table class="table table-light table-hover table-borderless animated fadeInUpBig">
                        <tbody>
                        <tr id="professors" class="lecturerow">
                        <td colspan="1">
                            <button class="btn btn-dark btn-lg" type="button" data-toggle="collapse" data-target="#prof" aria-expanded="false" aria-controls="collapseExample">
                                Subject & Professor Details:
                            </button>
                            <div class="collapse" id="prof">
                                <div class="card card-body mt-3">
                                    <div class="row" style="font-size: 16px; color: #333;" >
                                        <div class="col-lg-12" >
                                            <h5>Subject Details:</h5>
                                            <p><?php
                                            $page->getSubjectOffsetbyID($subid, "sub_detail");
                                            ?>
                                            </p>
                                            <h5>Professor Details:</h5>
                                            <?php
                                            $page->getSubjectOffsetbyID($subid, "sub_prof_detail", "<h6>", "</h6>");
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                            <td></td>
                        </tr>
                        <tr>
                            <th colspan="2" style="background-color: #0c5460;color:white;font-size: 22px;"><i class="fa fa-play-circle"></i> Subject Contents</th>
                        </tr>

                        <?php
                        $page->showChaptersBySubjectID($subid) ;?>
                        </tbody>
                        <tfoot>
                        <tr>
                            <th  style="background-color: #8c1f1a;color:white;font-size: 22px;"><i class="fa fa-question-circle"></i> Exam</th>
                            <th  style="background-color: #8c1f1a;color:white;font-size: 14px;"> Marks/Questions</th>
                        </tr>

                        <?php
                        $page->ShowQuizDatabySubjectID($fucid,$subid) ;?>
                        </tfoot>
                    </table>
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



