function valid_cuadro_1() 
{
    if(document.getElementById('licencia1').checked || document.getElementById('licencia2').checked || document.getElementById('licencia3').checked || document.getElementById('soat1').checked || document.getElementById('soat2').checked || document.getElementById('soat3').checked ){
        document.getElementById('hdd_cuadro_1').value = 1;
    }else{
        document.getElementById('hdd_cuadro_1').value = "";
    }
}

function valid_cuadro_2() 
{
    if(document.getElementById('dir_delanteras1').checked || document.getElementById('dir_delanteras2').checked || document.getElementById('dir_delanteras3').checked || document.getElementById('dir_traseras1').checked || document.getElementById('dir_traseras2').checked || document.getElementById('dir_traseras3').checked ){
        document.getElementById('hdd_cuadro_2').value = 1;
    }else{
        document.getElementById('hdd_cuadro_2').value = "";
    }
}

function valid_cuadro_3() 
{
    if(document.getElementById('luces_altas1').checked || document.getElementById('luces_altas2').checked || document.getElementById('luces_altas3').checked || document.getElementById('luces_bajas1').checked || document.getElementById('luces_bajas2').checked || document.getElementById('luces_bajas3').checked || document.getElementById('luces_stops1').checked || document.getElementById('luces_stops2').checked || document.getElementById('luces_stops3').checked 
         || document.getElementById('luces_reversa1').checked || document.getElementById('luces_reversa2').checked || document.getElementById('luces_reversa3').checked  || document.getElementById('luces_parqueo1').checked || document.getElementById('luces_parqueo2').checked || document.getElementById('luces_parqueo3').checked ){
        document.getElementById('hdd_cuadro_3').value = 1;
    }else{
        document.getElementById('hdd_cuadro_3').value = "";
    }
}