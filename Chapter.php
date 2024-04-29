<?php
require_once("includes/classes.php");
$page = new AllPagesOperation();
$page->head("Chapter panel | Kardan E-Study");
if(isset($_GET['ch_id'])){
    $ch_id = $_GET['ch_id'];
}else echo "No chapter error!";

?>

<body class="dmchapterBody" style="background-color: #79c2de; background-repeat: initial;  background-image: url('img/bg.jpg'); ">

<?php
//Menu Items
$page->logo();
?>
<div class="container">

        <div class="container-fluid animated slideinup">
            <div class="row">
                <div class="col-lg-12 pl-5 pt-5 mb-3" style="padding-left: 45%;">
                    <a href="index.php"> <img src="Img/logo.png" width="80px"class=" d-inline-block animated fadeInDown"></a>
                    <h1 class="animated fadeInRight d-inline-block" style="color: #fff;">Kardan University, <b style="color: #fff;">E-Study!</b> </h1>
                </div>
            </div>
            <div class="row  p-5" style="background-color: rgba(30,50,100,.9)">
                <div class="row w-100">

                    <div class="col-lg-8 pt-0 pl-0 textwhite align-middle" style="padding-left: 20%;">

                        <h3 class="textwhite animated slideInLeft"><?php
                            $id = $page->returnChapterOffsets($ch_id, 'ch_id');
                            $name = $page->returnChapterOffsets($ch_id, 'ch_title');
                            echo "Chapter ". $ch_id . " : " . $name;
                            ?> </h3>
                        <h5 class="textwhite animated slideInLeft delay-02s">
                            <a class="textwhite" href="Topic.php<?php
                            $sub_id = $_GET['sub_id'];
                            $fid = $_GET['fac_id'];
                            echo "?fac_id=".$fid. "&sub_id=". $sub_id;
                            ?>"> <?php

                                $page->getFacultyNameByID($fid);
                                echo " / ";
                                $page->getSubjectNamebyID($sub_id);
                                ?></a>
                            / <a class="textwhite" href="#">Chapter <?php
                                echo $ch_id;
                                ?></a>
                        </h5>
                        <div class="badge badge-warning p-2 animated mb-2 slideInLeft delay-02s" style="font-size: 14px;"><i class="fa fa-star"></i>
                            <?php
                            $rate = number_format(($page->findRatingforChapter($ch_id)), 2);
                            $feeds = $page->CountFeedbackRating($fid, $sub_id,$ch_id);
                            $people = $page->CountFeedbackUsers($fid, $sub_id,$ch_id);
                            echo " ". $rate . " (" . $feeds . " Feeds from ". $people . " Users)";  ?>
                        </div>
                    <?php
                    if(isset($_SESSION['Sess_user_id'])){
                        $perc = $page->calculatereadingpercentage($sub_id, $ch_id);
                        if($perc<100) {
                            echo '<div class="progress">';
                            echo '<div class=" progress progress-bar progress-bar-animated progress-bar-striped  active " role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width:';

                            $perc = $page->calculatereadingpercentage($sub_id, $ch_id);
                            echo (int)$perc . "%";
                            echo '">';
                            $perc = $page->calculatereadingpercentage($sub_id,$ch_id);
                            echo (int)$perc . "% Completed";
                            echo '</div></div>';

                        }else{
                    ?>
                </div>
                    <?php

                            echo '<div class="col-lg-4 badgebg animated flipIny delay-08s " style=""><img src="Img/badge.png" width="100%"></div>';

                        }
                    }
                    ?>


                </div>
                <div class="row w-100 textwhite text-left m-0 mt-4 mb-2 p-2" >
                        <div class="col-sm-6">
                            <h5 class="textwhite animated slideInLeft"><i class="fa fa-thumb-tack"></i> Objectives:</h5>
                            <h6>Students will achieve the knowledge and skills such as:</h6>
                            <ol type="1" class="animated slideInLeft delay-02s" >
                                <?php
                                $page->returnObjorOutbyChapterID($ch_id, 'ch_obj');
                                ?>
                            </ol>

                        </div>
                        <div class="col-sm-6">
                            <h5 class="textwhite animated slideInLeft"><i class="fa fa-exclamation-circle"></i> Learning Outcomes:</h5>
                            <h6>On successful completion of this chapter the learner will be able to:</h6>
                            <ol type="1" class="animated slideInLeft delay-02s" >
                                <?php
                                $page->returnObjorOutbyChapterID($ch_id, 'ch_out');
                                ?>
                            </ol>
                        </div>
                    </div>

                <div class="row">
                    <div class="col-lg-12 pl-0">
                        <?php
                        //'slide','book','quiz','note','videos','kvideos', 'articles', 'cases'

                        $page->chapterReaded($sub_id, $ch_id, "Slide", " Slides ", "slide.php?fac_id=$fid&sub_id=$sub_id&ch_id=$ch_id", "pan-5 btn-light", "vcard");
                        $page->chapterReaded($sub_id, $ch_id, "Note", " Written Notes ", "Notes.php?fac_id=$fid&sub_id=$sub_id&ch_id=$ch_id", "pan-5 btn-light", "sticky-note");
                        $page->chapterReaded($sub_id, $ch_id, "Book", " Books ", "Book.php?fac_id=$fid&sub_id=$sub_id&ch_id=$ch_id", "pan-5 btn-light", "book");
                        $page->chapterReaded($sub_id, $ch_id, "cases", " Case Study ", "cases.php?fac_id=$fid&sub_id=$sub_id&ch_id=$ch_id", "pan-5 btn-light", "key");


                        $page->chapterReaded($sub_id, $ch_id, "articles", " Articles ", "articles.php?fac_id=$fid&sub_id=$sub_id&ch_id=$ch_id", "pan-5 btn-light", "file");


                        $page->chapterReaded($sub_id, $ch_id, "Kvideos", " Kardan Videos ", "kardan_vid.php?fac_id=$fid&sub_id=$sub_id&ch_id=$ch_id", "pan-5 btn-light", "video-camera");
                        $page->chapterReaded($sub_id, $ch_id, "Videos", " Support Videos ", "Sup_vid.php?fac_id=$fid&sub_id=$sub_id&ch_id=$ch_id", "pan-5 btn-light", "play");
                        ?>

                    <button type="button" id="sum" class="btn btn-light  pan-5 m-1 animated slideInLeft delay-05s"><i class="fa vca fa-pencil"></i> Summary</button>


                    <a href="Topic.php<?php
                        echo "?fac_id=$fid&sub_id=$sub_id&ch_id=$ch_id";
                    ?>" class="btn btn-info pan-5 m-2 animated slideInLeft delay-04s"><i class="fa fa-address-book"></i> Other Chapters </a>
                        <button type="button" id="seefeedbacks" class="btn btn-warning pan-5 m-2 animated slideInLeft delay-03s"><i class="fa fa-feed"></i> See Feedbacks </button>
                        <center>
                        <?php
                        $page->chapterReaded($sub_id, $ch_id, "Quiz", " Practical Quiz ", "Quiz.php?fac_id=$fid&sub_id=$sub_id&ch_id=$ch_id", "pan-3 btn-danger", "question-circle");
                        ?>
                        </center>
                    </div>


            </div>

        </div>

</div>




    </div>


<!-- MODALS -->

<!-- Slide Modal -->
<div id="summary"  tabindex="-1" role="dialog" aria-labelledby="summarymo" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="summarymo" class="modal-title">Summary of Chapter 1</h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <h5>Digital Marketing</h5>
                <p>Digital Market is the set of marketing activities using electronic devices such as internet, social media, ads and websites to connect with the current and potential customers.</p>
                <h5>Digital media</h5>
                <p>Digital media can be Defined as any audio, video and any other Graphics such as photos and animation.</p>
                <h5>Features of Digital Media</h5>
                <li>Interactivity</li>
                <li>Social Networking</li>
                <li>Mass Reach</li>
                <h5>Benefits of Digital Marketing</h5>
                <li>Measurable results</li>
                <li>Low barrier to entry Traditional marketing activities Come with a large price tag.</li>
                <li>Reach larger Audiences</li>
                <li>Easy to optimize</li>
                <li>Digital marketing can make You money</li>
                <li>You connect with more</li>

            </div>
            <div class="modal-footer">
                <a href="notes.php" class="btn btn-primary">Read Notes</a>
                <button type="button" data-dismiss="modal" class="btn btn-secondary">Close</button>

            </div>
        </div>
    </div>
</div>
            <!-- Slide Modal -->






            <!--End of Modals -->



<div class="footer col-lg-12 mt-5">
</div>

<!--end of row -->

<div id="Feedbackbox"  tabindex="-1" role="dialog" aria-labelledby="Feedbackboxs" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="Feedbackboxs" class="modal-title">Feedbacks of Chapter <?php echo $ch_id ?></h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <h6><?php
                    echo "Total of : ". $page->CountFeedbackRating($fid, $sub_id,$ch_id) . " Feedback(s) From : " . $page->CountFeedbackUsers($fid, $sub_id,$ch_id) . " User(s)";
                    ?></h6>
                <table class="table table-striped table-borderless">
                    <tr>
                        <th>Username</th>
                        <th>Feedback</th>
                        <th>to</th>
                        <th>Rate</th>
                    </tr>
                    <?php

                    $page->fetchFeedbacksbychapter($fid, $sub_id,$ch_id);
                    ?>
                </table>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-secondary "><i class="fa fa-times" ></i> Close</button>

            </div>
        </div>
    </div>
</div>

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
    $(document).on('click', '#sum', function () {
        $('#summary').modal("show");
    })
    $(document).on('click', '#seefeedbacks', function () {
        $('#Feedbackbox').modal("show");
    })

</script>


