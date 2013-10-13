<?php
  $form = null;
  if($bean_wrapper->field_form->value() != "") {
    $form_name = $bean_wrapper->field_form->value();
    $form = function_exists($form_name) ? drupal_get_form($form_name) : "false";
  }
  elseif(!is_null($bean_wrapper->field_webform->value())) {
    $nid = $bean_wrapper->field_webform->vid->value();
    $form = drupal_get_form("webform_client_form_$nid", node_load($nid), array(), true, false);
  }
?>

<div id="<?php echo $bean_wrapper->field_unique_slug->value() ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="<?php echo $bean_wrapper->title->value() ?>" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3><?php echo $bean_wrapper->title->value() ?></h3>
  </div>

  <div class="modal-body <?php echo $form ? "with-form" : "" ?>">
    <?php $body = $bean_wrapper->field_body->value() ?>
    <p><?php echo $body['value'] ?></p>

    <?php if($form): ?>
      <?php echo drupal_render($form) ?>
    <?php endif ?>
  </div>

  <?php $footer = $bean_wrapper->field_footer->value() ?>
  <?php if($footer != ""): ?>
    <div class="modal-footer">
      <p><?php echo $footer['value'] ?></p>
    </div>
  <?php endif ?>
</div>