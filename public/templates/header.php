<!DOCTYPE HTML>
<html>
<head>
  <meta charset="utf-8">
  <title>Rickisen's School Projects</title>
  <link href='https://fonts.googleapis.com/css?family=Arimo' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Raleway:400,700' rel='stylesheet' type='text/css'>

  <link rel="stylesheet" href="/stylesheets/normalize.css" type="text/css"  charset="utf-8">

  <?php if ($data["loadview"] == "edit"):?>
    <link rel="stylesheet" href="/stylesheets/admin.css"     type="text/css"  charset="utf-8">
  <?php elseif($data["loadview"] == "projects"): ?>
    <link rel="stylesheet" href="/stylesheets/slider.css"    type="text/css"  charset="utf-8">
  <?php endif ?>

  <link rel="stylesheet" href="/stylesheets/cardStack.css" type="text/css"  charset="utf-8">
  <link rel="stylesheet" href="/stylesheets/main.css"      type="text/css"  charset="utf-8">

</head>
<body>
<div id="wrapper">
<header>
  <a href="/"> <h1 class="left"> Rickisen's School Projects </h1> </a>
  <?php if (isset($_SESSION['currentUser'])) : ?>
    <div class="right">
      Logged in as <?php echo $_SESSION['currentUser']->name ?>
      <a href="/?/Admin/edit">Admin</a>
      <a href="/?/Login/logout">Log out</a>
    </div>
  <?php endif ?>
  <div class="clear"></div>
</header>
