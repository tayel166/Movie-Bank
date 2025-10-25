<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Movies Bank </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="login_signup.css">
    <script src="login_signup.js"> </script>
</head>
    <body style="background-color: #1e1e1e">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
	<!-- login frame -->

	<?php
		if(isset($_COOKIE["UID"])) {
			header("Location: http://localhost/Movie-Bank/movies/movies.php?UID=".$_COOKIE["UID"]);
		}
	?>

	<h3 class="logo"> Movie Bank </h3>

	<div class="section">
		<div class="container">
			<div class="row full-height justify-content-center">
				<div class="col-12 text-center align-self-center py-5">
					<div class="section pb-5 pt-5 pt-sm-2 text-center">
						<h6 class="mb-0 pb-3"><span>Log In </span><span>Sign Up</span></h6>
			          	<input class="checkbox" type="checkbox" id="reg-log" name="reg-log"/>
			          	<label for="reg-log"></label>
						<div class="card-3d-wrap mx-auto">
							<div class="card-3d-wrapper">
								<div class="card-front">
									<div class="center-wrap">
										<div class="section text-center">
											<h4 class="mb-4 pb-3">Log In</h4>
											<form name="login_form" onsubmit="login(); return false">
												<input type="text" name="logemail" class="form-style" placeholder="Your Email" id="logemail">
												<input type="password" name="logpass" class="form-style mt-2" placeholder="Your Password" id="logpass">
												<input type="submit" class="btn mt-4">
											</form>
                            				<p class="mb-0 mt-4 text-center"><a href="#0" class="link" onclick="forgot_password()">Forgot your password?</a></p>
				      					</div>
			      					</div>
			      				</div>
								<div class="card-back">
									<div class="center-wrap">
										<div class="section text-center">
											<h4 class="mb-4 pb-3">Sign Up</h4>
											<form name="signup_form" onsubmit="signup(); return false">
												<input type="text" name="logname" class="form-style" placeholder="Your Full Name" id="signname">
												<input type="text" name="logemail" class="form-style mt-2" placeholder="Your Email" id="signemail">
												<input type="password" name="logpass" class="form-style mt-2" placeholder="Your Password" id="signpass">
												<input type="submit" class="btn mt-4">
											</form>
				      					</div>
			      					</div>
			      				</div>
			      			</div>
			      		</div>
			      	</div>
		      	</div>
	      	</div>
	    </div>
	</div>
	

	<!-- firebase section -->
	<script type="module">
		// Import the functions you need from the SDKs you need
		import { initializeApp } from "https://www.gstatic.com/firebasejs/10.7.1/firebase-app.js";
		import { getAuth, signInWithEmailAndPassword, createUserWithEmailAndPassword } from "https://www.gstatic.com/firebasejs/10.7.1/firebase-auth.js";
		import { getFirestore, collection, setDoc, doc, updateDoc } from "https://www.gstatic.com/firebasejs/10.7.1/firebase-firestore.js";

		// Your web app's Firebase configuration
		const firebaseConfig = {
			apiKey: "AIzaSyAiJqH3uIlh_6GkK_eemGTS0iwF6OZPkXo",
			authDomain: "movie-bank-5e524.firebaseapp.com",
			projectId: "movie-bank-5e524",
			storageBucket: "movie-bank-5e524.appspot.com",
			messagingSenderId: "167838756017",
			appId: "1:167838756017:web:97a848394cd88bab138690"
		};

		// Initialize Firebase
		const app = initializeApp(firebaseConfig);
		const auth = getAuth();
		const db = getFirestore(app);

		function firebase_login(email, password){
			signInWithEmailAndPassword(auth, email, password)
			.then(async (userCredential) => {
				// Signed in
				await updateDoc(doc(db, "users", userCredential.user.uid), {
                        isLogged: true,
                    });
				window.location.href = "../movies/movies.php?UID=" + userCredential.user.uid;
			})
			.catch((error) => {
				const errorMessage = error.message;
				alert(errorMessage);
			});
		}

		async function firebase_signup (email, password, name){
			createUserWithEmailAndPassword(auth, email, password)
			.then(async (userCredential) => {
				// Signed in 
				// will be replaced with cookie
				await setDoc(doc(db, "users", userCredential.user.uid), {
					name: name,
					email: email,
					isLogged: true,
					uid: userCredential.user.uid
				});
				window.location.href = "../movies/movies.php?UID=" + userCredential.user.uid;
			})
			.catch((error) => {
				const errorMessage = error.message;
				alert(errorMessage);
			});
		}

		function login() {
			var email = document.forms.login_form.logemail.value;
			var password = document.forms.login_form.logpass.value;

			if (validate_credentials(email, password)){
				firebase_login(email, password);
			}
		}

		function signup() {
			var email = document.forms.signup_form.logemail.value;
			var password = document.forms.signup_form.logpass.value;
			var name = document.forms.signup_form.logname.value;

			if (validate_credentials(email, password, name)){
				firebase_signup(email, password, name);
			}
		}

		window.signup = signup;
		window.login = login;
	</script>
    </body>
</html>
