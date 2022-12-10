$( document ).ready( function () {

	$("#Kilometraje").bloquearTexto().maxlength(7);
	$("#valor_x_galon").bloquearTexto().maxlength(7);
	
	$( "#formConsumo" ).validate( {
		rules: {
			valor_x_galon:		 		{ required: true, minlength: 3, maxlength: 7 },
			cantidad:					{ required: true, maxlength: 20 },
			Kilometraje: 				{ required: true, minlength: 2, maxlength:7 },
		},
		errorElement: "em",
		errorPlacement: function ( error, element ) {
			// Add the `help-block` class to the error element
			error.addClass( "help-block" );
			error.insertAfter( element );

		},
		highlight: function ( element, errorClass, validClass ) {
			$( element ).parents( ".col-sm-6" ).addClass( "has-error" ).removeClass( "has-success" );
		},
		unhighlight: function (element, errorClass, validClass) {
			$( element ).parents( ".col-sm-6" ).addClass( "has-success" ).removeClass( "has-error" );
		},
		submitHandler: function (form) {
			return true;
		}
	});
	
	$("#btnSubmitConsumo").click(function(){		
	
		if ($("#formConsumo").valid() == true){
		
				//Activa icono guardando
				$('#btnSubmitConsumo').attr('disabled','-1');
				$("#div_error").css("display", "none");
				$("#div_load").css("display", "inline");
			
				$.ajax({
					type: "POST",	
					url: base_url + "equipos/guardar_consumo",	
					data: $("#formConsumo").serialize(),
					dataType: "json",
					contentType: "application/x-www-form-urlencoded;charset=UTF-8",
					cache: false,
					
					success: function(data){
                                            
						if( data.result == "error" )
						{
							$("#div_load").css("display", "none");
							$('#btnSubmitConsumo').removeAttr('disabled');							
							return false;
						} 

						if( data.result )//true
						{	                                                        
							$("#div_load").css("display", "none");
							$('#btnSubmitConsumo').removeAttr('disabled');

							var url = base_url + "equipos/consumos/" + data.idRecord;
							$(location).attr("href", url);
						}
						else
						{
							alert('Error. Reload the web page.');
							$("#div_load").css("display", "none");
							$("#div_error").css("display", "inline");
							$('#btnSubmitConsumo').removeAttr('disabled');
						}	
					},
					error: function(result) {
						alert('Error. Reload the web page.');
						$("#div_load").css("display", "none");
						$("#div_error").css("display", "inline");
						$('#btnSubmitConsumo').removeAttr('disabled');
					}
					
		
				});	
		
		}//if			
	});
});