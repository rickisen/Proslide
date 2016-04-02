<p>Here you can change and add images and text displayed on the project overview site</p>
<div class="stack">

  <div class="card projects" id="groupProjects">
    <header>
      <h3>Group Projects</h3>
    </header>
  </div>

  <?php foreach($data["projects"] as $project) : ?>
    <?php if ($project->type == "group") : ?>
      <?php include "editProject.php" ?>
    <?php endif ?>
  <?php endforeach ?>

  <div class="card projects" id="soloProjects">
    <header>
      <h3>Solo Projects</h3>
    </header>
  </div>

  <?php foreach($data["projects"] as $project) : ?>
    <?php if ($project->type == "solo") : ?>
      <?php include "editProject.php" ?>
    <?php endif ?>
  <?php endforeach ?>

  <div class="card projects">
    <?php include "addProjectForm.php" ?>
  </div>

</div>
