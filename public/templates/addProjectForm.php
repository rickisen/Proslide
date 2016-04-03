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
  <textarea cols="50" rows="10" name="Description">
  </textarea>
  <br/>

  <label for="Github">Github</label>
  <input type="text" name="Github">

  <label for="Link">Link</label>
  <input type="text" name="Link">
  
  <label for="Date">Date</label>
  <input type="date" name="Date" placeholder="mm/dd/yyyy">

  <p><input type="submit" value="submit"></p>
</form>

