<?php
// Get POST body content
$content = file_get_contents('https://api.thingspeak.com/talkbacks/10962/commands.json?api_key=WFN45I92A9NN3S27');
// Parse JSON
$events = json_decode($content, true);
print $events;//->{'command_string'};

