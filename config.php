<?php
/**
 * Liteap config.
 *
 * @package   theme_liteap
 * @copyright 2025 liteap
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

require_once(__DIR__ . '/lib.php');

$THEME->name = 'liteap';
$THEME->sheets = ['sheet',];
$THEME->editor_scss = ['editor'];
$THEME->rendererfactory = 'theme_overridden_renderer_factory';
$THEME->scss = function($theme) {
    return scss_get_main($theme);
};
$THEME->prescsscallback = 'css_get_precompiled';
$THEME->layouts = [
    // Most backwards compatible layout without the blocks.
    'base' => array(
        'file' => 'drawers.php',
        'regions' => array(),
    ),
    // The site home page.
    'frontpage' => array(
        'file' => 'frontpage.php',
        'regions' => array('side-pre'),
        'defaultregion' => 'side-pre',
        'options' => array('nonavbar' => true),
    ),
    // My dashboard page.
    'mydashboard' => array(
        'file' => 'dashboard.php',
        'regions' => array('side-pre'),
        'defaultregion' => 'side-pre',
        'options' => array('nonavbar' => true, 'langmenu' => true),
    ),
    
];

$THEME->parents = ['boost'];
$THEME->enable_dock = false;
$THEME->usefallback = true;
$THEME->yuicssmodules = [];
$THEME->requiredblocks = '';
$THEME->iconsystem = \core\output\icon_system::FONTAWESOME;
$THEME->addblockposition = BLOCK_ADDBLOCK_POSITION_FLATNAV;
// By default, all boost theme do not need their titles displayed.
$THEME->activityheaderconfig = [
    'notitle' => true
];