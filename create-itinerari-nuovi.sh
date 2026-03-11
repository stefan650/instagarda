#!/bin/bash
# Crea i nuovi itinerari (batch 2) — 34 nuovi percorsi
cd /home/customer/www/test.instagarda.net/public_html

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

echo "=== HIKING — Sponda Ovest & Nord ==="

# 28. Punta Larici da Pregasina
create_itin "Punta Larici da Pregasina" "punta-larici-pregasina" "hiking" "media" "5.0" "350" "350" "2:00" "Riva del Garda" "45.8680" "10.8050" "" "vista-lago,panoramico,consigliato" "<p>Il belvedere più spettacolare dell'intero Lago di Garda. Un balcone naturale a 900 metri che si affaccia a strapiombo sul lago, con vista su Limone, Malcesine, Brenzone e il Monte Baldo.</p><p>Due varianti: il sentiero facile nel bosco (422B, 1 ora) oppure il sentiero esposto sulla roccia con cavo metallico (422A, per esperti). Dalla cima si domina il punto dove il Monte Baldo si tuffa nel lago.</p>"

# 29. Sentiero del Sole
create_itin "Sentiero del Sole" "sentiero-del-sole" "hiking" "media" "9.0" "500" "500" "3:30" "Limone sul Garda" "45.8130" "10.7850" "" "panoramico,culturale" "<p>Passeggiata panoramica che parte da Limone e attraversa uliveti, bouganville e una passerella sospesa sul lago.</p><p>Il sentiero prende il nome dai versanti soleggiati che hanno permesso storicamente la coltivazione dei limoni a questa latitudine insolitamente nordica. Lungo il percorso, tracce delle due Guerre Mondiali e viste sulla sponda bresciana.</p>"

# 30. Monte Tremalzo e Corno della Marogna
create_itin "Monte Tremalzo e Corno della Marogna" "monte-tremalzo-corno-marogna" "hiking" "difficile" "14.0" "1000" "1000" "5:30" "Limone sul Garda" "45.8200" "10.7100" "" "panoramico" "<p>Trekking alpino impegnativo lungo sentieri militari della Prima Guerra Mondiale fino alla vetta del Monte Tremalzo e alla cima rocciosa del Corno della Marogna.</p><p>Attraversa prati alpini e mughi, con vista a 360° su Lago di Garda, Lago di Ledro e le Dolomiti di Brenta in lontananza. Ritorno per il Passo Tremalzo.</p>"

echo "=== HIKING — Sponda Veronese ==="

# 31. Ponte Tibetano di Torri del Benaco
create_itin "Ponte Tibetano di Torri del Benaco" "ponte-tibetano-torri" "hiking" "facile" "3.0" "50" "50" "1:00" "Torri del Benaco" "45.6200" "10.6850" "" "panoramico,famiglie" "<p>Breve passeggiata nella Val Vanzana fino al ponte tibetano sospeso a 45 metri di altezza. Inaugurato nel 2019, è lungo 34 metri e attraversa la gola con vista mozzafiato.</p><p>Percorso nella vegetazione mediterranea, adatto alle famiglie. Combinazione perfetta tra passeggiata dolce e brivido adrenalinico.</p>"

# 32. Monte Luppia e Petroglifi Neolitici
create_itin "Monte Luppia e Petroglifi" "monte-luppia-petroglifi" "hiking" "facile" "6.0" "200" "200" "2:00" "Garda" "45.5750" "10.7050" "" "panoramico,culturale,famiglie" "<p>Camminata tra oliveti e macchia mediterranea fino alle rocce lisce ai piedi del Monte Luppia, dove sono incise figure neolitiche risalenti a migliaia di anni fa.</p><p>Un percorso che unisce bellezza naturale e significato archeologico, con scorci sul lago e il fascino della preistoria. Unico nel suo genere sul Garda.</p>"

# 33. Cima Valdritta da Rifugio Novezzina
create_itin "Cima Valdritta da Novezzina" "cima-valdritta-novezzina" "hiking" "difficile" "13.0" "965" "965" "5:30" "Ferrara di Monte Baldo" "45.7400" "10.8850" "" "panoramico,ristori" "<p>La via classica dal versante est per la vetta più alta del Monte Baldo (2218m). Si parte dal Rifugio Novezzina (1235m) vicino all'Orto Botanico del Monte Baldo.</p><p>Salita ripida attraverso prati alpini fino al Rifugio Telegrafo, uno degli ultimi rifugi autentici di montagna. Dalla Cima Valdritta, vista a 360° dalle Dolomiti alla Pianura Padana.</p>"

# 34. Prada Alta — Rifugio Mondini
create_itin "Prada Alta — Rifugio Mondini" "prada-alta-rifugio-mondini" "hiking" "facile" "8.0" "400" "400" "3:00" "San Zeno di Montagna" "45.6400" "10.7600" "" "panoramico,famiglie,circolare,ristori" "<p>Anello dolce sulla terrazza naturale di Prada, il 'balcone del Lago di Garda'. Prati alpini con mucche al pascolo, antichi abbeveratoi in pietra e malghe tradizionali.</p><p>San Zeno di Montagna (680m) è la base ideale. Il percorso passa per il Baito Ortigara e il Rifugio Mondini con panorami costanti sul lago.</p>"

# 35. Forte Naole — Sentiero 662
create_itin "Forte Naole — Sentiero 662" "forte-naole-sentiero-662" "hiking" "media" "10.0" "600" "600" "4:30" "Ferrara di Monte Baldo" "45.7300" "10.8800" "" "panoramico,culturale" "<p>Salita lungo l'antico sentiero 662 fino al Forte Naole (1675m), la più alta fortificazione militare italiana nel sistema difensivo di Rivoli, costruita tra il 1905 e il 1913.</p><p>Bocchetta di Naole è un importante snodo sentieristico che collega il Rifugio Fiori del Baldo e il Rifugio Chierego per traversate più lunghe.</p>"

# 36. Cresta di Naole
create_itin "Cresta di Naole" "cresta-di-naole" "hiking" "media" "12.0" "650" "650" "5:00" "San Zeno di Montagna" "45.6600" "10.7800" "" "panoramico,circolare,ristori" "<p>Camminata in cresta lungo la Cresta di Naole, alternativa meno affollata alla cresta principale del Monte Baldo. Prati fioriti in primavera, due rifugi accoglienti.</p><p>Collega il Rifugio Fiori del Baldo e il Rifugio Chierego. Vista su entrambi i versanti: Lago di Garda da un lato, Val d'Adige dall'altro.</p>"

# 37. Sentiero della Salute Malcesine-Cassone
create_itin "Sentiero della Salute" "sentiero-della-salute-malcesine" "hiking" "facile" "8.0" "250" "250" "2:30" "Malcesine" "45.7630" "10.8100" "" "vista-lago,panoramico,famiglie,cani" "<p>Anello che combina il lungolago Malcesine-Cassone con il Sentiero della Salute collinare. A Cassone si trova l'Aril, il fiume più corto del mondo con soli 175 metri.</p><p>La parte costiera passa per borghi di pescatori, la parte collinare sale tra oliveti fino alla stazione intermedia della funivia, con ritorno nel bosco.</p>"

# 38. Brenzone Nordic Walking Park
create_itin "Brenzone Nordic Walking Park" "brenzone-nordic-walking" "hiking" "facile" "20.0" "300" "300" "3:00" "Brenzone sul Garda" "45.7200" "10.7700" "" "vista-lago,famiglie,circolare,cani" "<p>Primo Nordic Walking Park del Lago di Garda. 4 anelli colorati (Verde 4km, Blu 6km, Rosso 7km, Nero 5km) tra i 16 borghi medievali di Brenzone.</p><p>L'Anello Verde segue il lago tra oliveti. L'Anello Blu attraversa boschi. L'Anello Rosso collega borghi antichi con vista aperta sul lago. L'Anello Nero ha salite impegnative nel bosco. Da non perdere il borgo medievale di Campo con la chiesa di San Pietro in Vincoli.</p>"

# 39. Rocca di Garda & Eremo dei Camaldolesi
create_itin "Rocca di Garda & Eremo Camaldolesi" "rocca-di-garda-camaldolesi" "hiking" "facile" "7.0" "200" "200" "2:00" "Garda" "45.5700" "10.7050" "" "panoramico,culturale,circolare" "<p>Anello sul promontorio della Rocca di Garda tra i paesi di Garda e Bardolino. Si passa per l'Eremo dei Camaldolesi, fondato nel 1663.</p><p>Dalla cima, panorama a 360°: a nord Malcesine, a sud Sirmione, a ovest Salò. Il nome 'Garda' deriva dal germanico 'Warda' (torre di guardia) — strategicamente importante fin dal V secolo a.C.</p>"

# 40. Circuito Storico di Rivoli Veronese
create_itin "Circuito Storico di Rivoli Veronese" "circuito-storico-rivoli" "hiking" "facile" "8.0" "200" "200" "3:00" "Rivoli Veronese" "45.5800" "10.8100" "" "culturale,circolare" "<p>Percorso attraverso uno dei siti storici più importanti del nord Italia. Nel 1797 Napoleone sconfisse gli austriaci nella decisiva Battaglia di Rivoli.</p><p>Il circuito include il Museo Napoleonico, il Forte Wohlgemuth (1854) — torre cilindrica austriaca su uno sperone roccioso sopra la gola dell'Adige — e la Tagliata di Incanale. Il forte ospita un museo della Prima Guerra Mondiale.</p>"

# 41. Mura UNESCO di Peschiera del Garda
create_itin "Mura UNESCO di Peschiera" "mura-unesco-peschiera" "hiking" "facile" "3.0" "10" "10" "1:00" "Peschiera del Garda" "45.4400" "10.6900" "" "culturale,famiglie,accessibile" "<p>Passeggiata lungo le mura veneziane pentagonali del XVI-XVII secolo, Patrimonio UNESCO dal 2017. Il percorso segue il camminamento di ronda collegando i cinque bastioni.</p><p>Vista sui canali, sul fiume Mincio e sul lago. Il centro storico è interamente racchiuso nelle fortificazioni a stella. Complementare il Giro delle Mura in barca (~25 minuti).</p>"

# 42. Monte Moscal
create_itin "Monte Moscal" "monte-moscal" "hiking" "facile" "8.0" "250" "250" "2:30" "Cavaion Veronese" "45.5300" "10.7700" "" "panoramico,circolare" "<p>Anello sulle colline moreniche con salita al Monte Moscal (434m). Panorama a 360° dal Lago di Garda alla Val d'Adige al Monte Baldo.</p><p>In cima si trova un grande bunker della Guerra Fredda, ex postazione di osservazione NATO. Il percorso passa per la Val Sorda e il borgo di Incaffi. Vista sull'intero anfiteatro morenico del Garda.</p>"

# 43. Costermano — Oliveti e Cimitero Militare
create_itin "Costermano — Oliveti e Memoriale" "costermano-oliveti-memoriale" "hiking" "facile" "5.0" "100" "100" "1:30" "Costermano sul Garda" "45.5600" "10.7300" "" "culturale,famiglie" "<p>Passeggiata riflessiva da Garda a Costermano attraverso oliveti fino al Cimitero Militare Tedesco, uno dei più importanti memoriali della Seconda Guerra Mondiale in Italia.</p><p>Circa 20.000 soldati vi sono sepolti. Ingresso monumentale con mosaico e portale in bronzo. La vicina Valle dei Mulini offre un'estensione incantevole nel bosco. Aperto tutti i giorni 8:00-19:00.</p>"

# 44. CamminaCustoza
create_itin "CamminaCustoza" "cammina-custoza" "hiking" "facile" "8.0" "150" "150" "2:30" "Custoza" "45.3900" "10.7800" "" "panoramico,culturale,circolare" "<p>Itinerario tra le colline moreniche di Custoza, teatro di due battaglie decisive del Risorgimento italiano (1848 e 1866). L'Ossario, inaugurato nel 1879, custodisce i resti di soldati italiani e austriaci.</p><p>Paesaggio dolce di vigneti Custoza DOC, campi coltivati e boschetti. Quote da 100 a 250m. Estensione consigliata al Forte Degenfeld di Pastrengo con vista sulla Val d'Adige.</p>"

echo ""
echo "=== CYCLING — Nuovi percorsi ==="

# 45. Peschiera — Sirmione — Desenzano
create_itin "Peschiera — Sirmione — Desenzano" "peschiera-sirmione-desenzano" "cycling" "facile" "36.0" "30" "30" "2:30" "Peschiera del Garda" "45.4400" "10.6900" "" "vista-lago,famiglie,accessibile,ebike,consigliato" "<p>Il giro della sponda sud del lago, pianeggiante e turistico. Collega tre delle località più famose del Garda passando per la penisola di Sirmione con il Castello Scaligero e le Grotte di Catullo.</p><p>Percorso ideale per una giornata rilassata con soste per gelato e bagni. Adatto a tutti, incluse famiglie con bambini.</p>"

# 46. Peschiera — Garda Lungolago
create_itin "Peschiera — Garda Lungolago" "peschiera-garda-lungolago" "cycling" "facile" "18.0" "30" "30" "1:30" "Peschiera del Garda" "45.4400" "10.6900" "" "vista-lago,famiglie,accessibile,ebike" "<p>Ciclabile della riviera veronese dalla fortezza UNESCO di Peschiera attraverso Lazise medievale, i vigneti di Bardolino fino al paese di Garda.</p><p>Mix di asfalto e sterrato battuto, passando per porticcioli, spiaggette, oliveti e bar sul lago. Completamente pianeggiante, adatto a famiglie.</p>"

# 47. Strada del Vino Bardolino
create_itin "Strada del Vino Bardolino" "strada-vino-bardolino" "cycling" "media" "35.0" "300" "300" "2:30" "Bardolino" "45.5400" "10.7300" "" "panoramico,circolare,ebike,ristori,culturale" "<p>La Strada del Vino Bardolino attraversa 16 comuni e oltre 60 cantine che producono Bardolino DOC. Il Cammino del Bardolino conta 18 sentieri segnalati per ~100 km totali.</p><p>Pedalata tra vigneti, oliveti e viste sulle colline. Degustazioni in cantina lungo il percorso. Segnaletica con QR code, 53 pannelli informativi e 281 frecce direzionali.</p>"

# 48. Ciclovia del Sole — Rivoli Veronese — Verona
create_itin "Ciclovia del Sole — Rivoli — Verona" "ciclovia-sole-rivoli-verona" "cycling" "facile" "20.0" "30" "30" "1:30" "Rivoli Veronese" "45.5800" "10.8200" "" "famiglie,accessibile,ebike,culturale" "<p>Tratto dell'EuroVelo 7 (Ciclovia del Sole) lungo il Canale Biffis dalla gola dell'Adige a Rivoli fino alle porte di Verona.</p><p>Passa per antichi forti austriaci e chiuse storiche che ricordano il dominio asburgico. Completamente asfaltato, separato dal traffico. Collegamento ideale dal campo di battaglia di Napoleone alla città romana di Verona.</p>"

# 49. Salò — Valtenesi Loop
create_itin "Salò — Valtenesi Loop" "salo-valtenesi-loop" "cycling" "media" "48.0" "400" "400" "3:00" "Salò" "45.6100" "10.5200" "" "panoramico,circolare,ebike,ristori" "<p>Anello sulle dolci colline della Valtenesi, zona di produzione del Chiaretto e del Groppello. Vigneti, castelli medievali e borghi sul lago.</p><p>Circa 3 ore di pedalata tra terreno ondulato con viste costanti sul lago. Attraversa Manerba, Moniga e Padenghe. Area rinomata per vino e olio d'oliva.</p>"

# 50. Ciclopedonale Brenzone — Malcesine
create_itin "Ciclopedonale Brenzone — Malcesine" "ciclopedonale-brenzone-malcesine" "cycling" "facile" "20.0" "20" "20" "1:30" "Brenzone sul Garda" "45.7200" "10.7700" "" "vista-lago,famiglie,accessibile,ebike,passeggino" "<p>Percorso ciclopedonale completamente piano e asfaltato che collega 10 borghi della sponda nord-est. Il Castello Scaligero di Malcesine è il punto di arrivo a nord.</p><p>Passa per i porticcioli più pittoreschi del Veneto, il museo del lago a Cassone e le frazioni storiche di Brenzone. Adatto a tutti, anche con passeggino.</p>"

echo ""
echo "=== MTB — Nuovi percorsi ==="

# 51. Monte Baldo Red Tour
create_itin "Monte Baldo Red Tour" "monte-baldo-red-tour" "mtb" "difficile" "35.0" "375" "1958" "4:00" "Malcesine" "45.7650" "10.8100" "" "panoramico,mezzi" "<p>Funivia in cima al Monte Baldo + mega discesa di quasi 2000 metri di dislivello! Si scende per il versante trentino verso Brentonico, Loppio e Torbole.</p><p>Terreno variabile: pascoli alpini, bosco, mulattiere, asfalto. La funivia trasporta 24 bici/ora. Si parte in ambiente alpino e si arriva sulle rive del lago — un contrasto unico.</p>"

# 52. Prada Enduro Trails
create_itin "Prada Enduro Trails" "prada-enduro-trails" "mtb" "media" "15.0" "600" "600" "3:00" "San Zeno di Montagna" "45.6400" "10.7700" "" "panoramico,circolare" "<p>Rete di 17 trail dedicati alla MTB sull'altopiano di Prada sopra San Zeno di Montagna. Trail 51/54: 5km singletrack blu. Malga Valfredda: 3.6km con 361m di dislivello negativo.</p><p>Meno affollata dei trail della funivia di Malcesine. Esperienza naturale e pastorale tra prati e boschi sulle pendici medie del Monte Baldo. Tracce GPS su Trailforks.</p>"

echo ""
echo "=== VIA FERRATA — Nuove ==="

# 53. Via Ferrata Gerardo Sega
create_itin "Via Ferrata Gerardo Sega" "via-ferrata-gerardo-sega" "ferrata" "difficile" "5.0" "1000" "1000" "5:00" "Avio" "45.7500" "10.9400" "" "panoramico" "<p>Una delle ferrate più scenografiche della zona. Dopo un lungo avvicinamento nel bosco, si raggiunge un vasto catino roccioso con la spettacolare Cascata della Preafessa.</p><p>Il percorso sale su scale lungo una grande parete strapiombante, attraversa cavi su cenge esposte e costeggia la cascata. Difficoltà C, tecnicamente gestibile ma molto esposta. Attrezzatura completa obbligatoria.</p>"

# 54. Via Ferrata delle Taccole
create_itin "Via Ferrata delle Taccole" "via-ferrata-delle-taccole" "ferrata" "difficile" "3.0" "400" "400" "6:00" "Malcesine" "45.7300" "10.8600" "" "panoramico" "<p>La via ferrata più difficile del Lago di Garda. Si accede dal Rifugio Telegrafo per il sentiero 658. Tre sezioni di difficoltà crescente.</p><p>Camino verticale tecnico, placca strapiombante con staffoni distanziati e crack-camino finale poco attrezzato che richiede capacità arrampicatorie. Solo per ferratisti esperti e allenati. Difficoltà C/D.</p>"

echo ""
echo "=== SCENIC DRIVE — Nuova categoria ==="

# 55. Strada della Forra
create_itin "Strada della Forra" "strada-della-forra" "drive" "media" "6.0" "400" "0" "0:30" "Tremosine sul Garda" "45.7800" "10.7700" "" "panoramico,consigliato" "<p>'L'ottava meraviglia del mondo' secondo Winston Churchill. Costruita nel 1913 per collegare il lago all'altopiano di Tremosine, si snoda nella gola scavata dal torrente Brasa.</p><p>Gallerie strettissime, curve cieche con pareti rocciose verticali e strapiombi. Set della scena iniziale dell'inseguimento in auto di James Bond in 'Quantum of Solace' (2008). Solo veicoli piccoli. Non adatta a grandi camper.</p>"

# 56. Strada Panoramica del Monte Baldo
create_itin "Strada Panoramica del Monte Baldo" "strada-panoramica-monte-baldo" "drive" "media" "25.0" "800" "0" "1:00" "Caprino Veronese" "45.6000" "10.8000" "" "panoramico,culturale" "<p>Strada di montagna con tornanti che sale il versante orientale del Monte Baldo. Viste incredibili sul lago e sulla pianura veneta.</p><p>Deviazione imperdibile al Santuario della Madonna della Corona, chiesa di pellegrinaggio incastonata in una parete rocciosa a picco a 774m. La strada prosegue verso San Zeno di Montagna e Prada, da dove parte la funivia per la cresta del Baldo.</p>"

# 57. Valvestino e Cima Rest
create_itin "Valvestino e Cima Rest" "valvestino-cima-rest" "drive" "media" "30.0" "600" "0" "1:00" "Gargnano" "45.7100" "10.5500" "" "panoramico,culturale" "<p>Viaggio nell'entroterra segreto dietro la sponda occidentale. Si raggiunge la minuscola Cima Rest (1000m), famosa per i fienili con tetto in paglia di epoca austro-ungarica ancora in piedi.</p><p>La Valle di Valvestino è selvaggia e incontaminata rispetto al lungolago. Osservatorio astronomico aperto al pubblico da maggio a settembre. Una finestra sulla cultura montana che esiste da secoli dietro le località turistiche del lago.</p>"

echo ""
echo "=== GARDA TREK — Multi-day ==="

# 58. Garda Trek — Top Loop
create_itin "Garda Trek — Top Loop" "garda-trek-top-loop" "hiking" "difficile" "95.0" "5500" "5500" "7 tappe" "Riva del Garda" "45.8850" "10.8430" "" "panoramico,consigliato,ristori,multiday" "<p>Il trekking definitivo del Lago di Garda. 7 tappe da rifugio a rifugio attorno a tutte le vette del Trentino settentrionale, dal livello del lago fino a oltre 2000 metri.</p><p>Ogni tappa termina in un rifugio di montagna. Solo da giugno a metà ottobre per la neve in quota. L'esperienza montana più completa del bacino nord del lago. Partenza e arrivo a Riva del Garda.</p>"

# 59. Garda Trek — Medium Loop
create_itin "Garda Trek — Medium Loop" "garda-trek-medium-loop" "hiking" "media" "73.0" "3275" "3275" "4 tappe" "Riva del Garda" "45.8850" "10.8430" "" "panoramico,consigliato,ristori,multiday,culturale" "<p>4 tappe a quote medie con viste spettacolari sul lago senza l'impegno del Top Loop. Passa per il borgo medievale di Tenno (uno dei borghi più belli d'Italia) e il turchese Lago di Tenno.</p><p>Il percorso include il villaggio degli artisti di Canale. Percorribile quasi tutto l'anno, salvo neve invernale occasionale.</p>"

# 60. Garda Trek — Low Loop
create_itin "Garda Trek — Low Loop" "garda-trek-low-loop" "hiking" "facile" "33.0" "1045" "1045" "2 tappe" "Riva del Garda" "45.8850" "10.8430" "" "panoramico,famiglie,ristori,multiday" "<p>Il mini-trek del Garda in 2 tappe. Tappa 1: Riva del Garda — Arco (capitale europea dell'arrampicata con il suo castello drammatico). Tappa 2: ritorno via Nago e Torbole, la mecca del windsurf.</p><p>Accessibile tutto l'anno, senza difficoltà tecniche. Può essere completato anche in un'unica lunga giornata. Introduzione perfetta al paesaggio del nord Garda.</p>"

# 61. GranGarda Bikepacking
create_itin "GranGarda Bikepacking" "grangarda-bikepacking" "cycling" "difficile" "350.0" "10000" "10000" "3-5 giorni" "Lago di Garda" "45.6500" "10.7500" "" "panoramico,consigliato,multiday" "<p>La circumnavigazione gravel definitiva del Lago di Garda. 350 km attraverso tutte e tre le regioni, restando in montagna: ~40% strade secondarie asfaltate, ~40% sterrate veloci, ~20% mulattiere e single track.</p><p>Attraversa i sentieri più iconici, i passi di montagna e i siti culturali del lago. Gomme minimo 40mm. Periodo migliore: aprile-maggio o settembre-ottobre. Per bikepackers esperti. 10.000+ metri di dislivello totale.</p>"

echo ""
echo "=== Tutti i 34 nuovi itinerari creati! ==="
echo "Totale itinerari sul sito: 61"
wp rewrite flush
