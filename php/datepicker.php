<!-- date picker-->
         <meta charset="utf-8">
		<title>jQuery UI Datepicker - Default functionality</title>
		<link rel="stylesheet" href="js/datepicker/jquery-ui.css">
		<script src="js/datepicker/jquery-1.10.2.js"></script>
		<script src="js/datepicker/jquery-ui.js"></script>
		<link rel="stylesheet" href="js/datepicker/style.css">
		<script>
		/*	$(function() {
			$( "#datepicker" ).datepicker();
			});*/

			$(function() {
			      var elem = document.createElement('input');
			      elem.setAttribute('type', 'date');

			      if ( elem.type === 'text' ) {
			    //     $('#date').datepicker();
			        // $( "#datepicker" ).datepicker();
			         $('#datepicker').datepicker({
					   dateFormat: 'yy-mm-dd'
					});
			      }
		   	})();
		</script>
		<!-- date picker-->