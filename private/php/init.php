<?php

/**
 * This file defines the rootpath of the project as constant and initialises the core of the project
 */

define('ROOTPATH', 'C:\\xampp\\htdocs\\shared-bookmarklet\\');
require_once 'core.php';

$SB_core = new sharedBookmarkled\Core();
