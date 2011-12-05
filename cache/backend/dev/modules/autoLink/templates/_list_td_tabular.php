<td class="sf_admin_text sf_admin_list_td_id">
  <?php echo link_to($link->getId(), 'link_edit', $link) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_url">
  <?php echo $link->getUrl() ?>
</td>
<td class="sf_admin_foreignkey sf_admin_list_td_episode">
  <?php echo $link->getEpisode() ?>
</td>
