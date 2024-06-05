

let isSmiling = false;
let image;
let autore;

function Sorridi() {
  if (!isSmiling) {
    image.src = 'result.gif';
    isSmiling = true;
    autore.innerHTML = 'Ora sta sorridendo!';
  } else {
    image.src = 'aranzulla2.png';
    isSmiling = false;
    autore.innerHTML = 'AUTORE --> clicca la foto per farlo sorridere';
  }
}

document.addEventListener('DOMContentLoaded', function() {
  image = document.querySelector(".immagine-ridotta5");
  autore = document.querySelector('#bio .autore');
  image.addEventListener('click', Sorridi);
});



function onJson(json) {
  console.log('JSON ricevuto');

  console.log(json);
  const apiDiv = document.querySelector('#api');
  apiDiv.innerHTML = '';

  
  for (let article of json.articles) {
      
      const title = article.title;
      const image = article.image;
      const url = article.url; 

    
      const articleLink = document.createElement('a');
      articleLink.href = url;
      articleLink.target = '_blank'; 

      
      const newsItem = document.createElement('div');
      newsItem.classList.add('news-item');

      
      const img = document.createElement('img');
      img.src = image;

      
      const caption = document.createElement('span');
      caption.textContent = title;

      
      newsItem.appendChild(img);
      newsItem.appendChild(caption);

      
      articleLink.appendChild(newsItem);

     
      apiDiv.appendChild(articleLink);
  }

 
  apiDiv.style.display = 'block';
}


function onResponse(response) {
  console.log('Risposta ricevuta');
  return response.json();
}

function search(event) {
  // Impediamo il submit del form
  event.preventDefault();
  // Leggo il valore del campo di testo
  const topicInput = document.querySelector('#topicInput');
  const topicValue = encodeURIComponent(topicInput.value);
  console.log('Eseguo ricerca per argomento: ' + topicValue);
  // Prepara la richiesta
 
  // Eseguo la fetch
  fetch("notizie.php?q=" + topicValue)
      .then(onResponse)
      .then(onJson)
      .catch(error => console.error('Errore durante la richiesta:', error));
}

// Aggiungi event listener al form
const form = document.querySelector('#searchForm');
form.addEventListener('submit', search);

const api_key = '47098e27938265c66f06140926079818';


function onJson2(json) {
  console.log('JSON ricevuto');
  console.log(json);
  // Svuotiamo la libreria
  const library = document.querySelector('#album-view');
  library.innerHTML = '';
  // Leggi il numero di risultati
  const results = json.tracks.items;
  let num_results = results.length;
  // Mostriamone al massimo 10
  if(num_results > 10)
    num_results = 10;
  // Processa ciascun risultato
  for(let i=0; i<num_results; i++)
  {
    // Leggi il documento
    const album_data = results[i]
    // Leggiamo info
    const title = album_data.name;
    const selected_image = album_data.album.images[0].url;
    
    const album = document.createElement('div');
    album.classList.add('album');
  
    const img = document.createElement('img');
    img.src = selected_image;
   
    const caption = document.createElement('span');
    caption.textContent = title;
   
    album.appendChild(img);
    album.appendChild(caption);
    
    library.appendChild(album);
  }
}

function onResponse2(response) {
  console.log('Risposta ricevuta');
  return response.json();
}

function search2(event)
{
  // Impedisco il submit del form
  event.preventDefault();
  // Leggi valore del campo di testo
  const album_input = document.querySelector('#album');
  const album_value = encodeURIComponent(album_input.value);
  console.log('Eseguo ricerca: ' + album_value);
  // Esegui la richiesta
  fetch("spotify.php?q=" + album_value,
    
  ).then(onResponse2).then(onJson2);
}

// Aggiungi event listener al form
const form2 = document.querySelector('#searchForm2');
form2.addEventListener('submit', search2)


const registrationButton = document.querySelector("#registrazione");
const registrationForm = document.querySelector("#registration-form");
const formContainer = document.querySelector(".form-container");

registrationButton.addEventListener("click", function() {
  console.log("Click registrato!"); // Aggiungi questo messaggio di debug
  registrationForm.style.display = "block";
  formContainer.style.display = "block";
});


const closeButton = document.querySelector("#close");

closeButton.addEventListener("click", function() {
    registrationForm.style.display = "none";
    formContainer.style.display = "none";
});

const closeButton2 = document.querySelector("#close2");
closeButton2.addEventListener("click", function() {
  loginform.style.display = "none";
  formContainer2.style.display = "none";
});

const loginButton = document.querySelector("#loginbutton");
const loginform= document.querySelector('#login-form')
const formContainer2 = document.querySelector(".form-container2");
loginButton.addEventListener("click", function() {
  formContainer2.style.display = "block";
  loginform.style.display = "block";
});



  document.addEventListener("DOMContentLoaded", () => {
    const registrationButton = document.querySelector("#registrazione");
    const closeButton = document.querySelector("#close");
    const formContainer = document.querySelector(".form-container");
    const form3 = document.querySelector("#registration-form");

    function validazione(event) {
        const username = form3.username.value.trim();
        const email = form3.email.value.trim();
        const password = form3.password.value.trim();

        // Controllo se i campi sono vuoti
        if (username === "" || email === "" || password === "") {
            alert("Compilare tutti i campi.");
            event.preventDefault();
            return;
        }

        // Controllo password
        if (password.length < 8) {
            alert("La password deve contenere almeno 8 caratteri.");
            event.preventDefault();
            return;
        }

        if (!/[A-Z]/.test(password)) {
            alert("La password deve contenere almeno una lettera maiuscola.");
            event.preventDefault();
            return;
        }

        if (!/[!@#$%^&*]/.test(password)) {
            alert("La password deve contenere almeno un carattere speciale.");
            event.preventDefault();
            return;
        }

        // Controllo email
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(email)) {
            alert("Inserisci un indirizzo email valido.");
            event.preventDefault();
            return;
        }
    }

    
    form3.addEventListener('submit', validazione);

    registrationButton.addEventListener("click", function() {
        formContainer.style.display = "block";
    });

   
    closeButton.addEventListener("click", function() {
        formContainer.style.display = "none";
    });
});

