<?php

// connect to the database for hostgator
// $conn = mysqli_connect('localhost', 'andrewcb_andrewc', '<password>', 'andrewcb_basketball_stats_hostgator');

// connect to local database
$conn = mysqli_connect('localhost', 'shaun', 'test1234', 'basketball_stats');


// check connection
if(!$conn){
    echo 'Connection error: '. mysqli_connect_error();
}
?>