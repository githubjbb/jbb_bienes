/**
 * Validaciones
 * @author bmottag
 * @since  4/05/2022
 */

$(document).ready(function () {
	
    $('#id_equipo').change(function () {
        $('#id_equipo option:selected').each(function () {
            var equipo = $('#id_equipo').val();
            if (equipo > 0 || equipo != '') {
                $.ajax ({
                    type: 'POST',
                    url: base_url + 'external/infoEquipo',
                    data: {'equipo': equipo},
                    cache: false,
                    success: function (data)
                    {
                        $('#info_equipo').html(data);
                    }
                });
            } else {
                var data = '';
                $("#info_equipo").html(data);
            }
        });
    });

    
});