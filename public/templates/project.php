<div class="project card" id="proj-<?php echo $project->id ?>">
  <header>
    <h3 class="left"><?php echo $project->title ?></h3>
    <div class="clear"></div>
  </header>
  <p><?php echo $project->description ?></p>
  <?php if (count($project->images) > 0) : ?>
      <?php include "templates/slider.php" ?>
  <?php endif ?>
</div>
