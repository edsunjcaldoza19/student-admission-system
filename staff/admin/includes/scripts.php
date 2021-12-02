 <!-- Jquery Core Js -->
 <script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap Core Js -->
<script src="../../plugins/bootstrap/js/bootstrap.js"></script>
<!-- Slimscroll Plugin Js -->
<script src="../../plugins/jquery-slimscroll/jquery.slimscroll.js"></script>
<!-- Waves Effect Plugin Js -->
<script src="../../plugins/node-waves/waves.js"></script>

<script>

	//auto logout on idle script//

		var maxIdle = 25; //log the user out after 25 minutes of inactivity
		var idleTime = 0;

		var idleInterval = setInterval("incrementTimer()", 60000);
		$("body").mousemove(function(event){
			idleTime = 0;
		})

		//increment idle time every minute

		function incrementTimer(){
			idleTime = idleTime + 1;
			if(idleTime > maxIdle){
				alert("[WARNING]: You've been logged-out due to inactivity. Please login again");
				window.location = "be/logout.php" ;
			}
		}

</script>
