<?php
/**
 * Update destination posts with rich descriptions
 * Run: wp eval-file wp-content/themes/instagarda/update-content.php
 */

$descriptions = [
    'sirmione' => '<p>Sirmione è la perla del Lago di Garda, una sottile penisola che si protende per quasi 4 chilometri nelle acque turchesi del lago. Dominata dall\'imponente Castello Scaligero del XIII secolo, Sirmione incanta i visitatori con il suo centro storico medievale fatto di vicoli stretti, botteghe artigiane e ristoranti affacciati sull\'acqua.</p>
<p>All\'estremità della penisola si trovano le Grotte di Catullo, i resti di una grandiosa villa romana del I secolo d.C. con vista panoramica mozzafiato. Le terme di Sirmione, alimentate da acque sulfuree che sgorgano dal fondale del lago, sono rinomate in tutta Europa per le loro proprietà curative.</p>
<p>Passeggiando lungo i vicoli fioriti del centro, tra gelaterie, negozi di artigianato locale e panorami che si aprono improvvisamente sul lago, si capisce perché Sirmione sia considerata una delle destinazioni più romantiche d\'Italia.</p>',

    'riva-del-garda' => '<p>Riva del Garda è la capitale del nord del lago, incastonata tra le imponenti pareti rocciose delle Dolomiti del Brenta e le acque cristalline del Garda. La Torre Apponale, simbolo della città, domina il porto e la piazza principale dove la vita scorre tra caffè all\'aperto e mercati settimanali.</p>
<p>Riva è la meta ideale per gli amanti degli sport all\'aria aperta: vela, windsurf, arrampicata, mountain bike e trekking trovano qui il loro paradiso grazie ai venti costanti del lago e alle montagne circostanti. La cascata del Varone, a pochi minuti dal centro, è uno spettacolo naturale unico.</p>
<p>Il centro storico conserva l\'eleganza asburgica con palazzi liberty, la Rocca medievale che ospita il museo civico, e un lungolago tra i più suggestivi dell\'intero Garda. Di sera, Riva si anima con ristoranti, enoteche e locali che si affacciano direttamente sull\'acqua.</p>',

    'malcesine' => '<p>Malcesine è un borgo fiabesco sulla sponda orientale del Lago di Garda, dove il Castello Scaligero sorge maestoso su uno sperone di roccia a strapiombo sull\'acqua. Goethe stesso ne fu così affascinato da dedicargli pagine del suo celebre "Viaggio in Italia".</p>
<p>La funivia rotante del Monte Baldo, partendo dal centro di Malcesine, sale fino a 1.800 metri regalando panorami straordinari sul lago e sulle Alpi. In inverno si scia, in estate si pratica parapendio e trekking tra i prati fioriti del Baldo, il "Giardino d\'Europa" per la sua incredibile biodiversità.</p>
<p>Il porticciolo di Malcesine, con le barche dei pescatori e i ristoranti sulla riva, è una cartolina vivente. Le stradine acciottolate del centro, gli ulivi secolari e i limoneti creano un\'atmosfera mediterranea indimenticabile.</p>',

    'limone-sul-garda' => '<p>Limone sul Garda è un gioiello incastonato tra lago e montagna, famoso in tutto il mondo per le sue storiche limonaie — le serre di limoni più settentrionali d\'Europa, simbolo della tenacia e dell\'ingegno dei suoi abitanti.</p>
<p>Il centro storico è un intrico affascinante di vicoli stretti e ripidi che scendono verso il porticciolo, con case colorate, bouganville e gelsomini che profumano l\'aria. La pista ciclabile sospesa sul lago, un capolavoro di ingegneria che corre agganciata alla roccia a picco sull\'acqua, è diventata una delle attrazioni più fotografate del Garda.</p>
<p>Limone è anche nota per una particolarità scientifica: molti dei suoi abitanti ultracentenari possiedono una proteina nel sangue che li protegge dall\'arteriosclerosi, oggetto di studi medici internazionali. Un paese dove bellezza e longevità vanno di pari passo.</p>',

    'desenzano-del-garda' => '<p>Desenzano del Garda è la città più grande e vivace del lago, un perfetto mix di storia romana, vita notturna e spiagge dorate. Il porto vecchio, con i suoi colori vivaci e le barche a vela ormeggiate, è il cuore pulsante della città.</p>
<p>La Villa Romana, con i suoi mosaici del IV secolo tra i meglio conservati del nord Italia, testimonia l\'importanza di Desenzano fin dall\'antichità. Il Duomo di Santa Maria Maddalena custodisce un capolavoro di Tiepolo, mentre il castello offre una vista panoramica su tutto il basso lago.</p>
<p>Il martedì mattina, il mercato di Desenzano trasforma il lungolago in un festival di colori, profumi e sapori. La sera, la città si accende con ristoranti, cocktail bar e locali che ne fanno la capitale del divertimento gardesano.</p>',

    'bardolino' => '<p>Bardolino è sinonimo di vino, olio d\'oliva e dolce vita sulla sponda veronese del Garda. Questo incantevole borgo è il cuore della zona DOC del Bardolino e del Chiaretto, vini che raccontano il territorio in ogni sorso.</p>
<p>Il centro storico conserva gioielli architettonici come la chiesa di San Zeno, capolavoro carolingio del IX secolo, e la chiesa romanica di San Severo con i suoi affreschi medievali. Il lungolago fiorito è perfetto per passeggiate al tramonto, con lo sguardo che spazia dalle colline moreniche alle montagne del Trentino.</p>
<p>In autunno, la Festa dell\'Uva e del Vino Bardolino trasforma il paese in una grande celebrazione enogastronomica. Il Museo dell\'Olio d\'Oliva e il Museo del Vino completano un percorso sensoriale unico nel cuore della tradizione gardesana.</p>',

    'peschiera-del-garda' => '<p>Peschiera del Garda è una fortezza stellare patrimonio UNESCO, dove il fiume Mincio nasce dalle acque del lago. Le possenti mura veneziane del XVI secolo, con i loro bastioni e canali, racchiudono un centro storico pedonale pieno di vita e fascino.</p>
<p>Camminare lungo i bastioni al tramonto, con il sole che si specchia nelle acque del Mincio, è un\'esperienza indimenticabile. All\'interno delle mura, vicoli colorati, piazzette nascoste, ristoranti e gelaterie creano un\'atmosfera rilassata e accogliente.</p>
<p>Peschiera è anche il punto di partenza della ciclabile Peschiera-Mantova, 45 km di pista immersa nella natura lungo il Mincio. Con Gardaland e i parchi divertimento a pochi minuti, è la base ideale per famiglie che vogliono combinare cultura, natura e divertimento.</p>',

    'lazise' => '<p>Lazise è uno dei borghi più romantici del Lago di Garda, il primo comune libero d\'Italia (dal 983 d.C.). Le sue mura medievali perfettamente conservate, il piccolo porto con le barche colorate e il Castello Scaligero creano un\'atmosfera da fiaba.</p>
<p>Il centro storico è un salotto a cielo aperto: piazza Vittorio Emanuele si anima ogni sera con famiglie, coppie e visitatori che passeggiano tra gelaterie, ristoranti e botteghe. La Dogana Veneta, antico edificio doganale sul porto, ospita oggi mostre ed eventi culturali.</p>
<p>Ogni mercoledì, il grande mercato settimanale di Lazise attira visitatori da tutto il lago. Le spiagge attrezzate, il parco termale di Colà e i vicini parchi divertimento rendono Lazise perfetta per ogni tipo di vacanza.</p>',

    'garda' => '<p>Garda è il paese che ha dato il nome al lago, un borgo di pescatori trasformato in elegante località turistica senza perdere la sua autenticità. Il lungolago fiancheggiato da palme e oleandri, con la Rocca che vigila dall\'alto, è tra i più suggestivi del Garda.</p>
<p>Punta San Vigilio, a pochi passi dal centro, è considerata uno dei luoghi più romantici d\'Italia: una penisola di cipressi e ulivi con una villa rinascimentale, una piccola chiesa e la Baia delle Sirene, una spiaggia incantata accessibile solo a piedi.</p>
<p>Il centro di Garda è un reticolo di vicoli veneziani, palazzi storici e piazzette dove gustare il pesce di lago accompagnato dal Bardolino locale. La tradizione della pesca è ancora viva, e ogni mattina i pescatori rientrano con il loro carico fresco.</p>',

    'torbole' => '<p>Torbole è il paradiso del windsurf e del kitesurf, dove il vento Ora soffia ogni pomeriggio creando condizioni perfette per gli sport velici. Questo piccolo borgo alla punta nord del lago è la capitale europea degli sport acquatici.</p>
<p>Ma Torbole non è solo sport: il suo porticciolo storico, dove Goethe soggiornò nel 1786, conserva il fascino di un antico villaggio di pescatori con le case colorate affacciate sull\'acqua e le reti stese ad asciugare al sole.</p>
<p>La posizione strategica di Torbole, tra lago e montagna, lo rende perfetto anche per mountain bike, arrampicata e trekking. Il sentiero Busatte-Tempesta, con le sue scalinate panoramiche a strapiombo sul lago, è un\'esperienza da non perdere.</p>',

    'salo' => '<p>Salò è l\'eleganza fatta città: il suo lungolago, il più lungo del Garda con quasi un chilometro di passeggiata, è fiancheggiato da palazzi signorili, boutique raffinate e caffè storici dove il tempo sembra rallentare.</p>
<p>Il Duomo tardogotico, con la sua facciata incompiuta e gli interni ricchi di opere d\'arte, domina la piazza principale. Il centro storico è un susseguirsi di portici, botteghe artigiane e ristoranti gourmet che ne fanno la capitale gastronomica della sponda bresciana.</p>
<p>Il MuSa, Museo di Salò, racconta la storia della città dalla preistoria al Novecento con allestimenti moderni e interattivi. La posizione riparata nella baia regala a Salò un microclima mite tutto l\'anno, con limoni e agrumi che crescono nei giardini del centro.</p>',

    'gardone-riviera' => '<p>Gardone Riviera è un gioiello liberty affacciato sul lago, dove la Belle Époque ha lasciato ville sontuose, giardini esotici e un\'atmosfera di eleganza senza tempo. Il Vittoriale degli Italiani, la spettacolare cittadella voluta da Gabriele d\'Annunzio, è il monumento più visitato del lago.</p>
<p>Il Giardino Botanico André Heller, con oltre 2.000 specie vegetali provenienti da tutto il mondo e installazioni di artisti contemporanei, è un\'oasi di bellezza e serenità. Le ville storiche — Villa Alba, il Grand Hotel — testimoniano l\'epoca d\'oro del turismo aristocratico.</p>
<p>Gardone Sopra, il borgo antico sulla collina, offre viste panoramiche incredibili e un\'atmosfera autentica con le sue trattorie e stradine silenziose. È la destinazione perfetta per chi cerca cultura, natura e raffinatezza.</p>',

    'toscolano-maderno' => '<p>Toscolano-Maderno è un doppio borgo dove storia e natura si intrecciano in modo unico. Maderno, con il suo romanico Duomo e il porticciolo animato, e Toscolano, con la Valle delle Cartiere — un\'antica zona industriale dove si produceva carta per la Serenissima — formano un tutt\'uno affascinante.</p>
<p>Il Parco Alto Garda Bresciano protegge le montagne alle spalle del paese, con sentieri che conducono a panorami mozzafiato e borghi abbandonati da riscoprire. Le spiagge di Toscolano-Maderno sono tra le più ampie e sabbiose del lago.</p>
<p>Il traghetto che collega Toscolano-Maderno a Torri del Benaco sulla sponda veronese rende questo paese un crocevia strategico per esplorare entrambe le rive del Garda. La sera, il lungolago si anima con passeggiate, gelati e cene vista lago.</p>',

    'gargnano' => '<p>Gargnano è il segreto meglio custodito del Lago di Garda, un borgo autentico e poco turistico dove D.H. Lawrence visse e scrisse. Le sue limonaie storiche, le chiostri medievali e i vicoli silenziosi raccontano un Garda genuino e incontaminato.</p>
<p>Villa Feltrinelli, oggi hotel di lusso, e Palazzo Bettoni, la più grande villa del lago, testimoniano la ricchezza storica di questo borgo. Il Chiostro di San Francesco, con i suoi capitelli scolpiti con limoni, è un gioiello unico dell\'arte romanica.</p>
<p>Gargnano è il punto di partenza per escursioni straordinarie nell\'entroterra montano: la Valle di Toscolano, il Parco dell\'Alto Garda e le malghe d\'alta quota offrono esperienze autentiche lontano dalla folla. La Centomiglia, la più importante regata velica del lago, parte proprio da qui ogni settembre.</p>',

    'tremosine-sul-garda' => '<p>Tremosine sul Garda è il paese del brivido: arroccato su un altopiano a 350 metri a picco sul lago, offre panorami vertiginosi che tolgono il fiato. La Terrazza del Brivido, una piattaforma di vetro sospesa nel vuoto, è diventata una delle attrazioni più iconiche del Garda.</p>
<p>La Strada della Forra, una strada scavata nella roccia viva che sale dal lago attraverso gole e gallerie naturali, fu definita da Winston Churchill "l\'ottava meraviglia del mondo". Ogni curva rivela scorci nuovi e drammatici sulla valle sottostante.</p>
<p>L\'altopiano di Tremosine è un paradiso per mountain bike, trekking e parapendio, con 18 frazioni sparse tra prati, boschi e panorami infiniti. I prodotti locali — formaggi d\'alpeggio, miele, salumi — hanno sapori intensi e autentici che raccontano la montagna gardesana.</p>',

    'brenzone-sul-garda' => '<p>Brenzone sul Garda è un comune unico composto da 16 piccole frazioni sparse sui pendii del Monte Baldo, dalla riva del lago fino ai pascoli d\'alta quota. Ogni borgata ha il suo carattere: Castelletto con il porto, Magugnano con la chiesa romanica, Assenza con le limonaie.</p>
<p>Il Monte Baldo, il "Giardino d\'Europa", si raggiunge con la funivia da Malcesine o a piedi da Brenzone, offrendo una biodiversità straordinaria: orchidee selvatiche, genziane, stelle alpine e oltre 60 specie endemiche. I sentieri panoramici regalano viste indimenticabili.</p>
<p>Brenzone è la destinazione ideale per chi cerca tranquillità e natura autentica. Le spiagge libere di ciottoli, l\'acqua cristallina, gli uliveti e i piccoli ristoranti di pesce di lago offrono un\'esperienza genuina lontano dal turismo di massa.</p>',

    'manerba-del-garda' => '<p>Manerba del Garda è una terrazza naturale sul Garda, dominata dalla Rocca — un promontorio roccioso che offre una vista a 360 gradi sul lago e sull\'Isola del Garda, la più grande isola lacustre italiana. Il parco archeologico della Rocca conserva tracce di insediamenti dal Mesolitico.</p>
<p>Le spiagge di Manerba sono tra le più belle del Garda: la Romantica, Porto Dusano, Pisenze — sabbia dorata, acqua bassa e limpida, perfette per famiglie. La Riserva Naturale della Rocca e delle zone umide protegge un ecosistema ricco di flora e fauna.</p>
<p>L\'Isola del Garda, con il suo palazzo neogotico-veneziano e i giardini all\'italiana, è visitabile in estate con escursioni in barca da Manerba. Il paese è anche circondato da vigneti e uliveti che producono il Groppello e l\'olio extravergine DOP del Garda.</p>',

    'torri-del-benaco' => '<p>Torri del Benaco è una perla nascosta sulla sponda veronese, un borgo dove il Castello Scaligero custodisce una delle ultime limonaie funzionanti del lago. Dentro le mura del castello, i limoni crescono ancora come secoli fa, protetti dalle serre originali.</p>
<p>Il piccolo porto è uno dei più pittoreschi del Garda: barche colorate, reti da pesca e ristoranti dove gustare il coregone e il luccioperca appena pescati. La chiesa dei Santi Pietro e Paolo conserva affreschi trecenteschi di rara bellezza.</p>
<p>Da Torri parte il traghetto per Toscolano-Maderno, il collegamento storico tra le due sponde del lago. Il borgo è anche la base per escursioni al Monte Baldo e alle colline dell\'entroterra, tra oliveti e vigneti che producono l\'Olio del Garda DOP.</p>',

    'arco' => '<p>Arco è la capitale dell\'arrampicata sportiva in Europa, dominata dalle rovine di un castello medievale che sorge su una rupe vertiginosa. La città, nella valle del Sarca a pochi chilometri dal lago, combina sport estremi, storia e un microclima mediterraneo unico.</p>
<p>Il Rock Master Festival richiama ogni anno i migliori climber del mondo, mentre le falesie circostanti offrono vie per tutti i livelli. Ma Arco è anche eleganza asburgica: il Casino, il Parco Arciducale con le sue sequoie giganti e le ville liberty testimoniano il suo passato come stazione climatica della nobiltà austro-ungarica.</p>
<p>L\'Olivaia, l\'oliveto più settentrionale del mondo ai piedi del castello, produce un olio pregiato. Il centro storico, con i suoi portici e le botteghe artigiane, si anima ogni sera con aperitivi e cene all\'aperto in un\'atmosfera rilassata e cosmopolita.</p>',
];

foreach ($descriptions as $slug => $content) {
    $posts = get_posts([
        'post_type'   => 'destinazione',
        'name'        => $slug,
        'numberposts' => 1,
    ]);

    if (empty($posts)) {
        WP_CLI::warning("Post not found: $slug");
        continue;
    }

    wp_update_post([
        'ID'           => $posts[0]->ID,
        'post_content' => $content,
    ]);

    WP_CLI::success("Updated content: $slug");
}

WP_CLI::success("All destination descriptions updated!");
