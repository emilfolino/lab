<?php
$currentVersion = VERSION;
echo <<< EOD
/**
 * @preserve $key
 *
 * $key
 * $course
 * $lab
 * $acronym
 * $created
 * $version
 *
 * Generated $timestamp_now by dbwebb lab-utility $currentVersion.
 * https://github.com/mosbth/lab
 */
EOD;
?>

<?php if (isset($header)) echo $header ?>

(function(dbwebb){
    "use strict";

    var ANSWER = null;

    console.log("Ready to begin.");


<?php
$sectionId = 0;

?>
/** ======================================================================
 * <?= $title . "\n" ?>
 *
 * <?= wrap($intro, "\n * ") ?>
 *
 */



<?php
foreach ($sections as $section) {
    $sectionId++;
    $questionId = 0;
?>
/** ----------------------------------------------------------------------
 * Section <?= $sectionId ?> . <?= $section['title'] . "\n" ?>
 *
 * <?= wrap($section['intro'], "\n * ") ?>
 *
 */



<?php
    foreach ($section['questions'] as $question) {
        $questionId++;

        // Get points
        $points = null;
        if (isset($question["points"])) {
            $points = " (${question["points"]} points)";
        }
?>
/**
 * Exercise <?= "$sectionId.$questionId$points\n" ?>
 *
 * <?= wrap($question['text'], "\n * ") ?>
 *
 * Write your code below and put the answer into the variable ANSWER.
 */






ANSWER = "Replace this text with the variable holding the answer.";

// I will now test your answer - change false to true to get a hint.
dbwebb.assert("<?="$sectionId.$questionId"?>", ANSWER, false);

<?php
    }
}
?>

    console.log(dbwebb.exitWithSummary());

}(window.dbwebb));
