let stan = []

const elements = document.querySelectorAll(".rozLista");
elements.forEach(() => stan.push(false));

console.log(stan)

function roz(rozKategoria){
    lista = document.querySelector(".rozLista" + rozKategoria)

    if(stan[rozKategoria] == false){
        stan[rozKategoria] = true
        lista.style.display = "block"
    }
    else{
        stan[rozKategoria] = false
        lista.style.display = "none"
    }
}