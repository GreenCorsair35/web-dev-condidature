<!DOCTYPE html>
<html>

<head>
	<!--Import Google Icon Font-->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

	<!--Let browser know website is optimized for mobile-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<!-- Compiled and minified CSS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

	<!-- Compiled and minified JavaScript -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</head>

<body>
    <?php
        if(isset($_GET["id"])){
            $filename = 'result.json';

            if(file_exists($filename)){
                $current_data = file_get_contents($filename);
                $array_data = json_decode($current_data, true);

                for($i = 0; $i < sizeof($array_data); $i++){
					if($array_data[$i]["id"] == $_GET["id"]){
						$username = $array_data[$i]["username"];
						$email = $array_data[$i]["email"];
						$password = $array_data[$i]["password"];
						$roles = $array_data[$i]["roles"];
					}
				}
            } else {
                echo "the data file does not exist";
            }
        } else {
			// redirect to the main page
            $url = "index.php";
    		header('Location: '.$url);
        }
    ?>

	<div class="container">
		<h4 style="text-align: center;">Create User</h4>
		<form class="col s12" action="updateUser.php?id=<?php echo $_GET["id"]; ?>" method="post">
			<div class="row">
				<div class="input-field col s12">
					<i class="material-icons prefix">account_circle</i>
					<input id="username" type="text" class="validate" name="username" value = "<?php echo (isset($username)) ? $username : ''; ?>">
					<label for="username">Nom d'utilisateur</label>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s12">
					<i class="material-icons prefix">email</i>
					<input id="email" type="email" class="validate" name="email" value = "<?php echo (isset($email)) ? $email : ''; ?>">
					<label for="email">Email</label>
					<span class="helper-text" data-error="wrong" data-success="right">toto@example.com</span>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s12">
					<i class="material-icons prefix">lock</i>
					<input id="password" type="password" class="validate" name="password" value = "<?php echo (isset($password)) ? $password : ''; ?>">
					<label for="password">Password</label>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s12">
					<i class="material-icons prefix">group_add</i>
					<select multiple name="roles[]">
						<option value="" disabled>Choose your option</option>
						<option value="user" 
							<?php 
								for($i = 0; $i < sizeof($roles); $i++){ 
									if($roles[$i] == "user"){ 
										echo "selected";
									}
								}
							?>
						>ROLE_USER</option>
						<option value="superuser"
							<?php 
								for($i = 0; $i < sizeof($roles); $i++){ 
									if($roles[$i] == "superuser"){ 
										echo "selected";
									}
								}
							?>
						>ROLE_SUPERUSER</option>
						<option value="admin"
							<?php 
								for($i = 0; $i < sizeof($roles); $i++){ 
									if($roles[$i] == "admin"){ 
										echo "selected";
									}
								}
							?>
						>ROLE_ADMIN</option>
						<option value="new"
							<?php 
								for($i = 0; $i < sizeof($roles); $i++){ 
									if($roles[$i] == "new"){ 
										echo "selected";
									}
								}
							?>
						>ROLE_NEW</option>
					</select>
					<label>Roles</label>
				</div>
			</div>
			<div class="row right">
				<input class="waves-effect waves-light btn" type="submit" value="Modifier" />
			</div>
		</form>
	</div>
    
	<script>
		document.addEventListener('DOMContentLoaded', function() {
			var elems = document.querySelectorAll('select');
			var instances = M.FormSelect.init(elems);
		});
	</script>
</body>

</html>