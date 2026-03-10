#!/bin/bash
# Crea i 27 itinerari come CPT su WordPress
cd /home/customer/www/test.instagarda.net/public_html

# Flush rewrite rules first
wp rewrite flush

create_itin() {
    local TITLE="$1" SLUG="$2" TYPE="$3" DIFF="$4" KM="$5" ELEV="$6" DESC_="$7" HOURS="$8" ZONE="$9" LAT="${10}" LNG="${11}" OAID="${12}" TAGS="${13}" CONTENT="${14}"

    local ID=$(wp post create --post_type=itinerario --post_title="$TITLE" --post_name="$SLUG" --post_status=publish --post_content="$CONTENT" --porcelain)

    if [ -n "$ID" ]; then
        wp post meta update $ID _ig_itin_type "$TYPE"
        wp post meta update $ID _ig_itin_difficulty "$DIFF"
        wp post meta update $ID _ig_itin_km "$KM"
        wp post meta update $ID _ig_itin_elevation "$ELEV"
        wp post meta update $ID _ig_itin_descent "$DESC_"
        wp post meta update $ID _ig_itin_hours "$HOURS"
        wp post meta update $ID _ig_itin_zone "$ZONE"
        wp post meta update $ID _ig_itin_lat "$LAT"
        wp post meta update $ID _ig_itin_lng "$LNG"
        wp post meta update $ID _ig_itin_oa_id "$OAID"
        wp post meta update $ID _ig_itin_tags "$TAGS"
        echo "Created: $TITLE (ID: $ID)"
    fi
}

# 1. Sentiero del Ponale
create_itin "Sentiero del Ponale" "sentiero-del-ponale" "hiking" "facile" "5.2" "290" "250" "2:00" "Riva del Garda" "45.8730" "10.8340" "1481019" "vista-lago,panoramico,consigliato,culturale,famiglie,ristori" "<p>Spettacolare sentiero scavato nella roccia a picco sul lago. Ex strada militare austro-ungarica, oggi il sentiero più iconico del Garda.</p><p>Partenza dal porto vecchio di Riva, arrivo al Lago di Ledro con possibilità di sosta al rifugio. Vista costante sul lago e le montagne.</p><p>Il percorso segue l'antica strada del Ponale, costruita tra il 1848 e il 1851 per collegare Riva del Garda alla Valle di Ledro. Scavata direttamente nella roccia a strapiombo sul lago, offre panorami mozzafiato in ogni stagione.</p>"

# 2. Rocca di Manerba
create_itin "Rocca di Manerba" "rocca-di-manerba" "hiking" "facile" "3.5" "120" "120" "1:15" "Manerba del Garda" "45.5520" "10.5530" "1530226" "vista-lago,panoramico,circolare,famiglie,culturale,cani,balneabile" "<p>Sentiero panoramico sulla penisola con resti del castello medievale e vista a 360° sul basso lago.</p><p>Parco archeologico naturalistico con pannelli informativi. Percorso ad anello adatto a tutti, immerso nella macchia mediterranea con uliveti e lecci.</p><p>Dalla sommità della Rocca si domina l'intero basso lago, l'Isola del Garda e le colline moreniche. Area protetta dal Parco Naturale della Rocca e del Sasso.</p>"

# 3. Sentiero dei Limoni
create_itin "Sentiero dei Limoni" "sentiero-dei-limoni" "hiking" "facile" "2.8" "80" "80" "1:00" "Limone sul Garda" "45.8090" "10.7900" "1505183" "panoramico,famiglie,culturale,accessibile" "<p>Passeggiata tra le antiche limonaie con terrazzamenti e viste sulla sponda bresciana.</p><p>Percorso storico che racconta la tradizione agrumicola del Garda, con pannelli che illustrano la coltivazione dei limoni iniziata nel XIII secolo.</p><p>Facile e adatto a tutti, il sentiero attraversa i giardini terrazzati dove ancora oggi crescono limoni, cedri e arance amare.</p>"

# 4. Cima Comer da Gargnano
create_itin "Cima Comer da Gargnano" "cima-comer-gargnano" "hiking" "difficile" "12.5" "1150" "1150" "5:30" "Gargnano" "45.6940" "10.6460" "1497954" "panoramico" "<p>Salita impegnativa verso la Cima Comer (1279m). Sentiero nel bosco con tratti esposti nella parte finale.</p><p>Dalla vetta si vede l'intero lago, dal Trentino a Sirmione. Solo per escursionisti esperti con buona preparazione fisica.</p><p>Il percorso parte dal lungolago di Gargnano e sale attraverso boschi di castagni e faggi fino alla cresta panoramica del Monte Denervo e Cima Comer.</p>"

# 5. Sentiero del Ventrar
create_itin "Sentiero del Ventrar" "sentiero-del-ventrar" "hiking" "media" "7.0" "420" "420" "3:00" "Tremosine" "45.7650" "10.7600" "14352779" "panoramico,circolare" "<p>Percorso panoramico sull'altopiano di Tremosine. Vista vertiginosa sulla Strada della Forra e sul lago.</p><p>Partenza da Pieve di Tremosine con ritorno ad anello tra borghi e uliveti. Il sentiero offre scorci unici sulla gola del torrente Brasa e sulle pareti verticali che scendono al lago.</p>"

# 6. Monte Baldo — Cresta
create_itin "Monte Baldo — Cresta" "monte-baldo-cresta" "hiking" "media" "8.5" "480" "480" "3:30" "Malcesine" "45.7250" "10.8520" "215009748" "vista-lago,panoramico,consigliato,mezzi" "<p>Traversata in cresta sul Monte Baldo con vista lago e Dolomiti. Si sale in funivia da Malcesine (1760m) e si cammina lungo il crinale tra prati fioriti e panorami infiniti.</p><p>Discesa a piedi o in funivia. In primavera il Monte Baldo è famoso per le oltre 600 specie di fiori che colorano i prati sommitali, tanto da meritarsi il nome di 'Giardino d'Europa'.</p>"

# 7. Punta San Vigilio
create_itin "Punta San Vigilio" "punta-san-vigilio" "hiking" "facile" "4.0" "50" "50" "1:30" "Garda" "45.5660" "10.7100" "265353721" "vista-lago,panoramico,famiglie,cani,consigliato,balneabile,ombreggiato" "<p>Passeggiata tra uliveti e cipressi verso la punta più romantica del lago. Baia nascosta, villa cinquecentesca e locanda storica.</p><p>Percorso pianeggiante adatto a tutti. Punta San Vigilio è considerata uno dei luoghi più belli del Garda, con la sua piccola baia riparata, la chiesa di San Vigilio e la storica Locanda che ospitò personaggi illustri nel corso dei secoli.</p>"

# 8. Cascate di Molina
create_itin "Cascate di Molina" "cascate-di-molina" "hiking" "media" "6.0" "350" "350" "2:30" "Fumane" "45.5850" "10.8450" "58399382" "panoramico,ristori" "<p>Percorso nel Parco delle Cascate con passerelle sospese tra gole e salti d'acqua. Tre percorsi di diversa lunghezza.</p><p>Ingresso a pagamento. Fresco anche in estate grazie all'ombra della forra e all'umidità delle cascate. Un'oasi naturale nell'entroterra veronese della Valpolicella.</p>"

# 9. Eremo di San Giorgio
create_itin "Eremo di San Giorgio" "eremo-di-san-giorgio" "hiking" "facile" "3.2" "180" "180" "1:15" "Bardolino" "45.5430" "10.7050" "804061398" "panoramico,culturale,circolare" "<p>Breve salita all'eremo con panorama sulla distesa del lago e i vigneti del Bardolino.</p><p>Sentiero tra cipressi e uliveti. Ritorno per lo stesso sentiero o variante ad anello. L'eremo medievale offre una vista privilegiata sulla sponda veronese e sul basso lago.</p>"

# 10. Busatte — Tempesta
create_itin "Busatte — Tempesta" "busatte-tempesta" "hiking" "facile" "4.0" "200" "400" "1:30" "Torbole" "45.8540" "10.8740" "1541894" "vista-lago,panoramico,famiglie,consigliato,mezzi" "<p>Il sentiero più famoso dell'alto Garda: 400 gradini di ferro a picco sul lago con vista mozzafiato.</p><p>Da Busatte (Nago) si scende a Tempesta. Facile ma spettacolare. Bus navetta per il ritorno. Le scalinate metalliche agganciate alla parete rocciosa offrono un'esperienza unica, sospesi tra cielo e lago.</p>"

# 11. Monte Brione
create_itin "Monte Brione" "monte-brione" "hiking" "facile" "5.5" "200" "200" "2:00" "Riva del Garda" "45.8780" "10.8810" "1490743" "panoramico,circolare,famiglie,culturale,cani" "<p>Anello sulla collina tra Riva e Torbole. Forte austro-ungarico, flora mediterranea e viste su entrambi i paesi.</p><p>Percorso botanico con orchidee selvatiche. Uno dei migliori per principianti. Il Monte Brione è un'isola di biodiversità con specie mediterranee uniche a questa latitudine.</p>"

# 12. Rifugio Altissimo
create_itin "Rifugio Altissimo" "rifugio-altissimo" "hiking" "difficile" "14.0" "1100" "1100" "6:00" "Brentonico" "45.8200" "10.9100" "14373302" "panoramico,ristori" "<p>Escursione impegnativa fino al Monte Altissimo (2079m), il balcone panoramico del Garda.</p><p>Dal rifugio Damiano Chiesa si domina l'intero lago. Possibilità di pernottamento in rifugio. La vetta offre una vista che spazia dalle Dolomiti di Brenta alla Pianura Padana.</p>"

# 13. Ciclabile Limone — Riva
create_itin "Ciclabile Limone — Riva" "ciclabile-limone-riva" "cycling" "facile" "15.0" "60" "60" "1:00" "Limone sul Garda" "45.8350" "10.8020" "800639914" "vista-lago,panoramico,famiglie,accessibile,ebike,consigliato,passeggino" "<p>La ciclabile a sbalzo sul lago più famosa d'Europa. Passerelle agganciate alla roccia a picco sull'acqua.</p><p>Percorso pianeggiante e protetto, adatto anche a bambini e e-bike. Vista spettacolare per tutto il tragitto. Un capolavoro di ingegneria che segue la costa tra gallerie illuminate e tratti panoramici mozzafiato.</p>"

# 14. Ciclopista del Mincio
create_itin "Ciclopista del Mincio" "ciclopista-del-mincio" "cycling" "facile" "43.0" "40" "40" "3:00" "Peschiera del Garda" "45.4390" "10.6880" "56764715" "famiglie,accessibile,ebike,ristori,cani,consigliato,passeggino,ombreggiato,culturale" "<p>Da Peschiera del Garda a Mantova lungo il fiume Mincio. Percorso completamente pianeggiante su pista ciclabile separata.</p><p>Attraversa Borghetto (uno dei borghi più belli d'Italia), Valeggio e il Parco del Mincio. Un viaggio tra natura, storia e gastronomia lungo uno dei fiumi più belli del nord Italia.</p>"

# 15. Colline Moreniche
create_itin "Colline Moreniche" "colline-moreniche" "cycling" "media" "38.0" "450" "450" "2:30" "Desenzano del Garda" "45.4600" "10.6300" "209343437" "panoramico,circolare,ebike,ristori" "<p>Percorso tra le colline moreniche del basso lago. Vigneti, castelli, borghi medievali e panorami sul Garda.</p><p>Alcuni strappi in salita ma nulla di impegnativo con e-bike. Il percorso attraversa la zona DOC del Lugana e del San Martino della Battaglia.</p>"

# 16. Ciclabile della Vallagarina
create_itin "Ciclabile della Vallagarina" "ciclabile-vallagarina" "cycling" "facile" "25.0" "80" "80" "1:45" "Riva del Garda" "45.8900" "10.9800" "8350452" "famiglie,accessibile,ebike" "<p>Da Rovereto a Riva del Garda su pista ciclabile separata. Lungo il fiume Adige e il suggestivo lago di Loppio.</p><p>Percorso in leggera discesa verso il lago — ideale con bambini. Attraversa paesaggi tra vigneti, meleti e il caratteristico lago di Loppio, un antico bacino lacustre oggi prosciugato.</p>"

# 17. Tremalzo Trail
create_itin "Tremalzo Trail" "tremalzo-trail" "mtb" "difficile" "32.0" "1500" "1800" "5:00" "Limone sul Garda" "45.8100" "10.7200" "15856288" "panoramico" "<p>Il trail MTB più iconico del Garda. Salita su strada sterrata al Passo Tremalzo (1665m), poi discesa mozzafiato su single trail tecnici con viste aeree sul lago.</p><p>Solo per biker esperti con buona preparazione fisica. Il Tremalzo è considerato uno dei percorsi MTB più belli d'Europa e attira rider da tutto il mondo.</p>"

# 18. Trail 601 Monte Baldo
create_itin "Trail 601 Monte Baldo" "trail-601-monte-baldo" "mtb" "difficile" "18.0" "1700" "1700" "3:30" "Malcesine" "45.7350" "10.8600" "17856272" "panoramico" "<p>Funivia da Malcesine + discesa dal Monte Baldo su trail tecnico con viste aeree sul lago.</p><p>Trail 601: il più famoso downhill del Garda. Solo per esperti con protezioni. Il percorso scende dalla cima del Monte Baldo attraverso single trail tecnici con passaggi esposti e panorami vertiginosi.</p>"

# 19. Ponale MTB
create_itin "Ponale MTB" "ponale-mtb" "mtb" "media" "12.0" "600" "600" "2:00" "Riva del Garda" "45.8720" "10.8350" "15866611" "panoramico,circolare,ristori" "<p>Variante MTB del sentiero del Ponale. Salita al Lago di Ledro e ritorno su sentiero panoramico.</p><p>Percorso misto strada e trail, adatto a biker di livello intermedio. Il giro completo include la salita panoramica lungo il Ponale e la discesa per sentieri nel bosco.</p>"

# 20. San Michele — Monte Cas
create_itin "San Michele — Monte Cas" "san-michele-monte-cas" "mtb" "media" "22.0" "850" "850" "3:00" "Salò" "45.6300" "10.5800" "235469274" "panoramico,circolare" "<p>Trail da Salò verso l'entroterra. Single track tra i boschi con viste sul golfo.</p><p>Percorso ad anello con mix di salita su forestale e discesa su sentiero. La Forra di San Michele e il Monte Cas offrono un ambiente selvaggio a pochi minuti dalla riviera.</p>"

# 21. Via Ferrata Cima Capi
create_itin "Via Ferrata Cima Capi" "via-ferrata-cima-capi" "ferrata" "difficile" "4.5" "600" "600" "4:00" "Riva del Garda" "45.8650" "10.8200" "8270049" "panoramico" "<p>Ferrata con vista aerea sul lago, cenge esposte e tratti verticali. Tra le più belle ferrate delle Alpi.</p><p>Partenza dal Sentiero del Ponale. Necessaria attrezzatura completa da ferrata. Vista indimenticabile dalla cima. Il percorso attrezzato sale lungo pareti verticali con passaggi esposti e panorami che spaziano sull'intero alto Garda.</p>"

# 22. Via Ferrata Monte Colodri
create_itin "Via Ferrata Monte Colodri" "via-ferrata-monte-colodri" "ferrata" "media" "2.5" "350" "350" "2:30" "Arco" "45.9200" "10.8850" "1374487" "panoramico,culturale" "<p>Ferrata breve ma intensa sopra la città di Arco. Panorama sulla valle del Sarca e sul Garda.</p><p>Tratti verticali ma ben attrezzati. Castello di Arco alla partenza. Ideale come prima ferrata. La salita offre scorci unici sul Castello di Arco e sulla piana del Sarca fino al lago.</p>"

# 23. Via Ferrata Che Guevara
create_itin "Via Ferrata Che Guevara" "via-ferrata-che-guevara" "ferrata" "difficile" "3.0" "450" "450" "3:30" "Pietramurata" "45.7680" "10.7450" "58397823" "panoramico" "<p>Ferrata atletica su parete verticale con ponti tibetani e strapiombi sulla Valle del Sarca.</p><p>Richiede ottima forma fisica e assenza di vertigini. Una delle più impegnative della zona. I ponti tibetani sospesi nel vuoto e le pareti verticali rendono questa ferrata un'esperienza adrenalinica unica.</p>"

# 24. Windsurf & Kitesurf Torbole
create_itin "Windsurf & Kitesurf Torbole" "windsurf-kitesurf-torbole" "water" "media" "0" "0" "0" "—" "Torbole" "45.8680" "10.8760" "" "panoramico" "<p>Torbole è la capitale mondiale del windsurf grazie al vento Ora (pomeridiano da sud) e Pelér (mattutino da nord).</p><p>Spot perfetto per kite e windsurf da aprile a ottobre. Numerose scuole e noleggi sulla spiaggia. I venti termici del Garda sono tra i più costanti e affidabili del Mediterraneo.</p>"

# 25. SUP Tour Sirmione
create_itin "SUP Tour Sirmione" "sup-tour-sirmione" "water" "facile" "0" "0" "0" "2:00" "Sirmione" "45.4960" "10.6080" "" "panoramico,famiglie" "<p>Tour in Stand-Up Paddle attorno al castello scaligero e le grotte di Catullo.</p><p>Acqua cristallina, fonti termali sul lago e vista unica sulla penisola. Adatto anche a principianti con guida. Un modo unico per esplorare Sirmione dal lago, scoprendo angoli nascosti e sorgenti termali.</p>"

# 26. Vela — Regate del Garda
create_itin "Vela — Regate del Garda" "vela-regate-del-garda" "water" "media" "0" "0" "0" "—" "Gargnano" "45.5800" "10.6400" "" "panoramico" "<p>Il Garda è la meta velica numero uno in Italia. Sede della Centomiglia, regata internazionale con 300+ barche.</p><p>Scuole vela a Riva, Gargnano e Malcesine. Vento costante e affidabile tutto l'anno. Il lago offre condizioni ideali per la vela grazie ai venti termici regolari e alla conformazione a imbuto del bacino.</p>"

# 27. Canyoning Rio Nero
create_itin "Canyoning Rio Nero" "canyoning-rio-nero" "water" "difficile" "0" "0" "0" "3:00" "Torbole" "45.8550" "10.8300" "" "" "<p>Discesa nelle gole del Rio Nero con tuffi, toboggan naturali e calate in corda. Brivido puro in un ambiente mozzafiato.</p><p>Solo con guida autorizzata. Da maggio a settembre. Le gole strette e i salti d'acqua cristallina offrono un'avventura adrenalinica immersi nella natura selvaggia dell'alto Garda.</p>"

echo ""
echo "=== Tutti i 27 itinerari creati! ==="
wp rewrite flush
