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
  // On ajoute 2 view modes en début de tableau
  if(!empty($variables['view_mode'])) {
    array_unshift($variables['theme_hook_suggestions'], 'node__' . $variables['type'] . '__' . $variables['view_mode']);
    array_unshift($variables['theme_hook_suggestions'], 'node__' . $variables['view_mode']);
  }

  // On créé le no_wrapper i18nisé et on le passe au template
  global $language_content;
  $node_wrapper = entity_metadata_wrapper('node', $variables['node']);
  $variables['node_wrapper'] = $node_wrapper->language($language_content->language);
}

function bootstrap_preprocess_entity(&$variables) {
  if($variables['entity_type'] == 'bean') {
    // On créé le no_wrapper i18nisé et on le passe au template
    global $language_content;
    $bean_wrapper = entity_metadata_wrapper('bean', $variables['bean']);
    $variables['bean_wrapper'] = $bean_wrapper->language($language_content->language);
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