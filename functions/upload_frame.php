<?
$url = basename($_SERVER['SCRIPT_FILENAME']);
if(isset($_GET['progress_key'])) {
	$status = apc_fetch('upload_'.$_GET['progress_key']);
	echo $status['current']/$status['total']*100;
	die;
}
?>
<link href="/css/barraProgreso.css" rel="stylesheet">
<script src="/vendors/jquery/jquery.min.js"></script>
<script>
$(document).ready(function() { 
	setInterval(function() {
	$.get("<?=  $url; ?>?progress_key=<?=  $_GET['up_id']; ?>&randval="+ Math.random(), {
	},
		function(data)	//return information back from jQuery's get request
			{
				$('#progress_container').fadeIn(100);	//fade in progress bar	
				$('#progress_bar').width(data +"%");	//set width of progress bar based on the $status value (set at the top of this page)
				$('#progress_completed').html(parseInt(data) +"%");	//display the % completed within the progress bar
			}
		)},250);	//Interval is set at 500 milliseconds (the progress bar will refresh every .5 seconds)
});
</script>
<body>
<div id="progress_container">
    <div id="progress_bar">
        <div id="progress_completed"></div>
    </div>
</div>
</body>