<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>test</title>
</head>
<body>
  

<form method="post">
  Författare: <input type="text" name="author">
  Titel: <input type="text" name="title">
  År: <input type="text" name="year">
  <input type="submit" value="Lägg till" name="add_book">
</form>
<img src="" id="bild"></img>

<?php
$xml = simplexml_load_file("books.xml");
$sxe = new SimpleXMLElement($xml->asXML());

if(isset($_POST["add_book"]) && !empty($_POST["add_book"])){
  $new_item = $sxe->addChild("book"); //ny <book></book> i XML strukturen
  $new_item->addChild("author", $_POST["author"]); // ny <author>VÄRDE</author>
  $new_item->addChild("tile", $_POST["title"]);
  $new_item->addChild("year", $_POST["year"]);
}

$sxe->asXML("books.xml");

/* var_dump($sxe->book[0]); */

/* foreach($sxe as $book){ */
/*   echo $book->title . "<br>"; */
/*   echo $book->author . "<br>"; */
/*   echo $book->year . "<br>"; */
/* } */
?>
  <script src="test.js" type="text/javascript" charset="utf-8"> </script>
</body>
</html>
