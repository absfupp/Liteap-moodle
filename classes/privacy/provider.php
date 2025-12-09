<?php
/**
 * Liteap config - Privacy provider.
 *
 * @package   theme_liteap
 * @copyright 2025 liteap
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace theme_liteap\privacy;

use core_privacy\local\metadata\collection;
use core_privacy\local\metadata\provider as baseprovider;
use core_privacy\local\request\user_preference_provider;
use core_privacy\local\request\writer;

class provider implements
    // This plugin has data.
    baseprovider,
    // This plugin has some sitewide user preferences to export.
    user_preference_provider {

    /** The user preference for the font size. */
    const FONTSIZE = 'accessibilitystyles_fontsizeclass';
    /** The user preference for the site color. */
    const SITECOLOR = 'accessibilitystyles_sitecolorclass';
    /** The user preference for the font type. */
    const FONTTYPE = 'themesettings_fonttype';
    /** The user preference for the enable accessibility toolbar. */
    const TOOLBAR = 'themesettings_enableaccessibilitytoolbar';

    /**
     * Returns meta data about this system.
     *
     * @param  collection $items The initialised item collection to add items to.
     * @return collection A listing of user data stored through this system.
     */
    public static function get_metadata(collection $items): collection {
        $items->add_user_preference(self::FONTSIZE, 'privacy:metadata:preference:accessibilitystyles_fontsizeclass');
        $items->add_user_preference(self::SITECOLOR, 'privacy:metadata:preference:accessibilitystyles_sitecolorclass');
        $items->add_user_preference(self::FONTTYPE, 'privacy:metadata:preference:themesettings_fonttype');
        $items->add_user_preference(self::TOOLBAR, 'privacy:metadata:preference:themesettings_enableaccessibilitytoolbar');
        return $items;
    }

    /**
     * Store all user preferences for the plugin.
     *
     * @param int $userid The userid of the user whose data is to be exported.
     * @throws \coding_exception
     */
    public static function export_user_preferences(int $userid) {
        $toolbar = get_user_preferences(self::TOOLBAR, null, $userid);
        if (isset($toolbar)) {
            writer::export_user_preference(
                'theme_liteap',
                self::TOOLBAR,
                $toolbar,
                get_string('privacy:themesettings_enableaccessibilitytoolbar', 'theme_liteap', $toolbar)
            );

            $fontsize = get_user_preferences(self::FONTSIZE, null, $userid);
            if (isset($fontsize)) {
                writer::export_user_preference(
                    'theme_liteap',
                    self::FONTSIZE,
                    $fontsize,
                    get_string('privacy:accessibilitystyles_fontsizeclass', 'theme_liteap', $fontsize)
                );
            }

            $sitecolor = get_user_preferences(self::SITECOLOR, null, $userid);
            if (isset($sitecolor)) {
                writer::export_user_preference(
                    'theme_liteap',
                    self::SITECOLOR,
                    $sitecolor,
                    get_string('privacy:accessibilitystyles_sitecolorclass', 'theme_liteap', $sitecolor)
                );
            }
        }

        $fonttype = get_user_preferences(self::FONTTYPE, null, $userid);
        if (isset($fonttype)) {
            writer::export_user_preference(
                'theme_liteap',
                self::FONTTYPE,
                $fonttype,
                get_string('privacy:themesettings_fonttype', 'theme_liteap', $fonttype)
            );
        }
    }
}
