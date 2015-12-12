<!DOCTYPE html>
<html>
	<title>Datatable CodeIgniter</title>
	<head>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/jquery.dataTables.css">
		<style>
			div.container {
				padding: 20px;
				border-radius: 10px;
				background-color: #fff;
				box-shadow: 0px 0px 10px rgba(0,0,0,0.2);
			    margin: 0 auto;
			    max-width:760px;
			}
			div.header {
			    margin: 40px auto;
			    line-height:30px;
			    max-width:760px;
			    text-align: center;
			    text-transform: uppercase;
			}
			body {
			    background: #eee;
			    color: #333;
			    font: 90%/1.45em "Helvetica Neue",HelveticaNeue,Verdana,Arial,Helvetica,sans-serif;
			}
		</style>
	</head>
	<body>
		<div class="header"><h1>DataTable (Server side) CodeIgniter</h1></div>
		<div class="container">
			<table id="employee-grid"  cellpadding="0" cellspacing="0" border="0" class="display" width="100%">
					<thead>
						<tr>
							<th>Employee name</th>
							<th>Salary</th>
							<th>Age</th>
						</tr>
					</thead>
			</table>
		</div>
	</body>

	<script type="text/javascript" language="javascript" src="<?php echo base_url() ?>assets/js/jquery.js"></script>
		<script type="text/javascript" language="javascript" src="<?php echo base_url() ?>assets/js/jquery.dataTables.js"></script>
		<script type="text/javascript" language="javascript" >
			$(document).ready(function() {
				var dataTable = $('#employee-grid').DataTable( {
					"processing": true,
					"serverSide": true,
					"ajax":{
						url : "<?php echo site_url('home/datatable_data') ?>", // json datasource
						type: "post",  // method  , by default get
						error: function(e){  // error handling
							$(".employee-grid-error").html("");
							$("#employee-grid").append('<tbody class="employee-grid-error"><tr><th colspan="3">Sorry, Something is wrong</th></tr></tbody>');
							$("#employee-grid_processing").css("display","none");							
						}
					}
				} );
			} );
		</script>
</html>
