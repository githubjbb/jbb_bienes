$( document ).ready( function () {
	
	$("#placa").convertirMayuscula().maxlength(8);
	$("#color").bloquearNumeros().maxlength(20);
	$("#numero_puertas").bloquearTexto().maxlength(5);
	$("#numero_ocupantes").bloquearTexto().maxlength(5);
	
	$( "#form" ).validate( {
		rules: {
			dimensiones: 					{ minlength: 4, maxlength:20 },
			linea: 							{ maxlength: 20 },
			color: 							{ maxlength: 20 },
			capacidad: 						{ maxlength: 20 },
			servicio: 						{ maxlength: 20 },
			numero_motor: 					{ maxlength: 25 },
			numero_chasis: 					{ minlength: 4, maxlength:30 },
			codigo_gps: 					{ minlength: 4, maxlength:20 },
			codigo_ship: 					{ minlength: 4, maxlength:30 },
			numero_puertas: 				{ maxlength:5 },
			numero_ocupantes: 				{ maxlength:5 },
			cilindraje: 					{ maxlength:15 }
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
	
	$("#btnSubmit").click(function(){		
	
		if ($("#form").valid() == true){
		
				//Activa icono guardando
				$('#btnSubmit').attr('disabled','-1');
				$("#div_error").css("display", "none");
				$("#div_load").css("display", "inline");
			
				$.ajax({
					type: "POST",	
					url: base_url + "equipos/guardar_info_especifica",	
					data: $("#form").serialize(),
					dataType: "json",
					contentType: "application/x-www-form-urlencoded;charset=UTF-8",
					cache: false,
					
					success: function(data){
                                            
						if( data.result == "error" )
						{
							$("#div_load").css("display", "none");
							$('#btnSubmit').removeAttr('disabled');							
							return false;
						} 

						if( data.result )//true
						{	                                                        
							$("#div_load").css("display", "none");
							$('#btnSubmit').removeAttr('disabled');

							var url = base_url + "equipos/especifico/" + data.idRecord;
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
		
		}//if			
	});
});