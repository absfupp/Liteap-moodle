<?php
defined('MOODLE_INTERNAL') || die();
redirect_if_major_upgrade_required();

// Redirect admin users to Kopere dashboard
global $USER, $PAGE;
if (is_siteadmin($USER) && $PAGE->pagetype == 'my-index') {
    redirect(new moodle_url('/local/kopere_dashboard/view.php?classname=dashboard&method=start'));
}
// For non-admin users, use your EXISTING drawers system which already works perfectly
require_once(__DIR__ . '/frontpage.php');