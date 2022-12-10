$( document ).ready( function () {
	
	jQuery.validator.addMethod("campoTo", function(value, element, param) {
		var to = $('#to').val();
		if ( to != "" && value == "" ) {
			return false;
		}else{
			return true;
		}
	}, "This field is required.");
	
	jQuery.validator.addMethod("campoFrom", function(value, element, param) {
		var from = $('#from').val();
		if ( from != "" && value == "" ) {
			return false;
		}else{
			return true;
		}
	}, "This field is required.");
	
	jQuery.validator.addMethod("unCampo", function(value, element, param) {
		var id_tipo_equipo = $('#id_tipo_equipo').val();
		var idEquipo = $('#idEquipo').val();
		var OTNumber = $('#OTNumber').val();
		var estado = $('#estado').val();
		var from = $('#from').val();
		var to = $('#to').val();

		if ( id_tipo_equipo == "" && idEquipo == "" && OTNumber == "" && estado == "" && from == "" && to == "") {
			return false;
		}else{
			return true;
		}
	}, "Seleccione por lo menos una opción.");

	$("#OTNumber").bloquearTexto().maxlength(10);

	$( "#form" ).validate( {
		rules: {
			id_tipo_equipo:		{ unCampo: true },
			idEquipo:			{ unCampo: true },
			OTNumber:			{ unCampo: true, number: true, maxlength: 10 },
			estado:				{ unCampo: true },
			from: 				{ campoTo: "#to", unCampo: true },
			to: 				{ campoFrom: "#from", unCampo: true }
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
		if ($("#form").valid() == true){
			var form = document.getElementById('form');
			form.submit();	
		}else
		{
			//alert('Error.');
		}
	});

});