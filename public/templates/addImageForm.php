<form action="/?/Admin/addImage" enctype="multipart/form-data" method="post" accept-charset="utf-8" class="container vertical">
  <input type="hidden" name="MAX_FILE_SIZE" value="3000000" />
  <input type="hidden" name="projId" value="<?php echo $projId ?>"/>

  <div class="flexObject">
    <label for="Title">Title</label>
    <input type="text/submit/hidden/button" name="Title"/>
  </div>
  
  <div class="flexObject flexBig">
    <label for="Caption">Caption</label>
    <textarea name="Caption" rows="8" cols="40"></textarea>
  </div>
  
  <div class="flexObject">
    <label for="Image">Image File</label>
    <input type="file" name="Image"/>
  </div>

  <div class="flexObject">
    <input type="submit" value="submit"/>
  </div>
</form>


<?php unset($projId) ?>
