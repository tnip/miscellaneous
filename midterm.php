<html>
	<head>
		<link href='http://fonts.googleapis.com/css?family=Rokkitt:400,700' rel='stylesheet' type='text/css'>
		<style type="text/css">
			body{
				font-family:Rokkitt;
				font-size:20px;
				/*
				color:#CC5500;
				color:#FF7518;
				*/
				color:#FFA812;
				background-color:#111;
			}

			#timer{
				margin:auto;
				width:100%;
			}

			#timer table{
				width:100%;
				font-size:2.5em;
			}

			#timer td{
				text-align:center;
				width:50%;
			}

			#timer span{
				font-weight:bold;
				font-size:3.0em;
			}

			#notes{
				margin:auto;
				font-size:1.8em;
				width:95%;
			}

			#notes div, #notes p{
				text-align:center;
			}

			#notes-title{
				text-align:center;
				font-weight:700;
				font-size:1.35em;
				text-decoration:underline;
			}

			#notes ul{
				margin-top:0;
				margin-left:3em;
			}

			#notes .sub{
				font-size:0.8em;
			}


			#note-finish{
				font-size:1.1em;
				font-weight:bold;
			}
		</style>
	</head>
	<body>
		<div id="container">
			<div id="timer">
				<table><tr>
					<td>
						<b>Current Time</b><br /><span id="timeCurr"></span>
					</td>
					<td>
						<b>Time Remaining</b><br /><span id="timeRemaining"></span>
					</td>
				</tr></table>
			</div>
			<br /><br />
			<div id="notes">
				<div><span id="notes-title">Midterm Notes / Corrections</span></div>
				<ul>
					<li><b>Q2, 6, 11</b>: You must circle the appropriate answer.</li>
				</ul>
				<br />
				<p id="note-finish">When you're done, you can hand in your midterm up front and head on out.<br /><span class="sub">(Also, please remember to toss out your wrappers!)</span></p>
			</div>
		</div>

		<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				updateMargin();
				updateTime();
				var hold_resize = 0;

				$(window).resize(function(){
					updateMargin();
				});

				function updateTime(){
					var targetDateTime = new Date(2013, 9, 31, 10, 55, 0);
					//var targetDateTime = new Date(2013, 9, 30, 17, 45, 0);
					var currentDateTime = new Date();

					// Time Math
					var timeRemaining = (targetDateTime.getTime() - currentDateTime.getTime()) / 1000;

					if(timeRemaining >= 0){
						// Formatting
						var timeRemaining_seconds = Math.floor(timeRemaining % 60);
							timeRemaining /= 60;
						var timeRemaining_minutes = Math.floor(timeRemaining % 60);
							timeRemaining /= 60;
						var timeRemaining_hours = Math.floor(timeRemaining % 60);
							timeRemaining /= 60;

						if(timeRemaining_hours < 10)
							timeRemaining_hours = "0" + timeRemaining_hours;
						if(timeRemaining_minutes < 10)
							timeRemaining_minutes = "0" + timeRemaining_minutes;
						if(timeRemaining_seconds < 10)
							timeRemaining_seconds = "0" + timeRemaining_seconds;
					} else{
						var timeRemaining_seconds = "00";
						var timeRemaining_minutes = "00";
						var timeRemaining_hours = "00";
					}

					var currentTime_hours = currentDateTime.getHours();
					var currentTime_minutes = currentDateTime.getMinutes();
					var currentTime_seconds = currentDateTime.getSeconds();

					if(currentTime_hours > 12){
						currentTime_hours = currentTime_hours % 12;
					}
					if(currentTime_hours < 10){
						currentTime_hours = "0" + currentTime_hours;
					}
					if(currentTime_minutes < 10)
						currentTime_minutes = "0" + currentTime_minutes;
					if(currentTime_seconds < 10)
						currentTime_seconds = "0" + currentTime_seconds;

					// Display Time
			//		console.log(timeRemaining_minutes + ":" + timeRemaining_seconds);
					$('#timeCurr').text(currentTime_hours + ":" + currentTime_minutes + ":" + currentTime_seconds);
					$('#timeRemaining').text(timeRemaining_hours + ":" + timeRemaining_minutes + ":" + timeRemaining_seconds);

					if(timeRemaining * 60 * 60 * 60 <= 300){
						$('#timeRemaining').css('color', '#FFFF00');
					}

					setTimeout(function(){updateTime()}, 1000);
				}

				function updateMargin(){
					var margin = Math.ceil(($(window).height() - $('#container').height()) / 2.5);
					$('#container').css('margin-top', margin + "px");
				}
			});
		</script>
	</body>
</head>
