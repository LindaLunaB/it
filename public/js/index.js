const tipoBusqueda = document.querySelector('#tipoBusqueda'),
    tipoLibro = document.querySelector('#tipoLibro'),
    anio = document.querySelector('#anio'),
    libro = document.querySelector('#libro'),
    tomo = document.querySelector('#tomo'),
    fasciculo = document.querySelector('#fasciculo');

const objSelect = {
    'tipoBusqueda' : tipoBusqueda,
    'tipoLibro': tipoLibro,
    'anio' : anio,
    'libro' : libro,
    'tomo' : tomo,
    'fasciculo' : fasciculo
};

tipoBusqueda.addEventListener('change', ()=>{
    let myFormData = new FormData();
    
    let path = getCurrentPath('tipoBusqueda');
    console.log(path);
    clearLowerLevelsSelects('tipoBusqueda');

    /* myFormData.append('path',path);
    fetch('', {
        method: "POST",
        body: myFormData
    })
    .then(res => res.json())
    .then(data => {
        console.log(data);
    }) */
});

tipoLibro.addEventListener('change', ()=>{
    let myFormData = new FormData();
    
    let path = getCurrentPath('tipoLibro');
    console.log(path);
    clearLowerLevelsSelects('tipoLibro');

    /* myFormData.append('path',path);
    fetch('', {
        method: "POST",
        body: myFormData
    })
    .then(res => res.json())
    .then(data => {
        console.log(data);
    }) */
});

anio.addEventListener('change', ()=>{
    let myFormData = new FormData();
    
    let path = getCurrentPath('anio');
    console.log(path);
    clearLowerLevelsSelects('anio');

    /* myFormData.append('path',path);
    fetch('', {
        method: "POST",
        body: myFormData
    })
    .then(res => res.json())
    .then(data => {
        console.log(data);
    }) */
});

libro.addEventListener('change', ()=>{
    let myFormData = new FormData();
    
    let path = getCurrentPath('libro');
    console.log(path);
    clearLowerLevelsSelects('libro');

    /* myFormData.append('path',path);
    fetch('', {
        method: "POST",
        body: myFormData
    })
    .then(res => res.json())
    .then(data => {
        console.log(data);
    }) */
});

tomo.addEventListener('change', ()=>{
    let myFormData = new FormData();
    
    let path = getCurrentPath('tomo');
    console.log(path);
    clearLowerLevelsSelects('tomo');

    /* myFormData.append('path',path);
    fetch('', {
        method: "POST",
        body: myFormData
    })
    .then(res => res.json())
    .then(data => {
        console.log(data);
    }) */
});

fasciculo.addEventListener('change', ()=>{
    let myFormData = new FormData();
    
    let path = getCurrentPath('fasciculo');
    console.log(path);
    clearLowerLevelsSelects('fasciculo');

    /* myFormData.append('path',path);
    fetch('', {
        method: "POST",
        body: myFormData
    })
    .then(res => res.json())
    .then(data => {
        console.log(data);
    }) */
});


const getCurrentPath = (select)=>{
    let path = "/",
        encontrado = false;

    for(let key in objSelect){
        
        if(!encontrado){
            path += objSelect[key].value + "/";
        }

        if(select === key){
            encontrado = true;
        }
    }

    return path;
}

const clearLowerLevelsSelects = (select)=>{
    let encontrado = false;

    for(let key in objSelect){
        
        if(encontrado){
            objSelect[key].innerHTML = "<option selected disabled>Seleccione una opción</option>";
        }

        if(select === key){
            encontrado = true;
        }
    }
}
