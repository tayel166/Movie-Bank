<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Movies Bank </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="movies.css">
    <script src="movies.js"> </script>
</head>

<body style="background-color: #1e1e1e;">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <!-- start of page -->

    <?php
      setcookie("UID", $_GET["UID"], time() + (86400 * 30), '/');
    ?>


    <!-- start of navbar -->
    <nav class="navbar sticky-top navbar-expand">
        <a class="navbar-brand" href="#" id="navbarheader"> Movies Bank </a>

        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link selected" href="#"> Movies </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../shows/shows.html"> Shows </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../about/about.html"> About us </a>
            </li>
            <li class="nav-item">
              <button class="nav-link btn" onclick="signout()"> Log Out </button>
            </li>
        </ul>
    </nav>
    <!-- end of navbar -->

    <!-- start of poster -->
    <div id="poster">
       <div id="poster-text">
            <h2> Land of Mine </h2> 
            <h6> (Danish: Under sandet, lit. 'Under the Sand') is a 2015 Danish-German historical
                drama war film directed by Martin Zandvliet. It was shown in the Platform section
                of the 2015 Toronto International Film Festival.</h6>
        </div>

        <button class="button" onclick="PlayNow('335578')">
          <svg viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" width="15px">
            <path d="M424.4 214.7L72.4 6.6C43.8-10.3 0 6.1 0 47.9V464c0 37.5 40.7 60.1 72.4 41.3l352-208c31.4-18.5 31.5-64.1 0-82.6z" fill="currentColor"></path></svg>
            Play Now
          <div class="arrow"> ›› </div>
        </button>
    </div>
    <!-- end of poster -->

    <!-- start of popular movies -->
    <h2 class="mt-5"> Popular Movies </h2>

    <div class="scroll-wrapper reveal">
      <!-- scroll left button -->
      <div class="scroll-btn scroll-left" onclick="slideleft_popular()">
        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path d="M0 0h24v24H0z" fill="none"></path>
          <path fill="rgba(255,255,255,1)" d="M11.9997 10.8284L7.04996 15.7782L5.63574 14.364L11.9997 8L18.3637 14.364L16.9495 15.7782L11.9997 10.8284Z">
          </path>
        </svg>
      </div>
      <!-- end of scroll left button -->
      <div class="movies-cards" id="popular-movies"></div>

      <!-- scroll rigt button -->
      <div class="scroll-btn scroll-right" onclick="slideright_popular()">
        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path d="M0 0h24v24H0z" fill="none"></path>
          <path fill="rgba(255,255,255,1)" d="M11.9997 10.8284L7.04996 15.7782L5.63574 14.364L11.9997 8L18.3637 14.364L16.9495 15.7782L11.9997 10.8284Z">
          </path>
        </svg>
      </div>
      <!-- end of scroll right button -->
    </div>
    <!-- end of movies -->


    <!-- start of trending movies -->
    <h2 class="mt-5"> Trending Movies </h2>
    <div class="scroll-wrapper reveal">
      <!-- scroll left button -->
      <div class="scroll-btn scroll-left" onclick="slideleft_trending()">
        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path d="M0 0h24v24H0z" fill="none"></path>
          <path fill="rgba(255,255,255,1)" d="M11.9997 10.8284L7.04996 15.7782L5.63574 14.364L11.9997 8L18.3637 14.364L16.9495 15.7782L11.9997 10.8284Z">
          </path>
        </svg>
      </div>
      <!-- end of scroll left button -->

      <div class="movies-cards" id="trending-movies"></div>

      <!-- scroll rigt button -->
      <div class="scroll-btn scroll-right" onclick="slideright_trending()">
        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path d="M0 0h24v24H0z" fill="none"></path>
          <path fill="rgba(255,255,255,1)" d="M11.9997 10.8284L7.04996 15.7782L5.63574 14.364L11.9997 8L18.3637 14.364L16.9495 15.7782L11.9997 10.8284Z">
          </path>
        </svg>
      </div>
      <!-- end of scroll right button -->

    </div>

    <!-- end of movies -->
    <br>
    <br>

    <script>
      loadData();
    </script>

    <<script type="module">
        import { initializeApp } from "https://www.gstatic.com/firebasejs/10.7.1/firebase-app.js";
        import { getAuth, signOut } from "https://www.gstatic.com/firebasejs/10.7.1/firebase-auth.js";
        import { getFirestore, doc, updateDoc } from "https://www.gstatic.com/firebasejs/10.7.1/firebase-firestore.js";
  
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
  
        function signout(){
          let UID = getCookie("UID");
          signOut(auth).then(async() => {
            await updateDoc(doc(db, "users", UID), {
                        isLogged: false,
                    });
            window.location.href = "../signout.php";
          }).catch((error) => {
            console.log(error);
          });
        }
        window.signout = signout;
      </script>
	
</body>
</html>
