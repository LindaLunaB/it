/* const tipoBusqueda = document.querySelector('#tipoBusqueda'),
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
 */

const enviar = document.querySelector("#enviar");
const inputs = ["oficina","tipo","libro","anio","tomo","fasciculo"];
const tbody = document.querySelector("#tbody");

enviar.addEventListener('click', ()=>{
    getInputs();
})

const getInputs = ()=>{
    let errors = [];
    let campos = {};

    inputs.forEach(inputName => {
        let input = document.querySelector(`#${inputName}`);
        let input_value = input.value.trim();

        if(input_value !== ''){
            let select = document.querySelector(`#${inputName}Select`);
            let select_value = select.value;
            if(select_value === "Seleccione una opción"){
                errors.push({
                    "type": "select",
                    "campo": inputName
                })
            }
        }

        let select = document.querySelector(`#${inputName}Select`);
        let select_value = select.value;

        if(select_value !== 'Seleccione una opción'){
            if(input_value === ''){
                errors.push({
                    "type": "input",
                    "campo": inputName
                })
            }
        }

        if(input_value !== '' && select_value !== 'Seleccione una opción'){
            campos[inputName] = {
                "condition" : select_value, 
                "value" : input_value
            };
        }
    });

    let alert_errors = document.querySelector('#alert_errors');
    if(errors.length > 0){

        alert_errors.classList.remove('d-none');
        let errors_html = "";

        errors.forEach(error => {
            let textCampos = {
                "oficina" : "Oficina",
                "tipo": "Tipo",
                "libro": "Libro",
                "anio": "Año",
                "tomo": "Tomo",
                "fasciculo": "Fasciculo"
            };
            if(error.type === "input"){
                errors_html += `<p class="mb-0">-El valor del campo ${textCampos[error.campo]} no puede ser vacio.</p>`;
            }else{
                errors_html += `<p class="mb-0">-Seleccione una condición para el campo ${textCampos[error.campo]}.</p>`;
            }
        });

        alert_errors.innerHTML = errors_html;

        return;
    }

    alert_errors.classList.add('d-none');

    if(Object.keys(campos).length === 0){
        return;
    }

    let myFormData = new FormData();
    myFormData.append('data', JSON.stringify(campos));

    fetch(`${ base_url }index/queryBuilder`,{
        method: "POST",
        body: myFormData
    })
    .then(res => res.json())
    .then(data =>{
        data.forEach(element => {
            tbody.innerHTML += `
                <tr>    
                    <th scope="row">${element.oficina}</th>
                    <td>${element.tipo}</td>
                    <td>${element.libro}</td>
                    <td>${element.anio}</td>
                    <td>${element.tomo}</td>
                    <td>${element.fasciculo}</td>
                    <td>
                        <a target="__blank" href="${ base_url }index/viewFile?file=${element.archivo}">Abrir</a>
                    </td>
                </tr>
            `;
        });
    });
}

inputs.forEach(buttonName => {
    let button = document.querySelector(`#${buttonName}Button`);

    button.addEventListener('click', ()=>{
        document.querySelector(`#${buttonName}`).value = "";
        document.querySelector(`#${buttonName}Select`).value = "Seleccione una opción";
    })
});