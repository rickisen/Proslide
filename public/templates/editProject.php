<div class="card project" id="proj-<?php echo $project->id ?>">

  <header>
    <h3><?php echo $project->title ?></h3>
    <p><?php echo $project->description ?></p>
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
                <p><?php echo $image->caption ?></p>
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

</div>
