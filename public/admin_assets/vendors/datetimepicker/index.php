<!DOCTYPE html>
<html>
<head>
	<title>DatetimePicker</title>
	<link rel="stylesheet" type="text/css" href="http://juegosdigitalesvenezuela.com/files/admin/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap-datetimepicker.min">
</head>
<body>
	<div class="well">
	  <div id="datetimepicker1" class="input-append date">
	    <input data-format="dd/MM/yyyy hh:mm:ss" type="text"></input>
	    <span class="add-on">
	      <i data-time-icon="icon-time" data-date-icon="icon-calendar">
	      </i>
	    </span>
	  </div>
	</div>
	<script src="http://juegosdigitalesvenezuela.com/files/admin/js/jquery.min.1.11.2.js" type="text/javascript"></script>
	<script src="js/bootstrap-datetimepicker.min" type="text/javascript"></script>
	<script type="text/javascript">
	  $(function() {
	    $('#datetimepicker1').datetimepicker({
	      language: 'pt-BR'
	    });
	  });
	</script>
</body>
</html>