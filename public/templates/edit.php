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
          <div class="projectforms">
            <fieldset>
              <legend>Remove Images</legend>
              <form id="<?php echo "proj-".$project->id."-imageForm" ?>" method="post" action="/?/Admin/removeImages" class="container">
                <input type="hidden" value="<?php echo $project->id?>" name="removeFromProject" />
                <?php foreach($project->images as $image) : ?>
                  <div class="flexObject imageCard">
                    <img src="<?php echo $image->src ?>"/>
                    <p><?php echo $image->caption ?></p>
                    <input type="checkbox" value="<?php echo $image->id ?>" name="removeImages[]"/>
                  </div>
                <?php endforeach ?>
              </form>
              <button class="right" form="<?php echo "proj-".$project->id."-imageForm" ?>" type="submit">Apply</button>
              <div class="clear"></div>
            </fieldset>
          </div>

          <div class="projectforms">
            <fieldset>
              <legend>Add New Image</legend>
                <?php $projId = $project->id ; include "addImageForm.php" ?>
            </fieldset>
          </div>
        </div>

      </div>
    <?php endif ?>
  <?php endforeach ?>
</div>

<div class="projects" id="soloProjects">
  <h3>Solo Assignments</h3>
</div>
