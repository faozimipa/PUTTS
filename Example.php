<?php

include("PUTTS.php");
include("Voice.php");
include("Language.php");
include("Languages/de_DE.php");
include("BrowserWav.php");

$putts = new PUTTS(new de_DE());
$voice = $putts->getVoice("Niki");
$voice->speakString(strtolower($_GET["t"]))->speak($voice);