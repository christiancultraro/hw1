function validazione(event) {
    const form = document.getElementById('login-form');
    const username = form.username.value.trim();
    const password = form.password.value.trim();

   
    if (username.length == 0 || password.length == 0) {
      
        event.preventDefault();
        alert("Compilare tutti i campi.");
        
        
    }
}


const form = document.getElementById('login-form');

form.addEventListener('submit', validazione);

