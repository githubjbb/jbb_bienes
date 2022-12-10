$( document ).ready( function () {

	jQuery.validator.addMethod("unCampo", function(value, element, param) {
		var activo = $('#activo').val();
		var hours = $('#hours').val();
		if ( activo == 1 && hours == "" ) {
			return false;
		}else if( activo == 2 && razon == "" ) {
			return false;
		}else if( activo == 2 && razon == 4 && cual == "" ) {
			return false;
		}else{
			return true;
		}
	}, "Debe indicar al menos un campo.");
			
	$("#hours").bloquearTexto().maxlength(10);
	$( "#form" ).validate( {
		rules: {
			activo: 			{ required: true },
			hours: 				{ unCampo: true, number: true, minlength: 1, maxlength: 10 },
			hdd_cuadro_1: 		{ required: true },
			hdd_cuadro_2: 		{ required: true },
			hdd_cuadro_3: 		{ required: true }
		},
		errorElement: "em",
		errorPlacement: function ( error, element ) {
			// Add the `help-block` class to the error element
			error.addClass( "help-block" );
			error.insertAfter( element );

		},
		highlight: function ( element, errorClass, validClass ) {
			$( element ).parents( ".col-sm-5" ).addClass( "has-error" ).removeClass( "has-success" );
		},
		unhighlight: function (element, errorClass, validClass) {
			$( element ).parents( ".col-sm-5" ).addClass( "has-success" ).removeClass( "has-error" );
		},
		submitHandler: function (form) {
			return true;
		}
	});
						
	$("#btnSubmit").click(function(){	

		grecaptcha.ready(function() {
			grecaptcha.execute('6LdTEiAgAAAAADm0QRJnFXzX9Awr51t4XuaKW7Ku', {
				action: 'validar'
			}).then(function(token) {
	
				if ($("#form").valid() == true){

						$('#form').prepend('<input type="hidden id="token" name="token" value="'+token+'">');
						$('#form').prepend('<input type="hidden id="action" name="action" value="validar">');
				
						//Activa icono guardando
						$('#btnSubmit').attr('disabled','-1');
						$("#div_load").css("display", "inline");
						$("#div_error").css("display", "none");
					
						$.ajax({
							type: "POST",	
							url: base_url + "external/save_inspection_vehiculos",	
							data: $("#form").serialize(),
							dataType: "json",
							contentType: "application/x-www-form-urlencoded;charset=UTF-8",
							cache: false,
							
							success: function(data){
		                                            
								if( data.result == "error" )
								{
									alert(data.mensaje);
									$("#div_load").css("display", "none");
									$('#btnSubmit').removeAttr('disabled');							
									
									$("#span_msj").html(data.mensaje);
									$("#div_error").css("display", "inline");
									return false;
								} 

								if( data.result )//true
								{	                                                        
									$("#div_load").css("display", "none");
									$('#btnSubmit').removeAttr('disabled');

									var url = base_url + "external/add_vehiculos_inspection/" + data.idVehicle + "/" + data.idInspection;
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
				else
				{
					alert('Faltan campos por diligenciar.');
					
				}
			});
		});
	});

	$(".btn-danger").click(function () {	
			var oID = $(this).attr("id");
			
			//Activa icono guardando
			if(window.confirm('Por favor confirmar si desea eliminar el Chequeo Preoperacional.'))
			{
					$(".btn-danger").attr('disabled','-1');
					$.ajax ({
						type: 'POST',
						url: base_url + 'equipos/delete_chequeo',
						data: {'identificador': oID},
						cache: false,
						success: function(data){
												
							if( data.result == "error" )
							{
								alert(data.mensaje);
								$(".btn-danger").removeAttr('disabled');							
								return false;
							} 
											
							if( data.result )//true
							{	                                                        
								$(".btn-danger").removeAttr('disabled');

								var url = base_url + "equipos/revision/" + data.idEquipo;
								$(location).attr("href", url);
							}
							else
							{
								alert('Error. Reload the web page.');
								$(".btn-danger").removeAttr('disabled');
							}	
						},
						error: function(result) {
							alert('Error. Reload the web page.');
							$(".btn-danger").removeAttr('disabled');
						}

					});
			}
	});

});