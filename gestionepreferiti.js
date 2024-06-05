document.addEventListener('DOMContentLoaded', () => {
    // Recupera gli ID degli articoli preferiti dall'attributo data
    const user_id = document.body.getAttribute('data-user-id');
    const preferiti = JSON.parse(document.body.getAttribute('data-preferiti'));

    // Funzione per gestire i preferiti
    const gestisciPreferiti = () => {
        const principaleDiv = document.querySelector('.articolo-principale');
        if (principaleDiv) {
            const cuoricinoPrincipale = principaleDiv.querySelector('.cuoricino');
            const articoloId = principaleDiv.getAttribute('data-id');
            if (preferiti.includes(parseInt(articoloId))) {
                principaleDiv.classList.add('preferito');
                cuoricinoPrincipale.classList.add('preferito');
                cuoricinoPrincipale.style.display = "block";
            }
            if (cuoricinoPrincipale) {
                principaleDiv.addEventListener("mouseenter", function () {
                    cuoricinoPrincipale.style.display = "block";
                });

                principaleDiv.addEventListener("mouseleave", function () {
                    if (!cuoricinoPrincipale.classList.contains('preferito')) {
                        cuoricinoPrincipale.style.display = "none";
                    }
                });

                cuoricinoPrincipale.addEventListener("click", function () {
                    togglePreferito(principaleDiv, cuoricinoPrincipale);
                });
            }
        }

        const articoli = document.querySelectorAll(".articolo");

        articoli.forEach((articolo) => {
            const cuoricino = articolo.querySelector(".cuoricino");
            const articoloId = articolo.getAttribute('data-id');

            if (preferiti.includes(parseInt(articoloId))) {
                articolo.classList.add('preferito');
                cuoricino.classList.add('preferito');
                cuoricino.style.display = "block";
            }

            articolo.addEventListener("mouseenter", function () {
                cuoricino.style.display = "block";
            });
            articolo.addEventListener("mouseleave", function () {
                if (!cuoricino.classList.contains('preferito')) {
                    cuoricino.style.display = "none";
                }
            });

            cuoricino.addEventListener("click", function () {
                togglePreferito(articolo, cuoricino);
            });
        });
    };

    const togglePreferito = (articolo, cuoricino) => {
        const articoloId = articolo.getAttribute('data-id');
        const utenteId = document.body.getAttribute('data-user-id');
        const isFavorite = cuoricino.classList.contains('preferito');
        const url = isFavorite ? 'rimuovipreferito.php' : 'aggiungipreferito.php';

        console.log(`Invio richiesta a ${url} per l'articolo ${articoloId}`);

        fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ utenteId, articoloId })
        }).then(response => response.json())
            .then(data => {
                console.log('Risposta dal server:', data);
                if (data.success) {
                    if (isFavorite) {
                        console.log(`Rimuovo articolo ${articoloId} dai preferiti`);
                        cuoricino.classList.remove('preferito');
                        articolo.classList.remove('preferito');
                        cuoricino.style.display = 'none';
                    } else {
                        console.log(`Aggiungo articolo ${articoloId} ai preferiti`);
                        cuoricino.classList.add('preferito');
                        articolo.classList.add('preferito');
                        cuoricino.style.display = 'block';
                    }
                } else {
                    console.error('Errore dal server:', data.error);
                }
            }).catch(error => console.error('Errore di rete:', error));
    };

 
    setTimeout(gestisciPreferiti, 1000); 
});

