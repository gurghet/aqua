<?php

function ds_aqua_ds() {
  return array(
    'label' => t('Aqua DS'),
    'regions' => array(
      // The key of this region name is also the variable used in
      // the template to print the content of that region.
      'aqua' => t('Aqua DS'),
    ),
    // Add this if there is a default css file.
    'css' => TRUE,
    // Add this if there is a default preview image
    'image' => TRUE,
  );
}