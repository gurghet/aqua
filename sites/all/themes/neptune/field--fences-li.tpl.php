<?php
/**
 * @file field--fences-li.tpl.php
 * Wrap each field value in the <li> element.
 *
 *
 */
?>

<?php foreach ($items as $delta => $item): ?>
  <li class="<?php print $classes; ?>"<?php print $attributes; ?>>
    <?php if ($element['#label_display'] == 'inline'): ?>
      <span class="field-label"<?php print $title_attributes; ?>>
        <?php print $label; ?>:
      </span>
    <?php elseif ($element['#label_display'] == 'above'): ?>
      <span class="field-label"<?php print $title_attributes; ?>>
        <?php print $label; ?>
      </span><br/>
<?php endif; ?>
    <?php print render($item); ?>
  </li>
<?php endforeach; ?>
