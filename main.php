
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" type="image/x-icon" href="./images/favicon.ico">
<link rel="stylesheet" href="style.css">
<style>
* {box-sizing: border-box;}
</style>
</head>
<body>
    
<!doctype html>
<html>
<head>
<link rel="stylesheet" href="style.css">
<style>
* {box-sizing: border-box;}
</style>
</head>
<body>
  <div class="header">
  <div class="container" style = "display:flex; justify-content: space-between; align-items: center;">
    <div style = "display:flex; gap: 1rem;">
        <a href='main.php'><img src = "images/vibecheck_logo_large.png" width = 80px; class='logo'></a>
        <h1><a href='main.php'>vibeCheck</a></h1>
    </div>

    <div class="header-right" style = "float: right;">
        <!-- <a class="active" href="#home">Home</a> -->
        <a id='home' href="main.php">Home</a>
        <a id='concerts'  href="concerts.php">Concerts</a>
        <!-- <a id='results'  href="results.html">Results</a> -->
        <a id='profile'  href="profile.php">Profile</a>
      </div>
  </div>

</div>
</body>
</html>

  </div>
  <div id="loginBlurb">
    <p>Find concerts you love near you!</p>

    <br><br>
    <center>
      <button id="loginButton">Login with Spotify</button>
    </center>
  </div>

  <div id="termSelection">
    <input type="radio" id="short" name="termPick" value="short" onclick="showArtists();">
      <label for="short">Short Term</label><br>
    <input type="radio" id="medium" name="termPick" value="medium" onclick="showArtists();">
      <label for="medium">Medium Term</label><br>
    <input type="radio" id="long" name="termPick" value="long" onclick="showArtists();">
      <label for="long">Long Term</label>
  </div>

  <div id='topArtists'>
  </div>


<script type="text/javascript">

    userArtists=sessionStorage.getItem('userArtists');
    userArtistsTerms = sessionStorage.getItem('userArtistsTerms');
    userArtistsPics=sessionStorage.getItem('userArtistsPics');

    console.log(userArtists);
    console.log(userArtistsTerms);
    user_S_Artists=[];
    user_M_Artists=[];
    user_L_Artists=[];

    //if its not logged into spotify don't show concerts or term selection

  if (userArtists==null) {
    document.getElementById("concerts").style.display="none";
    document.getElementById("termSelection").style.display="none";
    document.getElementById("loginBlurb").style.display="inline";
    document.getElementById("topArtists").style.display="none";
  }

  //if it is logged into spotify
  else{

    document.getElementById("loginBlurb").style.display="none";
    document.getElementById("termSelection").style.display="inline";
    document.getElementById("topArtists").style.display="flex";
    //automatically checks short term
    document.getElementById("short").checked=true;
    doArtists();
    showArtists();

  }
  async function doArtists(){
     //userArtists=sessionStorage.getItem('userArtists');
     userArtists=userArtists.split(",");
     //.userArtistsTerms = sessionStorage.getItem('userArtistsTerms');
     userArtistsTerms=userArtistsTerms.split(",");
     //userArtistsPics=sessionStorage.getItem('userArtistsPics');
     userArtistsPics=userArtistsPics.split(",");
     for(i=0;i<userArtists.length;i++){
        if(userArtistsTerms[i]=='l'){
            curArtistData=[userArtists[i],userArtistsPics[i]];
            user_L_Artists.push(curArtistData);
        }
        if(userArtistsTerms[i]=='m'){
            curArtistData=[userArtists[i],userArtistsPics[i]];
            user_M_Artists.push(curArtistData);
        }
        if(userArtistsTerms[i]=='s'){
            curArtistData=[userArtists[i],userArtistsPics[i]];
            user_S_Artists.push(curArtistData);
        }
    }
  }
  async function showArtists(){
    arr=[];
    if(document.getElementById("long").checked){arr=user_L_Artists;}
    if(document.getElementById("medium").checked){arr=user_M_Artists;}
    if(document.getElementById("short").checked){arr=user_S_Artists;}
    
    stringCode="";
    for (var i =0;i<arr.length;i++) {
      stringCode+="<div class='artistBlurb'>";
      stringCode+="<img src='"+arr[i][1]+"'>"
      stringCode+="<h2>"+ arr[i][0]+"</h2>"

      stringCode+="</div>";
    }
     document.getElementById('topArtists').innerHTML=stringCode;

  }
</script>

  <script>
    //login and spotify authentication script
    var client_id = '87587e4116394731a7ffbfb872d45712';//'daeea42af07e4702905904f246591317';
    var redirect_uri = 'https://oliverb.sgedu.site/vibeCheck/results.php';
    var scopes = 'user-top-read playlist-read-private user-read-recently-played';
            document.getElementById('loginButton').addEventListener('click', function() {
            var authUrl = 'https://accounts.spotify.com/authorize?response_type=token&client_id='
             + client_id + '&scope=' + encodeURIComponent(scopes)+'&redirect_uri=' + encodeURIComponent(redirect_uri);
            //sessionStorage.setItem('loggedInSpotify',1);
            window.location.href = authUrl;
        });

        // Function to extract code from URL after redirection
        function getCodeFromUrl() {
            var urlParams = new URLSearchParams(window.location.search);
            return urlParams.get('code');
        }
        function getAccessTokenFromURL(){
          var urlParams = new URLSearchParams(window.location.search);
         
          return  urlParams.get('access_token');
        }

        // Once the page loads, extract the code from URL and redirect to results.html
        window.onload = function() {
            var code = getCodeFromUrl();
            var code2 = getAccessTokenFromURL()
            if (code) {
                // Redirect to results.html with the code as a query parameter
                window.location.href = 'results.html?access_token='+encodeURIComponent(code2);
            }
        };
  </script>

<br><br>
<!-- <div class="musicNotesAnimation">
  <div class="note-1">
  &#9835; &#9833;
</div>
<div class="note-2">
  &#9833;
</div>
<div class="note-3">
  &#9839; &#9834;
</div>
<div class="note-4">
  &#9834;
</div>
</div> -->


<!-- <div class="footer"></div> -->


</body>
</html>