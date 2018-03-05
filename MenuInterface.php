<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="icon" href="https://pbs.twimg.com/profile_images/3596354243/36d8c7d11ff1e743dd3a8b18bf8be20a_400x400.png">
  <title>Sharky's Database</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=0.2">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/Styles.css">
<script src="scripts/menu_interact.js"></script>


<div id='Navbar'></div>
  
</head>



<body>
<h1>Utilities</h1>


<div id="flip">Click to configure a menu item</div>
<div id="panel">

<h3 style="position:fixed;right:1190px;top:180px;z-index:20;">Select an item</h3>

<select id="select" size="12" style="position:fixed;right:1200px;top:250px;">
  

</select>

<div id="items">

</div>

<button id="next">next</button>

<h3 style="position:fixed;right:900px;top:180px;z-index:4">Edit recipe</h3>
</div>

<button id="FadeButton">Click to view menu item details</button>
<div id="menu" class="well" style="position:fixed; left:400px; top:100px; display:none; width:1000px; height:600px"><b>Select a menu item</b>

<form>

<select size="10" style="position:fixed;right:800px;top:250px;">
  <option value="1">Thousand Oaks</option>
  <option value="2">Sherman Oaks</option>
  <option value="3">Westlake</option>
  <option value="4">Newbury</option>
</select>

<button type="submit" class="btn-primary" onclick="GetResults()" style="position:fixed;top:450px;">Fetch results</button>
</form>
</div>


</body>

</html>