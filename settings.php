<?php
/**
 * Liteap config.
 *
 * @package   theme_liteap
 * @copyright 2025 liteap
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
defined('MOODLE_INTERNAL') || die();

if ($ADMIN->fulltree) {
    $settings = new theme_boost_admin_settingspage_tabs('themesettingliteap', get_string('configtitle', 'theme_liteap'));
    /*
    * ----------------------
    *  Default settings tab
    * ----------------------
    */
    $page = new admin_settingpage('theme_liteap_general', get_string('generalsettings', 'theme_liteap'));
    // Blocks to be excluded when this theme is enabled in the "Add a block" list: Administration, Navigation, Courses and
    // Section links.
    $default = 'navigation,settings,course_list,section_links';
    $setting = new admin_setting_configtext(
        'theme_liteap/unaddableblocks',
        get_string('unaddableblocks', 'theme_liteap'),
        get_string('unaddableblocks_desc', 'theme_liteap'),
        $default,
        PARAM_TEXT
    );
    $page->add($setting);

    // Logo file setting - SECURITY FIX: Remove SVG to prevent JS injection
    $name = 'theme_liteap/logo';
    $title = get_string('logo', 'theme_liteap');
    $description = get_string('logodesc', 'theme_liteap');
    $opts = ['accepted_types' => ['.png', '.jpg', '.gif', '.webp', '.tiff'], 'maxfiles' => 1, 'maxbytes' => 5242880];
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'logo', 0, $opts);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Favicon setting - SECURITY FIX: Add file size limit
    $name = 'theme_liteap/favicon';
    $title = get_string('favicon', 'theme_liteap');
    $description = get_string('favicondesc', 'theme_liteap');
    $opts = ['accepted_types' => ['.ico'], 'maxfiles' => 1, 'maxbytes' => 1048576];
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'favicon', 0, $opts);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Background image setting - SECURITY FIX: Add file size limit
    $name = 'theme_liteap/backgroundimage';
    $title = get_string('backgroundimage', 'theme_liteap');
    $description = get_string('backgroundimage_desc', 'theme_liteap');
    $opts = ['maxfiles' => 1, 'maxbytes' => 10485760];
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'backgroundimage', 0, $opts);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Login Background image setting - SECURITY FIX: Add file size limit
    $name = 'theme_liteap/loginbackgroundimage';
    $title = get_string('loginbackgroundimage', 'theme_liteap');
    $description = get_string('loginbackgroundimage_desc', 'theme_liteap');
    $opts = ['maxfiles' => 1, 'maxbytes' => 10485760];
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'loginbackgroundimage', 0, $opts);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // We use an empty default value because the default colour should come from the default.
    $name = 'theme_liteap/brandcolor';
    $title = get_string('brandcolor', 'theme_liteap');
    $description = get_string('brandcolor_desc', 'theme_liteap');
    $setting = new admin_setting_configcolourpicker($name, $title, $description, '#7c3848');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Variable $navbar-header-color. We use an empty default value because the default colour should come from the preset.
    $name = 'theme_liteap/secondarymenucolor';
    $title = get_string('secondarymenucolor', 'theme_liteap');
    $description = get_string('secondarymenucolor_desc', 'theme_liteap');
    $setting = new admin_setting_configcolourpicker($name, $title, $description, '#70002C');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);


    // Preset.
    $name = 'theme_liteap/preset';
    $title = get_string('preset', 'theme_liteap');
    $description = get_string('preset_desc', 'theme_liteap');
    $default = 'default.scss';

    $context = \core\context\system::instance();
    $fs = get_file_storage();
    $files = $fs->get_area_files($context->id, 'theme_liteap', 'preset', 0, 'itemid, filepath, filename', false);

    $choices = [];
    foreach ($files as $file) {
        $choices[$file->get_filename()] = $file->get_filename();
    }
    // These are the built in presets.
    $choices['default.scss'] = 'default.scss';
    $choices['plain.scss'] = 'plain.scss';

    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);
    // Must add the page after definiting all the settings!
    $settings->add($page);
    /*
    * ----------------------
    * Advanced settings tab
    * ----------------------
    */
    $page = new admin_settingpage('theme_liteap_advanced', get_string('advancedsettings', 'theme_liteap'));

    // Raw SCSS to include before the content.
    $setting = new admin_setting_scsscode(
        'theme_liteap/scsspre',
        get_string('rawscsspre', 'theme_liteap'),
        get_string('rawscsspre_desc', 'theme_liteap'),
        '',
        PARAM_RAW
    );
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Raw SCSS to include after the content.
    $setting = new admin_setting_scsscode(
        'theme_liteap/scss',
        get_string('rawscss', 'theme_liteap'),
        get_string('rawscss_desc', 'theme_liteap'),
        '',
        PARAM_RAW
    );
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Google analytics block - SECURITY FIX: GA ID format validation (optional field)
    $name = 'theme_liteap/googleanalytics';
    $title = get_string('googleanalytics', 'theme_liteap');
    $description = get_string('googleanalyticsdesc', 'theme_liteap');
    $setting = new admin_setting_configtext($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // H5P custom CSS.
    $setting = new admin_setting_configtextarea(
        'theme_liteap/hvpcss',
        get_string('hvpcss', 'theme_liteap'),
        get_string('hvpcss_desc', 'theme_liteap'),
        ''
    );
    $page->add($setting);


    // Register link on user menu 
    $name = 'theme_liteap/userregister';
    $setting = new admin_setting_configcheckbox(
        $name, // The setting's name
        get_string('userregister', 'theme_liteap'), // Title for the checkbox
        get_string('userregisterdesc', 'theme_liteap'), // Description of what the checkbox does
        0 // Default value (0 means unchecked, 1 means checked)
    );
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $settings->add($page);
    /*
    * -----------------------
    * Frontpage settings tab
    * -----------------------
    */
    $page = new admin_settingpage('theme_liteap_frontpage', get_string('frontpagesettings', 'theme_liteap'));
    // Enable FAQ.
    $name = 'theme_liteap/faqcount';
    $title = get_string('faqcount', 'theme_liteap');
    $description = get_string('faqcountdesc', 'theme_liteap');
    $default = 0;
    $options = [];
    for ($i = 0; $i < 11; $i++) {
        $options[$i] = $i;
    }
    $setting = new admin_setting_configselect($name, $title, $description, $default, $options);
    $page->add($setting);

    $faqcount = get_config('theme_liteap', 'faqcount');

    if ($faqcount > 0) {
        for ($i = 1; $i <= $faqcount; $i++) {
            $name = "theme_liteap/faqquestion{$i}";
            $title = get_string('faqquestion', 'theme_liteap', $i . '');
            $setting = new admin_setting_configtext($name, $title, '', '');
            $page->add($setting);

            $name = "theme_liteap/faqanswer{$i}";
            $title = get_string('faqanswer', 'theme_liteap', $i . '');
            $setting = new admin_setting_confightmleditor($name, $title, '', '');
            $page->add($setting);
        }

        $setting = new admin_setting_heading('faqseparator', '', '<hr>');
        $page->add($setting);
    }
    $settings->add($page);
    /*
    * -----------------------
    * Featured Programs Settings
    * -----------------------
    */
    $page = new admin_settingpage('theme_liteap_featured', get_string('featuredsettings', 'theme_liteap'));

        // === Featured Programs Section ===
    $name = 'theme_liteap/featured_list_heading';
    $title = get_string('featured_list_heading', 'theme_liteap');
    $description = get_string('featured_list_headingdesc', 'theme_liteap');
    $setting = new admin_setting_heading($name, $title, $description);
    $page->add($setting);

    // Featured Programs Section Toggle
    $name = 'theme_liteap/featured';
    $title = get_string('featured', 'theme_liteap');
    $description = get_string('featureddesc', 'theme_liteap');
    $setting = new admin_setting_configcheckbox($name, $title, $description, 1);
    $page->add($setting);

    // Number of courses to display in program list
    $name = 'theme_liteap/featured_list_count';
    $title = get_string('featured_list_count', 'theme_liteap');
    $description = get_string('featured_list_countdesc', 'theme_liteap');
    $options = [
        1 => '1',
        2 => '2',
        3 => '3', 
        4 => '4',
        5 => '5',
        6 => '6',
    ];
    $setting = new admin_setting_configselect($name, $title, $description, 3, $options);
    $page->add($setting);

    // Featured Course Override - No validation (allow empty)
    $name = 'theme_liteap/featured_course_1';
    $title = get_string('featured_course_1', 'theme_liteap');
    $description = get_string('featured_course_1desc', 'theme_liteap');
    $setting = new admin_setting_configtext($name, $title, $description, '');
    $page->add($setting);

    // --- Overview Section Settings (KEEP AS IS) ---
    $name = 'theme_liteap/featured_overview_heading';
    $title = get_string('featured_overview_heading', 'theme_liteap');
    $description = get_string('featured_overview_headingdesc', 'theme_liteap');
    $setting = new admin_setting_heading($name, $title, $description);
    $page->add($setting);

    $name = 'theme_liteap/featured_overview_enabled';
    $title = get_string('featured_overview_enabled', 'theme_liteap');
    $description = get_string('featured_overview_enableddesc', 'theme_liteap');
    $setting = new admin_setting_configcheckbox($name, $title, $description, 0);
    $page->add($setting);

    $name = 'theme_liteap/featured_overview_title';
    $title = get_string('featured_overview_title', 'theme_liteap');
    $description = get_string('featured_overview_titledesc', 'theme_liteap');
    $default = get_string('featured_default_overview_title', 'theme_liteap');
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $page->add($setting);

    $name = 'theme_liteap/featured_overview_desc';
    $title = get_string('featured_overview_desc', 'theme_liteap');
    $description = get_string('featured_overview_descdesc', 'theme_liteap');
    $default = get_string('featured_default_overview_desc', 'theme_liteap');
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $page->add($setting);

    // Overview Background Image - SECURITY FIX: Add file size limit
    $name = 'theme_liteap/featured_overview_image';
    $title = get_string('featured_overview_image', 'theme_liteap');
    $description = get_string('featured_overview_imagedesc', 'theme_liteap');
    $opts = ['maxfiles' => 1, 'maxbytes' => 10485760];
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'featured_overview_image', 0, $opts);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Stats for Overview - No validation (allow empty)
    $name = 'theme_liteap/featured_overview_stat1_num';
    $title = get_string('featured_overview_stat1_num', 'theme_liteap');
    $description = get_string('featured_overview_stat1_numdesc', 'theme_liteap');
    $setting = new admin_setting_configtext($name, $title, $description, '2,500+');
    $page->add($setting);
    
    $name = 'theme_liteap/featured_overview_stat1_label';
    $title = get_string('featured_overview_stat1_label', 'theme_liteap');
    $setting = new admin_setting_configtext($name, $title,'','Active Students');
    $page->add($setting);

    $name = 'theme_liteap/featured_overview_stat2_num';
    $title = get_string('featured_overview_stat2_num', 'theme_liteap');
    $description = get_string('featured_overview_stat2_numdesc', 'theme_liteap');
    $setting = new admin_setting_configtext($name, $title, $description, '98%');
    $page->add($setting);

    $name = 'theme_liteap/featured_overview_stat2_label';
    $title = get_string('featured_overview_stat2_label', 'theme_liteap');
    $setting = new admin_setting_configtext($name, $title,'','Graduate Rate');
    $page->add($setting);

    $name = 'theme_liteap/featured_overview_stat3_num';
    $title = get_string('featured_overview_stat3_num', 'theme_liteap');
    $description = get_string('featured_overview_stat3_numdesc', 'theme_liteap');
    $setting = new admin_setting_configtext($name, $title, $description, '50+');
    $page->add($setting);
    
    $name = 'theme_liteap/featured_overview_stat3_label';
    $title = get_string('featured_overview_stat3_label', 'theme_liteap');
    $setting = new admin_setting_configtext($name, $title,'','Programs Offered');
    $page->add($setting);

    $settings->add($page);


    /*
    * -----------------------
    * Hero settings tab
    * -----------------------
    */
    $page = new admin_settingpage('theme_liteap_hero', 'Hero');

        // === Hero Section ===
    $name = 'theme_liteap/hero_heading';
    $title = get_string('hero_heading', 'theme_liteap');
    $description = get_string('hero_headingdesc', 'theme_liteap');
    $setting = new admin_setting_heading($name, $title, $description);
    $page->add($setting);

    // Hero Section Toggle
    $name = 'theme_liteap/hero_enabled';
    $title = get_string('hero_enabled', 'theme_liteap');
    $description = get_string('hero_enableddesc', 'theme_liteap');
    $setting = new admin_setting_configcheckbox($name, $title, $description, 0);
    $page->add($setting);

    // Hero Background Image - SECURITY FIX: Add file size limit
    $name = 'theme_liteap/hero_background';
    $title = get_string('hero_background', 'theme_liteap');
    $description = get_string('hero_backgrounddesc', 'theme_liteap');
    $opts = ['maxfiles' => 1, 'maxbytes' => 10485760];
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'hero_background', 0, $opts);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Hero Title
    $name = 'theme_liteap/hero_title';
    $title = get_string('hero_title', 'theme_liteap');
    $description = get_string('hero_titledesc', 'theme_liteap');
    $default = get_string('hero_default_title', 'theme_liteap');
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $page->add($setting);

    // Hero Description
    $name = 'theme_liteap/hero_description';
    $title = get_string('hero_description', 'theme_liteap');
    $description = get_string('hero_descriptiondesc', 'theme_liteap');
    $default = get_string('hero_default_description', 'theme_liteap');
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $page->add($setting);

    // CTA Buttons
    $name = 'theme_liteap/hero_apply_text';
    $title = get_string('hero_apply_text', 'theme_liteap');
    $description = get_string('hero_apply_textdesc', 'theme_liteap');
    $default = get_string('hero_default_apply_text', 'theme_liteap');
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $page->add($setting);

    $name = 'theme_liteap/hero_apply_link';
    $title = get_string('hero_apply_link', 'theme_liteap');
    $description = get_string('hero_apply_linkdesc', 'theme_liteap');
    $setting = new admin_setting_configtext($name, $title, $description, '');
    $page->add($setting);

    $name = 'theme_liteap/hero_tour_text';
    $title = get_string('hero_tour_text', 'theme_liteap');
    $description = get_string('hero_tour_textdesc', 'theme_liteap');
    $default = get_string('hero_default_tour_text', 'theme_liteap');
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $page->add($setting);

    $name = 'theme_liteap/hero_tour_link';
    $title = get_string('hero_tour_link', 'theme_liteap');
    $description = get_string('hero_tour_linkdesc', 'theme_liteap');
    $setting = new admin_setting_configtext($name, $title, $description, '');
    $page->add($setting);

    $name = 'theme_liteap/hero_tour_text1';
    $title = get_string('hero_tour_text1', 'theme_liteap');
    $description = get_string('hero_tour_textdesc1', 'theme_liteap');
    $default = get_string('hero_default_tour_text', 'theme_liteap');
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $page->add($setting);

    $name = 'theme_liteap/hero_tour_link1';
    $title = get_string('hero_tour_link1', 'theme_liteap');
    $description = get_string('hero_tour_linkdesc1', 'theme_liteap');
    $setting = new admin_setting_configtext($name, $title, $description, '');
    $page->add($setting);

    // Announcement Section
    $name = 'theme_liteap/hero_announcement_enabled';
    $title = get_string('hero_announcement_enabled', 'theme_liteap');
    $description = get_string('hero_announcement_enableddesc', 'theme_liteap');
    $setting = new admin_setting_configcheckbox($name, $title, $description, 0);
    $page->add($setting);

    $name = 'theme_liteap/hero_announcement_badge';
    $title = get_string('hero_announcement_badge', 'theme_liteap');
    $description = get_string('hero_announcement_badgedesc', 'theme_liteap');
    $default = get_string('hero_default_announcement_badge', 'theme_liteap');
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $page->add($setting);

    $name = 'theme_liteap/hero_announcement_text';
    $title = get_string('hero_announcement_text', 'theme_liteap');
    $description = get_string('hero_announcement_textdesc', 'theme_liteap');
    $default = get_string('hero_default_announcement_text', 'theme_liteap');
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $page->add($setting);

    // Highlights Section
    $name = 'theme_liteap/hero_highlights_enabled';
    $title = get_string('hero_highlights_enabled', 'theme_liteap');
    $description = get_string('hero_highlights_enableddesc', 'theme_liteap');
    $setting = new admin_setting_configcheckbox($name, $title, $description, 0);
    $page->add($setting);

    // Highlight Items
    for ($i = 1; $i <= 3; $i++) {
        // Icon (Font Awesome classes)
        $name = "theme_liteap/hero_highlight{$i}_icon";
        $title = get_string("hero_highlight{$i}_icon", 'theme_liteap');
        $description = get_string("hero_highlight{$i}_icondesc", 'theme_liteap');
        $default = get_string("hero_default_highlight{$i}_icon", 'theme_liteap');
        $setting = new admin_setting_configtext($name, $title, $description, $default);
        $page->add($setting);

        $name = "theme_liteap/hero_highlight{$i}_title";
        $title = get_string("hero_highlight{$i}_title", 'theme_liteap');
        $description = get_string("hero_highlight{$i}_titledesc", 'theme_liteap');
        $setting = new admin_setting_configtext($name, $title, $description, '');
        $page->add($setting);

        $name = "theme_liteap/hero_highlight{$i}_desc";
        $title = get_string("hero_highlight{$i}_desc", 'theme_liteap');
        $description = get_string("hero_highlight{$i}_descdesc", 'theme_liteap');
        $setting = new admin_setting_configtext($name, $title, $description, '');
        $page->add($setting);
    }

    // Event Banner
    $name = 'theme_liteap/hero_event_enabled';
    $title = get_string('hero_event_enabled', 'theme_liteap');
    $description = get_string('hero_event_enableddesc', 'theme_liteap');
    $setting = new admin_setting_configcheckbox($name, $title, $description, 0);
    $page->add($setting);

    $name = 'theme_liteap/hero_event_month';
    $title = get_string('hero_event_month', 'theme_liteap');
    $description = get_string('hero_event_monthdesc', 'theme_liteap');
    $default = get_string('hero_default_event_month', 'theme_liteap');
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $page->add($setting);

    $name = 'theme_liteap/hero_event_day';
    $title = get_string('hero_event_day', 'theme_liteap');
    $description = get_string('hero_event_daydesc', 'theme_liteap');
    $default = get_string('hero_default_event_day', 'theme_liteap');
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $page->add($setting);

    $name = 'theme_liteap/hero_event_title';
    $title = get_string('hero_event_title', 'theme_liteap');
    $description = get_string('hero_event_titledesc', 'theme_liteap');
    $default = get_string('hero_default_event_title', 'theme_liteap');
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $page->add($setting);

    $name = 'theme_liteap/hero_event_description';
    $title = get_string('hero_event_description', 'theme_liteap');
    $description = get_string('hero_event_descriptiondesc', 'theme_liteap');
    $default = get_string('hero_default_event_description', 'theme_liteap');
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $page->add($setting);

    $name = 'theme_liteap/hero_event_button';
    $title = get_string('hero_event_button', 'theme_liteap');
    $description = get_string('hero_event_buttondesc', 'theme_liteap');
    $default = get_string('hero_default_event_button', 'theme_liteap');
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $page->add($setting);

    $name = 'theme_liteap/hero_event_link';
    $title = get_string('hero_event_link', 'theme_liteap');
    $description = get_string('hero_event_linkdesc', 'theme_liteap');
    $setting = new admin_setting_configtext($name, $title, $description, '');
    $page->add($setting);


    $settings->add($page);

    /*
    * -----------------------
    * abouts settings tab
    * -----------------------
    */
    $page = new admin_settingpage('theme_liteap_about', 'Abouts');
        // === About Section ===
    $name = 'theme_liteap/about_heading';
    $title = get_string('about_heading', 'theme_liteap');
    $description = get_string('about_headingdesc', 'theme_liteap');
    $setting = new admin_setting_heading($name, $title, $description);
    $page->add($setting);

    // About Section Toggle
    $name = 'theme_liteap/about_enabled';
    $title = get_string('about_enabled', 'theme_liteap');
    $description = get_string('about_enableddesc', 'theme_liteap');
    $setting = new admin_setting_configcheckbox($name, $title, $description, 0);
    $page->add($setting);

    // About Image - SECURITY FIX: Add file size limit
    $name = 'theme_liteap/about_image';
    $title = get_string('about_image', 'theme_liteap');
    $description = get_string('about_imagedesc', 'theme_liteap');
    $opts = ['maxfiles' => 1, 'maxbytes' => 10485760];
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'about_image', 0, $opts);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // About Title
    $name = 'theme_liteap/about_title';
    $title = get_string('about_title', 'theme_liteap');
    $description = get_string('about_titledesc', 'theme_liteap');
    $default = get_string('about_default_title', 'theme_liteap');
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $page->add($setting);

    // About Description
    $name = 'theme_liteap/about_description';
    $title = get_string('about_description', 'theme_liteap');
    $description = get_string('about_descriptiondesc', 'theme_liteap');
    $default = get_string('about_default_description', 'theme_liteap');
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $page->add($setting);

    // Statistics Section
    $name = 'theme_liteap/about_stats_enabled';
    $title = get_string('about_stats_enabled', 'theme_liteap');
    $description = get_string('about_stats_enableddesc', 'theme_liteap');
    $setting = new admin_setting_configcheckbox($name, $title, $description, 0);
    $page->add($setting);

    // Stat Items - No validation (allow empty)
    for ($i = 1; $i <= 3; $i++) {
        $name = "theme_liteap/about_stat{$i}_number";
        $title = get_string("about_stat{$i}_number", 'theme_liteap');
        $description = get_string("about_stat{$i}_numberdesc", 'theme_liteap');
        $setting = new admin_setting_configtext($name, $title, $description, '');
        $page->add($setting);

        $name = "theme_liteap/about_stat{$i}_label";
        $title = get_string("about_stat{$i}_label", 'theme_liteap');
        $description = get_string("about_stat{$i}_labeldesc", 'theme_liteap');
        $setting = new admin_setting_configtext($name, $title, $description, '');
        $page->add($setting);
    }

    // Mission Statement
    $name = 'theme_liteap/about_mission_enabled';
    $title = get_string('about_mission_enabled', 'theme_liteap');
    $description = get_string('about_mission_enableddesc', 'theme_liteap');
    $setting = new admin_setting_configcheckbox($name, $title, $description, 0);
    $page->add($setting);

    $name = 'theme_liteap/about_mission_text';
    $title = get_string('about_mission_text', 'theme_liteap');
    $description = get_string('about_mission_textdesc', 'theme_liteap');
    $default = get_string('about_default_mission_text', 'theme_liteap');
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $page->add($setting);

    // Call to Action
    $name = 'theme_liteap/about_cta_enabled';
    $title = get_string('about_cta_enabled', 'theme_liteap');
    $description = get_string('about_cta_enableddesc', 'theme_liteap');
    $setting = new admin_setting_configcheckbox($name, $title, $description, 0);
    $page->add($setting);

    $name = 'theme_liteap/about_cta_text';
    $title = get_string('about_cta_text', 'theme_liteap');
    $description = get_string('about_cta_textdesc', 'theme_liteap');
    $default = get_string('about_default_cta_text', 'theme_liteap');
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $page->add($setting);

    $name = 'theme_liteap/about_cta_link';
    $title = get_string('about_cta_link', 'theme_liteap');
    $description = get_string('about_cta_linkdesc', 'theme_liteap');
    $setting = new admin_setting_configtext($name, $title, $description, '');
    $page->add($setting);

    // Experience Badge
    $name = 'theme_liteap/about_badge_enabled';
    $title = get_string('about_badge_enabled', 'theme_liteap');
    $description = get_string('about_badge_enableddesc', 'theme_liteap');
    $setting = new admin_setting_configcheckbox($name, $title, $description, 0);
    $page->add($setting);

    $name = 'theme_liteap/about_badge_years';
    $title = get_string('about_badge_years', 'theme_liteap');
    $description = get_string('about_badge_yearsdesc', 'theme_liteap');
    $default = get_string('about_default_badge_years', 'theme_liteap');
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $page->add($setting);

    $name = 'theme_liteap/about_badge_text';
    $title = get_string('about_badge_text', 'theme_liteap');
    $description = get_string('about_badge_textdesc', 'theme_liteap');
    $default = get_string('about_default_badge_text', 'theme_liteap');
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $page->add($setting);
    $settings->add($page);


    /*
    * --------------------
    * Footer settings tab
    * --------------------
    */
    $page = new admin_settingpage('theme_liteap_footer', get_string('footersettings', 'theme_liteap'));
    // Location Link 1
    $name = 'theme_liteap/locationlinkname';
    $title = get_string('locationlinkname', 'theme_liteap');
    $description = get_string('locationlinknamedesc', 'theme_liteap');
    $setting = new admin_setting_configtext($name, $title, $description, 'Default Location');
    $page->add($setting);

    $name = 'theme_liteap/locationlinkurl';
    $title = get_string('locationlinkurl', 'theme_liteap');
    $description = get_string('locationlinknamedesc', 'theme_liteap');
    $setting = new admin_setting_configtext($name, $title, $description, '');
    $page->add($setting);

    // Website - No validation (allow empty)
    $name = 'theme_liteap/website';
    $title = get_string('website', 'theme_liteap');
    $description = get_string('websitedesc', 'theme_liteap');
    $setting = new admin_setting_configtext($name, $title, $description, '');
    $page->add($setting);

    // Mobile - No validation (allow empty)
    $name = 'theme_liteap/mobile';
    $title = get_string('mobile', 'theme_liteap');
    $description = get_string('mobiledesc', 'theme_liteap');
    $setting = new admin_setting_configtext($name, $title, $description, '');
    $page->add($setting);

    // Mail - No validation (allow empty)
    $name = 'theme_liteap/mail';
    $title = get_string('mail', 'theme_liteap');
    $description = get_string('maildesc', 'theme_liteap');
    $setting = new admin_setting_configtext($name, $title, $description, '');
    $page->add($setting);

    // TikTok url setting - No validation (allow empty)
    $name = 'theme_liteap/tiktok';
    $title = get_string('tiktok', 'theme_liteap');
    $description = get_string('tiktokdesc', 'theme_liteap');
    $setting = new admin_setting_configtext($name, $title, $description, '');
    $page->add($setting);

    // Facebook url setting - No validation (allow empty)
    $name = 'theme_liteap/facebook';
    $title = get_string('facebook', 'theme_liteap');
    $description = get_string('facebookdesc', 'theme_liteap');
    $setting = new admin_setting_configtext($name, $title, $description, '');
    $page->add($setting);

    // Twitter url setting - No validation (allow empty)
    $name = 'theme_liteap/twitter';
    $title = get_string('twitter', 'theme_liteap');
    $description = get_string('twitterdesc', 'theme_liteap');
    $setting = new admin_setting_configtext($name, $title, $description, '');
    $page->add($setting);

    // Linkedin url setting - No validation (allow empty)
    $name = 'theme_liteap/linkedin';
    $title = get_string('linkedin', 'theme_liteap');
    $description = get_string('linkedindesc', 'theme_liteap');
    $setting = new admin_setting_configtext($name, $title, $description, '');
    $page->add($setting);

    // Youtube url setting - No validation (allow empty)
    $name = 'theme_liteap/youtube';
    $title = get_string('youtube', 'theme_liteap');
    $description = get_string('youtubedesc', 'theme_liteap');
    $setting = new admin_setting_configtext($name, $title, $description, '');
    $page->add($setting);

    // Instagram url setting - No validation (allow empty)
    $name = 'theme_liteap/instagram';
    $title = get_string('instagram', 'theme_liteap');
    $description = get_string('instagramdesc', 'theme_liteap');
    $setting = new admin_setting_configtext($name, $title, $description, '');
    $page->add($setting);

    // Pinterest url setting - No validation (allow empty)
    $name = 'theme_liteap/pinterest';
    $title = get_string('pinterest', 'theme_liteap');
    $description = get_string('pinterestdesc', 'theme_liteap');
    $setting = new admin_setting_configtext($name, $title, $description, '');
    $page->add($setting);

    // Whatsapp url setting - No validation (allow empty)
    $name = 'theme_liteap/whatsapp';
    $title = get_string('whatsapp', 'theme_liteap');
    $description = get_string('whatsappdesc', 'theme_liteap');
    $setting = new admin_setting_configtext($name, $title, $description, '');
    $page->add($setting);

    // Telegram url setting - No validation (allow empty)
    $name = 'theme_liteap/telegram';
    $title = get_string('telegram', 'theme_liteap');
    $description = get_string('telegramdesc', 'theme_liteap');
    $setting = new admin_setting_configtext($name, $title, $description, '');
    $page->add($setting);


    // Enable/disable service links
    $name = 'theme_liteap/enableservicelinks';
    $title = get_string('enableservicelinks', 'theme_liteap');
    $description = get_string('enableservicelinksdesc', 'theme_liteap');
    $default = 0;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
    $page->add($setting);

    // Service Link 1
    $name = 'theme_liteap/servicelink1name';
    $title = get_string('servicelink1name', 'theme_liteap');
    $description = get_string('servicelinknamedesc', 'theme_liteap');
    $setting = new admin_setting_configtext($name, $title, $description, 'Support');
    $page->add($setting);

    $name = 'theme_liteap/servicelink1url';
    $title = get_string('servicelink1url', 'theme_liteap');
    $description = get_string('servicelinkurldesc', 'theme_liteap');
    $setting = new admin_setting_configtext($name, $title, $description, '');
    $page->add($setting);

    // Service Link 2
    $name = 'theme_liteap/servicelink2name';
    $title = get_string('servicelink2name', 'theme_liteap');
    $description = get_string('servicelinknamedesc', 'theme_liteap');
    $setting = new admin_setting_configtext($name, $title, $description, 'Documentation');
    $page->add($setting);

    $name = 'theme_liteap/servicelink2url';
    $title = get_string('servicelink2url', 'theme_liteap');
    $description = get_string('servicelinkurldesc', 'theme_liteap');
    $setting = new admin_setting_configtext($name, $title, $description, '');
    $page->add($setting);

    // Service Link 3
    $name = 'theme_liteap/servicelink3name';
    $title = get_string('servicelink3name', 'theme_liteap');
    $description = get_string('servicelinknamedesc', 'theme_liteap');
    $setting = new admin_setting_configtext($name, $title, $description, 'Help Desk');
    $page->add($setting);

    $name = 'theme_liteap/servicelink3url';
    $title = get_string('servicelink3url', 'theme_liteap');
    $description = get_string('servicelinkurldesc', 'theme_liteap');
    $setting = new admin_setting_configtext($name, $title, $description, '');
    $page->add($setting);

    $settings->add($page);

}