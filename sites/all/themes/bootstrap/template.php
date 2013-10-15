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

   if (arg(0) == 'node' && is_numeric(arg(1))) {
     $node_wrapper = get_node_wrapper(arg(1));;
   }
   else {
     return "";
   }

   $title = drupal_get_title();

   $breadcrumbs = array();
   switch($node_wrapper->type->value()) {
       /**  Example **/
//     case "news":
//       $breadcrumbs[url('node/39')] = "News";
//       break;
   }

   $crumbs = '<div class="container"><ul class="breadcrumbs">';
   $crumbs .= '<li><a href="'.$base_url.'">'.t('Home').'</a> > </li>';

   foreach($breadcrumbs as $url => $value) {
     $crumbs .= '<li><a href="'.$url.'">'.$value.'</a> > </li>';
   }

   $crumbs .= '<li class="breadcrumb-last">'.$title.'</li>';

   $crumbs .= '</ul></div>';
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