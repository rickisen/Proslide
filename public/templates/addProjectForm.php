<form action="/?/Admin/addProject" method="post" accept-charset="utf-8">
  <input type="hidden" name="type" value="<?php echo $projType ?>">

  <label for="Title">Title</label>
  <input type="text" name="Title" value="" id="Title">
  <br/>

  <label>Description</label>
  <textarea name="Description">
  </textarea>
  <br/>

  <p><input type="submit" value="submit"></p>
</form>

<?php unset($projType) ?>
