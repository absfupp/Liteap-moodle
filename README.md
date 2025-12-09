# LiteAp Moodle Theme

LiteAp is a design-centric, customizable Moodle theme for educational institutions, based on the MySchool Bootstrap design. It offers a responsive layout, user-friendly navigation, and flexible settings for easy customization. Perfect for schools, colleges, and universities looking to enhance their Moodle platform.

## Theme Directory Structure

The LiteAp theme directory structure is organized for easy customization and extension:
theme/liteap/
├── config.php
├── lib.php
├── settings.php
├── version.php
│
├── classes/
│ ├── output/core_renderer.php
│ └── util/settings.php
│ └── privacy/provider.php
├── lang/en/theme_nren.php
│
├── layout/
│ ├── frontpage.php
│ ├── drawers.php
│ └── dashboard.php
│
├── templates/
│ ├── frontpage.mustache
│ ├── drawers.mustache
│ ├── navbar.mustache
│ ├── footer.mustache
│ └── core/loginform.mustache
│
├── scss/
│ ├── main.scss
│ └── default/
│ ├── default.scss
│ ├── plain.scss
│ ├── _variables.scss
│ ├── _frontpage.scss
│ ├── _footer.scss
│ ├── _navbar.scss
│ └── _login.scss
│
├── assets/
│ ├── bootstrap.bundle.min.js
│ ├── bootstrap.min.css
│ └── fonts/
│
└── amd/
├── src/Myschool.js
└── build/

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




