const enviar = document.querySelector("#enviar");
const tbody = document.querySelector("#tbody");
const thead = document.querySelector("#thead");
const loader = document.querySelector("#loader");

const itemsPerPage = 10;
let currentPage = 1;
let newData = [];
let tab = 'llave';

enviar.addEventListener('click', ()=>{
    getInputs();
})

const getInputs = ()=>{
    let errors = [];
    let campos = {};
    let inputs = [];

    config[tab].forEach(campo => {
        let input = document.querySelector(`#${campo.name}`);
        let input_value = input.value.trim();

        if(input_value !== ''){
            let select = document.querySelector(`#${campo.name}Select`);
            let select_value = select.value;
            if(select_value === "Seleccione una opción"){
                errors.push({
                    "type": "select",
                    "campo": campo.name
                })
            }
        }

        let select = document.querySelector(`#${campo.name}Select`);
        let select_value = select.value;

        if(select_value !== 'Seleccione una opción'){
            if(input_value === ''){
                errors.push({
                    "type": "input",
                    "campo": campo.name
                })
            }
        }

        if(input_value !== '' && select_value !== 'Seleccione una opción'){
            campos[campo.name] = {
                "condition" : select_value, 
                "value" : input_value
            };
        }

        inputs.push(campo.name);
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
        //loader.classList.add('d-none');
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

function renderTable(page, itemsPerPage) {
    const startIndex = (page - 1) * itemsPerPage;
    const endIndex = startIndex + itemsPerPage;
    const currentData = newData.slice(startIndex, endIndex);

    tbody.innerHTML = '';
    thead.innerHTML = '';

    let head = '<tr>';
    config[tab].forEach(element => {
        head += `<th scope="col">${element.placeholder}</th>`;
    });
    head += `
        <th>Archivo</th>
        <th></th>
        </tr>
    `;

    thead.innerHTML = head;

    currentData.forEach(item => {
        const tr = document.createElement('tr');
        config[tab].forEach(element => {
            tr.innerHTML += `<td>${item[element.name]}</td>`;
        });
        tr.innerHTML += `
            <td>${item.name}</td>
            <td>
                <button onclick="openFile('${item.archivo}','${item.name}')" type="button" class="btn btn-primary">
                    Abrir
                </button>
            </td>
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

function renderForm(inputs){
    const contenedor = document.querySelector("#contenedor");
    contenedor.innerHTML = '';

    inputs.forEach(campo =>{
        // Crear el div para el label
        const divLabel = document.createElement('div');
        divLabel.className = 'col-12 col-md-3 mb-3 d-flex align-items-center justify-content-center';
        const label = document.createElement('p');
        label.className = 'mb-0';
        label.textContent = campo.placeholder;
        divLabel.appendChild(label);
        contenedor.appendChild(divLabel);

        // Crear el div para el select
        const divSelect = document.createElement('div');
        divSelect.className = 'col-12 col-md-3 mb-3';
        const select = document.createElement('select');
        select.className = 'form-select';
        select.id = `${campo.name}Select`;
        select.setAttribute('aria-label', 'Default select example');
        const optionDefault = document.createElement('option');
        optionDefault.selected = true;
        optionDefault.disabled = true;
        optionDefault.textContent = 'Seleccione una opción';
        select.appendChild(optionDefault);
        let options = [
            { value: 'igual a', text: 'igual a' },
            { value: 'no igual a', text: 'no igual a' },
            { value: 'mayor que', text: 'mayor que' },
            { value: 'menor que', text: 'menor que' },
            { value: 'mayor o igual a', text: 'mayor o igual a' },
            { value: 'menor o igual a', text: 'menor o igual a' }
        ];
        options.forEach(option => {
            const opt = document.createElement('option');
            opt.value = option.value;
            opt.textContent = option.text;
            select.appendChild(opt);
        });
        divSelect.appendChild(select);
        contenedor.appendChild(divSelect);

        // Crear el div para el input
        const divInput = document.createElement('div');
        divInput.className = 'col-12 col-md-3 mb-3';
        const input = document.createElement('input');
        input.className = 'form-control';
        input.id = campo.name;
        input.type = 'text';
        input.placeholder = campo.placeholder || '';
        divInput.appendChild(input);
        contenedor.appendChild(divInput);

        // Crear el div para el botón
        const divButton = document.createElement('div');
        divButton.className = 'col-12 col-md-3 mb-3 d-flex align-items-center justify-content-center';
        const button = document.createElement('button');
        button.id = `${campo.name}Button`;
        button.className = 'btn btn-light';
        const svg = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
        svg.setAttribute('xmlns', 'http://www.w3.org/2000/svg');
        svg.setAttribute('width', '20');
        svg.setAttribute('height', '20');
        svg.setAttribute('viewBox', '0 0 24 24');
        const path = document.createElementNS('http://www.w3.org/2000/svg', 'path');
        path.setAttribute('fill', 'currentColor');
        path.setAttribute('d', 'm14.03 1.889l9.657 9.657l-8.345 8.345l-.27.27H20v2H6.747l-3.666-3.666a4 4 0 0 1 0-5.657l10.95-10.95Zm.322 16.163l6.507-6.506l-6.829-6.829l-6.828 6.829l6.828 6.828l.32-.323l.002.001ZM5.788 12.96l-1.293 1.293a2 2 0 0 0 0 2.828l3.08 3.08h4.68l.366-.368l-6.833-6.833Z');
        svg.appendChild(path);
        button.appendChild(svg);
        divButton.appendChild(button);
        contenedor.appendChild(divButton);

        let buttonClick = document.querySelector(`#${campo.name}Button`);

        buttonClick.addEventListener('click', ()=>{
            document.querySelector(`#${campo.name}`).value = "";
            document.querySelector(`#${campo.name}Select`).value = "Seleccione una opción";
        })
    });
}

function openFile(token, name){
    const myModal = new bootstrap.Modal(document.getElementById('exampleModal'), {
        keyboard: false
    });
    
    document.querySelector('#exampleModal .modal-title').textContent = name;
    document.querySelector('#exampleModal .modal-body').innerHTML = `<iframe src="${ base_url }index/pdfJS/${ token }" width="100%" height="100%" frameborder="0"></iframe>`;
    console.log(token, name);
    myModal.show();
}
const config = {
    llave:[
        {
            name: 'oficina',
            placeholder: 'Oficina'
        },
        {
            name: 'tipo',
            placeholder: 'Tipo'
        },
        {
            name: 'libro',
            placeholder: 'Libro'
        },
        {
            name: 'anio',
            placeholder: 'Año'
        },
        {
            name: 'tomo',
            placeholder: 'Tomo'
        },
        {
            name: 'fasciculo',
            placeholder: 'Fasciculo'
        }
    ],
    pishelugar:[
        {
            name: 'oficina',
            placeholder: 'Oficina'
        },
        {
            name: 'tipo',
            placeholder: 'Tipo'
        },
        {
            name: 'libro',
            placeholder: 'Libro'
        }
    ]
}

renderForm(config[tab]);