<?php

# 
# Runs php based background tasks (but not a web server) on development 
# computers that do not run queueRunner, kestrel, or phpCron daemons
#

require_once("scripts/cmdline.php");

$kestrel = run_task("java -jar kestrel-1.2.jar -f kestrel.conf", __DIR__."/vendors/kestrel_dev");

sleep(3);

$queueRunner = run_task("php scripts/queueRunner.php");

include("scripts/cron.php");
