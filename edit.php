<?php
include 'includes/header.php';

  if( !is_logged_in() )
        header('location: index.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (inlognaam_juist_ingevuld($_POST['gebruikersnaam']) && wachtwoord_correct($_POST['wachtwoord'], $_SESSION['inlognaam'], $db) && info_juist_ingevuld($_POST['postcode'], $_POST['email'], $_POST['straat'], $_POST['huisnummer'])) {
      update($_POST['gebruikersnaam'], $_SESSION['gebruiker'], $db);
      update_info($_POST['email'], $_POST['straat'], $_POST['huisnummer'], $_POST['postcode'], $db);

      if(!empty($_POST['Nwachtwoord']))
        update_ww($_POST['Nwachtwoord'], $db);
      header('location: userinfo.php');
    } 
    else {
      $msg = "";

      if (!inlognaam_juist_ingevuld($_POST['gebruikersnaam']))
        $msg .= "- Gebruikersnaam: moet tenminste 6 tekens lang zijn.</br>";
      if(!wachtwoord_correct($_POST['wachtwoord'], $_SESSION['inlognaam'], $db))
        $msg .= "- Wachtwoord: Voer je huidige wachtwoord in. </br>";
      if (!email_juist_ingevuld($_POST['email']))
        $msg .= "- Email: Vul een geldige email in. </br>";
      if (!straat_juist_ingevuld($_POST['straat']))
        $msg .= "- Straat <br>";
      if (!huisnummer_juist_ingevuld($_POST['huisnummer']))
        $msg .= "- Huisnummer: Moet beginnen met cijfers </br>";
      if (!postcode_juist_ingevuld($_POST['postcode']))
        $msg .= "- Postcode: moet beginnen met vier cijfers en twee letters </br>";
      
    }
  }
 
$gebruiker = get_gebruiker_info($db);


?>

<?php include 'includes/nav.php' ?>
  <div class="col-md-6 col-md-offset-3" style="margin-top: 2.5%">
      <div class="panel panel-info">
        <div class="panel-heading">
          <h3 class="panel-title">Account gegevens </h3>
        </div>
        <div class="panel-body">
        <form method="POST" action="#" class="form-horizontal">
          <fieldset>
            <div class="form-group ">
              <label for="email" class="col-lg-4 control-label">Gebruikersnaam</label>
              <div class="col-lg-8">
                <input class="form-control" placeholder="Username" name="gebruikersnaam" type="text" value="<?= $gebruiker->inlognaam ?>">
              </div>

            </div>
            <div class="form-group">
              <label for="email" class="col-lg-4 control-label">Email</label>
              <div class="col-lg-8">
                <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?= $gebruiker->email ?>">
              </div>
            </div>
          

            <div class="form-group">
              <label for="password" class="col-lg-4 control-label">Password</label>
              <div class="col-lg-8">
                <input class="form-control" placeholder="Huidige wachtwoord" name="wachtwoord" type="password" value="">
              </div>
            </div>
            <div class="form-group">
              <label for="password_confirmation" class="col-lg-4 control-label">Nieuwe wachtwoord (Niet vereist)</label>
              <div class="col-lg-8">
                <input class="form-control" placeholder="Nieuwe wachtwoord" name="Nwachtwoord" type="password" value="">
              </div>
            </div>
            <div class="form-group">
              <label for="password_confirmation" class="col-lg-4 control-label">Straat</label>
              <div class="col-lg-8">
                <input class="form-control" placeholder="Straat" name="straat" type="text" value="<?= $gebruiker->straat ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="password_confirmation" class="col-lg-4 control-label">Huisnummer</label>
              <div class="col-lg-8">
                <input class="form-control" placeholder="Huisnummer" name="huisnummer" type="text" value="<?= $gebruiker->huisnummer ?>">
              </div>
            </div>

            <div class="form-group">
              <label for="password_confirmation" class="col-lg-4 control-label">Postcode</label>
              <div class="col-lg-8">
                <input class="form-control" placeholder="Postcode" name="postcode" type="text" value="<?= $gebruiker->postcode ?>">
              </div>
            </div>

            <div class="form-group">
              <div class="col-lg-8 col-lg-offset-4">
                <button class="btn btn-primary btn-block" data-toggle="modal">
                  Bijwerken
                </button>
              </div>
            </div>
            
          </fieldset>
          </form>
          <?php if (isset($msg)): ?>
            <div class="alert alert-danger alert-dismissible" role="alert">

            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            
            <strong>De volgende velden zijn niet juist ingevuld</strong>
            <p><?= $msg ?></p>
          </div>
          <?php endif ?>
          
        </div>
        <div class="panel-footer">
          <a href="userinfo.php" data-toggle="tooltip" type="button" class="btn btn-sm btn-success"><i class="glyphicon glyphicon-arrow-left"> </i> Terug</a> 
              <div class="clearfix"></div>
            </div>
      </div>
    </div>
</body>
</html>