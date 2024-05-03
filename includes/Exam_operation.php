<?php
require_once("classes.php");
$coo = new AllPagesOperation();
if(isset($_GET['operate'])){
    $fac_id = $_GET['fac_id'];
    $sub_id = $_GET['sub_id'];
    $exam_id = $_GET['ex_id'];
    $q_no = $_GET['q'];
    $q_id = $_GET['q_id'];
    $total = $_GET['total'];
    $answer = $_POST['answer'];
    $user_id = $_SESSION['Sess_user_id'];
    //check the right answer!
    $checkAnswer = $coo->normalQuery("SELECT * FROM exam_answers where ans_question_id = $q_id", 1);
    foreach($checkAnswer as $ans){
        $ans_id = $ans['ans_answer_id'];
    }
    if($answer == $ans_id) {
        //find right answer score:

        $checkMark = $coo->normalQuery( "SELECT * FROM exam WHERE exam_id = $exam_id", 2);
        foreach ($checkMark as $mark) {
            $correct_score_mark = $mark['exam_correct_mark'];
        }
        if ($q_no == 1) {
            $recordInHistory = $coo->normalQuery( "INSERT INTO exam_history VALUES (his_id, $exam_id, $user_id, 0, 0, 0, 0, NOW())", 3);
        }
        $gettherecord = $coo->normalQuery("SELECT * FROM exam_history WHERE his_exam_id = $exam_id AND his_user_id = $user_id", 4);
        foreach ($gettherecord as $rec) {
            $his_id = $rec['his_id'];
            $score = $rec['his_score'];
            $corr = $rec['his_correct'];
        }
        $corr++;
        $score += $correct_score_mark;
        $updHist = $coo->normalQuery("UPDATE exam_history SET his_score = $score, his_level= $q_no, his_correct = $corr, his_date=NOW() WHERE his_exam_id=$exam_id AND his_user_id = $user_id AND his_id= $his_id", 5);
    }
    else {
        $checkMark = $coo->normalQuery("SELECT * FROM exam WHERE exam_id = $exam_id", 6);
        foreach ($checkMark as $mark) {
            $wrong_score_mark = $mark['exam_wrong_mark'];
        }
        if ($q_no == 1) {
            $recordInHistory = $coo->normalQuery( "INSERT INTO exam_history VALUES (his_id, $exam_id, $user_id, 0, 0, 0, 0, NOW())", 7);
        }
        $gettherecord = $coo->normalQuery( "SELECT * FROM exam_history WHERE his_exam_id = $exam_id AND his_user_id = $user_id", 8);
        foreach ($gettherecord as $rec) {
            $his_id = $rec['his_id'];
            $score = $rec['his_score'];
            $wrong = $rec['his_wrong'];
        }
        $wrong++;
        $score -= $wrong_score_mark;
        $updHist = $coo->normalQuery( "UPDATE  exam_history SET his_score = $score, his_level= $q_no, his_wrong = $wrong, his_date=NOW() WHERE his_exam_id=$exam_id AND his_user_id = $user_id AND his_id= $his_id", 9);
    }
    if($q_no != $total){
        $q_no++;
        header("location:../exam.php?fac_id=$fac_id&sub_id=$sub_id&eid=$exam_id&q=$q_no&t=$total");
    }
    else {
        $lastHistory = $coo->normalQuery("SELECT MAX(his_id) as 'max' from exam_history where `his_exam_id` = $exam_id AND `his_user_id` = $user_id",10);
        foreach($lastHistory as $final){
            $last_entery_id = $final['max'];
        }
        $checkHistory = $coo->normalQuery("SELECT his_score FROM exam_history WHERE his_id = $last_entery_id",10);
        foreach($checkHistory as $scr){
            $score = $scr['his_score'];
        }
        $checkRank = $coo->normalQuery("SELECT * FROM exam_rank WHERE rank_user_id = $user_id",11);
        if($checkRank->num_rows == 0 ){
            $insertRanking = $coo->normalQuery("INSERT INTO exam_rank VALUES(rank_id, $user_id, $score, NOW())",12);
        }else {
            foreach($checkRank as $rank){
                $update_score = $rank['rank_score'];
            }
            $update_score+=$score;
            $updateRanking = $coo->normalQuery("UPDATE exam_rank SET rank_score = $update_score, rank_time= NOW() WHERE rank_user_id = $user_id",13);
        }
        header("location:../Exam.php?option=result&fac_id=$fac_id&sub_id=$sub_id&ex_id=$exam_id");
    }
    //echo $answer;
}