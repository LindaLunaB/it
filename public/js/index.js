const enviar = document.querySelector("#enviar");
const inputs = ["oficina","tipo","libro","anio","tomo","fasciculo"];
const tbody = document.querySelector("#tbody");
const loader = document.querySelector("#loader");

const itemsPerPage = 10;
let currentPage = 1;
let newData = [];

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
    myFormData.append('levels', JSON.stringify(inputs));
    loader.classList.remove('d-none');

    fetch(`${ base_url }index/queryBuilder`,{
        method: "POST",
        body: myFormData
    })
    .then(res => res.json())
    .then(data =>{
        loader.classList.add('d-none');
        console.log(data);
        //return;
        loader.classList.add('d-none');
        newData = data;
        renderTable(currentPage, itemsPerPage);
        renderPagination(data.length, itemsPerPage, currentPage);
    })
    /*.catch(err=>{
        console.log(err);
        tbody.innerHTML = '';
        loader.classList.add('d-none');
        alert_errors.innerHTML = "Lo sentimos, el tiempo de espera se agoto. Intente un busqueda a un nivel inferior.";
        alert_errors.classList.remove('d-none');
    });*/
}

inputs.forEach(buttonName => {
    let button = document.querySelector(`#${buttonName}Button`);

    button.addEventListener('click', ()=>{
        document.querySelector(`#${buttonName}`).value = "";
        document.querySelector(`#${buttonName}Select`).value = "Seleccione una opción";
    })
});

function renderTable(page, itemsPerPage) {
    const startIndex = (page - 1) * itemsPerPage;
    const endIndex = startIndex + itemsPerPage;
    const currentData = newData.slice(startIndex, endIndex);

    tbody.innerHTML = '';

    currentData.forEach(item => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
            <th scope="row">${item.oficina}</th>
            <td>${item.tipo}</td>
            <td>${item.libro}</td>
            <td>${item.anio}</td>
            <td>${item.tomo}</td>
            <td>${item.fasciculo}</td>
            <td><a target="__blank" href="${item.archivo}">Abrir</a></td>
        `;
        tbody.appendChild(tr);
    });
}

function renderPagination(totalItems, itemsPerPage, currentPage) {
    const totalPages = Math.ceil(totalItems / itemsPerPage);
    const pagination = document.getElementById('pagination');
    pagination.innerHTML = '';

    const createPageItem = (page, label, active = false, disabled = false) => {
        const li = document.createElement('li');
        li.classList.add('page-item');
        if (active) li.classList.add('active');
        if (disabled) li.classList.add('disabled');
        const a = document.createElement('a');
        a.classList.add('page-link');
        a.href = '#';
        a.textContent = label;
        a.addEventListener('click', function (event) {
            event.preventDefault();
            if (!disabled) {
                currentPage = page;
                renderTable(currentPage, itemsPerPage);
                renderPagination(totalItems, itemsPerPage, currentPage);
            }
        });
        li.appendChild(a);
        return li;
    };

    const addEllipsis = () => {
        const li = document.createElement('li');
        li.classList.add('page-item', 'disabled');
        const a = document.createElement('a');
        a.classList.add('page-link');
        a.href = '#';
        a.textContent = '...';
        li.appendChild(a);
        return li;
    };

    const maxPagesToShow = 5;
    const halfMaxPagesToShow = Math.floor(maxPagesToShow / 2);
    let startPage = Math.max(1, currentPage - halfMaxPagesToShow);
    let endPage = Math.min(totalPages, currentPage + halfMaxPagesToShow);

    if (currentPage - startPage < halfMaxPagesToShow) {
        endPage = Math.min(totalPages, endPage + (halfMaxPagesToShow - (currentPage - startPage)));
    }
    if (endPage - currentPage < halfMaxPagesToShow) {
        startPage = Math.max(1, startPage - (halfMaxPagesToShow - (endPage - currentPage)));
    }

    pagination.appendChild(createPageItem(1, 'Primero', false, currentPage === 1));
    pagination.appendChild(createPageItem(currentPage - 1, 'Anterior', false, currentPage === 1));

    if (startPage > 1) {
        pagination.appendChild(createPageItem(1, '1'));
        if (startPage > 2) {
            pagination.appendChild(addEllipsis());
        }
    }

    for (let i = startPage; i <= endPage; i++) {
        pagination.appendChild(createPageItem(i, i, i === currentPage));
    }

    if (endPage < totalPages) {
        if (endPage < totalPages - 1) {
            pagination.appendChild(addEllipsis());
        }
        pagination.appendChild(createPageItem(totalPages, totalPages));
    }

    pagination.appendChild(createPageItem(currentPage + 1, 'Siguiente', false, currentPage === totalPages));
    pagination.appendChild(createPageItem(totalPages, 'Ultimo', false, currentPage === totalPages));
}