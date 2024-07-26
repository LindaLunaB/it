const login = document.querySelector('#login'),
    password = document.querySelector('#password'),
    usuario = document.querySelector('#usuario'),
    error_feedback = document.querySelector('#error_feedback');

login.addEventListener('click', ()=>{

    let usuario_value = usuario.value.trim(),
        password_value = password.value.trim();
    if(password_value === '' || usuario_value === ''){
        error_feedback.innerText = 'El usuario y contraseña son requeridos.';
        error_feedback.classList.remove('d-none');
        error_feedback.classList.add('d-block');
        return;
    }

    if(!validateEmail(usuario_value)){
        error_feedback.innerText = 'El correo electrónico no es válido.';
        error_feedback.classList.remove('d-none');
        error_feedback.classList.add('d-block');
        return;
    }

    error_feedback.classList.add('d-none');

    let myFormData = new FormData();
    myFormData.append('usuario', usuario_value);
    myFormData.append('password', password_value);
    
    fetch('http://localhost/it/login/login',{
        method: "POST",
        body: myFormData
    })
    .then(res => res.json())
    .then(data=>{
        console.log(data);
    })
});

const validateEmail = (email)=>{
    const re = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    return re.test(String(email).toLowerCase());
}