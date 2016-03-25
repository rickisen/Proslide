<div class="slider">
  <img xmlId="<?php echo $project->images[0]->id ?>" src="<?php echo $project->images[0]->src ?>"/>
  <button projId="<?php echo $project->id ?>" direction="prev" class="sliderBtn">
    Prev
  </button>
  <button projId="<?php echo $project->id ?>" direction="next" class="sliderBtn right">
    Next
  </button>
  <div class="clear"></div>
  <p class="caption"><?php echo $project->images[0]->caption ?></p>
</div>
