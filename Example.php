<?php

/*
 * This is an example file.
 * You can edit the constants below
 * to generate your personalised Audio.
 *
 * Put PUTTS in your web-directory and access this file with
 * your browser. Add '?t=<Your Text>' to the url. (Tested in Google Chrome).
 */

//Options
define("USE_VOICE", "Niki");
define("TALK_STRING", strtolower($_GET["t"]));




include("PUTTS.php");
include("Voice.php");
include("Language.php");
include("Languages/de_DE.php");
include("BrowserWav.php");

$putts = new PUTTS(new de_DE());
$voice = $putts->getVoice(USE_VOICE);
$voice->speakString(TALK_STRING)->speak($voice);