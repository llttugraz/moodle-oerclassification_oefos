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
 * Graz University of Technology specific subplugin for Open Educational Resources Plugin.
 *
 * @package    oerclassification_oefos
 * @author     Christian Ortner <christian.ortner@tugraz.at>
 * @copyright  2021-2023 Educational Technologies, Graz, University of Technology
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$plugin->version      = 2023062700;
$plugin->requires     = 2021051700; // Moodle 3.11.0.
$plugin->component    = 'oerclassification_oefos';
$plugin->release      = 'v1.1.0-RC1';
$plugin->dependencies = [
        'local_oer'                    => 2022012100,
];
