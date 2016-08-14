<?php
# cron.php
# 
# Code copy/pasted from StackOverflow so you *know* it's good code. Right?
# …Right?
# Here's the URL anyways : http://stackoverflow.com/a/13468943
# Stichoza and Ewout, I owe you a beer whenever we meet.

$path = __DIR__ . "/temp/*";
array_map('unlink', ( glob( $path ) ? glob( $path ) : array() ) );

?>