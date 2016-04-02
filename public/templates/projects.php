
<div class="stack">

  <?php foreach($data["projects"] as $project) : ?>
    <?php if ($project->type == "group") : ?>
      <?php include "project.php" ?>
    <?php endif ?>
  <?php endforeach ?>

  <div class="card projects">
    <header>
      <h3>Group Projects</h3>
    </header>
    <p>Projects in which I've been a member of a group to create.</p>
  </div>

  <?php foreach($data["projects"] as $project) : ?>
    <?php if ($project->type == "solo") : ?>
      <?php include "project.php" ?>
    <?php endif ?>
  <?php endforeach ?>

  <div class="card projects">
    <header>
      <h3>Solo Projects</h3>
    </header>
    <p>Projects in which I've been a member of a group to create.</p>
    <p>These here are some projects Iv'e created on my own.</p>
  </div>


  <div class="card projects">
    <header>
      <h3>My School Projects</h3>
    </header>
    <p> 
      Here You will find some of the projects I've been involved with 
      creating or which I have created by my self so far in my studies att MI 
    </p>
  </div>

</div>
