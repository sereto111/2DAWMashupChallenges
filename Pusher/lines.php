<?php
// First, run 'composer require pusher/pusher-php-server'
require __DIR__ . '/vendor/autoload.php';

$pusher = new Pusher\Pusher(
    "b40948aff03f4a465e37", // Replace with 'key' from dashboard
    "a5f9932fc412dd54f4a0", // Replace with 'secret' from dashboard
    "1760094", // Replace with 'app_id' from dashboard
    array(
        'cluster' => 'eu' // Replace with 'cluster' from dashboard
    )
);
// Trigger a new random event every second. In your application,
// you should trigger the event based on real-world changes!
for ($i = 1; $i < 10; $i++) {
    $pusher->trigger('lines', 'new-lines', array(
        rand(100, 200), rand(30, 130), rand(80, 120), rand(100, 200), rand(77, 177)
    ));
    sleep(1);
}