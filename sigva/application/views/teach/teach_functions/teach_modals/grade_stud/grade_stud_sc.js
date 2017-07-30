$(document).ready(function(){

		$('input').change(function(e){

			var sub_g = 0;
			var pr = $('#pr').val();
			var md = $('#md').val();
			var pf = $('#pf').val();
			var f = $('#f').val();

			sub_g = (pr * .20) + (md * .20) + (pf * .20) + (f * .40);

			$('#s_g').val(Math.round(sub_g));


			if (sub_g < 74) {

				$('#sub_eq').val("5.00");
			}
			else if( (sub_g > 74) && (sub_g < 77) ){

				$('#sub_eq').val("3.00");
			}
			else if( (sub_g > 76) && (sub_g < 80) ){

				$('#sub_eq').val("2.75");
			}
			else if( (sub_g > 79) && (sub_g < 83) ){

				$('#sub_eq').val("2.50");

			}
			else if( (sub_g > 82) && (sub_g < 86) ){

				$('#sub_eq').val("2.25");

			}
			else if( (sub_g > 85) && (sub_g < 89) ){

				$('#sub_eq').val("2.00");

			}
			else if( (sub_g > 88) && (sub_g < 92) ){

				$('#sub_eq').val("1.75");

			}
			else if( (sub_g > 91) && (sub_g < 95) ){

				$('#sub_eq').val("1.50");

			}
			else if( (sub_g > 94) && (sub_g < 98) ){

				$('#sub_eq').val("1.25");

			}
			else if( (sub_g > 97) && (sub_g < 101) ){

				$('#sub_eq').val("1.00");

			}
			else{

				$('#sub_eq').val("0.00");
			}

		});

	});