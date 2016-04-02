<header>
  <h3>Add New Project</h3>
</header>
<form action="/?/Admin/addProject" method="post" accept-charset="utf-8">
  <label for="type">Type</label>
  <select name="type">
    <option value="group">Group Project</option>
    <option value="solo">Solo Project</option>
  </select>

  <label for="Title">Title</label>
  <input type="text" name="Title" value="" id="Title">
  <br/>

  <label>Description</label>
  <textarea name="Description">
  </textarea>
  <br/>

  <p><input type="submit" value="submit"></p>
</form>

