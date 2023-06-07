$(function(){

    //funciones para controlar el tiempo

    var tiempoRestante = 180; // 3 minutos en segundos
    var interval=null;

    function actualizarTiempo() {
        var minutos = Math.floor(tiempoRestante / 60);
        var segundos = tiempoRestante % 60;
        document.getElementById('tiempo').innerText = minutos + ":" + segundos.toString().padStart(2, '0');
    }

    function iniciarCuentaRegresiva() {
        interval = setInterval(function() {
            tiempoRestante--;
            actualizarTiempo();
            if (tiempoRestante <= 0) {
                clearInterval(interval);
            }

            var valorPuntuacionRojo = parseInt(puntuacionRojo.innerHTML);
            var valorPuntuacionAzul = parseInt(puntuacionAzul.innerHTML);
  
            // Calcular la diferencia entre los valores
            var diferencia = valorPuntuacionRojo - valorPuntuacionAzul;
            console.log(diferencia)
            // Verificar si la diferencia es mayor o igual a 8 o menor a -8
            if (diferencia >= 8 || diferencia <= -8) {
                // Detener el tiempo
                clearInterval(interval);

                parpadearElementos(diferencia);
                // alert("Tiempo detenido");
            }
        }, 1000);
    }
    var parpadeoInterval = null; // Variable global para almacenar el intervalo de parpadeo
    function parpadearElementos(diferencia) {
        var div1 = document.getElementById("tiempo");   
        if (diferencia>0){
            parpadeoInterval = setInterval(function() {
                div1.style.visibility = (div1.style.visibility === 'visible') ? 'hidden' : 'visible';
                puntuacionRojo.style.visibility = (puntuacionRojo.style.visibility === 'visible') ? 'hidden' : 'visible';
            }, 500); // Cambiar el parpadeo cada 0.5 segundos (puedes ajustar el intervalo según tus necesidades)
        }
        else{
            parpadeoInterval = setInterval(function() {
                div1.style.visibility = (div1.style.visibility === 'visible') ? 'hidden' : 'visible';
                puntuacionAzul.style.visibility = (puntuacionAzul.style.visibility === 'visible') ? 'hidden' : 'visible';
            }, 500); // Cambiar el parpadeo cada 0.5 segundos (puedes ajustar el intervalo según tus necesidades)
        }
    }

    $('#iniciar').click(function() {
        if (!interval) {
            iniciarCuentaRegresiva();
        }
        $(this).prop('disabled', true);
    });

    $('#parar').click(function() {
        clearInterval(interval);
        interval = null;
        // actualizarTiempo();
        $('#iniciar').prop('disabled', false);
    });

    $('#restar').click(function() {
        tiempoRestante -= 5;
        if (tiempoRestante < 0) {
            tiempoRestante = 0;
        }
        actualizarTiempo();
    });

    $('#reiniciar').click(function() {
        console.log("EE");
        tiempoRestante = 180;
        actualizarTiempo();
        detenerParpadeo();
        $('input[type="checkbox"]:checked').prop('checked', false);

    });

    function detenerParpadeo() {
        clearInterval(parpadeoInterval); // Detener el intervalo de parpadeo
        tiempoRestante = 180;
        actualizarTiempo();
        puntuacionRojo.innerHTML = 0;
        puntuacionAzul.innerHTML = 0;
        $('#tiempo').css('visibility', 'visible');
        $('#puntosRojo').css('visibility', 'visible');
        $('#puntosAzul').css('visibility', 'visible');

    }

    $('#sumar').click(function() {
        tiempoRestante += 5;
        if (tiempoRestante > 180){
            tiempoRestante=180
        }
        actualizarTiempo();
    });

    // Al cargar la página, actualiza el tiempo inicial
    actualizarTiempo();

    //funciones para controlar los puntos

    var rojoMas1=$('#1Rojo');
    var rojoMas2=$('#2Rojo');
    var rojoMas3=$('#3Rojo');
    var rojoMenos1=$('#1MenosRojo');
    var rojoMenos2=$('#2MenosRojo');
    var rojoMenos3=$('#3MenosRojo');
    var azulMas1=$('#1Azul');
    var azulMas2=$('#2Azul');
    var azulMas3=$('#3Azul');
    var azulMenos1=$('#1MenosAzul');
    var azulMenos2=$('#2MenosAzul');
    var azulMenos3=$('#3MenosAzul');
    var puntuacionRojo=document.getElementById("puntosRojo");
    var puntuacionAzul=document.getElementById("puntosAzul");



    rojoMas1.click(function(){
        sumarPuntosRojo(1)
    })
    rojoMas2.click(function(){
        sumarPuntosRojo(2)
    })
    rojoMas3.click(function(){
        sumarPuntosRojo(3)
    })
    rojoMenos1.click(function(){
        restarPuntosRojo(1)
    })
    rojoMenos2.click(function(){
        restarPuntosRojo(2)
    })
    rojoMenos3.click(function(){
        restarPuntosRojo(3)
    })

    azulMas1.click(function(){
        sumarPuntosAzul(1)
    })
    azulMas2.click(function(){
        sumarPuntosAzul(2)
    })
    azulMas3.click(function(){
        sumarPuntosAzul(3)
    })
    azulMenos1.click(function(){
        restarPuntosAzul(1)
    })
    azulMenos2.click(function(){
        restarPuntosAzul(2)
    })
    azulMenos3.click(function(){
        restarPuntosAzul(3)
    })

    function sumarPuntosRojo(puntos) {
        var puntosActuales = parseInt(puntuacionRojo.innerHTML);
        var nuevosPuntos = puntosActuales + puntos;
        puntuacionRojo.innerHTML = nuevosPuntos;
    }
    
    function restarPuntosRojo(puntos) {
        var puntosActualesRojo = parseInt(puntuacionRojo.innerHTML);
        var nuevosPuntosRojo = puntosActualesRojo - puntos;
        if (nuevosPuntosRojo<0){
            nuevosPuntosRojo=0;
        }
        puntuacionRojo.innerHTML = nuevosPuntosRojo;
    }

    function sumarPuntosAzul(puntos) {
        var puntosActualesAzul = parseInt(puntuacionAzul.innerHTML);
        var nuevosPuntosAzul = puntosActualesAzul + puntos;
        puntuacionAzul.innerHTML = nuevosPuntosAzul;
    }
    
    function restarPuntosAzul(puntos) {
        var puntosActualesAzul = parseInt(puntuacionAzul.innerHTML);
        var nuevosPuntosAzul = puntosActualesAzul - puntos;
        if (nuevosPuntosAzul<0){
            nuevosPuntosAzul=0;
        }
        puntuacionAzul.innerHTML = nuevosPuntosAzul;
    }
 
});