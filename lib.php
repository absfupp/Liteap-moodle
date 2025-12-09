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

function url_context(stdClass $context, core_renderer $renderer): stdClass {
    global $CFG;
     // Get theme name from language string instead of hardcoding
    $themename = get_string('configtitle', 'theme_liteap');
    // Convert to lowercase for file paths
    $themename = strtolower($themename);
    $context->themeurl = $CFG->wwwroot . '/theme/'. $themename .'/pix';
    return $context;
}

/**
 * Get compiled css.
 *
 * @return string compiled css
 */
function css_get_precompiled() {
    global $CFG;
    // Get theme name from language string instead of hardcoding
    $themename = get_string('configtitle', 'theme_liteap');
    // Convert to lowercase for file paths
    $themename = strtolower($themename);
    $cssfile = $CFG->dirroot . '/theme/'. $themename .'/assets/bootstrap.min.css';
    if (file_exists($cssfile) && is_readable($cssfile)) {
        return file_get_contents($cssfile);
    }
    return '';
}

/**
 * Inject additional SCSS before the main SCSS is processed.
 *
 * @param theme_config $theme The theme config object.
 * @return string The pre-SCSS content.
 */
function scss_get_main($theme) {
    global $CFG;
    
    // Get theme name from language string instead of hardcoding
    $themename = get_string('configtitle', 'theme_liteap');
    // Convert to lowercase for file paths
    $themename = strtolower($themename);
    // Define the base theme directory using dynamic theme name
    $themeDir = $CFG->dirroot . '/theme/' . $themename . '/scss';
    
    // Static SCSS components that are the same for all theme instances
    $components = [
        'default/_variables.scss',
        'default/_security.scss',
        'main.scss'
    ];
    
    $scss = '';
    
    
    // Dynamic SCSS variables that must be defined early
    $secondarymenucolor = !empty($theme->settings->secondarymenucolor)
        ? $theme->settings->secondarymenucolor
        : '#70002C';
        
    $brandprimary = !empty($theme->settings->brandcolor)
        ? $theme->settings->brandcolor
        : '#7c3848';
        
    // Use dynamic theme name for assets URL
    $locationurl = $CFG->wwwroot . '/theme/' . $themename . '/assets';

    // SECURITY FIX: Escape URL to prevent SCSS injection
    $locationurl = addslashes($locationurl);

    // Inject critical variables before the rest of the SCSS content
    $scss .= "\n\$location: '" . $locationurl . "';\n";
    $scss .= "\$secondary-menu-color: {$secondarymenucolor};\n";
    $scss .= "\$brand-primary: {$brandprimary};\n";
    
    
    // Add static components securely
    foreach ($components as $component) {
        $filePath = $themeDir . '/' . $component;
        
        // Security: Validate file path to prevent directory traversal
        $realPath = realpath($filePath);
        $realThemeDir = realpath($themeDir);
        
        // Ensure the file is within the theme directory
        if ($realPath === false || strpos($realPath, $realThemeDir) !== 0) {
            // Log error and skip this file
            error_log("Security warning: Invalid SCSS file path: " . $component);
            continue;
        }
        
        // Check if file exists and is readable
        if (is_readable($realPath)) {
            $content = file_get_contents($realPath);
            if ($content !== false) {
                $scss .= $content . "\n";
            } else {
                error_log("Warning: Could not read SCSS file: " . $component);
            }
        } else {
            error_log("Warning: SCSS file not found or not readable: " . $component);
        }
    }

    // Add any custom SCSS defined in the theme settings (`scsspre`)
    if (!empty($theme->settings->scsspre)) {
        // Security: Basic sanitization of user-provided SCSS
        $customScss = trim($theme->settings->scsspre);
        
        // Remove any potential PHP tags or script injections
        $customScss = preg_replace('/<\?(php)?.*?\?>/is', '', $customScss);
        
        $scss .= $customScss . "\n";
    }
    // Load SCSS preset file if specified
        $filename = !empty($theme->settings->preset) ? $theme->settings->preset : null;
        
        if ($filename == 'default.scss') {
            $presetPath = $CFG->dirroot . '/theme/' . $themename . '/scss/default/default.scss';
            if (is_readable($presetPath)) {
                $content = @file_get_contents($presetPath);
                if ($content !== false) {
                    $scss .= $content . "\n";
                }
            }
        } else if ($filename == 'plain.scss') {
            $presetPath = $CFG->dirroot . '/theme/' . $themename . '/scss/default/plain.scss';
            if (is_readable($presetPath)) {
                $content = @file_get_contents($presetPath);
                if ($content !== false) {
                    $scss .= $content . "\n";
                }
            }
        }
    // Write the pre-SCSS to debug file (optional)
    if (!empty($CFG->dataroot) && is_writable($CFG->dataroot)) {
        $debugFile = $CFG->dataroot . '/scss-debug.txt';
        file_put_contents($debugFile, "----- PREF-SCSS SECTION -----\n\n" . $scss . "\n");
    }

    return $scss;
}

/**
 * Inject additional files.
 */
function theme_liteap_pluginfile($course, $cm, $context, $filearea, $args, $forcedownload, array $options = []) {
    if ($context->contextlevel != CONTEXT_SYSTEM) {
        send_file_not_found();
    }

    $theme = theme_config::load('liteap');

    // List of allowed fileareas
    $allowedfileareas = [
    'logo',
    'favicon', 
    'backgroundimage',
    'loginbackgroundimage',
    'featured_overview_image',
    'loginimg',
    'hero_background',
    'about_image',  // Add this line
    ];

    if (!in_array($filearea, $allowedfileareas)) {
        send_file_not_found();
    }

    // Set default cacheability
    if (!array_key_exists('cacheability', $options)) {
        $options['cacheability'] = 'public';
    }

    return $theme->setting_file_serve($filearea, $args, $forcedownload, $options);
}
