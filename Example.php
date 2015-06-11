<?php

/*
 * This is an example file.
 * You can edit the constants below
 * to generate your personalised Audio.
 *
 * Run this script with the Command Line.
 * A file "output.wav" will be created.
 */

echo "Enter a string >>> ";

$window = fopen("php://stdin", "r");
$string = fread($window, 20000);
fclose($window);

//Options
define("USE_VOICE", "Niki");
define("TALK_STRING", $string);




include("PUTTS.php");
include("Voice.php");
include("Language.php");
include("Languages/de_DE.php");
include("BrowserWav.php");

$putts = new PUTTS(new de_DE());
$voice = $putts->getVoice(USE_VOICE);
file_put_contents("output.wav", $voice->speakString(TALK_STRING)->speak($voice, false));