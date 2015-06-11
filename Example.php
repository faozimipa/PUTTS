<?php

include("PUTTS.php");
include("Voice.php");
include("Language.php");
include("Languages/de_DE.php");

$putts = new PUTTS(new de_DE());
$voice = $putts->getVoice("ExampleVoice");
print_r($putts->getLanguage()->sayNumber(5433));