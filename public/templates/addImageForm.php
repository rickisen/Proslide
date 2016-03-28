<form action="/?/Admin/addImage" enctype="multipart/form-data" method="post" accept-charset="utf-8">
  <h3>Add Image</h3>
  <input type="hidden" name="MAX_FILE_SIZE" value="3000000" />
  <input type="hidden" name="projId" value="<?php echo $projId ?>"/>
    
  <label>Image</label>
  <input type="file" name="Image"/>
  <br/>

  <label>Caption</label>
  <textarea name="Caption">
  </textarea>
  <br/>

  <p><input type="submit" value="submit"></p>
</form>

<?php unset($projId) ?>
