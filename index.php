<?php
/**
 * File index.php
 *
 * @author Edward Pfremmer <epfremme@nerdery.com>
 */

use PHPWeekly\Application;

require_once 'vendor/autoload.php';

$application = new Application();
$application->run();
