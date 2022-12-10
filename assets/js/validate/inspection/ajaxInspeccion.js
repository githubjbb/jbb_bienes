/**
 * Validaciones
 * @author bmottag
 * @since  4/05/2022
 */

$(document).ready(function () {
	
    $('#activo').change(function () {
        $('#activo option:selected').each(function () {
            var activo = $('#activo').val();
            if ((activo > 0 || activo != '') ) {
				
				$("#div_razon").css("display", "none");
                $("#div_cual").css("display", "none");
                $("#razon").val("");
                $("#cual").val("");
				if(activo==2){
                    console.log('inactivo');
                    $("#hours").val(1);
                    $("#hdd_cuadro_1").val(1);
                    $("#hdd_cuadro_2").val(1);
                    $("#hdd_cuadro_3").val(1);

					$("#div_razon").css("display", "inline");
                    $("#div_kilometros").css("display", "none");
                    $("#div_second_box").css("display", "none");
                    $("#div_third_box").css("display", "none");
                    $("#div_fourth_box").css("display", "none");
                    $("#div_fifth_box").css("display", "none");
                    $("#div_sixth_box").css("display", "none");
                    $("#div_seventh_box").css("display", "none");
                    $("#div_eighth_box").css("display", "none");
				}else if(activo==1){
                    console.log('encuesta');
                    $("#div_razon").css("display", "none");
                    $("#div_kilometros").css("display", "inline");
                    $("#div_second_box").css("display", "inline");
                    $("#div_third_box").css("display", "inline");
                    $("#div_fourth_box").css("display", "inline");
                    $("#div_fifth_box").css("display", "inline");
                    $("#div_sixth_box").css("display", "inline");
                    $("#div_seventh_box").css("display", "inline");
                    $("#div_eighth_box").css("display", "inline");
                }
            }
        });
    });

    $('#razon').change(function () {
        $('#razon option:selected').each(function () {
            var razon = $('#razon').val();
            if ((razon > 0 || razon != '') ) {
                $("#div_cual").css("display", "none");
                $("#cual").val("");
                if(razon==4){
                    $("#div_cual").css("display", "inline");
                }
            }
        });
    });

    $('#id_conductor').change(function () {
        $('#id_conductor option:selected').each(function () {
            var conductor = $('#id_conductor').val();
            if (conductor > 0 || conductor != '') {
                $.ajax ({
                    type: 'POST',
                    url: base_url + 'external/infoConductor',
                    data: {'conductor': conductor},
                    cache: false,
                    success: function (data)
                    {
                        $('#numero_identificacion').html(data);
                    }
                });
            } else {
                var data = '';
                $("#numero_identificacion").html(data);
            }
        });
    });

    
});