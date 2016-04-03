<div class="card project" id="proj-<?php echo $project->id ?>">

  <header>
    <h3><?php echo $project->title ?></h3>
  </header>

  <div class="container">
    <div class="flexObject flexBig">
      <fieldset>
        <legend>Remove Images</legend>
        <form id="<?php echo "proj-".$project->id."-imageForm" ?>" method="post" action="/?/Admin/removeImages" >
          <input type="hidden" value="<?php echo $project->id?>" name="removeFromProject" />
          <div class="container">
            <?php foreach($project->images as $image) : ?>
              <div class="flexObject imageCard">
                <input type="checkbox" value="<?php echo $image->id ?>" name="removeImages[]"/>
                <img src="<?php echo $image->src ?>"/>
                <h4><?php echo $image->title ?></h4>
              </div>
            <?php endforeach ?>
          </div>
          <button type="submit">Remove Selected</button>
        </form>
      </fieldset>
    </div>

    <div class="flexObject ">
      <fieldset>
        <legend>Add New Image</legend>
          <?php $projId = $project->id ; include "addImageForm.php" ?>
      </fieldset>
    </div>
  </div>

  <p><?php echo $project->description ?></p>

  <?php if ($project->github) : ?>
    <p>
      <a href="<?php echo $project->github ?>">Github Project</a>
    </p>
  <?php endif ?>
  
  <?php if ($project->link) : ?>
    <p>
      <a href="<?php echo $project->link ?>">Visit</a>
    </p>
  <?php endif ?>

  <?php if ($project->date) : ?>
    <p> <?php echo date("Y-m-m", $project->date) ?> </p>
  <?php endif ?>

</div>
