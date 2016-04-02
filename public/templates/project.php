<div class="project card" id="proj-<?php echo $project->id ?>">
  <header>
    <h3><?php echo $project->title ?></h3>
  </header>
  <p><?php echo $project->description ?></p>
  <?php if (count($project->images) > 0) : ?>
      <?php include "templates/slider.php" ?>
  <?php endif ?>
</div>