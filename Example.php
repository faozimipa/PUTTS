<?php

/*
 * This is an example file.
 * You can edit the constants below
 * to generate your personalised Audio.
 *
 * Run this script with the Command Line.
 * A file with the name "output.wav" will be created
 * in the same folder It will be overwritten if it exists.
 */

echo "Enter a string >>> ";

$window = fopen("php://stdin", "r");
$string = str_replace("\n", "", strtolower(fread($window, 20000)));
fclose($window);

//Options
define("USE_VOICE", "Niki");
define("TALK_STRING", $string);

echo "Speaking '".$string."'....\n";

include("DataProvider.php");
include("DataProvider/Wav.php");
include("PUTTS.php");
include("Voice.php");
include("Language.php");
include("Languages/de_DE.php");

$putts = new PUTTS(new de_DE(), new Wav()); //Set language and data-provider
file_put_contents("output.wav", PUTTS::getVoice(USE_VOICE)->speakString(TALK_STRING)->getOutput(PUTTS::getVoice(USE_VOICE)));