<?php use_helper('I18N', 'Date') ?>
<?php include_partial('link/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('New Link', array(), 'messages') ?></h1>

  <?php include_partial('link/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('link/form_header', array('link' => $link, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('link/form', array('link' => $link, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('link/form_footer', array('link' => $link, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>
</div>
