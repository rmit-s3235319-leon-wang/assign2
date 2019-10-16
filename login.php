<!DOCTYPE html>
<html>
<head>
	<title>Cloud assignment 2</title>
	<!-- Latest compiled and minified CSS -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="jumbotron jumbotron-fluid d-flex align-items-center" style="height: 300px; background-color: transparent;">
		<div class="container">
			<h1 style="margin: 0" class="display-2 pageHeader">Youtube Video Visualiser</h1>
		</div>
	</div>
	<div class="container">
		<form action="" method="GET">
			<div class="input-group">
				<input type="text" name="searchBar" id="searchBar" placeholder="Search" autocomplete="off" class="form-control">
				<input type="hidden" name="searchInput" id="searchInput">
				<div class="input-group-append">
					<button type="submit" class="btn btn-primary" id="search">Search</button>
				</div>
			</div>
		</form>
	</div>
	<script type="text/javascript">
		document.getElementById('search').addEventListener("click",searchVideo);

		function searchVideo(){
			var searchItem = document.getElementById('searchBar').value;
			document.getElementById('searchInput').value = searchItem;
		}
	</script>
<?php 
	$keyword='';
	if(isset($_GET['searchInput'])){
		$keyword = $_GET['searchInput'];
	}
	if(!empty($keyword)){
		$API_key = 'AIzaSyC-bz33drTNC_vAe7YB1LpdzFHivbYTk7Y';
		$maxResults = 10;
		$videoList = json_decode(file_get_contents('https://www.googleapis.com/youtube/v3/search?order=viewCount&part=snippet&q='.$keyword.'&maxResults='.$maxResults.'&key='.$API_key));

		foreach($videoList->items as $item){
			if(isset($item->id->videoId)){
							$viewCount = json_decode(file_get_contents('https://www.googleapis.com/youtube/v3/videos?part=statistics&id=' .$item->id->videoId.'&key='.$API_key.''));
			echo '<div class="youtube-video">
			<iframe width="280" height="150" src="https://www.youtube.com/embed/'.$item->id->videoId.'" frameborder="0" allowfullscreen></iframe>
			<h2>'. $item->snippet->title .'</h2>
			<h1>'.$viewCount->items[0]->statistics->viewCount.'</h1><h1>'.$viewCount->items[0]->statistics->likeCount.'</h1>
			</div>';
			}
	}
}
?>
</body>
</html>