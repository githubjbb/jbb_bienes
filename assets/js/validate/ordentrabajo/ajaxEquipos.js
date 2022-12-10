/**
 * Trucks´list by company
 * @author bmottag
 * @since  12/12/2016
 */

$(document).ready(function () {
	
    $('#id_tipo_equipo').change(function () {
        $('#id_tipo_equipo option:selected').each(function () {
            var idTipoEquipo = $('#id_tipo_equipo').val();
            if ((idTipoEquipo > 0 || idTipoEquipo != '') ) {
							
                $.ajax ({
                    type: 'POST',
                    url: base_url + 'ordentrabajo/listaEquipos',
                    data: {'idTipoEquipo': idTipoEquipo},
                    cache: false,
                    success: function (data)
                    {
                        $('#idEquipo').html(data);
                    }
                });
            } else {
                var data = '';
                $('#idEquipo').html(data);
            }
        });
    });
    
    $('#company').change(function () {
        $('#company option:selected').each(function () {
            var company = $('#company').val();
            if (company > 0 || company != '-') {
                $.ajax ({
                    type: 'POST',
                    url: base_url + 'hauling/truckList',
                    data: {'identificador': company},
                    cache: false,
                    success: function (data)
                    {
                        $('#truck').html(data);
                    }
                });
            } else {
                var data = '';
                $('#truck').html(data);
            }
        });
    });
    
});