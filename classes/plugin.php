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
 * @copyright  2022 Educational Technologies, Graz, University of Technology
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace oerclassification_oefos;

use local_oer\classification;

/**
 * Class plugin
 *
 * Implements classification interface from local_oer plugin.
 */
class plugin implements classification {
    /**
     * Prepares an array of the oefos dataset that can be used in a select field.
     *
     * @param bool $identifierinname If true the array value will consist of identifier + name
     * @return array
     */
    public static function get_select_data(bool $identifierinname = true): array {
        $data = oefos::load_oefos();

        $list = [];
        foreach ($data as $entry) {
            // Identifier => Identifier Name.
            if ($identifierinname) {
                $list[$entry[1]] = $entry[1] . ' ' . $entry[3];
            } else {
                $list[$entry[1]] = $entry[3];
            }
        }
        return $list;
    }

    /**
     * Provide a link to a description of the classification system.
     *
     * @return string|null
     */
    public static function url_to_external_resource(): ?string {
        return 'https://www.data.gv.at/katalog/dataset/stat_ofos-2012';
    }
}
