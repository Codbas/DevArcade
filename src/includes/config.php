<?php
// Only include files and variable shared for every PAGE header
date_default_timezone_set('America/Los_Angeles');
/*********** ERROR CODES *****************
 * ERROR: 1000  |   Database connection error
 * ERROR: 1100  |   Error parsing session lastActive date from database in Page.php
 * ERROR: 1200  |   Authentication error
 * ERROR: 1201  |   Error getting password hash from database (updatePassword.php)
 * ERROR: 1300  |   Server file read error
 * ERROR: 1400  |   Server file write error
 * ERROR: 1500  |
 * ERROR: 1600  |
 */

require_once '../classes/DevLogLoader.php';
require_once '../classes/DevLogTile.php';
require_once '../classes/GameLoader.php';
require_once '../classes/GameTile.php';
require_once '../classes/Page.php';
require_once '../classes/Tile.php';

include_once('../includes/db.php');
include_once('../includes/session.php');
include_once('../includes/header.php');
include_once('../includes/navbar.php');
