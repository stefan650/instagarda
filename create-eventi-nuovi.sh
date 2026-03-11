#!/bin/bash
# Crea 50 nuovi eventi come CPT su WordPress
cd /home/customer/www/test.instagarda.net/public_html

wp rewrite flush

create_evt() {
    local TITLE="$1" SLUG="$2" TIPO="$3" DATA_I="$4" DATA_F="$5" ORA="$6" LUOGO="$7" PREZZO="$8" LINK="$9" LOCALITA="${10}" CONTENT="${11}"

    local ID=$(wp post create --post_type=evento --post_title="$TITLE" --post_name="$SLUG" --post_status=publish --post_content="$CONTENT" --porcelain)

    if [ -n "$ID" ]; then
        wp post meta update $ID _ig_data_inizio "$DATA_I"
        wp post meta update $ID _ig_data_fine "$DATA_F"
        wp post meta update $ID _ig_orario "$ORA"
        wp post meta update $ID _ig_luogo "$LUOGO"
        wp post meta update $ID _ig_prezzo_evento "$PREZZO"
        wp post meta update $ID _ig_link_esterno "$LINK"
        # Assegna tipo_evento
        wp post term set $ID tipo_evento "$TIPO" --by=slug
        # Crea/assegna localita
        wp post term set $ID localita "$LOCALITA"
        echo "Created: $TITLE (ID: $ID)"
    else
        echo "FAILED: $TITLE"
    fi
}

# ============================================
# FEBBRAIO
# ============================================

# 1
create_evt \
  "Carnevale di Bacco e Arianna – Bardolino" \
  "carnevale-bacco-arianna-bardolino-2026" \
  "sagra-festival" \
  "2026-02-07" "2026-02-07" \
  "13:00 - 18:00" \
  "Centro storico e Lungolago, Bardolino" \
  "Ingresso libero" \
  "" \
  "Bardolino" \
  "<p>Il Carnevale di Bacco e Arianna porta nelle stradine del centro storico di Bardolino e sul lungolago decine di maschere e gruppi folkloristici da tutta Italia, con sfilata ufficiale a partire dalle 14:30.</p><p>La manifestazione, dedicata soprattutto ai bambini, unisce la tradizione carnascialesca veneta con i colori e i sapori della Riviera dei Vini gardesana.</p>"

# 2
create_evt \
  "Carnevale sul Lago – Lazise" \
  "carnevale-lazise-2026" \
  "sagra-festival" \
  "2026-02-28" "2026-03-01" \
  "14:00 - 18:00" \
  "Centro storico, Lazise" \
  "Ingresso libero" \
  "" \
  "Lazise" \
  "<p>Il Carnevale della Libera Contrà del Marciapiè di Lazise è una delle manifestazioni carnevalesche più originali della sponda veronese del Garda, con sfilate di carri allegorici e maschere storiche.</p><p>L'evento si svolge nel weekend che precede il Martedì Grasso nel borgo medievale murato affacciato sul lago.</p>"

# ============================================
# MARZO
# ============================================

# 3
create_evt \
  "Biennale della Fotografia Femminile – Mantova" \
  "biennale-fotografia-femminile-mantova-2026" \
  "mostra-arte" \
  "2026-03-06" "2026-03-29" \
  "10:00 - 19:00" \
  "Casa di Rigoletto, Casa del Mantegna, Palazzo della Ragione, Mantova" \
  "Gratuito / vario" \
  "https://www.bffmantova.com/" \
  "Mantova" \
  "<p>La quarta edizione della Biennale della Fotografia Femminile di Mantova esplora il tema Liminal attraverso mostre di artiste internazionali in luoghi storici della città.</p><p>Workshop, letture portfolio, conferenze e laboratori didattici completano una rassegna che trasforma Mantova in un crocevia di sguardi e narrazioni al femminile.</p>"

# 4
create_evt \
  "La Prima del Valtènesi" \
  "prima-del-valtenesi-2026" \
  "enogastronomia" \
  "2026-03-23" "2026-03-23" \
  "10:00 - 18:00" \
  "Sede Consorzio Valtènesi, Puegnago sul Garda" \
  "Su invito" \
  "https://www.consorziovaltenesi.it/" \
  "Puegnago sul Garda" \
  "<p>La Prima del Valtènesi è la presentazione delle nuove annate del Valtènesi Chiaretto DOC e del Riviera del Garda Classico Rosso DOC riservata a stampa e operatori.</p><p>L'evento apre la stagione dei grandi appuntamenti enologici della sponda bresciana del lago.</p>"

# ============================================
# APRILE
# ============================================

# 5
create_evt \
  "Lake Garda Meeting Optimist – 44ª Edizione" \
  "lake-garda-meeting-optimist-2026" \
  "sport-regata" \
  "2026-04-02" "2026-04-05" \
  "10:00" \
  "Fraglia Vela Riva, Riva del Garda" \
  "Info su sito" \
  "https://www.fragliavelariva.it/en/regattas/44-lake-garda-meeting-optimist/" \
  "Riva del Garda" \
  "<p>La 44ª edizione del Lake Garda Meeting Optimist è la regata di classe singola più grande del mondo, con oltre 900 barche e giovani velisti da più di 40 nazioni.</p><p>Ospitata dalla Fraglia Vela Riva nelle acque del Garda Trentino, apre ufficialmente la stagione velica internazionale del lago.</p>"

# 6
create_evt \
  "Colnago Cycling Festival 2026" \
  "colnago-cycling-festival-2026" \
  "sport-regata" \
  "2026-04-10" "2026-04-12" \
  "08:00" \
  "Lungolago, Desenzano del Garda" \
  "Da €30" \
  "https://www.colnagocyclingfestival.com/en/" \
  "Desenzano del Garda" \
  "<p>L'18ª edizione del Colnago Cycling Festival unisce granfondo, gravel, randonnée attorno al lago e cicloturistica. Venerdì parte la Randonnée Giro del Lago (260 km), domenica le gare Granfondo e Mediofondo.</p><p>Sabato sera l'evento Desenzano By Night chiude la giornata con una camminata serale sul lungolago.</p>"

# 7
create_evt \
  "MTB Garda Marathon Internazionale" \
  "mtb-garda-marathon-2026" \
  "sport-regata" \
  "2026-04-11" "2026-04-11" \
  "08:00" \
  "Garda (VR), sponda veronese" \
  "Da €40" \
  "https://www.mtbgarda.org" \
  "Garda" \
  "<p>La MTB Garda Marathon Internazionale propone percorsi da 63 e 42 km per mountain bike sul versante veronese del lago. Partenza dalla cittadina di Garda con itinerari tecnici tra colline, vigneti e borghi medievali.</p><p>L'evento fa parte del circuito Veneto Bike Cup Zero Wind e attrae ciclisti da tutta Europa.</p>"

# 8
create_evt \
  "Vinitaly 2026 – 57ª Edizione" \
  "vinitaly-2026" \
  "enogastronomia" \
  "2026-04-12" "2026-04-15" \
  "09:00 - 18:00" \
  "Veronafiere, Viale del Lavoro 8, Verona" \
  "Da €30" \
  "https://www.vinitaly.com/en/" \
  "Verona" \
  "<p>La 57ª edizione di Vinitaly, il salone internazionale del vino e dei distillati, torna a Veronafiere con migliaia di espositori da tutto il mondo.</p><p>L'evento è il principale appuntamento b2b del settore vitivinicolo globale, con degustazioni, masterclass e convegni.</p>"

# 9
create_evt \
  "Vinitaly and the City 2026" \
  "vinitaly-and-the-city-2026" \
  "enogastronomia" \
  "2026-04-10" "2026-04-12" \
  "15:00 - 23:00" \
  "Piazza dei Signori e centro storico, Verona" \
  "€18 online, €22 in loco" \
  "https://www.vinitaly.com/en/events/vinitaly-and-the-city/" \
  "Verona" \
  "<p>Il fuorisalone di Vinitaly apre il vino al grande pubblico nel cuore del centro storico UNESCO di Verona, con 70 eventi, masterclass, tour e serate enogastronomiche.</p><p>L'edizione 2026 si estende anche alle cantine della Strada del Vino Valpolicella.</p>"

# 10
create_evt \
  "Lake Garda 42 – Maratona del Lago" \
  "lake-garda-42-2026" \
  "sport-regata" \
  "2026-04-12" "2026-04-12" \
  "09:00" \
  "Limone sul Garda – Malcesine (percorso lungolago)" \
  "Da €50" \
  "https://lakegarda42.com/en/lakegarda42-anmeldung/" \
  "Malcesine" \
  "<p>La maratona del Lago di Garda propone un percorso da 42 km da Limone a Malcesine e una mezza maratona da Arco a Malcesine lungo la sponda bresciana e trentina.</p><p>La gara, una delle più scenografiche d'Europa, è omologata FIDAL con limite di 4.800 partecipanti.</p>"

# 11
create_evt \
  "Garda by Bike – Granfondo Cicloturistica" \
  "garda-by-bike-2026" \
  "sport-regata" \
  "2026-04-26" "2026-04-26" \
  "08:30" \
  "Peschiera del Garda" \
  "Da €35" \
  "" \
  "Peschiera del Garda" \
  "<p>Garda by Bike è la granfondo cicloturistica che percorre la sponda veronese del lago da Peschiera verso nord, attraversando Bardolino, Garda, Torri del Benaco e Malcesine.</p><p>Percorsi da 70 e 120 km, aperta a ciclisti di tutti i livelli.</p>"

# ============================================
# MAGGIO
# ============================================

# 12
create_evt \
  "FSA Bike Festival Riva del Garda 2026" \
  "bike-festival-riva-del-garda-2026" \
  "sport-regata" \
  "2026-05-01" "2026-05-03" \
  "08:00" \
  "Riva del Garda, Garda Trentino" \
  "Da €35" \
  "https://www.bikefestivalriva.com/en" \
  "Riva del Garda" \
  "<p>Tre giorni di mountain bike, eMTB, gravel e attività per famiglie sulle sponde del Garda Trentino. Include la Bike Marathon, eBike Marathon in Val di Ledro e Bosch eMTB Challenge.</p><p>Giovedì 30 aprile l'apertura è affidata all'EpicNight Ride, pedalata notturna panoramica.</p>"

# 13
create_evt \
  "Lugana Festival 2026" \
  "lugana-festival-2026" \
  "enogastronomia" \
  "2026-05-02" "2026-05-03" \
  "10:00 - 22:00" \
  "Lungolago, Sirmione / Desenzano del Garda" \
  "Bicchiere souvenir incluso" \
  "" \
  "Sirmione" \
  "<p>Il Lugana Festival celebra il bianco di eccellenza del Garda meridionale – il Lugana DOC – con oltre 30 produttori e degustazioni aperte al pubblico.</p><p>DJ set, food truck, area bambini e masterclass guidate da sommelier in uno scenario lacustre incomparabile.</p>"

# 14
create_evt \
  "Salò Botanica 2026" \
  "salo-botanica-2026" \
  "mercatino" \
  "2026-05-15" "2026-05-18" \
  "10:00 - 22:00" \
  "Lungolago e piazze del centro, Salò" \
  "Ingresso libero" \
  "" \
  "Salò" \
  "<p>Salò Botanica trasforma il lungolago e le piazze del centro in un grande giardino a cielo aperto affacciato sul Garda, con espositori di piante rare, fiori e prodotti naturali.</p><p>Workshop di floricoltura, dimostrazioni di giardinaggio e degustazioni di prodotti tipici locali.</p>"

# 15
create_evt \
  "Festa Medievale del Vino Bianco – Soave" \
  "festa-medievale-vino-soave-2026" \
  "sagra-festival" \
  "2026-05-15" "2026-05-17" \
  "10:00 - 23:00" \
  "Centro storico di Soave (VR)" \
  "Ingresso libero (degustazioni a pagamento)" \
  "" \
  "Soave" \
  "<p>La 56ª Festa Medievale del Vino Bianco di Soave anima il borgo medievale con rievocazioni storiche, cortei in costume, mercati d'epoca e degustazioni di Soave DOC.</p><p>Il borgo si trasforma in un palcoscenico a cielo aperto con spettacoli e giostre all'ombra del castello scaligero.</p>"

# 16
create_evt \
  "Valtènesi in Rosa 2026" \
  "valtenesi-in-rosa-2026" \
  "enogastronomia" \
  "2026-05-22" "2026-05-24" \
  "10:00 - 22:00" \
  "Castello di Moniga del Garda" \
  "Info su sito" \
  "https://www.valtenesiinrosa.it/en" \
  "Moniga del Garda" \
  "<p>Valtènesi in Rosa è la rassegna nazionale dedicata ai vini rosati nel suggestivo Castello medievale di Moniga del Garda, sulla sponda bresciana.</p><p>Degustazioni guidate, convegni e momenti di cultura enologica tra architettura medievale e vigneti del Garda Classico.</p>"

# 17
create_evt \
  "Mostra Arte Contemporanea – MAG Riva del Garda" \
  "mostra-arte-contemporanea-mag-riva-2026" \
  "mostra-arte" \
  "2026-05-30" "2026-10-31" \
  "10:00 - 18:00" \
  "MAG Museo Alto Garda, Riva del Garda" \
  "€6 intero, €4 ridotto" \
  "" \
  "Riva del Garda" \
  "<p>Il MAG ospita per l'estate-autunno 2026 una mostra di arte contemporanea dedicata al rapporto tra paesaggio lacustre e produzione artistica del Novecento.</p><p>Le sale espositive offrono un percorso intorno alla storia e all'identità visiva del Garda Trentino.</p>"

# ============================================
# GIUGNO
# ============================================

# 18
create_evt \
  "Palio del Chiaretto – Bardolino in Rosa" \
  "palio-del-chiaretto-2026" \
  "enogastronomia" \
  "2026-06-05" "2026-06-07" \
  "10:30 - 24:00" \
  "Lungolago e Parco Carrara Bottagisio, Bardolino" \
  "Bicchiere €5 (degustazioni da €2)" \
  "https://paliodelchiaretto.it/en/" \
  "Bardolino" \
  "<p>Il Palio del Chiaretto celebra il celebre vino rosato della sponda veronese del Garda con tre giorni di degustazioni, musica live e DJ set fino a mezzanotte.</p><p>Include la tradizionale regata di barche, il palio tra le contrade e uno spettacolo piromusical domenica sera sull'acqua.</p>"

# 19
create_evt \
  "Horizon Lake Garda Music Festival" \
  "horizon-lake-garda-music-festival-2026" \
  "concerto-musica" \
  "2026-06-12" "2026-06-13" \
  "17:00 - 02:00" \
  "Foce del Sarca, Torbole sul Garda" \
  "Da €50" \
  "https://www.gardatrentino.it/en/events/horizon-lake-garda-music-festival_64209" \
  "Torbole sul Garda" \
  "<p>L'Horizon Lake Garda Music Festival trasforma la spiaggia alla Foce del Sarca di Torbole in una grande arena internazionale di musica elettronica per due giorni.</p><p>Un lineup straordinario, paesaggi mozzafiato e una community di appassionati da tutta Europa.</p>"

# 20
create_evt \
  "Arena di Verona Opera Festival 2026 – 103ª Edizione" \
  "arena-verona-opera-festival-2026" \
  "teatro-spettacolo" \
  "2026-06-12" "2026-09-12" \
  "21:00" \
  "Arena di Verona" \
  "Da €30" \
  "https://www.arena.it/en/arena-verona-opera-festival/" \
  "Verona" \
  "<p>La 103ª edizione dell'Arena di Verona Opera Festival propone 50 serate di grande lirica nell'anfiteatro romano più grande del mondo: Aida, La Traviata, Turandot, La Bohème, Nabucco e Carmina Burana.</p><p>Stelle internazionali come Anna Netrebko e Lisette Oropesa. Oltre all'opera, concerti speciali e serate evento.</p>"

# 21
create_evt \
  "Fiera del Vino di Polpenazze – 74ª Edizione" \
  "fiera-vino-polpenazze-2026" \
  "enogastronomia" \
  "2026-06-12" "2026-06-14" \
  "18:00 - 23:00" \
  "Polpenazze del Garda (BS)" \
  "Ingresso libero" \
  "https://www.consorziovaltenesi.it/" \
  "Polpenazze del Garda" \
  "<p>La Fiera del Vino di Polpenazze è uno degli appuntamenti enologici più antichi del Garda bresciano, con degustazioni, convegni e gastronomia nei vigneti della Valtenesi.</p><p>Abbinata alla 20ª edizione del Concorso Enologico Valtènesi – Riviera del Garda Classico.</p>"

# 22
create_evt \
  "Festival del Vittoriale – Tener-a-Mente Solstizio" \
  "tener-a-mente-solstizio-2026" \
  "concerto-musica" \
  "2026-06-26" "2026-07-31" \
  "21:00" \
  "Anfiteatro del Vittoriale degli Italiani, Gardone Riviera" \
  "Da €40" \
  "https://www.anfiteatrodelvittoriale.it/" \
  "Gardone Riviera" \
  "<p>La 15ª edizione del festival estivo del Vittoriale porta sull'anfiteatro scavato nei giardini dannunziani artisti italiani e internazionali di alto calibro.</p><p>Of Monsters and Men, Steve Vai, LP, Diana Krall. Un'esperienza unica dove la musica si fonde con il paesaggio del lago al tramonto.</p>"

# ============================================
# LUGLIO
# ============================================

# 23
create_evt \
  "Garda Festival – Cinema e Musica sul Lago" \
  "garda-festival-2026" \
  "sagra-festival" \
  "2026-07-01" "2026-08-31" \
  "20:00" \
  "Castelnuovo, Desenzano, Lazise, Peschiera, Sirmione" \
  "Vario" \
  "https://www.gardafestival.com/en/home-english/" \
  "Desenzano del Garda" \
  "<p>Festival multidisciplinare internazionale che celebra la vocazione musicale e cinematografica del lago di Garda in luoghi di straordinario valore architettonico.</p><p>Opera, musica sinfonica, pop, musica da camera e cinema d'autore per tutta l'estate.</p>"

# 24
create_evt \
  "Estate Musicale del Garda – Gasparo da Salò" \
  "estate-musicale-garda-gasparo-salo-2026" \
  "concerto-musica" \
  "2026-07-03" "2026-08-28" \
  "21:00" \
  "Salò e comuni del Garda bresciano" \
  "Da €10" \
  "" \
  "Salò" \
  "<p>Ogni giovedì sera di luglio e agosto concerti di musica classica, jazz e contemporanea nei borghi e nelle ville storiche della sponda bresciana del lago.</p><p>Dedicata a Gasparo Bertolotti da Salò, il liutaio rinascimentale considerato l'inventore del violino moderno.</p>"

# 25
create_evt \
  "Estate Teatrale Veronese – Teatro Romano" \
  "estate-teatrale-veronese-teatro-romano-2026" \
  "concerto-musica" \
  "2026-07-04" "2026-08-29" \
  "21:00" \
  "Teatro Romano, Verona" \
  "Da €30" \
  "https://www.spettacoloverona.it/" \
  "Verona" \
  "<p>La rassegna Contaminazioni Musicali del Teatro Romano propone concerti di artisti italiani e internazionali nell'anfiteatro romano affacciato sull'Adige.</p><p>Niccolò Fabi, Johnny Marr, Daniele Silvestri e Joan Thiele nell'estate 2026.</p>"

# 26
create_evt \
  "Mantova Summer Festival 2026" \
  "mantova-summer-festival-2026" \
  "concerto-musica" \
  "2026-07-04" "2026-09-02" \
  "21:00" \
  "Piazza Sordello e Esedra di Palazzo Te, Mantova" \
  "Da €35" \
  "https://mantova-live.it/mantovasummerfestival/" \
  "Mantova" \
  "<p>Il Mantova Summer Festival trasforma Piazza Sordello e l'Esedra di Palazzo Te nei principali palcoscenici estivi del Nord Italia.</p><p>Line-up 2026: Caparezza, Pet Shop Boys, Jethro Tull, Coez, Mannarino e Luca Carboni.</p>"

# 27
create_evt \
  "MusicaRiva Festival – 41ª Edizione" \
  "musica-riva-festival-2026" \
  "concerto-musica" \
  "2026-07-10" "2026-08-09" \
  "21:00" \
  "Riva del Garda, Arco, Tenno, Malcesine" \
  "Da €15" \
  "https://www.musicariva.org/musicarivafestival" \
  "Riva del Garda" \
  "<p>Un mese di musica sinfonica, jazz, dixieland e recital solistici in luoghi iconici del Garda Trentino e dintorni.</p><p>Il festival unisce orchestre giovanili internazionali, artisti emergenti e musicisti affermati. Uno dei più longevi appuntamenti musicali del lago.</p>"

# 28
create_evt \
  "IFSC Campionati Mondiali Giovanili Arrampicata – Arco" \
  "campionati-mondiali-giovanili-arrampicata-arco-2026" \
  "sport-regata" \
  "2026-07-18" "2026-07-25" \
  "09:00" \
  "Centro Tecnico Federale FASI, Arco" \
  "Ingresso gratuito" \
  "" \
  "Arco" \
  "<p>I Campionati del Mondo Giovanili di Arrampicata Sportiva 2026 tornano ad Arco con oltre 1000 atleti da 70 nazioni in gara nelle discipline Lead, Boulder e Speed.</p><p>Il Centro Tecnico Federale completamente rinnovato diventa il cuore della scalata mondiale per una settimana.</p>"

# 29
create_evt \
  "Campionato Italiano Windsurfer – Torbole" \
  "campionato-italiano-windsurfer-torbole-2026" \
  "sport-regata" \
  "2026-07-18" "2026-07-19" \
  "10:00" \
  "Circolo Surf Torbole, Torbole sul Garda" \
  "Iscrizione atleti" \
  "" \
  "Torbole sul Garda" \
  "<p>Il Campionato Italiano Windsurfer torna a Torbole, una delle capitali mondiali del windsurf grazie ai venti costanti della punta nord del lago.</p><p>Le acque di Torbole, incorniciate dalle Alpi, offrono condizioni tecnicamente sfidanti per questo sport olimpico.</p>"

# ============================================
# AGOSTO
# ============================================

# 30
create_evt \
  "Sagra del Tortel di Patate – Trentino" \
  "sagra-tortel-patate-trentino-2026" \
  "sagra-festival" \
  "2026-08-01" "2026-08-02" \
  "11:00 - 22:00" \
  "Borgo Trentino, zona Alto Garda" \
  "Ingresso libero (piatti a pagamento)" \
  "" \
  "Arco" \
  "<p>La Sagra del Tortel di Patate celebra il piatto croccante della tradizione montana trentina: un disco di patate grattugiate fritto in padella, simbolo della cucina popolare del Garda Trentino.</p><p>Gare tra cuochi locali, degustazioni con vini Trentino DOC e musica folk.</p>"

# ============================================
# SETTEMBRE
# ============================================

# 31
create_evt \
  "Festival del Vittoriale – Tener-a-Mente Equinozio" \
  "tener-a-mente-equinozio-2026" \
  "concerto-musica" \
  "2026-09-04" "2026-09-16" \
  "21:00" \
  "Anfiteatro del Vittoriale degli Italiani, Gardone Riviera" \
  "Da €40" \
  "https://www.anfiteatrodelvittoriale.it/" \
  "Gardone Riviera" \
  "<p>Il secondo capitolo del festival estivo del Vittoriale 2026 con Biagio Antonacci e altri grandi nomi della scena musicale italiana e internazionale.</p><p>L'anfiteatro di Gardone Riviera ospita serate memorabili nella magia del crepuscolo lacustre.</p>"

# 32
create_evt \
  "Festivaletteratura di Mantova – 30ª Edizione" \
  "festivaletteratura-mantova-2026" \
  "sagra-festival" \
  "2026-09-09" "2026-09-13" \
  "09:00 - 23:00" \
  "Piazze e palazzi storici, Mantova" \
  "Da €3" \
  "https://www.festivaletteratura.it/en/home" \
  "Mantova" \
  "<p>La 30ª edizione del Festivaletteratura porta nella città dei Gonzaga autori italiani e internazionali per incontri, letture, performance e mostre.</p><p>Oltre 60.000 presenze in cinque giorni nei luoghi più suggestivi del centro storico rinascimentale.</p>"

# 33
create_evt \
  "Tocatì – Festival Internazionale dei Giochi di Strada" \
  "tocati-2026" \
  "sagra-festival" \
  "2026-09-17" "2026-09-20" \
  "10:00 - 23:00" \
  "Centro storico, Verona" \
  "Ingresso libero" \
  "https://tocati.it/en/" \
  "Verona" \
  "<p>La 24ª edizione di Tocatì invade piazze, cortili e vicoli del centro storico UNESCO di Verona con giochi tradizionali da ogni angolo del mondo.</p><p>Sport antichi, disfide, giochi per bambini e adulti riempiono la città per un lungo weekend di festa.</p>"

# 34
create_evt \
  "Verona Music Awards 2026" \
  "verona-music-awards-arena-2026" \
  "concerto-musica" \
  "2026-09-18" "2026-09-19" \
  "21:00" \
  "Arena di Verona" \
  "Da €50" \
  "https://www.arena.it/en/calendar/" \
  "Verona" \
  "<p>I Verona Music Awards 2026 tornano all'Arena di Verona in due serate di grande spettacolo che celebrano la musica italiana e internazionale.</p><p>Premi, esibizioni live e momenti emozionanti nell'anfiteatro romano più famoso del mondo.</p>"

# ============================================
# OTTOBRE
# ============================================

# 35
create_evt \
  "Rock Master 2026 – 40 Anni ad Arco" \
  "rock-master-arco-2026" \
  "sport-regata" \
  "2026-10-02" "2026-10-04" \
  "10:00" \
  "Stadio dell'Arrampicata, Arco" \
  "Ingresso libero (tribuna a pagamento)" \
  "https://rockmaster.com/en" \
  "Arco" \
  "<p>Il Rock Master 2026 festeggia 40 anni con i migliori 8 atleti maschi e 8 femmine del mondo in gara nelle discipline Boulder e Lead nello Stadio dell'Arrampicata.</p><p>Kids Area, slackline e skate activities completano tre giorni per tutta la famiglia.</p>"

# 36
create_evt \
  "Festival del Pesce d'Acqua Dolce – Garda Trentino" \
  "festival-pesce-acqua-dolce-garda-trentino-2026" \
  "enogastronomia" \
  "2026-10-02" "2026-10-04" \
  "11:00 - 22:00" \
  "Riva del Garda, Arco, Torbole" \
  "Vario" \
  "https://www.gardatrentino.it/en/events/festival-del-pesce-dacqua-dolce_26524" \
  "Riva del Garda" \
  "<p>Tre giorni dedicati alla scoperta del pesce di lago: carpioni, trote, lucci e lavarelli. Chef locali propongono ricette innovative e tradizionali con showcooking e mercatini.</p><p>L'evento di punta del Mese del Gusto del Garda Trentino.</p>"

# 37
create_evt \
  "Gardaland Magic Halloween" \
  "gardaland-magic-halloween-2026" \
  "sagra-festival" \
  "2026-10-03" "2026-11-02" \
  "10:00 - 22:00" \
  "Gardaland Resort, Castelnuovo del Garda" \
  "Da €29" \
  "https://www.gardaland.it/en/explore-gardaland/events-special-openings/magic-halloween/" \
  "Castelnuovo del Garda" \
  "<p>Gardaland si trasforma per un mese intero nella capitale italiana di Halloween con attrazioni a tema horror, spettacoli speciali e scenografie mozzafiato.</p><p>Zombie parade, case degli orrori, decorazioni a tema e personaggi in costume per tutta la famiglia.</p>"

# 38
create_evt \
  "Milk Festival di Fiavè" \
  "milk-festival-flave-2026" \
  "sagra-festival" \
  "2026-10-11" "2026-10-12" \
  "10:00 - 18:00" \
  "Fiavè (TN), Valle dei Laghi" \
  "Ingresso libero" \
  "" \
  "Fiavè" \
  "<p>Il Milk Festival di Fiavè è dedicato alla filiera del latte montano e ai formaggi dell'altopiano trentino con degustazioni, concorsi caseari e attività per famiglie.</p><p>Fiavè, Patrimonio UNESCO per le sue palafitte preistoriche, ospita l'evento in un contesto di grande valenza storica.</p>"

# 39
create_evt \
  "Festival Internazionale Cori e Orchestre sul Lago di Garda" \
  "festival-cori-orchestre-lago-garda-2026" \
  "concerto-musica" \
  "2026-10-14" "2026-10-18" \
  "17:00" \
  "Riva del Garda, Desenzano, Sirmione" \
  "Vario" \
  "" \
  "Riva del Garda" \
  "<p>La 19ª edizione porta per cinque giorni ensemble corali e orchestrali da tutto il mondo nelle chiese, auditori e piazze dei borghi gardesani.</p><p>Concerti, workshop corali e momenti di scambio musicale interculturale nella bellezza autunnale del lago.</p>"

# 40
create_evt \
  "Sagra dei Maroni di Drena" \
  "sagra-maroni-drena-2026" \
  "sagra-festival" \
  "2026-10-25" "2026-10-26" \
  "10:00 - 20:00" \
  "Drena (TN), Garda Trentino" \
  "Ingresso libero" \
  "" \
  "Drena" \
  "<p>Caldarroste, polenta, vini autunnali e prodotti tipici nel borgo medievale sotto il castello di Drena. Una sagra tradizionale del Mese del Gusto del Garda Trentino.</p><p>Musica folk e artigianato locale celebrano i ritmi e i sapori dell'autunno trentino.</p>"

# ============================================
# NOVEMBRE
# ============================================

# 41
create_evt \
  "Frantoi Aperti – Garda Trentino" \
  "frantoi-aperti-garda-trentino-2026" \
  "enogastronomia" \
  "2026-11-01" "2026-11-02" \
  "10:00 - 18:00" \
  "Frantoi di Arco, Riva del Garda, Torbole" \
  "Ingresso gratuito (degustazioni incluse)" \
  "https://www.gardatrentino.it/en/events/frantoi-aperti_11319" \
  "Arco" \
  "<p>I frantoi del Garda Trentino aprono le porte per raccontare l'arte millenaria della produzione dell'olio extravergine d'oliva gardesano con visite guidate e degustazioni.</p><p>L'evento si svolge tra ulivi centenari lungo il celebre Sentiero dell'Ulivo sopra Arco, Riva e Torbole.</p>"

# 42
create_evt \
  "Garda Trentino Half Marathon – 24ª Edizione" \
  "garda-trentino-half-marathon-2026" \
  "sport-regata" \
  "2026-11-08" "2026-11-08" \
  "10:15" \
  "PalaFiere – Spiaggia dei Sabbioni, Riva del Garda" \
  "Da €30" \
  "" \
  "Riva del Garda" \
  "<p>Una delle mezze maratone più panoramiche d'Europa: 21 km da Riva del Garda ad Arco lungo il fiume Sarca fino alla Spiaggia dei Sabbioni.</p><p>Anche distanza da 10 km e Run4Fun, con un limite di 4.800 partecipanti.</p>"

# 43
create_evt \
  "Mercatino di Natale di Riva del Garda – Di Gusto in Gusto" \
  "mercatino-natale-riva-garda-2026" \
  "mercatino" \
  "2026-11-14" "2027-01-06" \
  "10:00 - 19:00" \
  "Piazza III Novembre e Piazza Cesare Battisti, Riva del Garda" \
  "Ingresso libero" \
  "https://www.gardatrentino.it/en/events/from-taste-to-taste_9213" \
  "Riva del Garda" \
  "<p>Casette in legno dedicate alle specialità gastronomiche del Garda Trentino in una delle più belle piazze lacustri d'Italia affacciata sull'acqua.</p><p>Prodotti tipici, dolci natalizi trentini e artigianato locale con lo sfondo delle montagne innevate.</p>"

# 44
create_evt \
  "Presepi dal Mondo – Palazzo Gran Guardia Verona" \
  "presepi-dal-mondo-verona-2026" \
  "mostra-arte" \
  "2026-11-17" "2027-01-18" \
  "10:00 - 19:00" \
  "Palazzo della Gran Guardia, Verona" \
  "€5 intero" \
  "" \
  "Verona" \
  "<p>La 39ª Rassegna Internazionale del Presepio raccoglie natività artistiche da decine di Paesi del mondo, dalle tradizioni alpina e mediterranea alle interpretazioni esotiche.</p><p>Una delle mostre presepiali più complete d'Italia, nel cuore del centro storico UNESCO di Verona.</p>"

# 45
create_evt \
  "Mercatini di Natale di Verona" \
  "mercatini-natale-verona-2026" \
  "mercatino" \
  "2026-11-21" "2026-12-28" \
  "10:00 - 21:00" \
  "Piazza Bra, Piazza dei Signori, Verona" \
  "Ingresso libero" \
  "https://www.nataleinpiazza.it/" \
  "Verona" \
  "<p>Circa 100 espositori, vin brulé, prelibatezze speziate e prodotti artigianali nel cuore del centro storico UNESCO di Verona.</p><p>La celebre Stella Cometa di Piazza Bra illumina le notti veronesi. Pista di pattinaggio e Fiera di Santa Lucia.</p>"

# ============================================
# DICEMBRE
# ============================================

# 46
create_evt \
  "Mercatini di Natale di Desenzano del Garda" \
  "mercatini-natale-desenzano-2026" \
  "mercatino" \
  "2026-12-06" "2027-01-06" \
  "10:00 - 20:00" \
  "Piazza Malvezzi e Lungolago, Desenzano del Garda" \
  "Ingresso libero" \
  "" \
  "Desenzano del Garda" \
  "<p>Casette in legno con artigianato, prodotti tipici bresciani e specialità gastronomiche invernali nel centro storico tra Piazza Malvezzi e il lungolago.</p><p>Luminarie, mostre di presepi e animazioni per famiglie con il lago sullo sfondo.</p>"

# 47
create_evt \
  "Gardaland Magic Winter" \
  "gardaland-magic-winter-2026" \
  "sagra-festival" \
  "2026-12-06" "2027-01-06" \
  "10:00 - 20:00" \
  "Gardaland Resort, Castelnuovo del Garda" \
  "Da €29" \
  "https://www.gardaland.it/en/explore-gardaland/events-special-openings/magic-winter/" \
  "Castelnuovo del Garda" \
  "<p>Gardaland si veste di magia natalizia con il parco addobbato a festa, spettacoli speciali, personaggi natalizi e attrazioni aperte anche in inverno.</p><p>SUPERMAGIC, show di magia ed illusionismo, accompagna i visitatori per tutto il periodo delle feste.</p>"

# 48
create_evt \
  "Mercatini di Natale di Sirmione" \
  "mercatini-natale-sirmione-2026" \
  "mercatino" \
  "2026-12-07" "2027-01-06" \
  "10:00 - 20:00" \
  "Centro storico e Castello Scaligero, Sirmione" \
  "Ingresso libero" \
  "https://visitsirmione.com/en/" \
  "Sirmione" \
  "<p>Casette artigianali, prodotti tipici bresciani, vin brulé e dolci natalizi nel centro storico medievale con il castello scaligero sullo sfondo del lago.</p><p>Un mercatino unico per la combinazione di architettura medievale, lago e atmosfera natalizia.</p>"

# 49
create_evt \
  "Bike Marathon Garda Trentino" \
  "bike-marathon-garda-trentino-2026" \
  "sport-regata" \
  "2026-05-02" "2026-05-02" \
  "08:00" \
  "Riva del Garda, Garda Trentino" \
  "Inclusa nel Bike Festival" \
  "https://www.bikefestivalriva.com/en" \
  "Riva del Garda" \
  "<p>La gara principale del FSA Bike Festival con percorsi tecnici che toccano i sentieri più spettacolari sopra Riva del Garda, Tenno e la Val di Ledro.</p><p>Percorsi completamente rinnovati per il 2026 con viste panoramiche straordinarie sul lago.</p>"

# 50
create_evt \
  "Colnago Gravel Garda – Sentieri della Battaglia" \
  "colnago-gravel-garda-trentino-sentieri-battaglia-2026" \
  "sport-regata" \
  "2026-04-10" "2026-04-10" \
  "07:30" \
  "Lungolago, Desenzano del Garda" \
  "Inclusa nel Colnago Cycling Festival" \
  "https://www.colnagocyclingfestival.com/en/" \
  "Desenzano del Garda" \
  "<p>La gara gravel del venerdì del Colnago Cycling Festival sulle colline moreniche del basso lago di Garda, attraverso i luoghi della Battaglia di San Martino (1859).</p><p>Tracciati off-road e strade bianche con panorami sul lago e sui monumenti risorgimentali.</p>"

echo ""
echo "============================="
echo "FATTO! Creati 50 nuovi eventi"
echo "============================="
