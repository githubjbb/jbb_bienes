function valid_cuadro_1() 
{
    if(document.getElementById('amabilidad1').checked || document.getElementById('amabilidad2').checked || document.getElementById('amabilidad3').checked || document.getElementById('amabilidad4').checked || document.getElementById('presentacion1').checked || document.getElementById('presentacion2').checked || document.getElementById('presentacion3').checked || document.getElementById('presentacion4').checked ){
        document.getElementById('hdd_cuadro_1').value = 1;
    }else{
        document.getElementById('hdd_cuadro_1').value = "";
    }
}

function valid_cuadro_2() 
{
    if(document.getElementById('limpieza1').checked || document.getElementById('limpieza2').checked || document.getElementById('limpieza3').checked || document.getElementById('limpieza4').checked || document.getElementById('calidad1').checked || document.getElementById('calidad2').checked || document.getElementById('calidad3').checked || document.getElementById('calidad4').checked ){
        document.getElementById('hdd_cuadro_2').value = 1;
    }else{
        document.getElementById('hdd_cuadro_2').value = "";
    }
}