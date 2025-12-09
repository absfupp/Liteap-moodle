# LiteAp Moodle Theme

LiteAp is a design-centric, customizable Moodle theme for educational institutions, based on the MySchool Bootstrap design. It offers a responsive layout, user-friendly navigation, and flexible settings for easy customization. Perfect for schools, colleges, and universities looking to enhance their Moodle platform.

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
| `scss/default/_variables.scss`        | File     | SCSS variables for theming                      |
| `scss/default/_frontpage.scss`        | File     | SCSS for frontpage-specific styles              |
| `scss/default/_footer.scss`           | File     | SCSS for footer-specific styles                 |
| `scss/default/_navbar.scss`           | File     | SCSS for navbar-specific styles                 |
| `scss/default/_login.scss`            | File     | SCSS for login page-specific styles             |
| `assets/bootstrap.bundle.min.js`      | File     | Minified Bootstrap JS bundle                    |
| `assets/bootstrap.min.css`            | File     | Minified Bootstrap CSS file                     |
| `assets/fonts/`                       | Folder   | Contains font files used in the theme           |
| `amd/src/Myschool.js`                 | File     | JavaScript source for theme functionality       |
| `amd/build/`                          | Folder   | Contains the built JavaScript files             |

## Front Page Sections

### 1. Hero Section
- **Configurable Features:**
  - Background image
  - Title and Description
  - Primary & Secondary CTA buttons, plus additional
  - Announcement badge
- **Use Cases:**
  - Showcase admissions
  - Promote events
  - Display exam updates

### 2. About Section
- **Configurable Features:**
  - Image
  - Title and Description text
  - Statistics (students, staff, courses, achievements)
  - Experience/mission badges
- **Use Cases:**
  - Institutional marketing
  - Accreditation highlights
  - Organizational values

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
- **Use Cases:**
  - Highlight diploma programs
  - Promote short-term courses
  - Seasonal/semester course marketing

### 4. FAQ Section
- Uses Bootstrap’s accordion UI
- **Features:**
  - Editable content (but not layout)
  - Optional section
- **Use Cases:**
  - Answer common questions related to the institution, courses, etc.

### 5. Events Section
- **Data Source:**
  - Moodle calendar events (site, course, category types)
- **Extracted Information:**
  - Event title
  - Date
  - Description
  - Category/course
- **Use Cases:**
  - Academic events
  - Workshops
  - Webinars
  - Examinations

## Dashboard Customization

### Admin Dashboard
- Admins can view the Kopere Dashboard if the module is enabled.
- Allows for easier monitoring and management of Moodle site activity and user engagement.

## Installation

1. Download the theme files.
2. Upload the `liteap` theme folder to your Moodle site's `theme/` directory.
3. Navigate to `Site administration > Appearance > Themes > Manage themes` and select LiteAp as your theme.
4. Configure settings through the admin interface.

## Customization

- **SCSS Variables**: Adjust the color scheme, typography, and layout styles in `scss/_variables.scss`.
- **Layout Customization**: Modify the layout files located in the `layout/` folder to change the structure of the front page, dashboard, and other pages.
- **Language Files**: Customize the text strings by modifying `lang/en/theme_nren.php`.

## Credits

- **Bootstrap** - For the responsive grid system and UI components.
- **Moodle** - For the foundation of the theme.

## License

This theme is licensed under the [GPL v3](https://www.gnu.org/licenses/gpl-3.0.html).

---

Feel free to contribute or open an issue if you encounter any bugs or have suggestions for improvement!




