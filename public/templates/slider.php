<div class="slider">
  <img xmlId="<?php echo $project->images[0]->id ?>" src="<?php echo $project->images[0]->src ?>"/>
  <br/>
  <button projId="<?php echo $project->id ?>" direction="prev" class="sliderBtn">
    Prev
  </button>
  <button projId="<?php echo $project->id ?>" direction="next" class="sliderBtn right">
    Next
  </button>
  <div class="clear"></div>
  <h4 class="title"><?php echo $project->images[0]->title ?></h4>
  <p class="caption"><?php echo $project->images[0]->caption ?></p>
</div>
