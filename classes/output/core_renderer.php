<?php

namespace theme_liteap\output;

defined('MOODLE_INTERNAL') || die();

use theme_config;

class core_renderer extends \theme_boost\output\core_renderer {
       /**
     * Returns HTML attributes to use within the body tag. This includes an ID and classes.
     *
     * @param string|array $additionalclasses Any additional classes to give the body tag,
     *
     * @return string
     *
     * @throws \coding_exception
     *
     * @since Moodle 2.5.1 2.6
     */
    public function body_attributes($additionalclasses = []) {
        $hasaccessibilitybar = get_user_preferences('themesettings_enableaccessibilitytoolbar', '');
        if ($hasaccessibilitybar) {
            $additionalclasses[] = 'hasaccessibilitybar';

            $currentfontsizeclass = get_user_preferences('accessibilitystyles_fontsizeclass', '');
            if ($currentfontsizeclass) {
                $additionalclasses[] = $currentfontsizeclass;
            }

            $currentsitecolorclass = get_user_preferences('accessibilitystyles_sitecolorclass', '');
            if ($currentsitecolorclass) {
                $additionalclasses[] = $currentsitecolorclass;
            }
        }

        $fonttype = get_user_preferences('themesettings_fonttype', '');
        if ($fonttype) {
            $additionalclasses[] = $fonttype;
        }

        if (!is_array($additionalclasses)) {
            $additionalclasses = explode(' ', $additionalclasses);
        }

        return ' id="'. $this->body_id().'" class="'.$this->body_css_classes($additionalclasses).'"';
    }
     /**
     * Override the login renderer to inject logo + sitename.
     *
     * @param \core_auth\output\login $form The renderable.
     * @return string
     */
    public function render_login(\core_auth\output\login $form) {
        global $SITE, $CFG;

        // Get the standard context for the login form.
        $context = $form->export_for_template($this);

        // Add our logo URL and site name.
        $context->logourl = $this->get_custom_logo_url();
        $context->sitename = format_string(
            $SITE->fullname,
            true,
            ['context' => \context_course::instance(SITEID), 'escape' => false]
        );

        // Preserve instructions handling.
        if (empty($CFG->auth_instructions)) {
            $context->instructions = null;
            $context->hasinstructions = false;
        } else {
            $context->hastwocolumns = true;
        }

        // Finally, render using the same loginform template.
        return $this->render_from_template('theme_liteap/core/loginform', $context);
    }
    /**
     * Return the favicon URL.
     *
     * @return \moodle_url
     */
    public function favicon() {
        $theme = theme_config::load('liteap');
        $favicon = $theme->setting_file_url('favicon', 'favicon');
          if (empty($favicon)) {
            return $this->page->theme->image_url('favicon', 'theme');
        } else {
            return $favicon;
        };
    }

    /**
     * Fetch the logo URL for the theme.
     * This function can now be called through $OUTPUT->get_custom_logo_url()
     *
     * @return string|bool
     */
    public function get_custom_logo_url() {
        // Try to get the logo from the theme configuration
        $themeLogo = theme_config::load('liteap')->setting_file_url('logo', 'logo');
        
        // If the theme logo is not set, return the default logo
        if (empty($themeLogo)) {
            return $this->page->theme->image_url('default_logo', 'theme');
        }

        // If the theme logo is available, return it
        return $themeLogo ? $themeLogo : (parent::get_logo_url() ? parent::get_logo_url()->out(false) : false);
    }
}