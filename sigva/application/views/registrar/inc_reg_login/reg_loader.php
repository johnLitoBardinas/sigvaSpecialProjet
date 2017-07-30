<script type="text/javascript">
		
	/* pag nag load na di body dapat mauda na o ma hide na so loading*/
	$(document).ready(function(){

		setTimeout(show_loading, 1600);
		function show_loading(){

			$("#modal").hide();
			$("#registrar_login").show();
			
		}			
		$("#modal").show();
		$("#registrar_login").hide();

		document.body.style.backgroundColor = "#f2f3ea";
	});

</script>