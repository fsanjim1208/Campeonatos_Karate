$(function(){
    var provincia=$("#provincia");
    var comunidad=$("#comunidad");
    var provincias=[];
    $.ajax("http://127.0.0.1:8000/api/provincia",
    {
        method: "GET",
        dataType: "json",
        crossDomain: true,
        async: false,

    }).done(function (data) {
        
        $.each( data, function( key, val ) {
            provincias.push(val);
        });
    })
    
    provincias.forEach(function(opcion) {
        // Crear un nuevo elemento option
        if (comunidad.val()==opcion.id_comunidad) {
            var nuevoOption = document.createElement("option");
            nuevoOption.textContent = opcion.nombre;
            provincia[0].appendChild(nuevoOption);
        }
        
    });

    comunidad.change(function(ev){
        provincia[0].innerHTML="";
        provincias.forEach(function(opcion) {
            // Crear un nuevo elemento option
            if (comunidad.val()==opcion.id_comunidad) {
                var nuevoOption = document.createElement("option");
                nuevoOption.textContent = opcion.nombre;
                provincia[0].appendChild(nuevoOption);
            }
        });
    })
})