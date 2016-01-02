<?php
// Load in our background processing library
require('multiProcessManager.php');

$feeds = [
    'http://www.google.co.uk/sitemap.xml',
    'http://www.ask.com/sitemap.xml',
    'http://www.bbc.co.uk/sitemap.xml'
];

// Workers will need to contain an array of callables
$workers = [];

foreach ($feeds as $feed_url) {
    // Add our callables to $workers - Each entry in this array will have its own worker thread for processing
    $workers[] = function() use ($feed_url) {
        // TODO: Please your logic for each of the workers to execute here
        // Example...
        echo 'Fetching feed: ' . $feed_url . "\n";
        
        if ($feed_contents = file_get_contents($feed_url)) {
            // TODO: Log to DB, file or output to screen
            $lines = explode("\n", $feed_contents, 2);
            echo 'Line 1 of response from ' . $feed_url . ':'."\n".$lines[0]."\n";
        }
    };
}

// These will all be postfixed with a worker No. to ensure they're uniquely identifiable
$child_thread_name = 'multiProcessManager example';

// Should we keep allow execution of this script to continue?
//   true  = This script will continue running whilst the workers are still being processed
//   false = This script will halt execution at this point until the workers have completed and then execution will
//           continue as normal
//
//   Regardless of the value specified here, we will keep the child processes running until completion (unless a fatal
//   error occurs).
$parent_thread_can_continue_execution = true;

// Let the processing begin!
new multiProcessManager($child_thread_name, $workers, $parent_thread_can_continue_execution);
