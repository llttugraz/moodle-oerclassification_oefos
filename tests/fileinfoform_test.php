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
 * Open Educational Resources Plugin
 *
 * @package    oerclassification_oefos
 * @author     Christian Ortner <christian.ortner@tugraz.at>
 * @copyright  2022 Educational Technologies, Graz, University of Technology
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace oerclassification_oefos;

use local_oer\forms\fileinfo_form;
use local_oer\fromform;
use local_oer\testcourse;

defined('MOODLE_INTERNAL') || die();

require_once(__DIR__ . '/../../../tests/helper/testcourse.php');
require_once(__DIR__ . '/../../../tests/helper/fromform.php');

/**
 * Class fileinfoform_test
 */
class fileinfoform_test extends \advanced_testcase {
    /**
     * Extension for the update_metadata test of the base plugin.
     *
     * Test when the oefos plugin is enabled how the classification field is stored and modified.
     *
     * @return void
     */
    public function test_update_metadata() {
        $this->resetAfterTest();
        $this->setAdminUser();
        global $DB;
        set_config('enabledclassificationplugins', 'oefos', 'local_oer');
        \core_plugin_manager::reset_caches();
        $testcourse  = new testcourse();
        $course      = $testcourse->generate_testcourse($this->getDataGenerator());
        $contenthash = $testcourse->get_contenthash_of_first_found_file($course);
        $this->assertNotNull($contenthash);

        $record = $DB->get_record('local_oer_files', ['courseid' => $course->id, 'contenthash' => $contenthash]);
        $this->assertFalse($record, 'No files record exists yet.');

        $fromform = fromform::fileinfoform_submit($course->id, $contenthash, 'Unittest',
                                                  'Test update metadata', 1,
                                                  'cc', 'en', 1, [], 0, 0);
        // When no classification is selected. The moodle autocomplete formfield returns this string.
        // This string should not be stored in database. The value for this classification is then empty.
        // As for this test only one classification subplugin is enabled the result should be null.
        $fromform['oerclassification_oefos'] = "_qf__force_multiselect_submission";
        $form                                = new fileinfo_form(null, ['courseid' => $course->id, 'contenthash' => $contenthash]);
        $form->update_metadata($fromform);

        $record = $DB->get_record('local_oer_files', ['courseid' => $course->id, 'contenthash' => $contenthash]);
        $this->assertEquals(null, $record->classification);
    }
}
