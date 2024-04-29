<?php
require_once("includes/classes.php");
$page = new AllPagesOperation();
$page->head("My Profile | Kardan E-stu22222dy");
$page->Session();
?>

<body class="dmchapterBody" style="background-color: #333;">

<?php
//Menu Items
$page->logo();
?>
<div class="container">
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="row">
                <div class="row">
                    <div class="col-lg-12 pl-5 pt-5 mb-3" style="padding-left: 45%;">
                        <a href="index.php"> <img src="Img/logo.png" width="80px"class=" d-inline-block animated fadeInDown"></a>

                        <h1 class="animated fadeInRight d-inline-block" style="color: #fff;">Kardan University, <b style="color: #fff;">E-Study!</b> </h1>
                    </div>
                </div>
                <div class="col-lg-12 pt-5 pl-3 textwhite" style="padding-left: 20%;">
                    <script type="text/javascript">
                        function goback () {
                            window.history.back();
                        }
                    </script>
                    <h3 class="textwhite animated slideInLeft"><?php echo  $_SESSION['Sess_user_name'] . "'s profile"; ?> </h3>
                    <div class="float-right animated slideInRight"><button type='button' onclick="goback()" class="btn btn-light mr-2"><i class="fa fa-arrow-left"></i> Go back!</button> </div>

                    <div class="float-right"><!--Items--></div>
            </div>
            </div>
            <div class="row">
            <div class="col-lg-12 mt-4 p-3" style="background-color: white;">
                <h5 class="text-left"><i class="fa fa-bar-chart"></i> Statics</h5>
                <table class="table table-hover">
                    <tr>
                        <th>S/N</th>
                        <th>Subject Name</th>
                        <th>Chapter Name</th>
                        <th>Completion</th>
                    </tr>
                <?php

                $page->fetchCompletedCourses();
                ?>
                </table>
            </div>

        </div>
            <div class="row">
                <div class="col-lg-12 mt-3 p-3" style="background-color: white;">
                    <h5 class="text-left"><i class="fa fa-bar-chart"></i> Exam History</h5>
                    <?php
                    $page->fetchQuizHistory();
                    ?>
                </div>
    </div>
</div>




    </div>
<div class="footer col-lg-12 mt-5">
</div>

<!--end of row -->
<div id="RateSlide"  tabindex="-1" role="dialog" aria-labelledby="RateSlides" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="RateSlides" class="modal-title">Feedback!</h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <p>Please provide your feedback to improve the materials.</p>
                <form class="rateslideform">

                    <div class="form-group col-12">
                        <label>Feedback</label>
                        <textarea class="form-control feedback" name="slide_feedback"></textarea>
                    </div>

                    <div class="form-group col-3">
                        <label>Rate</label>
                        <select name="slide_rate" class="form-control rating">
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" value="Rate!" name="rate" class="btn btn-primary rate"><i class="fa fa-star"></i> Rate </button>
                <button type="button" data-dismiss="modal" class="btn btn-secondary nothanks"><i class="fa fa-ban" ></i> No Thanks</button>

            </div>
            </form>
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
    $(document).on('click', '#print', function () {
        window.print();
    })
</script>

<script>
    $(document).on('click', '#read_doc', function () {
        var faculty = $(this).attr('name');
        var chapter = $(this).attr('style');
        var subject = $(this).attr('role');
        var doc_submit = "Note";
        $.ajax({
            url:"includes/classes.php",
            method: "post",
            data: {
                doc_submit: doc_submit,
                doc_faculty : faculty,
                doc_subject : subject,
                doc_chapter: chapter,
            },
            success: function (data) {
                Const = "Seems like you already read this " + doc_submit;
                Const2 = "You already added feedback ";
                if(data == Const || data == Const2){
                    alert(data);
                }else {
                    $('#RateSlide').modal("show");
                }
            }
        })
    })

    $(document).on('click', '.nothanks', function () {
        alert("Okay! This Material Has been Marked as read!");
    })

    $(document).on('click', '.rate', function () {
        var faculty = $('#read_doc').attr('name');
        var chapter = $('#read_doc').attr('style');
        var subject = $('#read_doc').attr('role');
        var doc_submit = "slide";
        var rate_body = $('.feedback').val();
        var rating = $('.rating').val();
        $.ajax({
            url:"includes/classes.php",
            method: "post",
            data: {
                doc_submit: doc_submit,
                doc_faculty : faculty,
                doc_chapter: chapter,
                doc_subject: subject,
                doc_rate_text:rate_body,
                doc_rating: rating},
            success: function (data) {
                $('#RateSlide').modal("hide");
            }
        })
    })
</script>


