<form action="/?/Admin/addImage" enctype="multipart/form-data" method="post" accept-charset="utf-8" class="container vertical">
  <input type="hidden" name="MAX_FILE_SIZE" value="3000000" />
  <input type="hidden" name="projId" value="<?php echo $projId ?>"/>

  <input class="flexObject" type="text" name="Title" value="" id="Title">
  
  <textarea class="flexObject" rows="10" name="Caption">
  </textarea>
  
  <input class="flexObject" type="file" name="Image"/>

  <input class="flexObject" type="submit" value="submit">
</form>

<?php unset($projId) ?>
