<?php include 'includes/header.php' ?>
<?php

	if( is_logged_in() ){
		header('location: userinfo.php');
	}

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		
		if(wachtwoord_correct($_POST['wachtwoord'], $_POST['gebruikersnaam'] ,$db))
			login(get_gebruikerid($_POST['gebruikersnaam'], $db), $_POST['gebruikersnaam']);
		else
			$msg = "Onjuiste gegevens.";
	}
?>
	<div class="container">    
        <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
            <div class="panel panel-info" >
                    <div class="panel-heading">
                        <div class="panel-title">Login</div>
                    </div>     
				
                    <div style="padding-top:30px" class="panel-body" >
						
                        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                            
                        <form id="loginform" class="form-horizontal" role="form" method="POST" action="#">
                                    
                            <div style="margin-bottom: 25px" class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input id="login-username" type="text" class="form-control" name="gebruikersnaam" value="" placeholder="Inlognaam">                                        
                            </div>

                            <div style="margin-bottom: 25px" class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                <input id="login-password" type="password" class="form-control" name="wachtwoord" placeholder="Wachtwoord">
                            </div>
                            <div class="form-group">
                            	<div class="col-md-12"><button class="form-control btn btn-primary">Login</button></div>
                            </div>
                            <?php if (isset($msg)): ?>
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                
                                <strong><?= $msg ?></strong>
                                
                            </div>
                            <?php endif ?>
                            </form>
                        </div>
                        <div class="panel-footer">
							Nog geen account ? <a href="registratie.php">Account aanmaken</a>
						</div>                     
                    </div>  
        </div>
</body>
</html>