<?php $bodies = $bean_wrapper->field_bodies->value() ?>
<?php $row_width = 12 / count($bodies) ?>

<div class="row">
  <?php foreach($bodies as $body): ?>
    <div class="span<?php echo $row_width ?>">
      <?php echo $body["value"] ?>
    </div>
  <?php endforeach ?>
</div>