// DECLARACIÓN DE VARIABLES

// DECLARACION DE FUNCIONES

function showGUI()
{
    var cafe = new array(2);
    cafe[0] = "2";
    cafe[1] = "3";
}

function cargarElementoUno()
{   
    
    var primerEstructura = document.querySelector("#firstSection");
   
    
        var firstSectionStructure = "<br><button id='boton4'>prueba</button>";
        primerEstructura.innerHTML = firstSectionStructure;
}

function cargarElementoDos()
{
    var secondSectionStructure = "";
}

function cargaDocumento()
{
    
    var boton_elemento_1 = document.querySelector("#boton1");
    var boton_elemento_2 = document.querySelector("#boton2");
    var boton_elemento_4 = document.querySelector("#boton4");
    
    boton_elemento_1.addEventListener("click", cargarElementoUno);
    boton_elemento_2.addEventListener("click", cargarElementoDos);    
    
}

// ASIGNACION DE EVENTOS

window.addEventListener("load", cargaDocumento);