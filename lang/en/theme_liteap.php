<?php
/**
 * Liteap config.
 *
 * @package   theme_liteap
 * @copyright 2025 liteap
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


defined('MOODLE_INTERNAL') || die();

$string['pluginname'] = 'Liteap';
$string['configtitle'] = 'liteap';
$string['choosereadme'] = 'theme is a modern theme. This theme is intended to be used directly.';
$string['fontsite'] = 'Site font';
$string['fontsite_desc'] = 'Default font site. You can try out the fonts on <a href="https://fonts.google.com">Google Fonts site</a>.';
$string['themedevelopedby'] = 'Managed By © 2025 Nepal Research and Education Network';


// General settings tab.
$string['generalsettings'] = 'General';

$string['unaddableblocks'] = 'Section';
$string['unaddableblocks_desc'] = 'Blocks to be excluded when this theme is enabled in the "Add a block" list: Administration, Navigation, Courses';

$string['logo'] = 'Logo';
$string['logodesc'] = 'The logo is displayed in the header.';

$string['favicon'] = 'favicon';
$string['favicondesc'] = 'Upload your own favicon.  It should be an .ico file.';

$string['backgroundimage'] = 'Background image';
$string['backgroundimage_desc'] = 'The image to display as a background of the site. The background image you upload here will override the background image in your theme preset files.';
$string['brandcolor'] = 'Brand colour';
$string['brandcolor_desc'] = 'The accent colour.';

$string['loginbackgroundimage'] = 'Login page background';
$string['loginbackgroundimage_desc'] = 'Upload your custom background image for the login page.';

$string['secondarymenucolor'] = 'Secondary menu color';
$string['secondarymenucolor_desc'] = 'Secondary menu background color';

$string['navbarbg'] = 'Navbar color';
$string['navbarbg_desc'] = 'The left navbar color';
$string['navbarbghover'] = 'Navbar hover color';
$string['navbarbghover_desc'] = 'The left navbar hover color';

$string['preset'] = 'Theme preset';
$string['preset_desc'] = 'Pick a preset to broadly change the look of the theme.';
$string['presetfiles'] = 'Additional theme preset files';
$string['presetfiles_desc'] = 'Preset files can be used to dramatically alter the appearance of the theme. See <a href="https://docs.moodle.org/dev/Boost_Presets">Boost presets</a> for information on creating and sharing your own preset files.';


// Advanced settings tab.
$string['advancedsettings'] = 'Advanced';

$string['rawscsspre'] = 'Raw initial SCSS';
$string['rawscsspre_desc'] = 'In this field you can provide initialising SCSS code, it will be injected before everything else. Most of the time you will use this setting to define variables.';

$string['rawscss'] = 'Raw SCSS';
$string['rawscss_desc'] = 'Use this field to provide SCSS or CSS code which will be injected at the end of the style sheet.';

$string['googleanalytics'] = 'Google Analytics V4 Code';
$string['googleanalyticsdesc'] = 'Please enter your Google Analytics V4 code to enable analytics on your website. The code format shold be like [G-XXXXXXXXXX]';

$string['hvpcss'] = 'Raw H5P CSS';
$string['hvpcss_desc'] = 'Use this field to provide a CSS file which will be injected on mod_hvp plugin pages.';

// Footer settings tab.

$string['footersettings'] = 'Footer';

$string['locationlinkname'] = 'Footer Location';
$string['locationlinknamedesc'] = 'Location Details';
$string['locationlinkurl'] = 'Location URL';

$string['website'] = 'Website URL';
$string['websitedesc'] = 'Main company Website';

$string['mobile'] = 'Mobile';
$string['mobiledesc'] = 'Enter Mobile No. Ex: +xxxx';

$string['mail'] = 'E-Mail';
$string['maildesc'] = 'Company support e-mail';

$string['tiktok'] = 'TikTok URL';
$string['tiktokdesc'] = 'Enter the URL of your TikTok. (i.e http://www.tiktok.com)';

$string['facebook'] = 'Facebook URL';
$string['facebookdesc'] = 'Enter the URL of your Facebook. (i.e http://www.facebook.com)';

$string['twitter'] = 'Twitter URL';
$string['twitterdesc'] = 'Enter the URL of your twitter. (i.e http://www.twitter.com)';

$string['linkedin'] = 'Linkedin URL';
$string['linkedindesc'] = 'Enter the URL of your Linkedin. (i.e http://www.linkedin.com)';

$string['youtube'] = 'Youtube URL';
$string['youtubedesc'] = 'Enter the URL of your Youtube. (i.e https://www.youtube.com)';

$string['instagram'] = 'Instagram URL';
$string['instagramdesc'] = 'Enter the URL of your Instagram. (i.e https://www.instagram.com)';

$string['pinterest'] = 'Pinterest URL';
$string['pinterestdesc'] = 'Enter the URL of your Pinterest. (i.e http://www.pinterest.com)';

$string['whatsapp'] = 'Whatsapp number';
$string['whatsappdesc'] = 'Enter your whatsapp number for contact.';

$string['telegram'] = 'Telegram';
$string['telegramdesc'] = 'Enter your Telegram contact or group link.';

$string['contactus'] = 'Contact us';
$string['followus'] = 'Follow us';

$string['servicelinks'] = 'Service Links';
$string['enableservicelinks'] = 'Enable Service Links';
$string['enableservicelinksdesc'] = 'Show service links in footer';

$string['servicelink1name'] = 'Service Link 1 Name';
$string['servicelink2name'] = 'Service Link 2 Name';
$string['servicelink3name'] = 'Service Link 3 Name';
$string['servicelinknamedesc'] = 'Enter display name for service link';
$string['servicelink1url'] = 'Service Link 1 URL';
$string['servicelink2url'] = 'Service Link 2 URL';
$string['servicelink3url'] = 'Service Link 3 URL';
$string['servicelinkurldesc'] = 'Enter URL for service link';
// For language strings for the setting.
$string['userregister'] = 'Show Register Link';
$string['userregisterdesc'] = 'Toggle to display a registration link on the front page.';

// Data privacy.
$string['privacy:metadata:preference:accessibilitystyles_fontsizeclass'] = 'The user\'s preference for font size.';
$string['privacy:metadata:preference:accessibilitystyles_sitecolorclass'] = 'The user\'s preference for site color.';
$string['privacy:metadata:preference:themesettings_fonttype'] = 'The user\'s preference for font type.';
$string['privacy:metadata:preference:themesettings_enableaccessibilitytoolbar'] = 'The user\'s preference for enable the accessibility toolbar.';

$string['privacy:accessibilitystyles_fontsizeclass'] = 'The current preference for the font size is: {$a}.';
$string['privacy:accessibilitystyles_sitecolorclass'] = 'The current preference for the site color is: {$a}.';
$string['privacy:themesettings_fonttype'] = 'The current preference for the font type is: {$a}.';
$string['privacy:themesettings_enableaccessibilitytoolbar'] = 'The current preference for enable accessibility toolbar is to show it.';

$string['redirectmessage'] = 'This page should automatically redirect.';
$string['redirectbtntext'] = 'If nothing is happening please click here to continue.';



// Frontpage settings tab.
$string['frontpagesettings'] = 'Frontpage';
$string['faq'] = 'FAQ';
$string['faqcount'] = 'FAQ questions';
$string['faqcountdesc'] = 'Select how many questions you want to add <strong>then click SAVE</strong> to load the input fields.<br>If you don\'t want a FAQ, just select 0.';
$string['faqquestion'] = 'FAQ question {$a}';
$string['faqanswer'] = 'FAQ answer {$a}';

// Featured Programs Section

$string['featuredsettings'] = 'Featured Programs Settings';
$string['featured'] = 'Featured Programs';
$string['featureddesc'] = 'Enable featured programs section on frontpage';
$string['featured_list_heading'] = 'Featured Programs Settings';
$string['featured_list_headingdesc'] = 'Configure the featured programs section';
$string['featured_list_count'] = 'Number of programs to show in list';
$string['featured_list_countdesc'] = 'Number of starred courses to display in the program list';

// Course Selection
$string['featured_course_1'] = 'Featured Course Override';
$string['featured_course_1desc'] = 'Manually specify one course (by ID, shortname, or fullname) to feature. Leave empty to use starred courses.';
// Overview Section
$string['featured_overview_heading'] = 'Overview Section';
$string['featured_overview_headingdesc'] = 'Settings for the overview section above featured programs';
$string['featured_overview_enabled'] = 'Enable overview section';
$string['featured_overview_enableddesc'] = 'Show the overview section above featured programs';
$string['featured_overview_title'] = 'Overview title';
$string['featured_overview_titledesc'] = 'Title for the overview section';
$string['featured_overview_desc'] = 'Overview description';
$string['featured_overview_descdesc'] = 'Description text for the overview section';
$string['featured_overview_image'] = 'Overview image';
$string['featured_overview_imagedesc'] = 'Background image for overview section';

// Overview Stats
$string['featured_overview_stat1_num'] = 'Stat 1 number';
$string['featured_overview_stat1_numdesc'] = 'First statistic number (e.g., 2,500+)';
$string['featured_overview_stat2_num'] = 'Stat 2 number';
$string['featured_overview_stat2_numdesc'] = 'Second statistic number (e.g., 98%)';
$string['featured_overview_stat3_num'] = 'Stat 3 number';
$string['featured_overview_stat3_numdesc'] = 'Third statistic number (e.g., 50+)';
$string['featured_overview_stat1_label'] = 'Active Students';
$string['featured_overview_stat2_label'] = 'Graduate Rate';
$string['featured_overview_stat3_label'] = 'Programs Offered';

// Default values
$string['featured_default_overview_title'] = 'Transform Your Future with Our Programs';
$string['featured_default_overview_desc'] = 'Join thousands of students who have transformed their careers through our comprehensive learning programs. Start your journey today.';
$string['featured_default_course_desc'] = 'Explore this course to learn new skills and advance your career.';
$string['defaultcategory'] = 'General';
// Featured Programs Section end

// Hero Section
$string['hero_heading'] = 'Hero Section Settings';
$string['hero_headingdesc'] = 'Configure the hero section displayed on the frontpage';
$string['hero_enabled'] = 'Enable Hero Section';
$string['hero_enableddesc'] = 'Show the hero section on the frontpage';
$string['hero_background'] = 'Hero Background Image';
$string['hero_backgrounddesc'] = 'Background image for the hero section';
$string['hero_title'] = 'Hero Title';
$string['hero_titledesc'] = 'Main title for the hero section';
$string['hero_description'] = 'Hero Description';
$string['hero_descriptiondesc'] = 'Description text for the hero section';

// CTA Buttons
$string['hero_apply_text'] = 'Apply Button Text';
$string['hero_apply_textdesc'] = 'Text for the apply button';
$string['hero_apply_link'] = 'Apply Button Link';
$string['hero_apply_linkdesc'] = 'URL for the apply button';

$string['hero_tour_text'] = 'Tour Button Text';
$string['hero_tour_textdesc'] = 'Text for the campus tour button';
$string['hero_tour_link'] = 'Tour Button Link';
$string['hero_tour_linkdesc'] = 'URL for the campus tour button';

$string['hero_tour_text1'] = 'Tour Button Text';
$string['hero_tour_textdesc1'] = 'Text for the campus tour button';
$string['hero_tour_link1'] = 'Tour Button Link';
$string['hero_tour_linkdesc1'] = 'URL for the campus tour button';

// Announcement
$string['hero_announcement_enabled'] = 'Enable Announcement';
$string['hero_announcement_enableddesc'] = 'Show the announcement badge and text';
$string['hero_announcement_badge'] = 'Announcement Badge Text';
$string['hero_announcement_badgedesc'] = 'Text for the announcement badge (e.g., "New", "Alert")';
$string['hero_announcement_text'] = 'Announcement Text';
$string['hero_announcement_textdesc'] = 'Text for the announcement';

// Highlights
$string['hero_highlights_enabled'] = 'Enable Highlights';
$string['hero_highlights_enableddesc'] = 'Show the highlights section below hero';
$string['hero_highlight1_title'] = 'Highlight 1 Title';
$string['hero_highlight1_titledesc'] = 'Title for first highlight item';
$string['hero_highlight1_desc'] = 'Highlight 1 Description';
$string['hero_highlight1_descdesc'] = 'Description for first highlight item';
$string['hero_highlight2_title'] = 'Highlight 2 Title';
$string['hero_highlight2_titledesc'] = 'Title for second highlight item';
$string['hero_highlight2_desc'] = 'Highlight 2 Description';
$string['hero_highlight2_descdesc'] = 'Description for second highlight item';
$string['hero_highlight3_title'] = 'Highlight 3 Title';
$string['hero_highlight3_titledesc'] = 'Title for third highlight item';
$string['hero_highlight3_desc'] = 'Highlight 3 Description';
$string['hero_highlight3_descdesc'] = 'Description for third highlight item';

// Event Banner
$string['hero_event_enabled'] = 'Enable Event Banner';
$string['hero_event_enableddesc'] = 'Show the event banner section';
$string['hero_event_month'] = 'Event Month';
$string['hero_event_monthdesc'] = 'Month abbreviation for event date';
$string['hero_event_day'] = 'Event Day';
$string['hero_event_daydesc'] = 'Day number for event date';
$string['hero_event_title'] = 'Event Title';
$string['hero_event_titledesc'] = 'Title for the event';
$string['hero_event_description'] = 'Event Description';
$string['hero_event_descriptiondesc'] = 'Description for the event';
$string['hero_event_button'] = 'Event Button Text';
$string['hero_event_buttondesc'] = 'Text for the event register button';
$string['hero_event_link'] = 'Event Button Link';
$string['hero_event_linkdesc'] = 'URL for the event register button';

// Default Values
$string['hero_default_title'] = 'Shaping Minds for Tomorrow\'s World';
$string['hero_default_description'] = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin quis magna vel dolor mattis hendrerit. Vestibulum sodales dignissim ipsum id commodo.';
$string['hero_default_apply_text'] = 'Apply Now';
$string['hero_default_tour_text'] = 'Campus Tour';
$string['hero_default_announcement_badge'] = 'New';
$string['hero_default_announcement_text'] = 'Fall 2025 Applications Open - Early Decision Deadline December 15';
$string['hero_default_event_month'] = 'OCT';
$string['hero_default_event_day'] = '28';
$string['hero_default_event_title'] = 'Open Campus Day';
$string['hero_default_event_description'] = 'Experience our vibrant campus life, meet faculty members, and learn about our academic programs.';
$string['hero_default_event_button'] = 'Register';

// Default Highlight Texts
$string['hero_highlight1_title'] = '98% Graduate Success';
$string['hero_highlight1_desc'] = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.';
$string['hero_highlight2_title'] = '16:1 Student-Faculty Ratio';
$string['hero_highlight2_desc'] = 'Proin quis magna vel dolor mattis hendrerit.';
$string['hero_highlight3_title'] = 'Global Community';
$string['hero_highlight3_desc'] = 'Vestibulum sodales dignissim ipsum id commodo.';
// Hero Highlight Icons
$string['hero_highlight1_icon'] = 'Highlight 1 Icon';
$string['hero_highlight1_icondesc'] = 'Font Awesome icon classes for first highlight (e.g., fas fa-graduation-cap)';
$string['hero_highlight2_icon'] = 'Highlight 2 Icon';
$string['hero_highlight2_icondesc'] = 'Font Awesome icon classes for second highlight (e.g., fas fa-users)';
$string['hero_highlight3_icon'] = 'Highlight 3 Icon';
$string['hero_highlight3_icondesc'] = 'Font Awesome icon classes for third highlight (e.g., fas fa-globe-americas)';

// Default Icon Values - Change to Font Awesome
$string['hero_default_highlight1_icon'] = 'fas fa-graduation-cap';
$string['hero_default_highlight2_icon'] = 'fas fa-users';
$string['hero_default_highlight3_icon'] = 'fas fa-globe-americas';
// Hero Section end

// About Section
$string['about_heading'] = 'About Section Settings';
$string['about_headingdesc'] = 'Configure the about section displayed on the frontpage';
$string['about_enabled'] = 'Enable About Section';
$string['about_enableddesc'] = 'Show the about section on the frontpage';
$string['about_image'] = 'About Section Image';
$string['about_imagedesc'] = 'Main image for the about section';
$string['about_title'] = 'About Title';
$string['about_titledesc'] = 'Main title for the about section';
$string['about_description'] = 'About Description';
$string['about_descriptiondesc'] = 'Description text for the about section';

// Statistics
$string['about_stats_enabled'] = 'Enable Statistics';
$string['about_stats_enableddesc'] = 'Show statistics in the about section';
$string['about_stat1_number'] = 'Statistic 1 Number';
$string['about_stat1_numberdesc'] = 'Number for first statistic';
$string['about_stat1_label'] = 'Statistic 1 Label';
$string['about_stat1_labeldesc'] = 'Label for first statistic';
$string['about_stat2_number'] = 'Statistic 2 Number';
$string['about_stat2_numberdesc'] = 'Number for second statistic';
$string['about_stat2_label'] = 'Statistic 2 Label';
$string['about_stat2_labeldesc'] = 'Label for second statistic';
$string['about_stat3_number'] = 'Statistic 3 Number';
$string['about_stat3_numberdesc'] = 'Number for third statistic';
$string['about_stat3_label'] = 'Statistic 3 Label';
$string['about_stat3_labeldesc'] = 'Label for third statistic';

// Mission Statement
$string['about_mission_enabled'] = 'Enable Mission Statement';
$string['about_mission_enableddesc'] = 'Show mission statement in about section';
$string['about_mission_text'] = 'Mission Statement Text';
$string['about_mission_textdesc'] = 'Text for the mission statement';

// Call to Action
$string['about_cta_enabled'] = 'Enable Call to Action';
$string['about_cta_enableddesc'] = 'Show call to action button';
$string['about_cta_text'] = 'CTA Button Text';
$string['about_cta_textdesc'] = 'Text for the call to action button';
$string['about_cta_link'] = 'CTA Button Link';
$string['about_cta_linkdesc'] = 'URL for the call to action button';

// Experience Badge
$string['about_badge_enabled'] = 'Enable Experience Badge';
$string['about_badge_enableddesc'] = 'Show experience badge on image';
$string['about_badge_years'] = 'Badge Years';
$string['about_badge_yearsdesc'] = 'Number of years for experience badge';
$string['about_badge_text'] = 'Badge Text';
$string['about_badge_textdesc'] = 'Text for experience badge';

// Default Values
$string['about_default_title'] = 'Empowering Minds, Shaping Futures';
$string['about_default_description'] = 'For over three decades, we have been committed to providing exceptional education that prepares students for success in an ever-changing world. Our innovative approach combines traditional academic excellence with cutting-edge technology and personalized learning experiences.';
$string['about_default_mission_text'] = 'Our mission is to foster intellectual curiosity, critical thinking, and lifelong learning while nurturing compassionate leaders who will positively impact their communities and the world.';
$string['about_default_cta_text'] = 'Learn More About Us';
$string['about_default_badge_years'] = '32+';
$string['about_default_badge_text'] = 'Years of Excellence';
$string['about_default_image_alt'] = 'Campus Overview';

// Default Stat Values
$string['about_stat1_number'] = '15,000+';
$string['about_stat1_label'] = 'Students Enrolled';
$string['about_stat2_number'] = '98%';
$string['about_stat2_label'] = 'Graduation Rate';
$string['about_stat3_number'] = '250+';
$string['about_stat3_label'] = 'Expert Faculty';

// About Section end