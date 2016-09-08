<div class="wrapper">
  <span class="field">
    <input type="hidden" class="hiddenRecaptcha required" name="hiddenRecaptcha" id="hiddenRecaptcha">
    <div class="g-recaptcha" data-sitekey="6Lf4qCkTAAAAAKgwtKGhPLfLjjpa0UU4IIxOxhr4"></div>
  </span>
</div>

<?= new fieldCaptcha('recaptcha', array(
  'key' => '6Lf4qCkTAAAAAKgwtKGhPLfLjjpa0UU4IIxOxhr4',
  'id' => 'input-recaptcha',
  )) ?>
