<?php

/**
 * Plugin Name: BACOL WP Manager.
 * Plugin URI: http://lsri.nottingham.ac.uk
 * Description: Utils for Building a City of Literature
 * Version: 0.0.1
 * Author: Tom Sweeney
 * Author URI: http://www.magneticmule.com
 * License: GPL2.
 */

    /*  2015  Tom Sweeney  (email : skywriter@gmail.com)

        This program is free software; you can redistribute it and/or modify
        it under the terms of the GNU General Public License, version 2, as
        published by the Free Software Foundation.

        This program is distributed in the hope that it will be useful,
        but WITHOUT ANY WARRANTY; without even the implied warranty of
        MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
        GNU General Public License for more details.

        You should have received a copy of the GNU General Public License
        along with this program; if not, write to the Free Software
        Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
    */

        // This file is part of a Wordpress plugin so don't call it directly
        defined('ABSPATH') or die('This plugin cannot be accessed directly you silly goose!');
        
        protected $template_dir = plugin_dir_path((__FILE__).'templates/');

        // imports
        require_once plugin_dir_path(__FILE__).'includes/bacol-custom-post-manager-loader.class.php';
        require_once plugin_dir_path(__FILE__).'includes/bacol-custom-post-manager.class.php';
        require_once plugin_dir_path(__FILE__).'includes/bacol-custom-roles.class.php';
        require_once plugin_dir_path(__FILE__).'includes/bacol-menu-customizer.class.php';

        function runbacolPost()
        {
            
            $bacolPostManager = new BacolPostManager();
            $bacolPostManager->registerPostManager();

            $bacolCustomPostManager = new BacolCustomPostManager();
            $bacolCustomPostManager->registerCustomPost();

            $bacolMenuCustomizer = new BacolMenuCustomizer();
            $bacolMenuCustomizer->modifyAdminMenu();

            $bacolRolesManager = new BacolRolesManager();
            $bacolRolesManager->registerRoles();
        }

        runbacolPost();

