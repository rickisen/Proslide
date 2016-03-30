<p> 
  Here You will find some of the projects I've been involved with 
  creating or which I have created by my self so far in my studies att MI 
</p>

<div class="projects">
  <h2>Group Projects</h2>
  <p>Projects in which I've been a member of a group to create.</p>
  <?php foreach($data["projects"] as $project) : ?>
    <?php if ($project->type == "group") : ?>
      <?php include "project.php" ?>
    <?php endif ?>
  <?php endforeach ?>
</div>

<div class="projects">
  <h2>Solo Projects</h2>
  <p>These here are some projects Iv'e created on my own.</p>
  <?php foreach($data["projects"] as $project) : ?>
    <?php if ($project->type == "solo") : ?>
      <?php include "project.php" ?>
    <?php endif ?>
  <?php endforeach ?>
</div>

