<div class="slider" projId="<?php echo $project->id ?>" >
  <div class="sliderImage" xmlId="<?php echo $project->images[0]->id ?>" style="background-image:url(<?php echo $project->images[0]->src ?>);" >
    <div direction="prev" class="darkDiv sliderBtn left"><div>Prev</div></div>
    <div direction="next" class="darkDiv sliderBtn right"><div>Next</div></div>
    <div class="clear"></div>
  </div>
  <br/>
  <div class="clear"></div>
  <h4 class="title"><?php echo $project->images[0]->title ?></h4>
  <p class="caption"><?php echo $project->images[0]->caption ?></p>
</div>
