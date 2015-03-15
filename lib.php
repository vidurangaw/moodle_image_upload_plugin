<?php

// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * This plugin is used to upload images
 *
 * @since Moodle 2.0
 * @package    repository
 * @subpackage image_upload
 * @copyright  2015 Vidruanga Wijesooriya
 * @author     Vidruanga Wijesooriya <vpowerrc@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once($CFG->dirroot . '/repository/lib.php');

class repository_image_upload extends repository {
    private $mimetypes = array();


    /**
     * Return names of the general options.
     * By default: no general option name.
     *
     * @return array
     */
    public static function get_type_option_names() {
        return array('image_width', 'image_height', 'image_quality', 'pluginname');
    }

    /**
     * What kind of files will be in this repository?
     *
     * @return array return '*' means this repository support any files, otherwise
     *               return mimetypes of files, it can be an array
     */
    public function supported_filetypes() {
        return array('web_image');
    }

    /**
     * supported return types
     * @return int
     */
    public function supported_returntypes() {
        return FILE_INTERNAL;
    }

    /**
     * Edit/Create Admin Settings Moodle form.
     *
     * @param moodleform $mform Moodle form (passed by reference).
     * @param string $classname repository class name.
     */
    public static function type_config_form($mform, $classname = 'repository') {

        parent::type_config_form($mform);

        $mform->addElement('static', null, '', get_string('plugin_desc', 'repository_image_upload'));

        $mform->addElement('text', 'image_width', get_string('image_width', 'repository_image_upload'));
        $mform->setType('image_width', PARAM_RAW_TRIMMED);
        $mform->setDefault('image_width', '');


        $mform->addElement('text', 'image_height', get_string('image_height', 'repository_image_upload'));
        $mform->setType('image_height', PARAM_RAW_TRIMMED);
        $mform->setDefault('image_height', '');

        $image_quality_options = array_combine(range(100, 10, 10),range(100, 10, 10));
        $mform->addElement('select', 'image_quality', get_string('image_quality', 'repository_image_upload'), $image_quality_options);
        $mform->setDefault('image_quality', 100);
        $mform->addRule('image_quality', get_string('required'), 'required', null, 'client');


    }
}
