<?php

namespace theme_liteap\util;

defined('MOODLE_INTERNAL') || die();

use theme_config;
use core_course_category;
use moodle_url;
use context_user;
use context_course;
use core_course\external\course_summary_exporter;
use Exception;

class settings
{   
    /**
     * @var \stdClass $theme The theme object.
     */
    protected $theme;
    
    /**
     * List of file settings that need special handling
     */
    protected $files = [
        'loginbg',
        'sliderimage1', 
        'hero_background', 'about_image', 'featured_overview_image'
    ];

    /**
     * Class constructor
     */
    public function __construct()
    {
        $this->theme = theme_config::load('liteap');
    }
    
    /**
     * Magic method to get theme settings
     *
     * @param string $name
     * @return false|string|null
     */
    public function __get(string $name) {
        // Handle file settings
        if (in_array($name, $this->files)) {
            return $this->theme->setting_file_url($name, $name);
        }

        // Handle regular theme settings
        if (empty($this->theme->settings->$name)) {
            return false;
        }

        return $this->theme->settings->$name;
    }
    
    /**
     * Get frontpage settings
     *
     * @return array
     */
    public function frontpage()
    {
         return array_merge(
            $this->faq(),
            $this->featured(),
            $this->hero(),
            $this->about(),
        );
    }
    
    /**
     * Get footer settings
     *
     * @return array
     */
    public function footer()
    {
        global $CFG;

        // Initialize the template context array
        $templatecontext = [];
        // List of all settings to check (social and contact)
        $settings = [
            'facebook', 'twitter', 'linkedin', 'youtube', 'instagram',
            'whatsapp', 'telegram', 'tiktok', 'pinterest',
            'website', 'mobile', 'mail',
        ];

        // Initialize the flags for contact and social sections
        $templatecontext['hasfootercontact'] = false;
        $templatecontext['hasfootersocial'] = false;
        $templatecontext['locationlinkname'] = format_string($this->locationlinkname);
        $templatecontext['locationlinkurl'] = $this->locationlinkurl;
        // Loop through all settings and populate the template context
        foreach ($settings as $setting) {
            $templatecontext[$setting] = $this->$setting;

            // If it's a contact setting (website, mobile, or mail), and it's not empty, set the flag
            if (in_array($setting, ['website', 'mobile', 'mail']) && !empty($templatecontext[$setting])) {
                $templatecontext['hasfootercontact'] = true;
            }

            // If it's a social setting, and it's not empty, set the flag
            if (in_array($setting, ['facebook', 'twitter', 'linkedin', 'youtube', 'instagram', 'whatsapp', 'telegram', 'tiktok', 'pinterest']) && !empty($templatecontext[$setting])) {
                $templatecontext['hasfootersocial'] = true;
            }
        }
        // Get the setting value from the theme settings (whether the user registration link is enabled)
        $userregister_enabled = get_config('theme_liteap', 'userregister'); // Get setting value

        // Default signup URL
        $default_signup_url = $CFG->wwwroot . '/login/signup.php'; // Default registration URL

        // If the setting is enabled, pass 'userregister' and 'userregisterurl' to the template context
        if ($userregister_enabled) {
            // Add the default signup URL to the template context
            $templatecontext['userregisterurl'] = $default_signup_url;
            $templatecontext['userregister'] = true; // Show the registration link
        } else {
            $templatecontext['userregister'] = false; // Don't show the registration link
        }
        
        // Merge the service links with the template context and return it
        return array_merge($templatecontext, $this->servicelinks());
    }

    /**
     * Get service links configuration
     *
     * @return array
     */
    public function servicelinks()
    {
        // Get the flag for enabling service links
        $enableservicelinks = $this->enableservicelinks;
        $servicelinks = [];

        // If service links are enabled, fetch the link data
        if ($enableservicelinks) {
            $links = [1, 2, 3]; // Assuming there are 3 possible service links
            foreach ($links as $num) {
                $name = $this->{'servicelink' . $num . 'name'};
                $url = $this->{'servicelink' . $num . 'url'};

                // If both name and URL are not empty, add the link to the service links array
                if (!empty($name) && !empty($url)) {
                    $servicelinks[] = [
                        'url' => $url,
                        'text' => $name,
                        'number' => $num
                    ];
                }
            }
        }

        // Return the service links in the context
        return [
            'service_links' => $servicelinks,
            'has_service_links' => !empty($servicelinks)
        ];
    }

    /**
     * Get config theme faq
     *
     * @return array
     */
    public function faq()
    {
        $templatecontext['faqenabled'] = false;

        if ($this->faqcount) {
            for ($i = 1; $i <= $this->faqcount; $i++) {
                $faqquestion = 'faqquestion' . $i;
                $faqanswer = 'faqanswer' . $i;

                if (!$this->$faqquestion || !$this->$faqanswer) {
                    continue;
                }

                $templatecontext['faq'][] = [
                    'id' => $i,
                    'question' => format_text($this->$faqquestion),
                    'answer' => format_text($this->$faqanswer),
                    'active' => $i === 1,
                ];
            }

            if (!empty($templatecontext['faq'])) {
                $templatecontext['faqenabled'] = true;
            }
        }

        return $templatecontext;
    }

    /**
     * Get config for Hero Section.
     */
    public function hero() {
        global $CFG;

        $templatecontext = [];
        $templatecontext['themeurl'] = $CFG->wwwroot . '/theme/liteap';
        
        // --- Hero Toggle ---
        $templatecontext['heroenabled'] = (bool)$this->hero_enabled;

        // If hero is disabled, return empty context
        if (!$templatecontext['heroenabled']) {
            return $templatecontext;
        }

        // --- Main Hero Content ---
        $templatecontext['hero_title'] = format_string($this->hero_title);
        $templatecontext['hero_description'] = format_string($this->hero_description);
        
        // Set defaults if empty
        if (empty($templatecontext['hero_title'])) {
            $templatecontext['hero_title'] = get_string('hero_default_title', 'theme_liteap');
        }
        if (empty($templatecontext['hero_description'])) {
            $templatecontext['hero_description'] = get_string('hero_default_description', 'theme_liteap');
        }

        // Hero Background Image
        $templatecontext['hero_background'] = $this->hero_background ?: $templatecontext['themeurl'] . '/pix/default-overview.webp';

        // --- CTA Buttons ---
        $templatecontext['apply_text'] = format_string($this->hero_apply_text);
        $templatecontext['apply_link'] = $this->hero_apply_link;
        $templatecontext['tour_text'] = format_string($this->hero_tour_text);
        $templatecontext['tour_link'] = $this->hero_tour_link;
        $templatecontext['tour_text1'] = format_string($this->hero_tour_text1);
        $templatecontext['tour_link1'] = $this->hero_tour_link1;

        // Set default CTA values
        if (empty($templatecontext['apply_text'])) {
            $templatecontext['apply_text'] = get_string('hero_default_apply_text', 'theme_liteap');
        }
        if (empty($templatecontext['tour_text'])) {
            $templatecontext['tour_text'] = get_string('hero_default_tour_text', 'theme_liteap');
        }
        if (empty($templatecontext['tour_text1'])) {
            $templatecontext['tour_text1'] = get_string('hero_default_tour_text1', 'theme_liteap');
        }
        if (empty($templatecontext['apply_link'])) {
            $templatecontext['apply_link'] = $CFG->wwwroot . '/auth/register';
        }
        if (empty($templatecontext['tour_link'])) {
            $templatecontext['tour_link'] = $CFG->wwwroot . '/course';
        }

        // --- Announcement ---
        $templatecontext['announcement_enabled'] = (bool)$this->hero_announcement_enabled;
        if ($templatecontext['announcement_enabled']) {
            $templatecontext['announcement_badge'] = format_string($this->hero_announcement_badge);
            $templatecontext['announcement_text'] = format_string($this->hero_announcement_text);

            if (empty($templatecontext['announcement_badge'])) {
                $templatecontext['announcement_badge'] = get_string('hero_default_announcement_badge', 'theme_liteap');
            }
            if (empty($templatecontext['announcement_text'])) {
                $templatecontext['announcement_text'] = get_string('hero_default_announcement_text', 'theme_liteap');
            }
        }

        // --- Highlights Section ---
        $templatecontext['highlights_enabled'] = (bool)$this->hero_highlights_enabled;

        if ($templatecontext['highlights_enabled']) {
            $highlights = [];
            $highlight_configs = [
                '1' => [
                    'icon' => get_string('hero_default_highlight1_icon', 'theme_liteap'),
                    'title' => get_string('hero_highlight1_title', 'theme_liteap'),
                    'description' => get_string('hero_highlight1_desc', 'theme_liteap')
                ],
                '2' => [
                    'icon' => get_string('hero_default_highlight2_icon', 'theme_liteap'), 
                    'title' => get_string('hero_highlight2_title', 'theme_liteap'),
                    'description' => get_string('hero_highlight2_desc', 'theme_liteap')
                ],
                '3' => [
                    'icon' => get_string('hero_default_highlight3_icon', 'theme_liteap'),
                    'title' => get_string('hero_highlight3_title', 'theme_liteap'),
                    'description' => get_string('hero_highlight3_desc', 'theme_liteap')
                ]
            ];
        

            foreach ($highlight_configs as $key => $highlight) {
                // Check if custom values are set
                $custom_icon = $this->{'hero_highlight' . $key . '_icon'};
                $custom_title = $this->{'hero_highlight' . $key . '_title'};
                $custom_desc = $this->{'hero_highlight' . $key . '_desc'};
                
                $highlights[] = [
                    'icon' => !empty($custom_icon) ? format_string($custom_icon) : $highlight['icon'],
                    'title' => !empty($custom_title) ? format_string($custom_title) : $highlight['title'],
                    'description' => !empty($custom_desc) ? format_string($custom_desc) : $highlight['description']
                ];
            }

            $templatecontext['highlights'] = $highlights;
        }
           

        // --- Event Banner ---
        $templatecontext['event_enabled'] = (bool)$this->hero_event_enabled;
        if ($templatecontext['event_enabled']) {
            $templatecontext['event_month'] = format_string($this->hero_event_month);
            $templatecontext['event_day'] = format_string($this->hero_event_day);
            $templatecontext['event_title'] = format_string($this->hero_event_title);
            $templatecontext['event_description'] = format_string($this->hero_event_description);
            $templatecontext['event_button'] = format_string($this->hero_event_button);
            $templatecontext['event_link'] = $this->hero_event_link;

            // Set defaults
            if (empty($templatecontext['event_month'])) {
                $templatecontext['event_month'] = get_string('hero_default_event_month', 'theme_liteap');
            }
            if (empty($templatecontext['event_day'])) {
                $templatecontext['event_day'] = get_string('hero_default_event_day', 'theme_liteap');
            }
            if (empty($templatecontext['event_title'])) {
                $templatecontext['event_title'] = get_string('hero_default_event_title', 'theme_liteap');
            }
            if (empty($templatecontext['event_description'])) {
                $templatecontext['event_description'] = get_string('hero_default_event_description', 'theme_liteap');
            }
            if (empty($templatecontext['event_button'])) {
                $templatecontext['event_button'] = get_string('hero_default_event_button', 'theme_liteap');
            }
            if (empty($templatecontext['event_link'])) {
                $templatecontext['event_link'] = $CFG->wwwroot . '/course';
            }
        }

        return $templatecontext;
    }

    /**
     * Get config for About Section.
     */
    public function about() {
        global $CFG;

        $templatecontext = [];
        $templatecontext['themeurl'] = $CFG->wwwroot . '/theme/liteap';
        
        // --- About Toggle ---
        $templatecontext['aboutenabled'] = (bool)$this->about_enabled;

        // If about is disabled, return empty context
        if (!$templatecontext['aboutenabled']) {
            return $templatecontext;
        }

        // --- Main About Content ---
        $templatecontext['about_title'] = format_string($this->about_title);
        $templatecontext['about_description'] = format_string($this->about_description);
        
        // Set defaults if empty
        if (empty($templatecontext['about_title'])) {
            $templatecontext['about_title'] = get_string('about_default_title', 'theme_liteap');
        }
        if (empty($templatecontext['about_description'])) {
            $templatecontext['about_description'] = get_string('about_default_description', 'theme_liteap');
        }

        // About Image
        $templatecontext['about_image'] = $this->about_image ?: $templatecontext['themeurl'] . '/pix/default-overview.webp';
        $templatecontext['about_image_alt'] = get_string('about_default_image_alt', 'theme_liteap');

        // --- Statistics ---
        $templatecontext['stats_enabled'] = (bool)$this->about_stats_enabled;
        if ($templatecontext['stats_enabled']) {
            $stats = [];
            $stat_configs = [
                '1' => [
                    'number' => get_string('about_stat1_number', 'theme_liteap'),
                    'label' => get_string('about_stat1_label', 'theme_liteap')
                ],
                '2' => [
                    'number' => get_string('about_stat2_number', 'theme_liteap'), 
                    'label' => get_string('about_stat2_label', 'theme_liteap')
                ],
                '3' => [
                    'number' => get_string('about_stat3_number', 'theme_liteap'),
                    'label' => get_string('about_stat3_label', 'theme_liteap')
                ]
            ];

            foreach ($stat_configs as $key => $stat) {
                // Check if custom values are set
                $custom_number = $this->{'about_stat' . $key . '_number'};
                $custom_label = $this->{'about_stat' . $key . '_label'};
                
                $stats[] = [
                    'number' => !empty($custom_number) ? format_string($custom_number) : $stat['number'],
                    'label' => !empty($custom_label) ? format_string($custom_label) : $stat['label']
                ];
            }

            $templatecontext['stats'] = $stats;
        }

        // --- Mission Statement ---
        $templatecontext['mission_enabled'] = (bool)$this->about_mission_enabled;
        if ($templatecontext['mission_enabled']) {
            $templatecontext['mission_text'] = format_string($this->about_mission_text);
            
            if (empty($templatecontext['mission_text'])) {
                $templatecontext['mission_text'] = get_string('about_default_mission_text', 'theme_liteap');
            }
        }

        // --- Call to Action ---
        $templatecontext['cta_enabled'] = (bool)$this->about_cta_enabled;
        if ($templatecontext['cta_enabled']) {
            $templatecontext['cta_text'] = format_string($this->about_cta_text);
            $templatecontext['cta_link'] = $this->about_cta_link;

            if (empty($templatecontext['cta_text'])) {
                $templatecontext['cta_text'] = get_string('about_default_cta_text', 'theme_liteap');
            }
            if (empty($templatecontext['cta_link'])) {
                $templatecontext['cta_link'] = $CFG->wwwroot . '/course';
            }
        }

        // --- Experience Badge ---
        $templatecontext['badge_enabled'] = (bool)$this->about_badge_enabled;
        if ($templatecontext['badge_enabled']) {
            $templatecontext['badge_years'] = format_string($this->about_badge_years);
            $templatecontext['badge_text'] = format_string($this->about_badge_text);

            if (empty($templatecontext['badge_years'])) {
                $templatecontext['badge_years'] = get_string('about_default_badge_years', 'theme_liteap');
            }
            if (empty($templatecontext['badge_text'])) {
                $templatecontext['badge_text'] = get_string('about_default_badge_text', 'theme_liteap');
            }
        }

        return $templatecontext;
    }

    /**
    * Get config for Featured Programs (FULLY DYNAMIC)
    */
    public function featured() {
        global $CFG;

        $templatecontext = [];
        $templatecontext['themeurl'] = $CFG->wwwroot . '/theme/liteap';
        
        // Feature Toggle
        $templatecontext['featuredenabled'] = (bool)$this->featured;
        if (!$templatecontext['featuredenabled']) {
            return $templatecontext;
        }

        // Section Title
        $templatecontext['section_title'] = get_string('featured', 'theme_liteap');
        $templatecontext['section_description'] = get_string('featureddesc', 'theme_liteap');

        // Overview Section (keep as is)
        $templatecontext['overview_enabled'] = (bool)$this->featured_overview_enabled;
        if ($templatecontext['overview_enabled']) {
            $this->build_overview_section($templatecontext);
        }

        // Featured Programs (DYNAMIC)
        $this->build_dynamic_featured_courses($templatecontext);

        return $templatecontext;
    }

    /**
     * Build Overview Section (UNCHANGED)
     */
    private function build_overview_section(&$templatecontext) {
        $default_image = $templatecontext['themeurl'] . '/pix/default-overview.webp';

        // Title and Description
        $templatecontext['overview_title'] = format_string($this->featured_overview_title) ?: get_string('featured_default_overview_title', 'theme_liteap');
        $templatecontext['overview_description'] = format_string($this->featured_overview_desc) ?: get_string('featured_default_overview_desc', 'theme_liteap');

        // Image
        $templatecontext['overview_image'] = $this->featured_overview_image ?: $default_image;

        // Stats
        $stats = [];
        
        $stat1_num = $this->featured_overview_stat1_num;
        if (!empty($stat1_num)) {
            $stats[] = ['number' => $stat1_num, 'label' => $this->featured_overview_stat1_label];
        }
        
        $stat2_num = $this->featured_overview_stat2_num;
        if (!empty($stat2_num)) {
            $stats[] = ['number' => $stat2_num, 'label' => $this->featured_overview_stat2_label];
        }
        
        $stat3_num = $this->featured_overview_stat3_num;
        if (!empty($stat3_num)) {
            $stats[] = ['number' => $stat3_num, 'label' => $this->featured_overview_stat3_label];
        }

        $templatecontext['overview_stats'] = $stats;
    }

    /**
     * Build Dynamic Featured Courses
     */
    private function build_dynamic_featured_courses(&$templatecontext) {
        // Get featured course (manual override → starred → recent)
        $featured_course = $this->get_featured_course();
        
        // Build featured card
        if ($featured_course) {
            $templatecontext['featured_card'] = $this->build_course_data($featured_course);
        }
        
        // Build program list from starred courses
        $this->build_program_list($templatecontext, $featured_course);
    }

    /**
     * Get Featured Course (manual → starred → recent)
     */
    private function get_featured_course() {
        $admin_course = trim($this->featured_course_1);
        
        // 1. Manual override
        if (!empty($admin_course)) {
            $course = $this->find_course_by_identifier($admin_course);
            if ($course) return $course;
        }
        
        // 2. First starred course
        $starred_courses = $this->get_starred_courses();
        if (!empty($starred_courses)) {
            return reset($starred_courses);
        }
        
        // 3. First recent course
        $coursecat = core_course_category::get(0);
        $recent_courses = $coursecat->get_courses([
            'recursive' => true, 
            'limit' => 1,
            'sort' => ['timemodified DESC']
        ]);
        
        return !empty($recent_courses) ? reset($recent_courses) : null;
    }

    /**
     * Build Program List from Starred Courses (with fallback to recent courses)
     */
    private function build_program_list(&$templatecontext, $featured_course) {
        $list_count = (int)$this->featured_list_count;
        
        if ($list_count <= 0) {
            $templatecontext['has_program_list'] = false;
            return;
        }
        
        // Get starred courses
        $starred_courses = $this->get_starred_courses();
        
        // If no starred courses, get recent courses as fallback
        if (empty($starred_courses)) {
            $coursecat = core_course_category::get(0);
            $recent_courses = $coursecat->get_courses([
                'recursive' => true, 
                'limit' => $list_count + 5,
                'sort' => ['timemodified DESC']
            ]);
            
            // Use recent courses as available courses
            $available_courses = $recent_courses;
        } else {
            // Use starred courses
            $available_courses = $starred_courses;
        }
        
        // Remove featured course from list to avoid duplicates
        if ($featured_course && !empty($available_courses)) {
            $available_courses = array_filter($available_courses, function($course) use ($featured_course) {
                return $course->id != $featured_course->id;
            });
        }
        
        // Limit to requested count
        $available_courses = array_slice($available_courses, 0, $list_count);
        
        // Build program list items
        $program_list_items = [];
        foreach ($available_courses as $course) {
            $program_list_items[] = $this->build_course_data($course);
        }
        
        $templatecontext['program_list_items'] = $program_list_items;
        $templatecontext['has_program_list'] = !empty($program_list_items);
        
        // Debug log
        error_log("Program List: list_count=$list_count, available_courses=" . count($available_courses) . ", program_items=" . count($program_list_items));
    }

    /**
     * Find course by ID, shortname, or fullname
     */
    private function find_course_by_identifier($identifier) {
        // Try by ID
        if (is_numeric($identifier)) {
            try {
                $course = get_course($identifier);
                if ($course->visible) return $course;
            } catch (Exception $e) {}
        }
        
        // Search by name/shortname
        $coursecat = core_course_category::get(0);
        $all_courses = $coursecat->get_courses(['recursive' => true, 'limit' => 100]);
        
        foreach ($all_courses as $course) {
            if (strcasecmp($course->shortname, $identifier) === 0 || 
                stripos($course->fullname, $identifier) !== false) {
                return $course;
            }
        }
        
        return null;
    }

    /**
     * Get starred/favourite courses
     */
    private function get_starred_courses() {
        global $USER, $DB;
        
        $favourite_courses = [];
        
        // Debug: Check if user has any favourites
        error_log("Getting starred courses for user: " . $USER->id);
        
        if (class_exists('core_favourites\service_factory')) {
            try {
                $usercontext = context_user::instance($USER->id);
                $ufservice = \core_favourites\service_factory::get_service_for_user_context($usercontext);
                
                $favourites = $ufservice->find_favourites_by_type('core_course', 'courses');
                error_log("Found favourites via service: " . count($favourites));
                
                foreach ($favourites as $favourite) {
                    try {
                        $course = get_course($favourite->itemid);
                        if ($course->visible) {
                            $favourite_courses[] = $course;
                            error_log("Added course to favourites: " . $course->fullname);
                        }
                    } catch (Exception $e) {
                        error_log("Error getting course: " . $e->getMessage());
                    }
                }
            } catch (Exception $e) {
                error_log("Favourites service error: " . $e->getMessage());
            }
        } else {
            error_log("Favourites service not available");
        }
        
        error_log("Final starred courses count: " . count($favourite_courses));
        return $favourite_courses;
    }   

    /**
     * Build course data for template
     */
    private function build_course_data($course) {
        global $OUTPUT;

        $courseurl = new moodle_url('/course/view.php', ['id' => $course->id]);
        $courseimage = course_summary_exporter::get_course_image($course);
        $imageurl = $courseimage ?: $OUTPUT->image_url('defaultcourseimage', 'theme')->out();
        
        $summary = content_to_text($course->summary, $course->summaryformat);
        if (strlen($summary) > 120) {
            $summary = substr($summary, 0, 120) . '...';
        }
        if (empty($summary)) {
            $summary = get_string('featured_default_course_desc', 'theme_liteap');
        }

        $category = core_course_category::get($course->category);
        $categoryname = $category ? format_string($category->name) : get_string('defaultcategory', 'theme_liteap');

        $context = context_course::instance($course->id);
        $enrollment_count = count(get_enrolled_users($context, '', 0, 'u.id', null, 0, 0, true));

        // Course duration
        $course_duration = 'Self Paced';
        if (!empty($course->enddate) && !empty($course->startdate)) {
            $days = ($course->enddate - $course->startdate) / (60 * 60 * 24);
            if ($days > 365) {
                $course_duration = round($days / 365) . ' Years';
            } elseif ($days > 30) {
                $course_duration = round($days / 30) . ' Months';
            } else {
                $course_duration = round($days) . ' Days';
            }
        }

        return [
            'title' => format_string($course->fullname),
            'category' => $categoryname,
            'description' => $summary,
            'image' => $imageurl,
            'link' => $courseurl->out(),
            'duration' => $course_duration,
            'type' => 'Course',
            'enrollment_count' => $enrollment_count
        ];
    }

    /**
     * Helper function to get file URL from file picker setting
     */
    protected function get_setting_file_url($settingname) {
        return $this->theme->setting_file_url($settingname, $settingname);
    }
}