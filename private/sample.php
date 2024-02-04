<?php
date_default_timezone_set('Asia/Manila');

// Get the current Unix timestamp
$currentTimestamp = time();

// Calculate the Unix timestamp for the start of the current hour
$currentHourTimestamp = strtotime(date('Y-m-d H:00:00', $currentTimestamp));

echo "Current Unix Timestamp: $currentTimestamp<br>";
echo "Unix Timestamp for Start of Current Hour: $currentHourTimestamp";

?>