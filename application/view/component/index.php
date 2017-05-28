<div class="container">
  <img src="http://i.imgur.com/Jeoxccv.png">

  <form action="<?=Config::get('URL');?>component/index"  method="post">
    <input id="search" name="search" type="text" placeholder="Scan Barcode">
    <button type="submit">Zoeken</button>
  </form>
  
  <p id="create">
    <h3>Nieuw component</h3>
  </p>
<p>
  <form method="post" action="<?=Config::get('URL');?>component/create">
    <ul>
      <li><label>Naam component: </label><input class="reset" type="text" name="name" required /></li>
      <li><label>Beschrijving: </label><input class="reset" type="textarea" name="description" required /></li>
      <li><label>Specs: </label><input class="reset" type="textarea" name="specs" required /></li>
      <li><label>Hyperlink: </label><input class="reset" type="text" name="hyperlink" required /></li>
    </ul>
    <input class="button" type="submit" value='Maak dit component aan' autocomplete="off" />
  </form>
<div>