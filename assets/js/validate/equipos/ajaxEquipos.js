/**
 * Cities by country
 * @author bmottag
 * @since  9/7/2021
 */

$(document).ready(function () {
	   
    $('#idTipoEquipo').change(function () {
        $('#idTipoEquipo option:selected').each(function () {
            var idTipoEquipo = $('#idTipoEquipo').val();
            if (idTipoEquipo > 0 || idTipoEquipo != '') {
				$("#div_equipo").css("display", "inline");
				
                $.ajax ({
                    type: 'POST',
                    url: base_url + 'equipos/listaEquiposInfo',
                    data: {'idTipoEquipo': idTipoEquipo},
                    cache: false,
                    success: function (data)
                    {
                        $('#idEquipo').html(data);
                    }
                });
            } else {				
                var data = '';
				$("#div_equipo").css("display", "none");
                $('#idEquipo').html(data);
            }
        });
    });

    $('#idTipoEquipoSearch').change(function () {
        $('#idTipoEquipoSearch option:selected').each(function () {
            var idTipoEquipo = $('#idTipoEquipoSearch').val();
            if (idTipoEquipo > 0 || idTipoEquipo != '') {
                $("#div_equipo").css("display", "inline");
                
                $.ajax ({
                    type: 'POST',
                    url: base_url + 'equipos/listaEquiposInfo',
                    data: {'idTipoEquipo': idTipoEquipo},
                    cache: false,
                    success: function (data)
                    {
                        $('#idEquipoSearch').html(data);
                    }
                });
            } else {                
                var data = '';
                $("#div_equipo").css("display", "none");
                $('#idEquipoSearch').html(data);
            }
        });
    });
    
});