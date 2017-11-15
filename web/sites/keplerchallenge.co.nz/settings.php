<?php

/**
 * @file
 * Drupal site-specific configuration file.
 *
 * IMPORTANT NOTE:
 *
 * @see example.sites.php
 * for documentation
 *
 */

/**
 * Salt for one-time login links, cancel links, form tokens, etc.
 */
$settings['hash_salt'] = 'WinA79zeuvHCI6Zeu9GZJlqswy9ihPZumbGwb7B-xL-wYYVqn5h2yTU13vuoG6VJL1HxqHO8Rg';


/**
 * Access control for update.php script.
 */
$settings['update_free_access'] = FALSE;

/**
 * Default mode for for directories and files written by Drupal.
 *
 * Value should be in PHP Octal Notation, with leading zero.
 */
# $settings['file_chmod_directory'] = 0775;
# $settings['file_chmod_file'] = 0664;

/**
 * Public file path:
 */
$settings['file_public_path'] = 'sites/keplerchallenge.co.nz/files';

/**
 * Private file path:
 */
$settings['file_private_path'] = '/var/www/vhosts/keplerchallenge.co.nz/private';

/**
 * Load services definition file.
 */
$settings['container_yamls'][] = __DIR__ . '/services.yml';

$settings['install_profile'] = 'standard';
$config_directories['sync'] = 'config/sync';

/**
 * Load local development override configuration, if available.
 *
 * Keep this code block at the end of this file to take full effect.
 */
 if (file_exists(__DIR__ . '/settings.local.php')) {
   include __DIR__ . '/settings.local.php';
 }
