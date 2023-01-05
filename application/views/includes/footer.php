	<script>
		function isValid(data) {
			if(data != "" && data != null && data != undefined) return true;
			else return false;
		}

		function clearFormData(form) {
			$('#'+form+' input').val('');
		}
	</script>

</body>
</html>