	<form method="POST" id="my_table" action="<?php echo site_url('teacher/post_Table_data') ?>">
	<table border="1" class="table table-bordered" cellspacing="0" width="100%"> 
		<thead>
			
			<tr>
				<th> Student Name </th>
				<th> Prelim </th>
	            <th> Midterm </th>
	            <th> Pre-Finals </th>
	            <th> Finals </th>
	            <th> Subject Grade </th>
	            <th> Equivalent </th>
	            <th> Remarks </th>
			</tr>
		</thead>

		<tbody>
			
		</tbody>
	</table>

		<!-- all magic belongs here -->
		<input type="hidden" name="out_put" id="out_put"></input>
		<input class="btn btn-md btn-success save_snd" dir="rtl"  type="submit" value="Save" />
	</form>

<script type="text/javascript">
	
	$(document).ready(function(){


		$('#my_table').on('submit', function(e){

			e.preventDefault();
			var result = [];

			var pr_array = $('td>input#pr').map(function(){
				return $(this).val();
			}).get(); 

			
			var md_array = $('td>input#md').map(function(){
				return $(this).val();
			}).get(); 


			var pf_array = $('td>input#pf').map(function(){
				return $(this).val();
			}).get(); 


			var f_array = $('td>input#f').map(function(){
				return $(this).val();
			}).get(); 


			var sub_g_array = $('input#s_g').map(function(){
				return $(this).val();
			}).get(); 


			var sub_eq_array = $('input#sub_eq').map(function(){
				return $(this).val();
			}).get(); 

			var rmks = $('input#remarks').map(function(){
				return $(this).val();
			}).get(); 


			/* each grade id in table */
			var grade_id = $('input#grade_id').map(function(){
				return $(this).val();
			}).get(); 


			var obj = {

				grade_id:0,
				pr_g:0,
				md_g:0,
				pf_g:0,
				f_g:0,
				s_g:0,
				sub_eq:0.00,
				remarks:""

			};

			/* do the magic of json*/
			var ctr = $('input#grade_id').length;
			for (var i = 0; i < ctr; i= i + 1){
				
				obj = {

				grade_id:grade_id[i],
				pr_g:pr_array[i],
				md_g:md_array[i],
				pf_g:pf_array[i],
				f_g:f_array[i],
				s_g:sub_g_array[i],
				sub_eq:sub_eq_array[i],
				remarks:rmks[i]
				};

				result.push(obj);
			}

			//console.log(result);

			//var json_controller = JSON.stringify(result);

			//console.log(json_controller);

			$('input[name="out_put"]').val(JSON.stringify(result));

			var url = "<?php echo site_url('teacher/post_Table_data') ?>";

			var data = $('form#my_table').serialize();
			var cb = function(response){

				alert(response);
			};
			$.post(url, data, cb);

		});


		$('tbody').on('change', 'tr > td > input[type="number"]', function(e){

			e.preventDefault();

			var pr = $(this).closest('tr').find('td>input#pr').val();
			var md = $(this).closest('tr').find('td>input#md').val();
			var pf = $(this).closest('tr').find('td>input#pf').val();
			var f = $(this).closest('tr').find('td>input#f').val();
			/* how to get the individual input fields */

			//console.log(" prelim: " + pr + " midterm: " + md + " prefi: " + pf + " final: " + f);

			var graderade = (pr * .20) + (md * .20) + (pf * .20) + (f * .40);
			$(this).closest('tr').find('td > input#s_g').val(Math.round(graderade));

			$(this).closest('tr').find('td > input#sub_eq').val(compute_eq(graderade));


		});

		//$('td > input').on('change', 'input', );



		/*ajax nalang dapat so pag butang ka mga tr sa e table */
		$.ajax({

			url:"<?php echo site_url('teacher/ajax_get_student_grades') ?>",
			dataType:"JSON",
			success:function(data){

				/* if the datatype is expecting a JSON data it will automatically convert it to javascript object */
				console.log(data);

				/*var f_res = $.parseJSON(data);

				console.log */

				
				$.each(data, function(row, val){
				
				var html = "<tr>";

					html += "<input type='hidden' id='grade_id' value='"+val.grade_id+"'/>";

					html += "<td> <input type='text' readonly='true' id='stud_name' value='"+val.stud_name+"' style='width: 215px;'/></td>";

					html += "<td> <input type='number' id='pr' value='"+val.pr_g+"'/></td>";

					html += "<td> <input type='number' id='md' value='"+val.md_g+"'/></td>";

					html += "<td> <input type='number' id='pf' value='"+val.pf_g+"'/></td>";

					html += "<td> <input type='number' id='f' value='"+val.f_g+"'/></td>";

					html += "<td> <input readonly='true' type='number' id='s_g' value='"+val.sub_g+"'/></td>";

					html += "<td> <input readonly='true' type='number' id='sub_eq' value='"+val.eq+"'/></td>";

					html += "<td> <input type='text' id='remarks' value='"+val.remarks+"'/></td>";


					//alert(row + ": "+ val.grade_id);
				html  += "</tr>";
				$('tbody').append(html);	
				});
				

				

				//console.log(html);*/
			}, 

			error:function(jqXHR, textStatus, errorThrown){

				alert(textStatus + " Message: " + errorThrown);
			}
		});

	});


	/* sample function to compute the equvallient grade of the grade according to the sti college naga criteria */

	function compute_eq(grade){
		var final_grade;

		if (grade < 74) {

				final_grade = "5.00";
			}
			else if( (grade > 74) && (grade < 77) ){

				final_grade = "3.00";
			}
			else if( (grade > 76) && (grade < 80) ){

				final_grade = "2.75";
			}
			else if( (grade > 79) && (grade < 83) ){

				final_grade = "2.50";

			}
			else if( (grade > 82) && (grade < 86) ){

				final_grade = "2.25";

			}
			else if( (grade > 85) && (grade < 89) ){

				final_grade = "2.00";

			}
			else if( (grade > 88) && (grade < 92) ){

				final_grade = "1.75";

			}
			else if( (grade > 91) && (grade < 95) ){

				final_grade = "1.50";

			}
			else if( (grade > 94) && (grade < 98) ){

				final_grade = "1.25";

			}
			else if( (grade > 97) && (grade < 101) ){

				final_grade = "1.00";

			}
			else{

				final_grade = "0.00";
			}

		return final_grade;

	}

</script>