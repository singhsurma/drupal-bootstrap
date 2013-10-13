<?php

function bootstrap_menu_local_tasks(&$vars) {
  $output = '';

  if ( !empty($vars['primary']) ) {
    $vars['primary']['#prefix'] = '<ul class="nav nav-pills">';
    $vars['primary']['#suffix'] = '</ul>';
    $output .= drupal_render($vars['primary']);
  }

  return $output;
}

function bootstrap_preprocess_node(&$variables) {
  if(!empty($variables['view_mode'])) {
    array_unshift($variables['theme_hook_suggestions'], 'node__' . $variables['type'] . '__' . $variables['view_mode']);
    array_unshift($variables['theme_hook_suggestions'], 'node__' . $variables['view_mode']);
  }

  $variables['node_wrapper'] = get_node_wrapper($variables['node']);
}

function bootstrap_preprocess_entity(&$variables) {
  if($variables['entity_type'] == 'bean') {
    $variables['bean_wrapper'] = get_bean_wrapper($variables['bean']);
  }
}

function bootstrap_breadcrumb($variables) {
  global $base_url;

  $crumbs = '<ul class="breadcrumbs">';
  $crumbs .= '<li><a href="'.$base_url.'">'.t('Home').'</a></li>';

  if (count($variables['breadcrumb']) > 0) {
    foreach($variables['breadcrumb'] as $value) {
      $crumbs .= '<li>'.$value.'</li>';
    }
  }

  $crumbs .= '<li class="breadcrumb-last">'.drupal_get_title().'</li>';
  $crumbs .= '</ul>';
  return $crumbs;
}

/*** UTILITIES ***/

function get_node_wrapper($node) {
  global $language_content;
  $node_wrapper = entity_metadata_wrapper('node', $node);

  return $node_wrapper->language($language_content->language);
}

function get_bean_wrapper($bean) {
  global $language_content;
  $bean_wrapper = entity_metadata_wrapper('bean', $bean);

  return $bean_wrapper->language($language_content->language);
}