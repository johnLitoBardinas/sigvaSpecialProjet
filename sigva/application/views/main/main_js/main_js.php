<script type="text/javascript">

    //checking if jquery not working

        /*window.onload = function() {
            if (window.jQuery) {  
                // jQuery is loaded  
                alert("Yeah!");
            } else {
                // jQuery is not loaded
                alert("Doesn't Work");
            }
        };*/

        function acad_page(){

            /*
                base_url = walang index sa url
                site_url = merong index dun sa url
            */
            location.href = "<?php echo site_url()?>academic";
        }

        function registrar_page(){

            location.href = "<?php echo site_url()?>registrar";

            //8/30/2016
            //alert('HS');
        }

        function teach_page(){

            location.href = "<?php echo site_url()?>teacher";

            /* date_started: unknown*/
            /* date_finished: unknown*/
        }

        
        function stud(){
            
            location.href = "<?php echo site_url()?>student";

            /* date_started: 10/3/2016 */
            /* date_finished: */
        }

    </script>
</body>
</html>