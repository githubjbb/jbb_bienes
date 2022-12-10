$( document ).ready( function () {
	
	$( "#form" ).validate( {
		rules: {
			descripcion: 	{ required: true, minlength: 3, maxlength:5000 },
			consideracion: 	{ required: true, minlength: 3, maxlength:5000 }
		},
		errorElement: "em",
		errorPlacement: function ( error, element ) {
			error.addClass( "help-block" );
			error.insertAfter( element );
		},
		highlight: function ( element, errorClass, validClass ) {
			$( element ).parents( ".col-sm-12" ).addClass( "has-error" ).removeClass( "has-success" );
		},
		unhighlight: function (element, errorClass, validClass) {
			$( element ).parents( ".col-sm-12" ).addClass( "has-success" ).removeClass( "has-error" );
		},
		submitHandler: function (form) {
			return true;
		}
	});
	
	$("#btnSubmit").click(function(){		
		if ($("#form").valid() == true){
			$('#btnSubmit').attr('disabled','-1');
			$("#div_error").css("display", "none");
			$("#div_load").css("display", "inline");
			$.ajax({
				type: "POST",	
				url: base_url + "mantenimiento/guardar_correctivo",
				data: $("#form").serialize(),
				dataType: "json",
				contentType: "application/x-www-form-urlencoded;charset=UTF-8",
				cache: false,
				success: function(data) {
					if( data.result == "error" )
					{
						$("#div_load").css("display", "none");
						$("#div_error").css("display", "inline");
						$("#span_msj").html(data.mensaje);
						$('#btnSubmit').removeAttr('disabled');
						return false;
					} 
					if( data.result )
					{	                                                        
						$("#div_load").css("display", "none");
						$('#btnSubmit').removeAttr('disabled');
						var url = base_url + "mantenimiento/correctivo/" + data.idRecord;
						$(location).attr("href", url);
					}
					else
					{
						alert('Error. Reload the web page.');
						$("#div_load").css("display", "none");
						$("#div_error").css("display", "inline");
						$('#btnSubmit').removeAttr('disabled');
					}	
				},
				error: function(result) {
					alert('Error. Reload the web page.');
					$("#div_load").css("display", "none");
					$("#div_error").css("display", "inline");
					$('#btnSubmit').removeAttr('disabled');
				}
			});
		}
	});
});