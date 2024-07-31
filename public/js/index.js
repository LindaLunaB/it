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
    generateData('tipoBusqueda', 'tipoLibro');
});

tipoLibro.addEventListener('change', ()=>{
    generateData('tipoLibro', 'anio');
});

anio.addEventListener('change', ()=>{
    generateData('anio', 'libro');
});

libro.addEventListener('change', ()=>{
    generateData('libro', 'tomo');
});

tomo.addEventListener('change', ()=>{
    generateData('tomo', 'fasciculo');
});

const generateData = async(select, nextPath)=>{
    let path = getCurrentPath(select);
    clearLowerLevelsSelects(select);

    const result = await getContentDirectory(path);
    objSelect[nextPath].innerHTML = result;
}

const getContentDirectory = async(path)=>{

    let myFormData = new FormData();
    myFormData.append('path',path);

    const response = await fetch(`${ base_url }index/getDirectories`, {
        method: "POST",
        body: myFormData
    })

    const data = await response.json();
    let htmlSelect = "<option selected disabled>Seleccione una opción</option>";

    data.forEach(element => {
        htmlSelect += `<option value="${ element }">${ element }</option>`;
    });

    return htmlSelect;
}


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
