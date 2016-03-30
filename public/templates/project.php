<div class="project" id="proj-<?php echo $project->id ?>">
  <h3><?php echo $project->title ?></h3>
  <p><?php echo $project->description ?></p>
  <?php if (count($project->images) > 0) : ?>
      <?php include "templates/slider.php" ?>
  <?php endif ?>
</div>
