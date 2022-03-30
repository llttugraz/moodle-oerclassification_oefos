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
 * Helper class to prepare select field data
 *
 * @package    oerclassification_oefos
 * @author     Christian Ortner <christian.ortner@tugraz.at>
 * @copyright  2017-2022 Educational Technologies, Graz, University of Technology
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace oerclassification_oefos;

/**
 * Class oefos
 */
class oefos {
    /**
     * Load oefos information from file
     *
     * @return array
     */
    public static function load_oefos() {
        global $CFG;
        $oefos       = [];
        $path        = '/local/oer/classification/oefos/data/';
        $filenameen = 'OEFOS2012_EN_CTI_20171007_030427_utf8.txt';
        $filenamede = 'OEFOS2012_DE_CTI_20171007_030438_utf8.txt';
        $filename    = current_language() == 'de' ? $filenamede : $filenameen;
        if (($file = fopen($CFG->dirroot . $path . $filename, 'r')) !== false) {
            while (($data = fgetcsv($file, 1000, ";")) !== false) {
                if ($data[0] == 'Ebene') {
                    continue;
                } //skip first line
                $oefos[] = $data;
            }
            fclose($file);
        }
        return $oefos;
    }
}
