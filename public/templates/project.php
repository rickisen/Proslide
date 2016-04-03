<div class="project card" id="proj-<?php echo $project->id ?>">
  <header>
    <h3><?php echo $project->title ?></h3>
  </header>
  <p class="left"><?php echo $project->description ?></p>

  <ul class="right">
      <?php if ($project->date) : ?>
        <li> <?php echo date("Y-m-m", $project->date) ?> </li>
      <?php endif ?>

      <?php if ($project->github) : ?>
        <li><a href="<?php echo $project->github ?>">Github Project</a></li>
      <?php endif ?>

      <?php if ($project->link) : ?>
        <li><a href="<?php echo $project->link ?>">Visit</a></li>
      <?php endif ?>
  </ul>
  <div class="clear"></div>

  <?php if (count($project->images) > 0) : ?>
      <?php include "templates/slider.php" ?>
  <?php endif ?>
</div>
