document.addEventListener('DOMContentLoaded', () => {
    fetch('caricarticoli.php')
        .then(response => response.json())
        .then(data => {
            const container = document.getElementById('articoli-container');

            if (data.articolo_principale) {
                const principaleDiv = document.createElement('div');
                principaleDiv.classList.add('articolo-principale');
                principaleDiv.setAttribute('data-id', data.articolo_principale.id);
                principaleDiv.innerHTML = `
                    <a href="visualizzarticoli.php?id=${data.articolo_principale.id}">
                        <h2>${data.articolo_principale.titolo}</h2>
                    </a>
                    <img src="${data.articolo_principale.immagine}" alt="${data.articolo_principale.titolo}">
                    <p>${data.articolo_principale.contenuto}</p>
                `;
                const cuoricinoPrincipale = document.createElement('div');
                cuoricinoPrincipale.classList.add('cuoricino');
                principaleDiv.appendChild(cuoricinoPrincipale);

                container.appendChild(principaleDiv);
            }

            if (Array.isArray(data.articoli)) {
                data.articoli.forEach(articolo => {
                    const div = document.createElement('div');
                    div.classList.add('articolo');
                    div.setAttribute('data-id', articolo.id);
                    div.innerHTML = `
                        <a href="visualizzarticoli.php?id=${articolo.id}">
                            <h2>${articolo.titolo}</h2>
                        </a>
                        <img src="${articolo.immagine}" alt="${articolo.titolo}">
                        <p>${articolo.contenuto}</p>
                    `;
                    const cuoricino = document.createElement('div');
                    cuoricino.classList.add('cuoricino');
                    div.appendChild(cuoricino);

                    container.appendChild(div);
                });
            } else {
                console.error('Articoli non trovati o formato non corretto');
            }
        })
        .catch(error => console.error('Error loading articles:', error));
});
