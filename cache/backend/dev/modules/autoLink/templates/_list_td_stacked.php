<td colspan="3">
  <?php echo __('%%id%% - %%url%% - %%episode%%', array('%%id%%' => link_to($link->getId(), 'link_edit', $link), '%%url%%' => $link->getUrl(), '%%episode%%' => $link->getEpisode()), 'messages') ?>
</td>
