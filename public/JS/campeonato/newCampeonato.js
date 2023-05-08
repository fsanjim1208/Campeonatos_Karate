$(function(){
    var input=$('input[name="tipo"]')
    var comunidad=$('#comunidad')
    
    var comunidades=[];
    $.ajax("http://127.0.0.1:8000/api/comunidad",
    {
        method: "GET",
        dataType: "json",
        crossDomain: true,
        async: false,

    }).done(function (data) {
        
        $.each( data, function( key, val ) {
            comunidades.push(val);
        });
    })

    input.change(function() 
    {
        if ($(this).val() == 'Autonomico') {
            comunidad.prop('disabled', false);

            comunidades.forEach(function(opcion) {
                var nuevoOption = document.createElement("option");
                nuevoOption.textContent = opcion.nombre;
                comunidad[0].appendChild(nuevoOption);
            });

        } else {
            comunidad.prop('disabled', true);
            comunidad[0].innerHTML="";
        }
    });
})