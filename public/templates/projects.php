<p> 
  Here You will find some of the projects I've been involved with 
  creating or which I have created by my self so far in my studies att MI 
</p>

<div class="projects" id="groupProjects">
  <h2>Group Projects</h2>
  <p>Projects in which I've been a member of a group to create.</p>
  <?php foreach($data["projects"] as $project) : ?>
    <?php if ($project->type == "group") : ?>
      <div class="project" id="proj-<?php echo $project->id ?>">
        <h3><?php echo $project->title ?></h3>
        <p><?php echo $project->description ?></p>
        <?php if (count($project->images) > 0) : ?>
            <?php include "templates/slider.php" ?>
        <?php endif ?>
      </div>
    <?php endif ?>
  <?php endforeach ?>
</div>

<div class="projects" id="soloProjects">
  <h2>Solo Projects</h2>
  <p>These here are some projects Iv'e created on my own.</p>
  <?php foreach($data["projects"] as $project) : ?>
    <?php if ($project->type == "solo") : ?>
      <div class="project" id="proj-<?php echo $project->id ?>">
        <h3><?php $project->title ?></h3>
        <p><?php $project->description ?></p>
        <?php if (count($project->images) > 0) : ?>
            <?php include "templates/slider.php" ?>
        <?php endif ?>
      </div>
    <?php endif ?>
  <?php endforeach ?>
</div>

