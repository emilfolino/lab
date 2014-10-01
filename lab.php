<?php
include __DIR__ . "/config.php";



// Incoming
$doLab        = isset($_GET['lab']) ? true : false;
$doAnswers    = isset($_GET['answers']) ? true : false;
$doAnswerHtml = isset($_GET['answer-html']) ? true : false;
$doAnswerJs   = isset($_GET['answer-js']) ? true : false;
$doAnswerPy   = isset($_GET['answer-py']) ? true : false;
$doAnswerPyAssert = isset($_GET['answer-py-assert']) ? true : false;
$doAnswerJson = isset($_GET['answer-json']) ? true : false;
$doAnswerExtra = isset($_GET['answer-extra']) ? true : false;
$key          = isset($_GET['key']) ? $_GET['key'] : null;



// Check or die
(isset($doLab) 
    || isset($doAnswers)
    || isset($doAnswerHtml)
    || isset($doAnswerJs)
    || isset($doAnswerPy)
    || isset($doAnswerJson)
    || isset($doAnswerExtra)
    || isset($doAnswerPyAssert))
        or die("Missing what to do.");
isset($key) or die("No key supplied.");



// Get the details to generate the lab
$db = new PDO("sqlite:db.sqlite");

$sql = "
select * from lab
where 
    gen_key = ?
";
$stmt = $db->prepare($sql);
$stmt->execute([$key]);
$res = $stmt->fetch(PDO::FETCH_OBJ);

if (!$res) {
    die("Key did not match!");
}

define("KEY", $key);
$acronym = $res->acronym;
$course = $res->course;
$lab = $res->lab;
$created = $res->created;



// Generate
if ($course == 'javascript1' && $lab == 'lab1') {
    
    extract(include "config/javascript1/lab1.php");
    // shuffle questions

} else if ($course == 'javascript1' && $lab == 'lab2') {
    
    extract(include "config/javascript1/lab2.php");
    // shuffle questions

} else if ($course == 'javascript1' && $lab == 'lab3') {
    
    extract(include "config/javascript1/lab3.php");
    // shuffle questions

} else if ($course == 'javascript1' && $lab == 'lab4') {
    
    extract(include "config/javascript1/lab4.php");
    // shuffle questions

} else if ($course == 'javascript1' && $lab == 'lab5') {
    
    extract(include "config/javascript1/lab5.php");
    // shuffle questions

} else if ($course == 'python' && $lab == 'lab1') {
    
    extract(include "config/python/lab1.php");
    // shuffle questions

} else if ($course == 'python' && $lab == 'lab2') {
    
    extract(include "config/python/lab2.php");
    // shuffle questions

} else if ($course == 'python' && $lab == 'lab3') {
    
    extract(include "config/python/lab3.php");
    // shuffle questions

} else if ($course == 'python' && $lab == 'lab4') {
    
    extract(include "config/python/lab4.php");
    // shuffle questions

} else if ($course == 'python' && $lab == 'lab5') {
    
    extract(include "config/python/lab5.php");
    // shuffle questions

} else if ($course == 'python' && $lab == 'lab6') {
    
    extract(include "config/python/lab6.php");
    // shuffle questions

} else if ($course == 'htmlphp' && $lab == 'lab1') {
    
    extract(include "config/htmlphp/lab1.php");
    // shuffle questions

} else if ($course == 'htmlphp' && $lab == 'lab2') {
    
    extract(include "config/htmlphp/lab2.php");
    // shuffle questions

} else if ($course == 'htmlphp' && $lab == 'lab3') {
    
    extract(include "config/htmlphp/lab3.php");
    // shuffle questions

} else if ($course == 'htmlphp' && $lab == 'lab4') {
    
    extract(include "config/htmlphp/lab4.php");
    // shuffle questions

} else if ($course == 'htmlphp' && $lab == 'lab5') {
    
    extract(include "config/htmlphp/lab5.php");
    // shuffle questions

} else if ($lab == 'labtest') {
    
    extract(include "config/labtest.php");
    // shuffle questions

} else {
    die("Not a valid combination.");
}



/**
 * Format the basic values
 */
function formatType($value)
{
    if (is_bool($value)) {
        $value = $value ? "true" : "false";
    } else if (is_int($value)) {
        ;
    } else if (is_string($value)) {
        $value = "\"$value\"";
    }

    return $value;
}



/**
 * Format the answer for print in HTML
 */
function formatAnswerPrintable($answer)
{
    return json_encode($answer, JSON_PRETTY_PRINT);

    if (is_bool($answer)) {
        $answer = $answer ? "true" : "false";
    } else if (is_array($answer)) {
        $answer = formatArray($answer);
    }

    return $answer;
}


/**
 * Format the answer for a JSON object
 */
function formatAnswerJSON($answer)
{
    return json_encode($answer, JSON_PRETTY_PRINT);
/*
    if (is_int($answer) || is_float($answer)) {
        //$answer
    } else if (is_string($answer)) {
        return json_encode($answer, JSON_PRETTY_PRINT);
        #$answer = "\"$answer\"";
    } else if (is_bool($answer)) {
        $answer = $answer ? "true" : "false";
    } else if (is_array($answer)) {
        //return json_encode($answer, JSON_PRETTY_PRINT);
        $answer = formatArray($answer);
    }
    // add checks for array and object and null

    return $answer;
    */
}




if ($doLab && $doAnswers) {
    include "view/lab_tpl.php";
} else if ($doLab) {
    include "view/lab_tpl.php";
} else if ($doAnswers) {
    include "view/answers_tpl.php";
} else if ($doAnswerHtml) {
    include "view/answer-html_tpl.php";
} else if ($doAnswerJs) {
    include "view/answer-js_tpl.php";
} else if ($doAnswerPy) {
    include "view/answer-py_tpl.php";
} else if ($doAnswerJson) {
    include "view/answer-json_tpl.php";
} else if ($doAnswerPyAssert) {
    include "view/answer-py-assert_tpl.php";
} else if ($doAnswerExtra) {
    include "view/answer-extra_tpl.php";
} else {
    die("Nothing to do.");
}
