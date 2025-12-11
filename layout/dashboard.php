<?php

defined('MOODLE_INTERNAL') || die();

redirect_if_major_upgrade_required();

global $USER, $PAGE;

// SYSTEM context
$systemcontext = context_system::instance();

// Check: site admin OR user assigned Manager role (roleid=1) at system level
$issystemmanager = user_has_role_assignment($USER->id, 1, $systemcontext->id);

if (is_siteadmin($USER) || $issystemmanager) {
    if ($PAGE->pagetype === 'my-index') {
        redirect(new moodle_url('/local/kopere_dashboard/view.php?classname=dashboard&method=start'));
    }
}

// Others use standard frontpage
require_once(__DIR__ . '/frontpage.php');