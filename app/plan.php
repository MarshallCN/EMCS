<?php
$ch = curl_init("/notification.php?uid=".$_SESSION['userid']);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($ch);
curl_close($ch);