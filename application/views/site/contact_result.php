<div class="container">
  <div class="row">
    <?= heading( $title); ?>
  </div>
  <div class="row alert <?=$result_class; ?>" role="alert">
    <?=$result_message; ?>
  </div>
  <div class="row text-center">
    <?= anchor("index", "Fermer", ['class' => "btn btn-primary"]); ?>
  </div>
</div>
