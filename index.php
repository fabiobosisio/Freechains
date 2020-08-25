<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Wikies</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="">
    <style>
    .wrapper {
         margin: 0 auto;
         width: 90%
    }    
    .cards {
      margin: 0 auto;
      display: grid;
      grid-gap: 1rem;
      grid-template-columns: repeat(2, 1fr);
    }
    .card {
      max-width: 515px;
      box-shadow: 0 4px 8px 0 rgba(0,0,0,0.4);
      transition: 0.3s;
      margin: auto;
      width: 100%;
      margin-top: 1px;
      font-family: sans-serif;
      background-color: #F9F9F0;
    }

    .card:hover {
      box-shadow: 0 8px 16px 0 rgba(0,0,0,0.4);
    }

    .title {
      box-shadow: 0 4px 8px 0 rgba(0,0,0,0.4);
      transition: 0.3s;
      margin: auto;
      padding: 10px;
      border: 1px solid #111111;
      margin: 30px 15px 0 15px;
      font-family: sans-serif;
      background-color: #F6F6F6;
    }

    .container {
      padding: 2px 16px;
    }
    .id {
        word-break: break-all;
        font-size: 12px;
        font-family: sans-serif;
        
/*        white-space: nowrap; 
        width: auto; 
        overflow: hidden;
        text-overflow: ellipsis;
*/
    }
    .entry {
      text-align: center;
      font-family: sans-serif;
      text-overflow: ellipsis;
      font-weight: bold;
      font-size: 1.2em;
    }
    @media screen and (max-width: 768px) 
    { 
      .cards {
        grid-template-columns: 1fr;
      }
    } 
    </style>
  </head>
  <body>
    <!--[if lt IE 7]>
      <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
    
    <script src="" async defer></script>
  <div class="wrapper">
  <?php 
  
	$json_data = file_get_contents('/mnt/RAM/wikichain.json');
	$wikies = json_decode($json_data, true);
	
	echo "<div class='title'><div class='container'><h3>Leitor de Wikies</h3><h5>Atualizado em: ". $wikies['Updated'] ."</h5></div></div>"; 
	echo "<script>console.log('app iniciada' );</script>";
	
	echo "<div class='cards'>";
	foreach($wikies as  $key => $value){
		if ( $key != "Updated" ) {
			echo "<div class='container'>";
			echo "<p class='entry'> Cadeia: ".$key."</p>";
			foreach($value as $wiki){
				if ( $wiki['Front'] ){
					$likes = 0;
					if ( !is_null($wiki['Likes']) ){
						$likes = $wiki['Likes'];
					}
					echo    "<div class='card'>
								<div class='container'>
									<h4>
										<b>". $wiki['Payload'] . "</b>
									</h4>
									<p class='id'><b>Curtidas:</b> ". $likes . "</p>
									<p class='id'><b>ID:</b> ". $wiki['Front'] . "</p>
								</div>
							</div>";
				}
			}
			echo "</div>";
		}
	}
	echo "</div>";
  ?>
  </div>
 </body>
 </script>
</html>
