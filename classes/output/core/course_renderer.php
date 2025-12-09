<?php

namespace theme_liteap\output\core;

use moodle_url;
use coursecat_helper;


class course_renderer extends \core_course_renderer {
    /**
     * Renders the list of courses
     *
     * This is internal function, please use core_course_renderer::courses_list or another public
     * method from outside of the class
     *
     * If list of courses is specified in $courses; the argument $chelper is only used
     * to retrieve display options and attributes, only methods get_show_courses(),
     * get_courses_display_option() and get_and_erase_attributes() are called.
     *
     * @param coursecat_helper $chelper various display options
     * @param array $courses the list of courses to display
     * @param int|null $totalcount total number of courses (affects display mode if it is AUTO or pagination if applicable),
     *     defaulted to count($courses)
     * @return string
     */
    
    protected function coursecat_courses(coursecat_helper $chelper, $courses, $totalcount = null) {
    global $CFG, $OUTPUT, $PAGE;

    // Only apply custom styling to frontpage course listings
    if ($PAGE->pagetype !== 'site-index') {
        // For other pages, use the parent's default rendering
        return parent::coursecat_courses($chelper, $courses, $totalcount);
    }
    if ($totalcount === null) {
        $totalcount = count($courses);
    }
    if (!$totalcount) {
        return '';
    }

    // Your existing custom Bootstrap code...
    $content = '';
    $content .= '<div id="courses" class="courses">';
    $content .= '<div class="row gy-5">';

    foreach ($courses as $course) {
        $courseurl = new moodle_url('/course/view.php', ['id' => $course->id]);

        // Use Moodle's built-in way to get the course image
        $imageurl = $OUTPUT->image_url('defaultcourseimage', 'theme');
        $image = \core_course\external\course_summary_exporter::get_course_image($course);
        if ($image) {
            $imageurl = $image;
        }

        // Shorten the course summary to make it more readable
        $summary = trim(strip_tags($course->summary));
        if (strlen($summary) > 120) {
            $summary = substr($summary, 0, 120) . '...';
        }

        // Get the course creator's full name (first and last name)
        $creator_name = ''; // Default is empty
        if (!empty($course->managers)) {
            // Assuming the first manager is the creator
            $manager = reset($course->managers); // Get the first manager from the array

            // Concatenate the first and last name to form the full name
            if ($manager) {
                $creator_name = htmlspecialchars($manager->firstname . ' ' . $manager->lastname);
            }
        }

        // Add course block content
        $content .= '
        <div class="col-xl-3 col-md-6" style="text-align: left;">
            <div class="course-box">
            <div class="course-img">
                <img src="' . $imageurl . '" class="img-fluid" alt="' . htmlspecialchars($course->fullname) . '">
            </div>
            <div class="meta">
                <span class="post-date">' . userdate($course->timemodified, '%b %e, %Y') . '</span>
                / <i class="fa fa-regular fa-user"></i> <span class="post-date">' . $creator_name . '</span>
            </div>
            <h3 class="course-title"><a href="' . $courseurl . '">' . $course->fullname . '</a></h3>
            <p>' . $summary . '</p>
            <a href="' . $courseurl . '" class="readmore stretched-link"><span>View Course</span><i class="bi bi-arrow-right"></i></a>
            </div>
        </div>';
    }

    $content .= '</div></div>'; // Close the row and container for the courses

    return $content;
    }
    /**
     * Renders the activity navigation.
     *
     * Defer to template.
     *
     * @param \core_course\output\activity_navigation $page
     * @return string html for the page
     */
    public function render_activity_navigation(\core_course\output\activity_navigation $page) {
        $data = $page->export_for_template($this->output);
        if (isset($data->prevlink)) {
            $data->prevlink->classes = 'btn btn-outline-primary';
            $prevoriginal = $data->prevlink->text;
            // Removes the hard coded icon.
            $prevoriginal = substr($prevoriginal, 9);
            // Replaces the activity name for the theme string.
            $prevlink = str_replace($prevoriginal, 'prevactivity', $prevoriginal);
            // Adds a new icon.
            $data->prevlink->text = '<i class="fa fa-arrow-circle-left" aria-hidden="true"></i> ' .$prevlink;
            // Tooltip data.
            $data->prevlink->attributes = [
                ['name' => 'data-toggle', 'value' => 'tooltip'],
                ['name' => 'title', 'value' => $prevoriginal],
            ];
        }

        if (isset($data->nextlink)) {
            $data->nextlink->classes = 'btn btn-outline-primary';
            $nextoriginal = $data->nextlink->text;
            // Removes the hard coded icon.
            $nextoriginal = substr($nextoriginal, 0, -9);
            // Replaces the activity name for the theme string.
            $nextlink = str_replace($nextoriginal, 'nextactivity', $nextoriginal);
            // Adds a new icon.
            $data->nextlink->text = '<i class="fa fa-arrow-circle-right" aria-hidden="true"></i> ' .$nextlink;
            // Tooltip data.
            $data->nextlink->attributes = [
                ['name' => 'data-toggle', 'value' => 'tooltip'],
                ['name' => 'title', 'value' => $nextoriginal],
            ];
        }
        return $this->output->render_from_template('core_course/activity_navigation', $data);
    }
}
