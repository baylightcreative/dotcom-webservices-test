<html>
<head>
	<title>Form Test</title>
	<script src="/api/public/js/jquery.js" type="text/javascript"></script>
</head>
<body>
	<form id="test" action="sendForm" method="post">
		<input type="text" name="name" value="" placeholder="">
		<input type="submit" name="submit" value="Submit">
	</form>
	<script type="text/javascript">
		$(document).ready(function(){
			$.getJSON("/api/index.php/form/get_authToken", function(data) {
					$("form#test").append('<input type="hidden" name="authToken" value="' + data.authToken + '">');
			});
		});
	</script>
</body>
</html>