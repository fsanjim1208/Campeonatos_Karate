$(function(){
    var boton=$(".eliminarCampeonato");
    boton.click(function(ev) {
        const id=this.id;
        console.log(id)
        $.ajax( "http://127.0.0.1:8000/api/campeonato/"+id,  
        {
            method:"GET",
            dataType:"json",
            crossDomain: true,
        }
        ).done(function(data){
            console.log(data)
            var id=data.id;
            var nombre=data.nombre;
            var img=data.cartel;
            console.log(img)
            if(img==null || img==""){
                var plantilla=`
                <div>
                    <h4>`+nombre+`</h4>
                </div>`;
            }else{
                var plantilla=`
                <div>
                    <h4>`+nombre+`</h4>
                    <img src="`+img+`" class="c-imagen c-imagen--juegos"></img>
                </div>`;
            }

            

            jqPlantilla=$(plantilla);

            jqPlantilla.dialog({
                title: "¿Está seguro que desea eliminarlo?",
                height: 280,
                width: 400,
                modal: true,
                buttons: {
                    "Eliminar": function() {
                        window.location.href = "http://localhost:8000/deleteEvento/"+id;
                    },
                    Cancelar: function() {
                    jqPlantilla.dialog( "close" );
                    },
                },
                close: function() {
                    jqPlantilla.dialog( "close" );
                },
            })

        });
    })


})