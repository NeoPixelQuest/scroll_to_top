<?php

/**
 * @file
 * Hooks for the scroll_to_top module.
 */

/**
 * @addtogroup hooks
 * @{
 */

/**
 * Alter scroll to top configs.
 *
 * @param array $configs
 *   An array of default configs.
 */
function hook_scroll_to_top_configs_alter(array &$configs) {
  if ('system.modules_list' == \Drupal::routeMatch()->getRouteName()) {
    $configs['scroll_to_top_enable_admin_theme'] = TRUE;
  }
}

/**
 * @} End of "addtogroup hooks".
 */
