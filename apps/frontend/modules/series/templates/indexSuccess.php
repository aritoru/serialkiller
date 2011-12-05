<ul>
<?php 
 foreach ($series as $serie) {
?>
  <img src="images/series/<?php echo $serie->id; ?>.jpg"/>
  <li><?php echo $serie->name;?></li>
  <ul>
      
<?php /*print_r($serie);*/ ?>
      <?php foreach ($serie->Episode as $episode) { ?>
      <li><?php echo $episode->name; ?> | <?php echo $episode->date; ?> | <?php echo $episode->season; ?> | <?php echo $episode->episode; ?></li>
      <?php } ?>

    </ul>
 <?php } ?>
</ul>