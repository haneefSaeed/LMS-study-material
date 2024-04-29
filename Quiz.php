<?php
require_once("includes/classes.php");
$page = new AllPagesOperation();
$page->head("Quiz | Kardan E-Study");
$page->Session();

if(isset($_GET['fac_id'])){
    $fac_id = @$_GET['fac_id'];
    $sub_id = @$_GET['sub_id'];
    $ch_id = @$_GET['ch_id'];
}else header("location:index.php");
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
                    <h3 class="textwhite animated slideInLeft">Practical Quiz </h3>
                    <h5 class="textwhite animated slideInLeft delay-02s">

                        <a class="textwhite" href="index.php"><?php
                            echo $page->getFacultyNameByID($fac_id);
                            ?></a> /

                        <a class="textwhite" href="Topic.php?<?php
                        echo 'fac_id='. $fac_id . "&sub_id=". $sub_id;
                        ?>"><?php
                            echo $page->getSubjectNamebyID($sub_id);
                            ?></a> /

                        <a class="textwhite" href="Chapter.php?<?php
                        echo 'fac_id='. $fac_id . "&sub_id=". $sub_id . "&ch_id=" . $ch_id;
                        ?>">Chapter <?php echo $ch_id; ?></a></h5>
                    <div class="float-right animated slideInRight"><button type='button' id="read_doc" class="btn btn-success mr-2" name="<?php echo $fac_id; ?>" role="<?php echo $sub_id; ?>" style="<?php echo $ch_id; ?>"><i class="fa fa-check-circle"></i> Mark as Read</button> </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 pt-2 textwhite" style="text-align: justify">
                <form class="form animated rotateInUpRight " id="quizform" method="post">
                    <table class="table-light table-bordered table">

                        <tr>
                            <td colspan="3"><label><b>1. Digital Marketing is marketing through:</b> </label></td>
                        </tr>
                        <tr>
                            <td width="30%">
                                <input type="radio" required required class="form-check-inline" name="q1" id="q1-1" value="A"> A. Print Media</td>
                            <td><input type="radio" requiredrequired class="form-check-inline" name="q1" id="q1-2" value="B"> B. Broadcast Media</td>

                            <td><input type="radio" required class="form-check-inline" name="q1" id="q1-3" value="C"> C. Electronic device </td>
                            <td><input type="radio" required class="form-check-inline" name="q1" id="q1-4" value="D"> D. All of the above</td>
                        </tr>

                        <tr>
                            <td colspan="3"><label><b>2. Broadcast media includes:</b> </label></td>
                        </tr>
                        <tr>
                            <td><input type="radio" required class="form-check-inline" name="q2" id="q2-1" value="A"> A. News paper and magazine </td>
                            <td><input type="radio" required class="form-check-inline" name="q2" id="q2-2" value="B"> B. TV and radio </td>


                            <td><input type="radio" required class=" form-check-inline" name="q2" id="q2-3" value="C"> C. Fliers, Postcards</td>
                            <td><input type="radio" required class="form-check-inline" name="q2" id="q2-4" value="D"> D. Newsletters, Brochures</td>
                        </tr>

                        <tr>
                            <td colspan="3"><label><b>3. Features of Digital Marking: </b> </label></td>
                        </tr>
                        <tr>
                            <td><input type="radio" required class="form-check-inline" name="q3" id="q3-1" value="A"> A. Interactivity </td>
                            <td><input type="radio" required class="form-check-inline" name="q3" id="q3-2" value="B"> B. Social Networking </td>

                            <td><input type="radio" required class="form-check-inline" name="q3" id="q3-3" value="C"> C. Mass reach </td>
                            <td><input type="radio" required class="form-check-inline" name="q3" id="q3-4" value="D"> D. All of the above </td>
                        </tr>

                        <tr>
                            <td colspan="3"><label><b>4. Through Digital Marketing:</b> </label></td>
                        </tr>
                        <tr>
                            <td><input type="radio" required class="form-check-inline" name="q4" id="q4-1" value="A"> A. You connect with more customers online </td>
                            <td><input type="radio" required class="form-check-inline" name="q4" id="q4-2" value="B"> B. You spend more money  </td>
                            <td><input type="radio" required class="form-check-inline" name="q4" id="q4-3" value="C"> C. Cant reach customers easily  </td>
                        </tr>

                        <tr>
                            <td colspan="3"><label><b>5. Satisfying customers needs and wants through electronic device is a part of:</b> </label></td>
                        </tr>
                        <tr>
                            <td><input type="radio" required class="form-check-inline" name="q5" id="q5-1" value="A"> A. Management  </td>
                            <td><input type="radio" required class="form-check-inline" name="q5" id="q5-2" value="B"> B. Marketing  </td>

                            <td><input type="radio" required class="form-check-inline" name="q5" id="q5-3" value="C"> C. Digital marketing  </td>
                            <td><input type="radio" required class="form-check-inline" name="q5" id="q5-4" value="D"> D. None </td>
                        </tr>
                        <tr><td></td></tr>
                        <tr><td colspan="3"></td>
                            <td class=" float-right p-4"> <input type="button" class="btn btn-lg btn-success" value="Evaluate!" id="evaluate"></td>

                        </tr>

                    </table>


                </form>
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

<div id="results"  tabindex="-1" role="dialog" aria-labelledby="results" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="results" class="modal-title" style="color: red;">Your Results is <span id="mark"></span> </h5>
                <button type="button" id="close" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <p>Great! Here's Your results:</p>
                <h6 style="color:green;">Total Right Answers: <b id="right_answers"></b></h6>
                <h6 style="color: red;">Total Wrong Answers: <b id="wrong_answers"></b></h6>
                <h6>All Your Answers: </h6>
                <table class="table table-borderless">
                    <tr>
                        <td><p id="all_answers"></p></td>
                        <td><h6 id="show_answers"></h6></td>
                    </tr>
                </table>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="Back"><i class="fa fa-eye"></i> See Answer </button>
                <a href="Notes.php" class="btn btn-info" ><i class="fa fa-sticky-note"></i> Read Notes</a>
                <button type="button" data-dismiss="modal" class="btn btn-secondary">Close</button>
            </div>
        </div>
    </div>
</div>

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

</body>

<script src="js/jquery-3.4.1.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap.bundle.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>

<script>
    $(document).on('click', '#evaluate', function () {

         All =0; Right =0;  Wrong= 0; NA=5;

        /**
         * @return {number}
         */
        function FindChecked(question, items) {
            var Answers = document.getElementsByName(question),
                Ans;
            for(x = 0; x<Number(items); x++) {
                if (Answers[x].checked === true) {
                    Ans = Answers[x].value;
                }
            }return Ans;
        }


        select1 = FindChecked('q1', 4);
        select2 = FindChecked('q2', 4);
        select3 = FindChecked('q3', 4);
        select4 = FindChecked('q4', 3);
        select5 = FindChecked('q5', 4);

        function checkAnswer(selected, answer){
            if(selected === answer){
                Right++;
                NA--;
                return selected;
            }else {
                NA--;
                Wrong++;
                return selected;
            }
        };

        RA1 = "C";
        RA2 = "B";
        RA3 = "D";
        RA4 = "A";
        RA5 = "C";
        Ans1 = checkAnswer(select1, RA1);
        Ans2 = checkAnswer(select2, RA2);
        Ans3 = checkAnswer(select3, RA3);
        Ans4 = checkAnswer(select4, RA4);
        Ans5 = checkAnswer(select5, RA5);
        console.log("Ans1: " + Ans1);
        console.log("Ans2: " + Ans2);
        console.log("Ans3: " + Ans3);
        console.log("Ans4: " + Ans4);
        console.log("Ans5: " + Ans5);

        /**
         * @return {string}
         */
        function RightorWrong(Ans1, RA1){
            if(Ans1===RA1) {
                return "<i class='fa fa-check' style='color: green;'></i>";

            }else {
                return "<i class='fa fa-times' style='color: red;'></i>";
            }
        }

        stat1 = RightorWrong(Ans1, RA1);
        stat2 = RightorWrong(Ans2, RA2);
        stat3 = RightorWrong(Ans3, RA3);
        stat4 = RightorWrong(Ans4, RA4);
        stat5 = RightorWrong(Ans5, RA5);


        allAns = "<br>"+ "Q1: " + stat1 + "<br>" +
            "Q2: " + stat2 + "<br>" +
            "Q3: " + stat3 + "<br>"   +
            "Q4: " + stat4 + "<br>" +
            "Q5: " + stat5 + "<br>";
        $('#all_answers').html(allAns);
        $('#right_answers').html(Right);
        $('#wrong_answers').html(Wrong);
        $('#not_answered').html(Wrong);
        $('#mark').html(Right+"/5");
        //$('#right_answers').html(Right);

        $('#results').modal("show");

    })

    $(document).on('click', "#Back", function () {
        Ans = "<br>"+ "Q1: " + RA1 + "<br>" +
            "Q2: " + RA2 + "<br>" +
            "Q3: " + RA3 + "<br>"   +
            "Q4: " + RA4 + "<br>" +
            "Q5: " + RA5 + "<br>";
        $('#show_answers').html(Ans)
    })
    $(document).on('blur', "#Back", function () {
        $('#show_answers').html('')
    })

    doctype = "Quiz";
    $(document).on('click', '#read_doc', function () {
        var faculty = $(this).attr('name');
        var chapter = $(this).attr('style');
        var subject = $(this).attr('role');
        var doc_submit = doctype;
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
        var doc_submit = doctype;
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

