<?php
$content = file_get_contents('https://api.thingspeak.com/talkbacks/10962/commands.json?api_key=WFN45I92A9NN3S27');
$events = json_decode($content, true);
foreach ($events as $result) {
   $test=$result["command_string"];
   echo $test;
}

