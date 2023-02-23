<?php 
if(isset($_POST['btnpostform'])){
$dt = new \DateTime();
$date = $dt->format('Y-m-d H:i:s');
$psw = md5($_POST['password']);

$url = "http://137.135.245.31:3000/api/v1/users/create";
$data = array('utilisateur' => $_POST['user'], 'mdp' => $psw, 'nom' => $_POST['Nom'], 'prenom' => $_POST['Prenom'], 'mail' => $_POST['Email'], 'date_creation' => $date);


$options = array(
    'http' => array(
        'method'  => 'POST',
        'header'  => 'Content-type: application/x-www-form-urlencoded',
        'content' => http_build_query($data),
    ),
);

$context  = stream_context_create($options);
$response = file_get_contents($url, false, $context);
$_SESSION['flash']['success'] = 'Connecté';
header('Location: '. $router->url('first'));
exit();
}

/*
$data = array('utilisateur' => $_POST['user'], 'mdp' => $psw, 'nom' => $_POST['Nom'], 'prenom' => $_POST['Prenom'], 'mail' => $_POST['Email'], 'date_creation' => $date);

// use key 'http' even if you send the request to https://...
$options = array(
    'http' => array(
        'header'  => "",
        'method'  => 'POST',
        'content' => http_build_query($data)
    )
);
}

if(!empty($_POST) && !empty($_POST['user']) && !empty($_POST['password'])){
	$req = $pdo->prepare("INSERT INTO users SET utilisateur = ?, mdp = ?, nom = ?, prenom = ?, mail = ?, date_creation = NOW()");
    $mdp = $_POST['password'];
    $password = password_hash($mdp, PASSWORD_BCRYPT);
    $req->execute([$_POST['user'], $password ,$_POST['Nom'], $_POST['Prenom'], $_POST['Email']]);

    $_SESSION['flash']['success'] = "Première étape validée";
	header('Location: '. $router->url('logout'));
    exit();
}*/
	?>


<div class="main d-flex justify-content-center w-100">
		<main class="content d-flex p-0">
			<div class="container d-flex flex-column">
				<div class="row h-100">
					<div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
						<div class="d-table-cell align-middle">

							<div class="text-center mt-4">
								<h1 class="h2">Get started</h1>
								<p class="lead">
									Start creating the best possible user experience for you customers.
								</p>
							</div>

							<div class="card">
								<div class="card-body">
									<div class="m-sm-4">
										<form action="" method="post">
											<div class="mb-3">
												<label class="form-label">Nom</label>
												<input class="form-control form-control-lg" type="text" name="Nom" id="nom" placeholder="Entrez votre nom" required/>
											</div>
											<div class="mb-3">
												<label class="form-label">Prénom</label>
												<input class="form-control form-control-lg" type="text" name="Prenom" id="prenom" placeholder="Entrez votre prénom" required/>
											</div>

											<div class="mb-3">
												<label class="form-label">Nom d'utilisateur</label>
												<input class="form-control form-control-lg" type="text" name="user" id="user" placeholder="Entrez votre nom d'utilisateur" required/>
											</div>
					
											<div class="mb-3">
												<label class="form-label">Email</label>
												<input class="form-control form-control-lg" type="email" name="Email" id="mail" placeholder="Entrez votre Email" required/>
											</div>
											<div class="mb-3">
												<label class="form-label">Mot de passe</label>
												<input class="form-control form-control-lg" type="password" name="password" placeholder="Entrez votre mot de passe" required/>
											</div>
											<div class="text-center mt-3">
												<button type="submit" class="btn btn-lg btn-primary" name="btnpostform">Créer mon compte</button> 
											</div>
										</form>
									</div>
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
		</main>
	</div>
