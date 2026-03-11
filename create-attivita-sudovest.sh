#!/bin/bash
# Crea attività per la zona sud-ovest del Lago di Garda
cd /home/customer/www/test.instagarda.net/public_html

# Crea nuove località mancanti
echo "=== Creazione località mancanti ==="
wp term create localita "Lonato del Garda" --slug=lonato-del-garda 2>/dev/null
wp term create localita "Padenghe sul Garda" --slug=padenghe-sul-garda 2>/dev/null
wp term create localita "Manerba del Garda" --slug=manerba-del-garda 2>/dev/null
wp term create localita "San Felice del Benaco" --slug=san-felice-del-benaco 2>/dev/null
wp term create localita "Soiano del Lago" --slug=soiano-del-lago 2>/dev/null

create_att() {
    local TITLE="$1"
    local SLUG="$2"
    local LOCALITA="$3"
    local INDIRIZZO="$4"
    local TELEFONO="$5"
    local WEBSITE="$6"
    local PREZZO="$7"
    local ORARI="$8"
    local CONTENT="$9"

    echo "Creating: $TITLE..."
    local ID=$(wp post create --post_type=struttura --post_title="$TITLE" --post_name="$SLUG" --post_status=publish --post_content="$CONTENT" --porcelain)

    if [ -n "$ID" ] && [ "$ID" -gt 0 ] 2>/dev/null; then
        wp post term set $ID tipo_struttura attivita
        wp post term set $ID localita "$LOCALITA"
        [ -n "$INDIRIZZO" ] && wp post meta update $ID _ig_indirizzo "$INDIRIZZO"
        [ -n "$TELEFONO" ] && wp post meta update $ID _ig_telefono "$TELEFONO"
        [ -n "$WEBSITE" ] && wp post meta update $ID _ig_website "$WEBSITE"
        [ -n "$PREZZO" ] && wp post meta update $ID _ig_prezzo "$PREZZO"
        [ -n "$ORARI" ] && wp post meta update $ID _ig_orari "$ORARI"
        echo "  OK — ID: $ID"
    else
        echo "  ERRORE nella creazione"
    fi
}

echo ""
echo "=== Creazione attività zona sud-ovest ==="

# --- SIRMIONE ---
create_att \
    "Terme di Sirmione — Spa & Thermal Garden" \
    "terme-sirmione-spa" \
    "sirmione" \
    "Piazza Don A. Piatti 1, 25019 Sirmione" \
    "+39 030 916261" \
    "https://www.termedisirmione.com/" \
    "3" \
    "Lun-Dom 10:00-22:00" \
    "Centro termale con oltre 700 mq di piscine di acqua sulfurea a 36°C, idromassaggi, docce aromatiche, percorso vascolare e lettini effervescenti. Il complesso si estende su 6.500 mq di parco affacciato direttamente sul Lago di Garda, offrendo un'esperienza di relax unica con vista panoramica. Trattamenti benessere, massaggi e percorsi sensoriali completano l'offerta."

create_att \
    "Castello Scaligero di Sirmione" \
    "castello-scaligero-sirmione" \
    "sirmione" \
    "Piazza Castello 34, 25019 Sirmione" \
    "+39 030 916468" \
    "https://museilombardia.cultura.gov.it/" \
    "1" \
    "Mar-Sab 8:30-19:30, Dom 8:30-14:00" \
    "Castello medievale del XIII-XIV secolo costruito dalla famiglia Della Scala di Verona, circondato interamente dalle acque del lago. È possibile salire sulla torre per godere di una vista spettacolare sulla penisola di Sirmione e sul Lago di Garda. Il castello comprende una darsena fortificata, una delle poche darsene lacustri medievali ancora conservate in Italia."

create_att \
    "Grotte di Catullo e Museo Archeologico" \
    "grotte-di-catullo-sirmione" \
    "sirmione" \
    "Piazzale Orti Manara 4, 25019 Sirmione" \
    "+39 030 916157" \
    "http://www.grottedicatullo.beniculturali.it/" \
    "1" \
    "Mar-Sab 8:30-19:30, Dom 8:30-14:00" \
    "I resti della più grande villa romana dell'Italia settentrionale (circa 2 ettari), risalente al I secolo a.C. Il sito comprende un museo archeologico con reperti romani e altomedievali, e un oliveto secolare che circonda le rovine con vista mozzafiato sul lago. Un luogo magico dove storia e natura si incontrano sulla punta estrema della penisola."

create_att \
    "Jamaica Beach — Spiaggia Giamaica" \
    "jamaica-beach-sirmione" \
    "sirmione" \
    "Punta della penisola di Sirmione" \
    "" \
    "https://visitsirmione.com/" \
    "1" \
    "Sempre accessibile (stagione balneare Giu-Set)" \
    "Spiaggia naturale unica caratterizzata da grandi lastre di roccia bianca levigate dall'acqua e dal vento, con acque cristalline e turchesi. Situata ai piedi delle Grotte di Catullo, è stata celebrata dal The Guardian come una delle spiagge più belle e selvagge d'Italia. Accesso gratuito con possibilità di noleggiare lettini nella zona attrezzata."

create_att \
    "Lanaplanet — Windsurf, Kitesurf e SUP" \
    "lanaplanet-sirmione" \
    "sirmione" \
    "Garda Village Beach, Sirmione" \
    "+39 338 624 3650" \
    "https://www.lanaplanet.it/" \
    "2" \
    "Apr-Ott: 10:00-18:00" \
    "Centro sportivo professionale che offre corsi di windsurf, kitesurf e Stand Up Paddle per principianti e avanzati. Il percorso in SUP intorno alla penisola di Sirmione permette di ammirare il castello medievale e le Grotte di Catullo dalla prospettiva unica dell'acqua. Noleggio attrezzature e corsi giornalieri disponibili."

# --- DESENZANO DEL GARDA ---
create_att \
    "Castello di Desenzano e Torre Panoramica" \
    "castello-desenzano" \
    "desenzano-del-garda" \
    "Via Castello, Desenzano del Garda" \
    "+39 030 9994301" \
    "https://www.comune.desenzano.brescia.it/" \
    "1" \
    "Mar-Dom 10:00-12:30, 14:30-18:00" \
    "Fortezza medievale con pianta rettangolare irregolare, dotata di una torre d'ingresso da cui si gode uno dei panorami più belli del Lago di Garda. Il percorso di visita include il camminamento sulle mura, la discesa nella scala a chiocciola per ammirare le antiche cannoniere, e l'accesso al mastio con osservatorio panoramico a 360 gradi."

create_att \
    "Villa Romana e Antiquarium" \
    "villa-romana-desenzano" \
    "desenzano-del-garda" \
    "Via Crocefisso 22, Desenzano del Garda" \
    "+39 030 9143547" \
    "https://www.villaromanadesenzano.beniculturali.it/" \
    "1" \
    "Mar-Dom 8:30-19:00" \
    "Una delle ville romane tardo-antiche più importanti dell'Italia settentrionale (IV-V secolo d.C.), famosa per i suoi straordinari mosaici pavimentali policromi considerati tra i più belli del Nord Italia. La villa comprendeva piscine, terme e una terrazza panoramica sul lago. L'Antiquarium espone tutti i reperti emersi dagli scavi."

create_att \
    "Navigazione Lago di Garda — Crociere e Battelli" \
    "navigazione-lago-garda" \
    "desenzano-del-garda" \
    "Porto di Desenzano del Garda" \
    "+39 800 551801" \
    "https://www.navigazionelaghi.it/" \
    "1" \
    "Tutto l'anno, orari variabili per stagione" \
    "Servizio pubblico di navigazione con battelli e catamarani che collegano tutte le località del lago. Ideale per escursioni giornaliere panoramiche: da Desenzano si raggiungono Sirmione, Salò, Gardone, Limone e Riva del Garda. Disponibili biglietti singoli, giornalieri e di libera circolazione."

create_att \
    "Noleggio Barche Desenzano" \
    "noleggio-barche-desenzano" \
    "desenzano-del-garda" \
    "Porto Vecchio, Desenzano del Garda" \
    "+39 347 4620027" \
    "https://noleggiobarchedesenzano.com/" \
    "2" \
    "Apr-Ott: 9:00-19:00" \
    "Noleggio di motoscafi con e senza patente nautica per esplorare il lago in autonomia. I tour includono Sirmione, le Grotte di Catullo viste dal lago, l'Isola del Garda e la costa della Valtenesi. Disponibili barche da 1 a 8 ore e tour guidati con skipper per gruppi."

# --- MANERBA DEL GARDA ---
create_att \
    "Rocca di Manerba — Parco Archeologico Naturalistico" \
    "rocca-manerba-garda" \
    "manerba-del-garda" \
    "Via Rocca 20, Manerba del Garda" \
    "+39 0365 659269" \
    "https://museoroccamanerba.it/" \
    "1" \
    "Mar-Dom 10:00-18:00 (estate fino alle 19:00)" \
    "Riserva naturale di quasi 200 ettari con sentieri tra uliveti, vigneti e boschi. Il Museo Archeologico della Valtenesi espone reperti preistorici e romani. Dalla cima della Rocca (216 m) si gode una vista panoramica a 360 gradi sul lago. Possibilità di birdwatching, trekking ed e-bike tra paesaggi mozzafiato."

# --- SAN FELICE DEL BENACO ---
create_att \
    "Isola del Garda — Visite Guidate" \
    "isola-del-garda" \
    "san-felice-del-benaco" \
    "Porto di San Felice del Benaco" \
    "+39 328 3848226" \
    "https://www.isoladelgarda.com/" \
    "3" \
    "Apr-Ott, visite ogni giorno tranne lunedì" \
    "L'isola più grande del Lago di Garda, con un'elegante villa neogotica veneziana dei primi del '900, circondata da giardini all'inglese e all'italiana. La visita guidata (circa 2 ore) porta i visitatori attraverso la vegetazione intatta e le sale della villa della famiglia Cavazza. Il tour include trasporto in barca A/R e drink di benvenuto. Prenotazione obbligatoria."

# --- SALÒ ---
create_att \
    "MuSa — Museo di Salò" \
    "musa-museo-salo" \
    "salo" \
    "Via Brunati, Salò" \
    "+39 0365 20553" \
    "https://museodisalo.it/" \
    "1" \
    "Mar-Dom 10:00-18:00" \
    "Museo inaugurato nel 2015 che raccoglie e interpreta l'identità di Salò e del Lago di Garda. Ospita mostre permanenti e temporanee su arte, musica — con una sezione dedicata al liutaio Gasparo da Salò, inventore del violino — storia e territorio. Un viaggio tra cultura e tradizione in una delle città più eleganti del lago."

create_att \
    "Duomo di Salò — Cattedrale di Santa Maria Annunziata" \
    "duomo-salo" \
    "salo" \
    "Piazza del Duomo, Salò" \
    "" \
    "https://www.visitbrescia.it/" \
    "1" \
    "Tutti i giorni 8:30-12:00, 15:30-19:00" \
    "Cattedrale tardo-gotica costruita nel 1453, con facciata in terracotta rimasta incompiuta. L'interno custodisce opere d'arte di grande valore: dipinti di Romanino, Moretto e Paolo Veneziano, un crocifisso ligneo di Giovanni Teutonico e l'imponente pala d'altare dell'Ancona di Salò. Ingresso gratuito."

create_att \
    "Rimbalzello Adventure Park" \
    "rimbalzello-adventure-park" \
    "salo" \
    "Barbarano di Salò" \
    "+39 333 7751227" \
    "https://rimbalzelloadventure.com/" \
    "2" \
    "Apr-Set: Sab-Dom 10:00-18:00, Lug-Ago anche infrasettimanale" \
    "Parco avventura tra gli alberi con 5 percorsi aerei a diverse altezze e livelli di difficoltà: ponti tibetani, liane, teleferiche, reti e passerelle sospese. Adatto a bambini, ragazzi e adulti. A pochi passi dal Vittoriale degli Italiani, con area picnic e bar. Divertimento garantito per tutta la famiglia."

# --- PADENGHE SUL GARDA ---
create_att \
    "Castello di Padenghe sul Garda" \
    "castello-padenghe" \
    "padenghe-sul-garda" \
    "Via Castello, Padenghe sul Garda" \
    "" \
    "https://turismo.comune.padenghesulgarda.bs.it/" \
    "1" \
    "Tutti i giorni 9:00-18:00 (estate fino alle 21:00)" \
    "Castello-ricetto risalente al IX-X secolo, il più antico della Valtenesi, che conserva quasi interamente la struttura originale con tre torri. Dalla cima della torre maggiore (oltre 21 metri) si gode un panorama spettacolare sul Lago di Garda con vista su Sirmione. Ingresso gratuito. D'estate ospita eventi teatrali e concerti all'aperto."

# --- MONIGA DEL GARDA ---
create_att \
    "Castello di Moniga del Garda" \
    "castello-moniga" \
    "moniga-del-garda" \
    "Collina sopra Moniga del Garda" \
    "" \
    "" \
    "1" \
    "Sempre accessibile (parco pubblico)" \
    "Uno dei castelli-ricetto meglio conservati del Lago di Garda, costruito nel X secolo per difendersi dalle invasioni ungariche. Di forma rettangolare con mura merlate, sette torri cilindriche e un'unica porta d'ingresso con tracce dell'antico ponte levatoio. Il parco è ad accesso libero. D'estate ospita un suggestivo festival del cinema all'aperto."

# --- LONATO DEL GARDA ---
create_att \
    "Rocca di Lonato e Fondazione Ugo Da Como" \
    "rocca-lonato-garda" \
    "lonato-del-garda" \
    "Via Rocca, Lonato del Garda" \
    "+39 030 9130060" \
    "https://www.roccadilonato.it/" \
    "1" \
    "Mar-Dom 10:00-18:00 (estate), Sab-Dom (inverno)" \
    "Fortezza del X secolo, Monumento Nazionale, lunga 180 metri e larga 45. Ospita la Fondazione Ugo Da Como con la Casa del Podestà, museo con biblioteca di circa 50.000 volumi, e il Museo Ornitologico con circa 700 esemplari di avifauna. Vista panoramica imperdibile su tutto il basso lago."

# --- GARDONE RIVIERA ---
create_att \
    "Il Vittoriale degli Italiani" \
    "vittoriale-italiani-gardone" \
    "gardone-riviera" \
    "Via Vittoriale 12, 25083 Gardone Riviera" \
    "+39 0365 296511" \
    "https://www.vittoriale.it/" \
    "2" \
    "Tutti i giorni 9:00-20:00 (estate), 9:00-17:00 (inverno)" \
    "Complesso monumentale dove visse Gabriele d'Annunzio dal 1921 alla morte nel 1938. Comprende la Prioria (casa del poeta), giardini monumentali, la nave Puglia incastonata nella collina, un MAS, il Mausoleo, l'Auditorium e un teatro all'aperto con vista sul lago che ospita concerti e spettacoli estivi. Uno dei luoghi più iconici del Lago di Garda."

# --- PUEGNAGO DEL GARDA (enogastronomia) ---
create_att \
    "Cantina Conti Thun — Degustazione Vini Valtenesi" \
    "cantina-conti-thun" \
    "puegnago-sul-garda" \
    "Puegnago del Garda" \
    "+39 0365 651757" \
    "https://www.contithun.com/" \
    "2" \
    "Su prenotazione, Lun-Sab" \
    "Cantina boutique a conduzione familiare nel cuore della Valtenesi, immersa tra le colline moreniche del Lago di Garda. Offre visite guidate con degustazione dei vini tipici della Valtenesi: Chiaretto, Groppello e Rosso, accompagnati da stuzzichini locali. Disponibile il Gran Tour con degustazione di 6 etichette. Prenotazione consigliata."

# --- SOIANO DEL LAGO (enogastronomia) ---
create_att \
    "Frantoio Manestrini — Degustazione Olio EVO" \
    "frantoio-manestrini" \
    "soiano-del-lago" \
    "Via Avanzi 7, 25080 Soiano del Lago" \
    "+39 0365 502231" \
    "https://manestrini.it/" \
    "2" \
    "Su prenotazione" \
    "Frantoio storico con oltre 40 anni di attività, immerso negli uliveti della Valtenesi. Offre visite guidate al frantoio e agli uliveti secolari, degustazione di oli extravergine Garda DOP, pranzi e aperitivi nell'Oil Bar & Bistro. Esperienza unica il Picnic tra gli Ulivi con cestini preparati con ingredienti freschi e locali."

# --- DESENZANO / SALÒ (ciclabile) ---
create_att \
    "Pista Ciclabile Desenzano — Salò (Garda by Bike)" \
    "ciclabile-desenzano-salo" \
    "desenzano-del-garda" \
    "Partenza dal lungolago di Desenzano" \
    "" \
    "https://www.gardabybikebs.it/" \
    "1" \
    "Sempre accessibile, tutto l'anno" \
    "Percorso ciclopedonale di circa 25 km (sola andata) che attraversa i magnifici paesaggi collinari della Valtenesi tra vigneti, uliveti e borghi storici come Moniga, Manerba e Padenghe. Fa parte del progetto Garda by Bike. Percorribile anche in e-bike. Noleggio biciclette disponibile presso operatori locali a Desenzano e Salò."

echo ""
echo "============================="
echo "CREAZIONE ATTIVITÀ COMPLETATA!"
echo "============================="
