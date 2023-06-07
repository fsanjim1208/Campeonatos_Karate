$(function(){
    var boton=$(".inscribir");

    console.log(boton);
    boton.click(function(ev) {
        console.log(this);
        var celda = this.parentNode;
        $.ajax( "http://127.0.0.1:8000/api/participaciones",  
        {
            method:"POST",
            dataType:"json",
            crossDomain: true,
            data: {
                "campeonato" : this.id, 
            },
        }).done(function(data){
            celda.innerHTML="";
            var icon = document.createElement("i");
            var icon2 = document.createElement("i");
            icon.classList.add("fas", "fa-fist-raised");
            icon2.classList.add("fas", "fa-fist-raised");

            var text = document.createTextNode("  Ya estás inscrito  ");
            celda.appendChild(icon2);
            celda.appendChild(text);
            celda.appendChild(icon);
        })
    })
})