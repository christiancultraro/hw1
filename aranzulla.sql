
CREATE TABLE articoli (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titolo VARCHAR(255) NOT NULL,
    immagine VARCHAR(255) NOT NULL,
    contenuto TEXT NOT NULL,
    principale BOOLEAN DEFAULT 0
);
--
CREATE TABLE utenti (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE
);
-- Dump dei dati per la tabella `articoli`
-- 
SET FOREIGN_KEY_CHECKS = 0;
truncate TABLE ARTICOLI;
SET FOREIGN_KEY_CHECKS = 1;
INSERT INTO articoli (id, titolo, immagine, contenuto, principale) VALUES
(1, 'Articolo 1', 'art1.png', 'Contenuto del primo articolo', 0),
(2, 'Articolo 2', 'art2.png', 'Contenuto del secondo articolo', 0),
(3, 'Articolo 3', 'art3.png', 'Contenuto del terzo articolo', 0),
(4, 'Articolo 4', 'art4.png', 'Contenuto del quarto articolo', 0),
(5, 'no vabbe assurdo', 'art5.png', 'Contenuto dedew articolo', 0),
(6, 'no vabbe assurdo', 'art5.png', 'Contenuto dedew articolo', 0),
(7, 'incredibbbile', 'art6.png', 'Contenuto del qudearticolo', 0),
(8, 'polpetta', 'art7.png', 'Contenuto del quarto artedicolo', 0),
(9, 'Come silenziare un contatto', 'mbareeee.png', 'Per restare in contatto con amici, parenti e colleghi di lavoro utilizzi WhatsApp, l’app di messaggistica istantanea più famosa al mondo. Ti ci trovi bene, ma ci sono alcune persone che ti contattano troppo di frequente, disturbandoti sempre nei momenti meno opportuni. Pertanto, stai ora leggendo questo mio tutorial poiché sei alla ricerca di una soluzione che ti permetta di rimediare al problema, andando a silenziare le notifiche.\n\nCome dici? Le cose stanno proprio così e vorresti quindi sapere come silenziare un contatto su WhatsApp? Benissimo, allora non devi fare altro che continuare a leggere: in questa guida, infatti, ti illustrerò tutte le procedure per riuscire nel tuo intento non solo nella “classica” app di WhatsApp per Android e iPhone, ma anche su PC.\n\nSe, dunque, sei pronto per scoprire come mettere fine alle notifiche dei contatti più petulanti su WhatsApp — temporaneamente o definitivamente — leggi quanto riportato di seguito. Scommetto che resterai soddisfatto dai risultati (e dalla pace) che otterrai!', 1),
(10, 'titolob', 'artic1.png', 'Contenuto dedmklmnklmkòlndcnnskjncjskew articolo', 0),
(11, 'titoloa', 'artic2.png', 'Contenuto ddecdecedel qudearticolo', 0),
(12, 'titoloc', 'artic3.png', 'Contenuto del quartdeceo artedicolo', 0),
(13, 'titolod', 'artic4.png', 'Contenuto dedmklmnklmkòlndcnnskjncjskew articolo', 0),
(14, 'titoloe', 'artic5.png', 'Contenuto ddecdecedel qudearticolo', 0),
(15, 'titolof', 'artic6.png', 'Contenuto del quartdeceo artedicolo', 0),
(16, 'titolog', 'artic7.png', 'Contenuto del quartdeceo artedicolo', 0),
(17, 'titoloh', 'artic8.png', 'Contenuto dedmklmnklmkòlndcnnskjncjskew articolo', 0),
(18, 'Migliori smartphone medio gamma, guida all acquisto', 'artic9.png', 'Purtroppo il tuo vecchio smartphone ha esalato l ultimo respiro, per cui ti ritrovi con la necessità di doverne acquistare uno nuovo. Quando ti ritrovi a fare questa scelta ti viene un po di “ansia”, perché ormai sul mercato sono disponibili tantissimi prodotti e tu, che non sei un grande esperto, non sai mai quale scegliere. Inoltre, non vuoi spendere cifre “folli” per uno smartphone, per cui hai deciso di optare per un modello di fascia media.\n\nDato che vuoi essere sicuro di acquistare il modello più adatto alle tue esigenze, ti sei messo sul Web alla ricerca di maggiori informazioni al riguardo e sei capitato su questa mia guida all acquisto sui migliori smartphone medio gamma speranzoso di trovare la risposta a tutte le tue domande.\n\nNon ti preoccupare, sei nel posto giusto! Tutto quello che devi fare è metterti comodo, prenderti cinque minuti di tempo libero e proseguire con la lettura dei prossimi paragrafi. Sono sicuro che riuscirai facilmente a trovare lo smartphone medio gamma più adatto alle tue necessità. Non mi resta che augurarti una buona lettura e buono shopping!\ne dei contatti più petulanti su WhatsApp — temporaneamente o definitivamente — leggi quanto riportato di seguito. Scommetto che resterai soddisfatto dai risultati (e dalla pace) che otterrai!', 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `preferiti`
--
CREATE TABLE preferiti (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    articolo_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES utenti(id),
    FOREIGN KEY (articolo_id) REFERENCES articoli(id)
);


--

--
--
--
ALTER TABLE articoli
  ADD PRIMARY KEY (`id`);

--

--
-
--
ALTER TABLE `utente`
  ADD PRIMARY KEY (`utente_id`);




