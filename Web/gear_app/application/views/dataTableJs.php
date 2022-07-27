<?php
$plength=5;
if(!empty($datatablepagelength))
{
	$plength=$datatablepagelength;
}
?>
<!-- DataTables -->
<script src="<?php echo $baseurl;?>/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo $baseurl;?>/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<script src="<?php echo $baseurl;?>/bower_components/datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
<script src="<?php echo $baseurl;?>/bower_components/datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
<script src="<?php echo $baseurl;?>/bower_components/cloudfare/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="<?php echo $baseurl;?>/bower_components/cloudfare/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
<script src="<?php echo $baseurl;?>/bower_components/cloudfare/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
<script src="<?php echo $baseurl;?>/bower_components/datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
<script src="<?php echo $baseurl;?>/bower_components/datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>

<script>
var table=$('#example1').dataTable( {
  "pageLength": <?=$plength;?>,
   "bLengthChange": false,
   "order": [],
   "bFilter": false,
   "dom": 'Bfrtip',
        "buttons": [
             /*'csv',*/
              'excel',
              /* 'pdf', 'print'*/
        ],
        "drawCallback": function( settings ) {
       
        var api = this.api();

        /*Hide datatable when there is no data*/
        if(api.rows( {page:'current'} ).data().length==0)
        {
        	$('.buttons-excel').css( 'display', 'none' );
        }
        

    }
     
      

} );




</script>
