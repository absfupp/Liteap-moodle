[![Version](https://img.shields.io/badge/version-0.0.23-green.svg)]()
[![GitHub issues](https://img.shields.io/bitbucket/issues/absfupp/Liteap-moodle)](https://github.com/absfupp/Liteap-moodle/issues)
[![GitHub stars](https://img.shields.io/github/stars/absfupp/Liteap-moodle.svg?style=social&label=Star&maxAge=2592000)](https://github.com/absfupp/Liteap-moodle/stargazers/)

# LiteAp Moodle Theme

LiteAp is a design-centric, customizable Moodle theme for educational institutions, based on the MySchool Bootstrap design. It offers a responsive layout, user-friendly navigation, and flexible settings for easy customization. Perfect for schools, colleges, and universities looking to enhance their Moodle platform.

## State

| Option                      | Value             | Description                                |
|-----------------------------|-------------------|--------------------------------------------|
| `maturity`                  | `MATURITY_RC`     | Indicates that the theme is in release candidate stage |

## Requirements

- **Moodle >= 5.0** (**Preferred**)
- **Note:** Works with Moodle 4.5.7 or lower (may cause CSS styling issues)
- Modern browser with **ES6+** support
  
## Theme Directory Structure

The LiteAp theme directory structure is organized for easy customization and extension:
| Directory/File                        | Type     | Description                                     |
|---------------------------------------|----------|-------------------------------------------------|
| `config.php`                          | File     | Configuration file for the theme                |
| `lib.php`                             | File     | Library file containing helper functions        |
| `settings.php`                        | File     | Theme settings file                             |
| `version.php`                         | File     | Version information of the theme                |
| `classes/output/core_renderer.php`    | File     | Custom renderer for the theme's core output     |
| `classes/util/settings.php`           | File     | Utility functions for settings handling         |
| `classes/privacy/provider.php`        | File     | Privacy provider for handling data privacy      |
| `lang/en/theme_nren.php`              | File     | Language file for theme text and strings        |
| `layout/frontpage.php`                | File     | Layout template for the front page              |
| `layout/drawers.php`                  | File     | Layout template for side drawers                |
| `layout/dashboard.php`                | File     | Layout template for the dashboard               |
| `templates/frontpage.mustache`        | File     | Mustache template for the front page            |
| `templates/drawers.mustache`          | File     | Mustache template for the side drawers          |
| `templates/navbar.mustache`           | File     | Mustache template for the navbar                |
| `templates/footer.mustache`           | File     | Mustache template for the footer                |
| `templates/core/loginform.mustache`   | File     | Mustache template for the login form            |
| `scss/main.scss`                      | File     | Main SCSS file for theme styling                |
| `scss/default/default.scss`           | File     | Default SCSS file for theme styling             |
| `scss/default/plain.scss`             | File     | Plain SCSS file for minimal styling             |
| `amd/build/`                          | Folder   | Contains the built JavaScript files             |

## Front Page Sections

### 1. Hero Section
- **Configurable Features:**
  - Background image
  - Title and Description
  - Primary & Secondary CTA buttons, plus additional
  - Announcement badge

### 2. About Section
- **Configurable Features:**
  - Image
  - Title and Description text
  - Statistics (students, staff, courses, achievements)
  - Experience/mission badges

### 3. Featured Programs Section
- **Configurable Options:**
  - **Mode:** 
    - Starred courses only
    - Category-based courses
    - Manually selected list
  - **Display Styles:**
    - Overview
    - Grid
    - Card layout

### 4. FAQ Section
- Uses Bootstrap’s accordion UI
- **Features:**
  - Editable content (but not layout)
  - Optional section
    
### 5. Events Section
- **Data Source:**
  - Moodle calendar events (site, course, category types)
- **Extracted Information:**
  - Event title
  - Date
  - Description
  - Category/course

### Upcoming (v1.0)
- 🔄 Performance improvements
- 🔄 New features
- 🔄 Bug fixes

## Installation

1. Download the theme files.
2. Upload the `liteap` theme folder to your Moodle site's `theme/` directory.
3. Navigate to `Site administration > Appearance > Themes > Manage themes` and select LiteAp as your theme.
4. Configure settings through the admin interface.

## Credits

- **Bootstrap** - For the responsive grid system and UI components.
- **Moodle** - For the foundation of the theme.

## License

This theme is licensed under the [GPL v3](https://www.gnu.org/licenses/gpl-3.0.html).

---

Feel free to contribute or open an issue if you encounter any bugs or have suggestions for improvement!

**Made with ❤️ by [Absfupp](https://github.com/absfupp)**




