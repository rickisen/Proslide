<h1> Rickisen's School Projects </h1>
<p> 
  Here You will find some of the projects I've been involved with 
  creating or which I have created by my self so far in my studies att MI 
</p>

<div class="projects" id="groupProjects">
  <h3>Group Projects</h3>
  <p>Projects in which I've been a member of a group to create.</p>
  <?php foreach($data["projects"] as $project) : ?>
    <?php if ($project->type == "group") : ?>
      <div class="project" projectId="<?php $project->id ?>">
        <h5><?php echo $project->title ?></h5>
        <p><?php echo $project->description ?></p>
        <div class="slider">
        </div>
      </div>
    <?php endif ?>
  <?php endforeach ?>
</div>

<div class="projects" id="soloProjects">
  <h3>Solo Projects</h3>
  <p>These here are some projects Iv'e created on my own.</p>
  <?php foreach($data["projects"] as $project) : ?>
    <?php if ($project->type == "solo") : ?>
      <div class="project" projectId="<?php $project->id ?>">
        <h5><?php $project->title ?></h5>
        <p><?php $project->description ?></p>
        <div class="slider">
        </div>
      </div>
    <?php endif ?>
  <?php endforeach ?>
</div>

