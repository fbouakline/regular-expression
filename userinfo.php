<?php 
include 'includes/header.php';
$gebruiker = get_gebruiker_info($db);
include 'includes/nav.php';
  if( !is_logged_in() )
        header('location: index.php');
?>


  <div class="container">
      <div class="row">
        <div style="margin-top: 3%" class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
   
   
          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title"><?= $gebruiker->inlognaam ?></h3>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=100" class="img-circle"> </div>
                
                <div class=" col-md-9 col-lg-9 "> 
                  <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td>Gebruikersnaam</td>
                        <td><?= $gebruiker->inlognaam ?></td>
                      </tr>
                      <tr>
                        <td>Email</td>
                        <td><a href="mailto:<?= $gebruiker->email ?>"><?= $gebruiker->email ?></a></td>
                      </tr>
                      <tr>
                        <td>Straat</td>
                        <td><?= $gebruiker->straat ?></td>
                      </tr>
                   
                         <tr>
                             <tr>
                        <td>Huisnummer</td>
                        <td><?= $gebruiker->huisnummer ?></td>
                      </tr>
                        <tr>
                        <td>Postcode</td>
                        <td><?= $gebruiker->postcode ?></td>
                      </tr>
                     
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

           <div class="panel-footer">
              <span class="pull-right">
                  <a href="edit.php" data-original-title="Edit this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-edit"></i> Bijwerken</a>
              </span>
              <div class="clearfix"></div>
            </div>
            
          </div>
        </div>
      </div>
    </div>
    
<?php include 'includes/footer.php' ?>