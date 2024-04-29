<?php
session_start();
define("TABNUMBERS", 8);
class mysql {
    private  $con;
    public function connect()
    {
        $this->con = new mysqli("localhost", "root", "", "Kestudy");
        if($this->con){
            return $this->con;
        }
        return "DB ERROR: " . $this->con->connect_error;
    }

}
class AllPagesOperation
{
    private $con;

    //SQL functions
    public function __construct()
    {
        $db = new mysql();
        $this->con = $db->connect();
    }

    public function normalQuery($query, $no=0)
    {
        $q = $this->con->prepare($query) or die ("Query Error on $no : " . $this->con->error);
        $q->execute() or die("Cannot Execute: " . $this->con->error);
        $res = $q->get_result();
        return $res;
    }


    //page parts function
    public function head($title)
    {
        echo <<<_Head
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="css/bootstrap.css">
<link rel="stylesheet" href="css/bootstrap-grid.css" >
<link rel="stylesheet" href="css/bootstrap-reboot.css">
<link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.css">
<link rel="stylesheet" type="text/css"  href="css/added.css">
<link rel="stylesheet" type="text/css"  href="css/animate.css">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>$title</title>
</head>
_Head;

    }

    public function logo()
    {
        echo <<<_Menu
<div class="row">
            
                <div class="col-lg-10">
                </div>
                <div class="col-lg-2">
          
                
_Menu;
        if (isset($_SESSION['Sess_user_name'])) {
            echo '<a href="Profile.php" class="topbtns">' . $_SESSION['Sess_user_name'] . '</a> ';
            echo '<a href="includes/Classes.php?id=3945" class="topbtns btn-danger">Logout</a>';
        } else {
            echo '<a href="login.php" class="topbtns">Login</a> <a href="register.php" class="topbtns">Register</a>';
        }
        echo <<<_Menu
                
               </div>
        </div>
_Menu;

    }

    public function footer()
    {
        echo <<<_Footer

<script src="js/jquery-3.4.1.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap.bundle.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>

_Footer;

    }
    public function issetshead($param='fac_id',$direct="index.php"){

    }

    //login and sessions
    public function Session()
    {
        if (!isset($_SESSION['Sess_user_name'])) {
            header("location:login.php?id=1");
        }
    }

    public function login($id, $pass)
    {
        $q = $this->con->prepare("SELECT * From users where student_id = ?") or die("Error in Database : " . $this->con->error);
        $q->bind_param("i", $id);
        $q->execute() or die("Error Executing" . $this->con->error);
        $student_info = $q->get_result();
        foreach ($student_info as $info) {
            if ($pass == $info['password']) {
                $_SESSION['Sess_user_id'] = $info['id'];
                $_SESSION['Sess_user_name'] = $info['user_name'];
                $_SESSION['Sess_student_id'] = $info['Student_id'];
                $_SESSION['Sess_semester'] = $info['Semester'];
                $_SESSION['Sess_email'] = $info['Email_address'];
//                header("location:../index.php");
                echo '<script>window.history.back()</script>';
                return true;
            } else {
                return False;
            }
        }
    }

    public function is_Available_stid($id)
    {
        $q = $this->con->prepare("SELECT * from users where Student_id = ?");
        $q->bind_param('i', $id);
        $q->execute();
        $res = $q->get_result();
        $no = $res->num_rows;
        if ($no > 0) {
            return true;
        } else return false;
    }

    public function is_Available_email($email)
    {
        $q = $this->con->prepare("SELECT * from users where Email_address = ?") or die ("error with query" . $this->con->error);
        $q->bind_param('s', $email);
        $q->execute();
        $res = $q->get_result();
        $no = $res->num_rows;
        if ($no > 0) {
            return true;
        } else return false;
    }

    public function registerUser($id, $name, $email, $fac, $sem, $pass, $dob, $sex)
    {
        $insert = $this->con->prepare("INSERT INTO USERS VALUES (id, ?, ?, ?, ?, ?, ?, ?,? )") or die("Error with Query!");
        $insert->bind_param("ssisisss", $name, $pass, $id, $fac, $sem, $email, $dob, $sex);
        $exec = $insert->execute() or die ("Error Executing!");
        if ($exec) {
            Return $id . " has been registerd!";
        } else {
            return "Could Not Register";
        }


    }


    //rating system
    public function addAsReaded($fac,$sub, $ch, $type)
    {
        $user = $_SESSION['Sess_user_id'];
        $checkuser = $this->con->prepare("select * from user_readings where ur_user_id = $user AND ur_user_read = '$type' AND ur_reading_faculty = $fac AND ur_reading_subject = $sub AND ur_reading_chapter=$ch") or die($this->con->error);
        $checkuser->execute();
        $res = $checkuser->get_result();
        if ($res->num_rows <= 0) {
            $q = $this->con->prepare("insert into user_readings values (ur_id, ?, ?,?, ?, ?)") or die($this->con->error);
            $q->bind_param('iiiis', $user, $fac,$sub, $ch, $type);
            $q->execute();
            return true;
        } else return false;
    }

    public function AddFeeback($fac,$sub, $ch, $type, $rate, $feedback)
    {
        $user = $_SESSION['Sess_user_id'];
        $checkuser = $this->con->prepare("select * from rating where rate_user = $user AND rate_part = '$type' AND rate_faculty= $fac AND rate_subject=$sub AND rate_chapter=$ch") or die($this->con->error);
        $checkuser->execute();
        $res = $checkuser->get_result();
        if ($res->num_rows <= 0) {
            $q = $this->con->prepare("insert into rating values (rate_id, ?, ?, ?,?, ?, ?, ?)") or die($this->con->error);
            $q->bind_param('iiisisi', $user, $fac,$sub, $feedback, $ch, $type, $rate);
            $q->execute();
            return true;
        } else false;
    }

    public function calculatereadingpercentage($sub, $chapter)
    {
        $uid = $_SESSION['Sess_user_id'];
        $q = $this->con->prepare("SELECT * FROM user_readings WHERE ur_reading_chapter = $chapter AND ur_reading_subject = $sub AND ur_user_id = $uid") or die($this->con->error);
        $q->execute();
        $res = $q->get_result();
        $items = $res->num_rows;
        $percentage = $items * (100 / TABNUMBERS);
        $ifcomp = $this->normalQuery("SELECT * FROM COMPLETED_COURSE WHERE comp_sub_id = $sub AND comp_chapter_id = $chapter AND comp_user_id = $uid", 400);
        if($ifcomp->num_rows==0){
            $insert= $this->normalQuery("INSERT INTO COMPLETED_COURSE VALUES (comp_id, $sub, $chapter, $uid, $percentage)", 401);
        }else{
            $update = $this->normalQuery("UPDATE completed_course SET comp_percentage = $percentage WHERE comp_sub_id = $sub AND comp_chapter_id = $chapter AND comp_user_id = $uid ", 403);
        }
        return $percentage;
    }

    public function findRatingforChapter($chid)
    {
        $q = $this->con->prepare("SELECT AVG(`rate_rating`) AS 'rate' FROM rating where `rate_chapter` = $chid");
        $q->execute();
        $res = $q->get_result();
        if($res->num_rows>0){
        foreach ($res as $avg) {
            return $avg['rate'];
        }}else return 0;
    }

    public function CountFeedbackRating($fac, $sub, $ch)
    {
        $q = $this->con->prepare("SELECT COUNT(`rate_id`) as 'count' frOM rating WHERE rate_faculty=$fac AND rate_subject =$sub AND rate_chapter = $ch;");
        $q->execute();
        $res = $q->get_result();
        if($res->num_rows>0)
        foreach ($res as $count) {
            return $count['count'];
        }else{
            return 0;
        }
    }
    public function CountFeedbackUsers($fac, $sub, $ch){
        $q = $this->con->prepare("SELECT DISTINCT rate_user FROM rating WHERE rate_faculty=$fac AND rate_subject =$sub AND rate_chapter = $ch; ");
        $q->execute();
        $res = $q->get_result();
        $no = $res->num_rows;
        return $no;
    }

    public function fetchUserById($id)
    {
        $user = $this->con->prepare("SELECT * FROM users WHERE id = $id;") or die ($this->con->error);
        $user->execute();
        $users = $user->get_result();
        foreach ($users as $u) {
            return $u['user_name'];
        }
    }

    public function fetchFeedbacksbychapter($fac, $sub, $ch)
    {
        $feed = $this->con->prepare("SELECT * FROM rating WHERE rate_faculty=$fac AND rate_subject =$sub AND rate_chapter = $ch") or die ("ERROR: ". $this->con->error);
        $feed->execute();
        $feeds = $feed->get_result();
        if ($feeds->num_rows > 0) {
            foreach ($feeds as $rate) {
                $uid = $rate['rate_user'];
                $name = $this->fetchUserById($uid);
                $rate['rate_feedback'];
                echo "<tr>";
                echo "<td>" . ucfirst(strtolower($name)) . "</td>";
                echo "<td>" . $rate['rate_feedback'] . "</td>";
                echo "<td>" . ucfirst(strtolower($rate['rate_part'])) . "</td>";
                echo "<td>" . $rate['rate_rating'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr>";
            echo "<td colspan='4' class='text-center'>No Feedbacks to show! :(</td>";
            echo "</tr>";
        }
    }

    public function chapterReaded($sub, $ch, $type, $tab, $link, $css = NULL, $icon)
    {

        if (isset($_SESSION['Sess_user_id'])) {
            $uid = $_SESSION['Sess_user_id'];
            $read = $this->con->prepare("SELECT * FROM USER_READINGS WHERE UR_READING_SUBJECT = $sub AND UR_READING_CHAPTER = $ch AND ur_user_read = '$type' AND ur_user_id=$uid;") or die($this->con->error);
            $read->execute();
            $res = $read->get_result();
            if ($res->num_rows > 0) {
                echo '<a href="' . $link . '" class="btn  ' . $css . ' m-2 animated slideInLeft delay-03s"><i class="fa fa-check" style="color:darkgreen;"></i> <i class="fa fa-' . $icon . ' " ></i> ' . $tab . '</i> </a>';
            } else {
                echo '<a href="' . $link . '" class="btn  ' . $css . ' m-2 animated slideInLeft delay-03s"><i class="fa fa-' . $icon . ' " ></i> ' . $tab . '</i> </a>';
            }
        } else {
            echo '<a href="' . $link . '" class="btn  ' . $css . ' m-2 animated slideInLeft delay-03s"><i class="fa fa-' . $icon . ' " ></i> ' . $tab . '</i> </a>';
        }
    }

    //dynamic content
    //Subjects
    public function getSubjectsbyFacultyID($fid)
    {
        $q = $this->con->prepare("SELECT * FROM subjects WHERE sub_fac = ?");
        $q->bind_param("i", $fid);
        $q->execute();
        $subjects = $q->get_result();
        foreach ($subjects as $sub) {
            echo ' <a class="dropdown-item" href="topic.php?fac_id='. $fid.'&sub_id=' . $sub['sub_id'] . '">' . $sub['sub_name'] . '</a>' .
                '<div class="dropdown-divider"></div>';
        }
    }
    public function FacultyTabs()
    {
        $q = $this->con->prepare("SELECT * FROM FACULTY");
        $q->execute();
        $facs = $q->get_result();
        foreach ($facs as $fac) {
            $fac_id = $fac['fac_id'];
            $fac_name = $fac['fac_name'];

            echo <<<_FACULTIES
<div class="btn-group col-lg-3 panel-home  pan-5 animated fadeInUp delay-01s">
                <button type="button" class="btn dropdown-toggle htbtn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    $fac_name
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                   
_FACULTIES;
            $this->getSubjectsbyFacultyID($fac_id);
            echo <<<_FACULTIES
                </div>
            </div>
_FACULTIES;
        }


    }
    public function getFacultyNameByID($fid){
        $q = "SELECT * FROM faculty where fac_id = $fid";
        $res = $this->normalQuery($q);
        foreach($res as $item){
            echo $item['fac_name'];
        }
    }


    public function getSubjectNamebyID($sid)
    {
        $q = "SELECT sub_name from subjects where sub_id = $sid";
        $res = $this->normalQuery($q);
        foreach ($res as $name) {
            echo $name['sub_name'];
        }
    }
    public function getSubjectOffsetbyID($sid, $type, $tagst = "", $tage = "")
    {
        $q = "SELECT $type from subjects where sub_id = $sid";
        $res = $this->normalQuery($q);
        foreach ($res as $name) {
            echo $tagst . $name[$type] . $tage;
        }
    }
    public function getFacultyIdfromSubjectId($sid){
        $q = "SELECT sub_fac FROM subjects where sub_id = $sid";
        $res = $this->normalQuery($q);
        foreach($res as $fac){
            return $fac['sub_fac'];
        }
    }
    public function showChaptersBySubjectID($sub_id)
    {
            $q = "SELECT * FROM chapter WHERE ch_sub_id = $sub_id";
            $all_chapters = $this->normalQuery($q);
            $rows = $all_chapters->num_rows;
            if($rows>0){
            foreach ($all_chapters as $chapter) {
                $title = $chapter['ch_title'];
                $chid = $chapter['ch_id'];
                $objective = $chapter['ch_obj'];
                $outcome = $chapter['ch_out'];
                $material = explode(",", $chapter['ch_materials']);
                $rowid = "row" . $chid;
                $facid= $this->getFacultyIdfromSubjectId($sub_id);

                echo <<<_Chapters
 <tr  class="chaptersrow">
                        <td width="90%">
                            <b><a href="chapter.php?fac_id=$facid&sub_id=$sub_id&ch_id=$chid" class="chapters_link"> <div class="badge badge-warning p-2" style="font-size: 14px;"><i class="fa fa-star"></i>                              
_Chapters;

                $rate = number_format(($this->findRatingforChapter($chid)), 2);
                echo " " . $rate . " ";

                echo <<<_Chapters
   
                                    </div> Chapter $chid : $title</a></b>
                            <div class="collapse" id="{$rowid}">
                                <div class="card card-body mt-3">
                                    <div class="row">
                                        <div class="col-lg-5 mb-3">
                                        <h6><i class="fa fa-thumb-tack"></i> Course Objectives: </h6>
                                            <h6>Students will achieve the knowledge and skills such as:</h6>
                                            <ol type="1">
                                                {$objective}
                                            </ol>
                                        </div>
                                        <div class="col-lg-7 mb-3">
                                        <h6><i class="fa fa-exclamation-circle"></i> Learning Outcomes: </h6>
                                            <h6>On successful completion of chapter $chid the learner will be able to:</h6>
                                            <ol type="1">
                                            {$outcome}

                                            </ol>
                                        </div>
                                        <div class="ml-2"><h6>Available Materials:
_Chapters;

                foreach ($material as $mat) {
                    echo '<div class="badge badge-dark p-2 m-1">' . $mat . '</div>';
                }

                echo <<<_Chapters
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <button class="btn btn-primary btn-sm" type="button" data-toggle="collapse" data-target="#$rowid" aria-expanded="false" aria-controls="collapseExample">
                                Objectives Outcomes
                            </button>
                        </td>
                        </tr>
_Chapters;

            }
        }else {
                echo <<<_Blankrow
<tr  class="chaptersrow">
                        <td width="90%">
                            No Chapters Yet, Please come back later! Thank you! </td></tr>                        

_Blankrow;
;
            }
    }

    //Chapter
    public function returnObjorOutbyChapterID($chid, $offset, $tagst = "", $tage=""){
        $q = "SELECT $offset FROM chapter WHERE ch_id = $chid";
        $res = $this->normalQuery($q);
        foreach ($res as $obou) {
            echo $tagst .  $obou[$offset] . $tage;
        }

    }

    public function returnChapterOffsets($chid, $offset){
        $q = "SELECT $offset from chapter where ch_id = $chid";
        $res = $this->normalQuery($q);
        foreach($res as $item){
            return $item[$offset];
        }
    }

    //slides
    public function getiframe($chapter){
        $q = "SELECT * FROM slides where slide_chapter_id= $chapter";
        $res = $this->normalQuery($q);
        foreach($res as $iframe){
            echo $iframe['slide_iframe_code'];
        }
    }

    //notes
    public function getNotesOffset($chapter, $offset){
        $q = "SELECT * FROM Notes where note_ch_id = $chapter";
        $res = $this->normalQuery($q);
        foreach($res as $text){
            echo $text[$offset];
        }
    }

    //########################ONLINEQUIZ#################################
    public function ShowQuizDatabySubjectID($fac, $sub){
        if(isset($_SESSION['Sess_user_id'])){
        $q = "SELECT * FROM exam where exam_subject_id = $sub";
        $res = $this->normalQuery($q);
        foreach($res as $quiz){
                $name= $quiz['exam_Name'];
                $eid= $quiz['exam_id'];
                $cor = $quiz['exam_correct_mark'];
                $quests = $quiz['exam_total_questions'];
                $marks = $cor*$quests;
                $quest_no = 1;
                $user = $_SESSION['Sess_user_id'];
                $check  = $this->normalQuery("SELECT his_score FROM exam_history WHERE his_exam_id =".$eid." AND his_user_id = ".$user);
                if($check->num_rows==0) {
                    echo '<th><a style="text-decoration:none; font-size:18px; color:black; "href="exam.php?fac_id=' . $fac . '&sub_id=' . $sub . '&eid=' . $eid . '&q=' . $quest_no . '&t=' . $quests . '"> ' . $name . '</a></th>';
                    echo '<td>' . $marks . '/' . $quests . '</td>';
                }else {
                    echo '<th><a style="text-decoration:none; font-size:18px; color:black; "href="exam.php?fac_id=' . $fac . '&sub_id=' . $sub . '&eid=' . $eid . '&q=' . $quest_no . '&t=' . $quests . '"><i class="fa fa-check-square"></i> ' . $name . '</a></th>';
                    echo '<td>' . $marks . '/' . $quests . '</td>';
                }
        }}else echo '<td>Please Log in <a href="login.php">Here </a> to View Exams!</td>';
    }
    //fac_id=1&sub_id=1&eid=1&q=1&t=10
    public function showQuizPanel($fac, $sub, $exid, $quest_no, $total){
    $allQuest = $this->normalQuery("SELECT * FROM exam_questions WHERE quest_no = $quest_no AND quest_exam_id = $exid;", 23);
    echo '<div class="col-lg-12 p-5 table-light">';
    foreach($allQuest as $question){
        $qsn = $question['quest_question'];
        $q_id = $question['quest_id'];
        echo '<h4>Question '.$quest_no.'. '.$qsn.'</h4>';
    }
    $getOptions = $this->normalQuery("SELECT * FROM EXAM_OPTIONS WHERE option_quest_id = $quest_no", 22);
    echo '<form method="post" class="mt-5" action ="includes/exam_operation.php?operate=true&fac_id='.$fac.'&sub_id='.$sub.'&ex_id='.$exid.'&q='.$quest_no.'&total='.$total.'&q_id='.$quest_no.'" ><tr>';
    foreach($getOptions as $opt){
        $option = $opt['option_option'];
        $opt_id = $opt['option_id'];
        echo '<input type="radio" name="answer" value= '.$opt_id .'>'.$option.'<br><br>';
    }
        echo'<br /><button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span>&nbsp;Submit</button></form></div>';

        echo '</form></div>';
    }
    public function showResultPanel($fac, $sub, $exid){
        $user  = $_SESSION['Sess_user_id'];
        $finalResult = $this->normalQuery("SELECT MAX(his_id) as 'max' from exam_history where `his_exam_id` = $exid AND `his_user_id` = $user", 31);
        foreach($finalResult as $final){
            $last_entery_id = $final['max'];
        }
        $getHistoryRecord = $this->normalQuery("SELECT * FROM exam_history WHERE his_id= $last_entery_id");
        echo '<div class="col-lg-12 pt-2 table-light">';
        echo '<br><h3 class="text-center">Well Done! Your Result is: </h3><br><table class="table table-striped table-borderless">';
        foreach ($getHistoryRecord as $result){
            $score = $result['his_score'];
            $right = $result['his_correct'];
            $wrong = $result['his_wrong'];
            $attempted = $result['his_level'];
            echo <<<_
<tr>
<td><h5><i class="fa fa-question-circle"></i> Total Questions Attempted :</h5></td>
<td><h5>$attempted</h5></td>
</tr>
<tr>
<td><h5 style="color:#3aa30f"><i class="fa fa-check-circle"></i> Right Answers :</h5></td>
<td><h5 style="color:#3aa30f">$right</h5></td>
</tr>

<tr>
<td><h5 style="color: red;"><i class="fa fa-ban"></i> Wrong Answers :</h5></td>
<td><h5 style="color: red;">$wrong</h5></td>
</tr>
<tr>    
<td><h5><i class="fa fa-bar-chart"></i> Score :</h5></td>
<td><h5>$score</h5></td>
</tr>

_;

        }
      echo '</table></div>';

    }
    public function fetchQuizHistory()
    {
        $user = $_SESSION['Sess_user_id'];
        $c = 1;
        $q = $this->normalQuery("SELECT * FROM exam_history WHERE his_user_id = $user ORDER BY his_date DESC", 323);

        echo <<<_TABLE
<table class="table table-hover table-bordered"><tr>
            <th>S/N</th>
            <th>Exam</th>
            <th>Exam Date</th>
            <th>Total Questions</th>
            <th>Right Answer</th>
            <th>Wrong Answer</th>
            <th>Score</th>
</tr>
_TABLE;
if($q->num_rows<0){
echo "<tr><td colspan='7' class='text-center'>No Exams Attemepted Yet!</td></tr></table>";
}
        foreach ($q as $history) {
            $ex_id = $history['his_exam_id'];
            $fetch_exid = $this->normalQuery("SELECT * FROM EXAM WHERE exam_id = $ex_id");
            foreach ($fetch_exid as $name) {
                $ex_name = $name['exam_Name'];
                $ex_q = $name['exam_total_questions'];
                $ex_m = $name['exam_correct_mark'];
                $allMarks = $ex_q*$ex_m;
            }
            $score = $history['his_score'];
            $total = $history['his_level'];
            $correct = $history['his_correct'];
            $wrong = $history['his_wrong'];
            $date = $history['his_date'];
            echo <<<_CompleteData
            <tr>
            <td>$c</td>
            <td>$ex_name</td>
            <td>$date</td>
            <td class="text-center">$total</td>
            <td class="text-center" style="color: #0b2e13;">$correct/$ex_q</td>
            <td class="text-center" style="color: red;">$wrong/$ex_q</td>
            <td class="text-center"><b>$score/$allMarks</b></td
</tr>
_CompleteData;
            $c++;
        }

    }


    //---Profile
    public function fetchCompletedCourses(){
        $user = $_SESSION['Sess_user_id'];
        $c=1;
            $allcourse = $this->normalQuery("SELECT * FROM completed_course WHERE comp_user_id = $user");
        if($allcourse->num_rows>=1) {
            foreach ($allcourse as $course) {
                $sub_id = $course['comp_sub_id'];
                $ch_id = $course['comp_chapter_id'];
                $percentage = $course['comp_percentage'];
                if ($percentage > 0) {
                    $q = "SELECT sub_name from subjects where sub_id = $sub_id";
                    $res = $this->normalQuery($q);
                    foreach ($res as $name) {
                        $sub_name = $name['sub_name'];
                    };
                    $ch = $this->normalQuery("SELECT * FROM Chapter WHERE Ch_id = $ch_id");
                    foreach ($ch as $name) {
                        $ch_no = $name['ch_no'];
                        $ch_name = $name['ch_title'];
                    }
                    echo <<<_CompleteData
            <tr>
            <td>
            $c
            </td>
            <td>$sub_name</td>
            <td>Chapter $ch_no: $ch_name</td>
_CompleteData;

                    if ($percentage < 100) {
                        echo '<td><div class="progress">';
                        echo '<div class="progress progress-bar progress-bar-animated progress-bar-striped  active " role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width:';
                        echo (int)$percentage . "%";
                        echo '">';
                        echo (int)$percentage . "% Completed";
                        echo '</div></div></td>';
                    } else {
                        echo "<td style='color: green;'><i class='fa fa-check'></i> <b>Completed! </b></td>";
                    }
                    echo <<<_CompleteData
</tr>
_CompleteData;
                    $c++;

                }
            }
        }else echo "<tr><td colspan='4' class='text-center'>No Courses has been selected yet!</td></tr>";

    }



}

//Setups

if(isset($_POST['submit'])){
    $id = $_POST['student_id'];
    $pass  =$_POST['student_pass'];
    $operation = new AllPagesOperation(); //id 3 = error username or password wrong
    $operation->login($id, $pass) or die (header("location:../login.php?id=3"));
}
if(isset($_GET['id'])){
    $id = $_GET['id'];
    if($id == 3945 ){
        session_destroy();
        echo '<script>window.history.back()</script>';
    }
}

if(isset($_POST['Reg_id'])){
    $id = $_POST['Reg_id'];
    $name = $_POST['Reg_name'];
    $email = $_POST['Reg_email'];
    $fac = $_POST['Reg_faculty'];
    $sem =  $_POST['Reg_semester'];
    $pass = $_POST['Reg_password'];
    $dob = $_POST['Reg_dob'];
    $sex = $_POST['Reg_gender'];
    if(empty($_POST['Reg_id']) || empty($_POST['Reg_name']) || empty($_POST['Reg_email']) ||  empty($_POST['Reg_password'])){
        echo "Please Fill The Required fields";
    }
    $operation = new AllPagesOperation();
    $operation->is_Available_stid($id);
    $is_available = $operation->is_Available_stid($id);
    if($is_available == true){
        echo "User with ID ". $id . " Already Exists";
    }else {
        $email_exist = $operation->is_Available_email($email);
        if($email_exist == true){
            echo $email . " Already Exists!";
        }else {
            $insert = $operation->registerUser($id, $name, $email, $fac, $sem, $pass, $dob, $sex);
            if($insert){
                echo $id;
            }
        }

    }
}


if(isset($_POST['doc_submit'])){

    $operation = new AllPagesOperation();
    $faculty = $_POST['doc_faculty'];
    $chapter = $_POST['doc_chapter'];
    $subject = $_POST['doc_subject'];
    $type = $_POST['doc_submit'];
    if(!isset($_POST['doc_rate_text'])) {
        $add = $operation->addAsReaded($faculty,$subject, $chapter, $type);
        if ($add) {
            echo $type . " Has been Marked as Read!";
        } else echo "Seems like you already read this " . $type;
    }else {
        $feedback = $_POST['doc_rate_text'];
        $rate = $_POST['doc_rating'];
        $fb = $operation->AddFeeback($faculty,$subject,  $chapter, $type, $rate, $feedback);
        if ($fb) {
            echo "Thanks for your feedback!";
        } else echo "You already added feedback ";
    }
    $operation->calculatereadingpercentage($subject, $chapter);
}
