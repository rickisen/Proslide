<h1>Rickisen Admin Panel</h1>
<p>Here you can change and add images and text displayed on the project overview site</p>

<div class="projects" id="groupProjects">
  <h3>Add a Group Assignment</h3>
  <?php $projType = "group" ; include "addProjectForm.php" ?>
</div>

<div class="projects" id="soloProjects">
  <h3>Add a Solo Assignment</h3>
  <?php $projType = "solo" ; include "addProjectForm.php" ?>
</div>

<div class="projects" id="groupProjects">
  <h3>Group Assignments</h3>
  <?php foreach($data["projects"] as $project) : ?>
    <?php if ($project->type == "group") : ?>
      <div class="project" id="proj-<?php echo $project->id ?>">
        <h3><?php echo $project->title ?></h3>
        <p><?php echo $project->description ?></p>
        <div class="container">
          <div class="smallImages flexObject container">
            <?php foreach($project->images as $image) : ?>
              <div class="flexObject">
                <img src="<?php echo $image->src ?>"/>
                <p><?php echo $image->caption ?></p>
              </div>
            <?php endforeach ?>
          </div>
          <div class="flexObject">
            <?php $projId = $project->id ; include "addImageForm.php" ?>
          </div>
      </div>
      </div>
    <?php endif ?>
  <?php endforeach ?>
</div>

<div class="projects" id="soloProjects">
  <h3>Solo Assignments</h3>
</div>
