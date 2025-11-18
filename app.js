async function loadData() {
    const response = await fetch('./802936.json');
    const data = await response.json();

    processData(data);
    return data;
}

function processData(data) {
    //nazwa
    document.querySelector("#nazwaproduktu").innerHTML = data.basicInfo.name
    //cena
    document.querySelector("#cena").innerHTML = "<h1>"+data.price.final.gross.formatted+"</h1>"
    //dostawa
    document.querySelector("#dostawa").innerHTML = data.basicInfo.freeShipping
    //obrazy
    const obrazek = document.querySelector("#obrazek")
    obrazek.src = data.gallery.pictures[0].sizeXL.url
    // kody
    const kody = document.querySelector("#kody")
    let kodytekst = "<h2>Kody</h2><ul>"
    for (let i = 0; i < data.codes.length; i++) {
        kodytekst += "<li>"
        kodytekst += data.codes[i].label
        kodytekst += ": "
        kodytekst += data.codes[i].code
        kodytekst += "</li>"
        kodytekst += "<br>"
    }
    kodytekst += "</ul>"
    kody.innerHTML = kodytekst
    // specyfikacje
    const spec = document.querySelector("#spece")
    let spectekst = ""
    for (let i = 0; i < data.specification.length; i++) {
        spectekst += "<h3>" + data.specification[i].name + "</h3>"
        spectekst += "<ul>"
        for(let j = 0; j < data.specification[i].attributes.length; j++){
            spectekst += "<li>"
            spectekst += "<h5>" + data.specification[i].attributes[j].name + ": "
            spectekst += data.specification[i].attributes[j].values[0].name + "</h5>"
            spectekst += "</li>"
        }
        spectekst += "</ul>"
    }
    
    spec.innerHTML = spectekst
}

loadData();

function batonClick() {
    console.log("makapaka")
}