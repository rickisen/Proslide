<p>Here you can change and add images and text displayed on the project overview site</p>

<div class="projects" id="groupProjects">
  <?php include "addProjectForm.php" ?>
</div>

<div class="projects" id="groupProjects">
  <h3>Group Projects</h3>
  <?php foreach($data["projects"] as $project) : ?>
    <?php if ($project->type == "group") : ?>
      <?php include "editProject.php" ?>
    <?php endif ?>
  <?php endforeach ?>
</div>

<div class="projects" id="soloProjects">
  <h3>Solo Projects</h3>
  <?php foreach($data["projects"] as $project) : ?>
    <?php if ($project->type == "solo") : ?>
      <?php include "editProject.php" ?>
    <?php endif ?>
  <?php endforeach ?>
</div>
