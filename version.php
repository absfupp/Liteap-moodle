<?php
/**
 * Liteap config.
 *
 * @package   theme_liteap
 * @copyright 2025 liteap
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// This line protects the file from being accessed by a URL directly.
defined('MOODLE_INTERNAL') || die();

// This is the component name of the plugin - it always starts with 'theme_'
$plugin->component = 'theme_liteap';

// This is the version of the plugin.
$plugin->version = 20251128023;

// This is the named version.
$plugin->release = 'v0.0.23';

$plugin->maturity = MATURITY_RC;

// This is a list of plugins, this plugin depends on (and their versions).
$plugin->dependencies = [
    'theme_boost' => 2025041400,
];