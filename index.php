<?php session_start(); 
ini_set('session.gc_maxlifetime', 172800);
ini_set('session.cookie_lifetime', 172800);
if(!isset($_SESSION['id']) and isset($_COOKIE['ALog']))
{
	header('Location: loguj-script.php');
}else if(!isset($_SESSION['id'])){
	header('Location: loguj.php');
}
require_once "conect.php";
$conect = @new mysqli($host,$db_user,$db_password,$db_name);

$page = isSet( $_GET['page'] ) ? intval( $_GET['page'] ) :1;
$pageilosicifoto = isSet( $_GET['how'] ) ? intval( $_GET['how'] ) :40;

?>
<!DOCTYPE html>
<html lang="pl">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>tak</title>
	<link rel="shortcut icon" href="https://pbs.twimg.com/profile_images/1128944282943942658/_SKGcaOa.jpg">
	<meta name="description" content="strony">
	<meta name="dawid" content="str">
	<meta http-equiv="X-Ua-Compatible" content="IE=edge,chrome=1">
	<script src="js/jquery-1.12.4.js" defer></script>
	<script src="js/jquery-ui.js" defer></script>
	<script src="js/jquery.min.js" defer></script>
	<link rel="stylesheet" href="css.css" type="text/css" >
	<script src="flex.js" defer></script>
	<script src="style.js" defer></script>
	<script src="ajax.js" defer></script>
	<script defer>
let tera = {
	data:'',
	get_r: () => document.getElementById('checked').parentElement.nextElementSibling.firstElementChild,
	get_l: () => document.getElementById('checked').parentElement.previousElementSibling.firstElementChild,
};

function right(){
	try{
	onClick(tera.get_r());
	}catch(error){
		onClick(tera.get_r());
	}
}
function left(){
	try{
	onClick(tera.get_l());
	}catch(error){
		onClick(tera.get_l());
	}
}
function onClick(x){
	document.getElementById("offfoto").style.display = "block";
	if(typeof x.src !== 'undefined'){ 
		document.getElementById("hoverfoto").style.display= 'block';
		document.getElementById("displayvideo").style.display= 'none';
		document.getElementById("hovervideo").src= '';
		document.getElementById("displayvideo").load();
		document.getElementById("hoverfoto").src = x.dataset.src;
		if(document.getElementById('checked')) document.getElementById('checked').id ='';
		x.id = 'checked';
		tera.data = x;
	}else{
		document.getElementById("hoverfoto").style.display= 'none';
		document.getElementById("displayvideo").style.display= 'block';
		document.getElementById("hovervideo").src= x.querySelector('source').dataset.src;
		document.getElementById("displayvideo").load();
		if(document.getElementById('checked')) document.getElementById('checked').id ='';
		x.id = 'checked';
		tera.data = x;
	}
	smoothScroll(x.parentElement,1000);
}
async function scol(){
	 window.scrollBy(0,1);
	 setTimeout(scol, 10);
	}
var id;
function onslider(){tera.data.id='checked';
clearInterval(id);right();
id = setInterval(function(){ right() },5000);
}
async function offslider(){
clearInterval(id);
}
window.onscroll = async function(){
	let progres = document.getElementById('progressbar');
	let totalHeight = document.body.scrollHeight - window.innerHeight;
	let progresHeight = (window.pageYOffset / totalHeight) * 100;
	progres.style.height = progresHeight + "%";
}
	</script>
</head>
<body id="cialo">
	<div id="inputs" onclick="show()" >I</div>	
	<div id="scrooltop" onclick="smoothScroll('body',4000)" >^</div>
	<div id="progressbar"></div>
	<div id="scrollPath"></div>
	<nav id ="navbar"class="">
		<div id="sprawdzi" style="z-index:9;">
		  <a id="ileplikow" class="ile-foto" href="#"><?php echo $_SESSION['id']; ?> - <?php 
		  $uzerid = $_SESSION['id'];
		  $sql = "SELECT COUNT(*) AS `in` FROM `img` WHERE uzer='$uzerid'";
		  $file = $conect->query($sql);
		  $file = $file->fetch_assoc();
		  echo $file['in'];
		  
		  ?></a>
		  <button id="rozwini">
		  </button>
		  <ul id="ukryte">
			<li>
				<a class="" href="loguj.php">wyloguj</a>
			</li>
			<li>
				<a class="" href="szukajsamych.php">szukajsamych</a>
			</li>
			<li>	
				<form id="fupForm" enctype="multipart/form-data" method="post" class="razem">
				<input id="data" type="file" name="plik[]" class="file" multiple />
				<input type="submit" value="wyślij foto" />
				</form>
			</li>
			<li>
				<input type="text" name="filtr" onchange="edit_zap1(this)"><input type="text" name="filtr" onchange="edit_zap2(this)">
			</li>
			<li>	
				<button onclick="scol()">scroll</button>
				</li>
			</ul>
		</div>
		
		
		
	</nav>
	<progress id="loading" value="50" max="100" style="width:100%; "></progress>
	<div class="container">	
		<div id="imagines" class="row" style="position:relative;">	
		</div>
	</div>
	<div id="offfoto" style="display:none;" >
		<div id="przykryj"></div>
		<div id="hoverfotobox">
			<img id="hoverfoto" alt="xd"> 
			<video id="displayvideo" style="display:none" autoplay="autoplay">
				<source id="hovervideo" type="video/mp4">
			</video>
		</div>
		<div id="bottommenu">
				<button onclick="onslider()" ontouchend="onslider()" >onslider</button>
				<button onclick="offslider()" ontouchend="offslider()" >offslider</button>
		</div>
	</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
</body>
</html>