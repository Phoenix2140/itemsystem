$(document).ready(function() {
	$("#l-login-btn").click(function(event) {
		event.preventDefault();
		
		var user =   $("#l-ususario").val();
		var passwd = $("#l-passwd").val();

		$.ajax({
		  url: '',
		  type: 'POST',
		  dataType: 'json',
		  data: { 'l-ususario': user, 'l-passwd': passwd},
		  success: function(data) {
		    if(data.response) {
		    	window.location.replace(data.link);
		    }else{
		    	var str = "";
		    	str = alertMsg('danger', 'Ha ocurrido un <strong>error</strong>, el usuario y/o contraseña no existe o es inválido.');
		    	$("#l-msg").html(str);
		    };
		  }
		});
		
	});

	function alertMsg(tipo, texto){
		var str = '<div class="alert alert-'+tipo+'"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'+texto+'</div>';
		return str;
	}
});