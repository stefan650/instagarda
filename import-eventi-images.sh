#!/bin/bash
# Importa immagini per gli eventi dal web e le imposta come immagine in evidenza
cd /home/customer/www/test.instagarda.net/public_html

import_img() {
    local POST_ID="$1"
    local URL="$2"
    local TITLE="$3"

    echo "Importing image for $TITLE (ID: $POST_ID)..."
    local ATTACH_ID=$(wp media import "$URL" --post_id=$POST_ID --featured_image --title="$TITLE" --porcelain 2>/dev/null)
    if [ -n "$ATTACH_ID" ] && [ "$ATTACH_ID" -gt 0 ] 2>/dev/null; then
        echo "  OK — Attachment ID: $ATTACH_ID"
    else
        echo "  FAILED — trying curl fallback..."
        # Fallback: download with curl then import
        local EXT="${URL##*.}"
        EXT="${EXT%%\?*}"
        [ ${#EXT} -gt 5 ] && EXT="jpg"
        local TMPFILE="/tmp/evt_img_${POST_ID}.${EXT}"
        curl -sL -o "$TMPFILE" "$URL" 2>/dev/null
        if [ -s "$TMPFILE" ]; then
            ATTACH_ID=$(wp media import "$TMPFILE" --post_id=$POST_ID --featured_image --title="$TITLE" --porcelain 2>/dev/null)
            rm -f "$TMPFILE"
            if [ -n "$ATTACH_ID" ] && [ "$ATTACH_ID" -gt 0 ] 2>/dev/null; then
                echo "  OK (fallback) — Attachment ID: $ATTACH_ID"
            else
                echo "  FAILED completely"
            fi
        else
            echo "  FAILED — curl download empty"
            rm -f "$TMPFILE"
        fi
    fi
}

# === EXISTING EVENTS (156-163) ===
import_img 156 "https://bucket.lagodigardacamping.com/159335163480.jpeg" "Festa della Sardina"
import_img 157 "https://gardawow.it/wp-content/uploads/2025/04/Gardaland-50-1.webp" "Gardaland Season Opening"
import_img 158 "https://centomiglia.it/wp-content/uploads/2024/09/centomiglia-garda-ed-2024-gallery-1.jpg" "Centomiglia Velica"
import_img 159 "https://bucket.lagodigardacamping.com/911885002930664.jpeg" "Notte di Fiaba"
import_img 160 "https://gardawow.it/wp-content/uploads/2025/09/Bardolino-Festa-uva-e-vino-1.webp" "Festa dell Uva e del Vino Bardolino"
import_img 161 "https://www.mercatininatalearco.com/gallery/slider_gallery/a706a6a14281236280e37e043da69dc2.jpeg" "Mercatini di Natale di Arco"
import_img 162 "https://www.gardatrentino.it/pppage_assets/MAIN_Garda_Jazz_Festival/2026/image-thumb__59176__pp-header_auto_ce0dda9dde390ade8d3e4ca49df544a1/gardajazz_visual_web_1600x1066.jpg" "Garda Jazz Festival"
import_img 163 "https://static.museoaltogarda.it/mostre/mostra_temporanea__rinascimento_sul_garda/images/20240701112930_res.jpg" "Arte e Lago Mostra al MAG"

# === FEBBRAIO ===
import_img 225 "https://www.tuttogarda.it/bardolino/svaghi/bardolino-carnevale.JPG" "Carnevale di Bacco e Arianna Bardolino"
import_img 226 "https://www.gardapost.it/wp-content/uploads/2026/02/carnevale-del-marciapie1.webp" "Carnevale sul Lago Lazise"

# === MARZO ===
import_img 227 "https://images.squarespace-cdn.com/content/v1/67a610416512875957785316/179876dd-ded5-4d01-9bd5-217b0c8761e0/Pia%2BPaulina%2BGuilmoth%2BDaisy%2Beye%2B%282024%29.webp" "Biennale Fotografia Femminile Mantova"
import_img 228 "https://www.consorziovaltenesi.it/wp-content/uploads/2025/02/la-primaBANNER-1024x553.jpg" "La Prima del Valtenesi"

# === APRILE ===
import_img 229 "https://www.fragliavelariva.it/wp-content/uploads/2021/03/160402890_10158702447753005_2446744708957327344_o.jpg" "Lake Garda Meeting Optimist"
import_img 230 "https://www.colnagocyclingfestival.com/wp-content/uploads/2026/01/Progetto-senza-titolo-83-scaled.png" "Colnago Cycling Festival"
import_img 232 "https://media.vinitaly.com/media/s5uobisb/vinitaly_ed2026_skinweb_desktop.jpg?width=2560&height=1150" "Vinitaly 2026"
import_img 233 "https://www.vinitaly.com/media/2nzo0uck/vinitalyandthecity2024_veronafiere_ennevifoto__1sm2862.jpg" "Vinitaly and the City"
import_img 234 "https://lakegarda42.com/wp-content/uploads/2025/07/wisthaler_24_04_lakegarda__HW91109.webp" "Lake Garda 42 Maratona"
import_img 235 "https://www.lagodigardaeventi.it/wp-content/uploads/2021/04/garda-by-bike.jpeg" "Garda by Bike"
import_img 236 "https://www.bikefestivalriva.com/01-immagini-sito/expo/YOGA/2256/image-thumb__2256__fullscreenHeader/%C2%A9garda_dolomiti_spA_2025-05-04_BF-Riva_Patrick-Wasshuber-0421.4cf0f36b.jpg" "FSA Bike Festival Riva del Garda"

# === MAGGIO ===
import_img 237 "https://www.visitbrescia.it/wp-content/uploads/lugana-festival.jpg" "Lugana Festival"
import_img 238 "https://www.visitbrescia.it/wp-content/uploads/Salo-Botanica-1.jpg" "Salo Botanica"
import_img 239 "https://www.cittadiverona.it/wp-content/uploads/2016/05/festa-medievale-e-del-vino-soave-2025.jpg" "Festa Medievale Vino Soave"
import_img 240 "https://www.garda-outdoors.com/wp-content/uploads/2026/02/valtenesi-in-rosa-2026.jpg" "Valtenesi in Rosa"
import_img 241 "https://static.museoaltogarda.it/mostre/claudio_orlandi_ultimate_landscape___lillusione_del_ghiaccio/images/20251127111124_hr.jpg" "Mostra MAG Riva del Garda"

# === GIUGNO ===
import_img 242 "https://paliodelchiaretto.it/wp-content/uploads/2025/05/PalioDelChiaretto25-posterA3-WEB.jpg" "Palio del Chiaretto Bardolino"
import_img 243 "https://www.sierks.com/wp-content/uploads/2025/03/horizon-lake-garda-music-festival-2025_02.jpg" "Horizon Lake Garda Music Festival"
import_img 244 "https://www.arena.it/site/assets/files/29167/stagione-2025-arena-di-verona_01.jpg" "Arena di Verona Opera Festival"
import_img 245 "https://www.visitbrescia.it/wp-content/uploads/fiera-vino-polpenazze-2025.jpg" "Fiera del Vino Polpenazze"
import_img 246 "https://www.visitbrescia.it/wp-content/uploads/festival-vittoriale-tener-a-mente-2017.jpg" "Festival del Vittoriale Solstizio"

# === LUGLIO-AGOSTO ===
import_img 247 "https://www.gardafestival.com/wp-content/uploads/2025/05/img-patty-pravo.jpg" "Garda Festival"
import_img 248 "https://www.visitbrescia.it/wp-content/uploads/estate-musicale-del-garda-gasparo-da-salo.jpg" "Estate Musicale Gasparo da Salo"
import_img 249 "https://www.spettacoloverona.it/wp-content/uploads/2025/04/1440441-scaled-e1744378296184.jpg" "Estate Teatrale Veronese Teatro Romano"
import_img 250 "https://mantova-live.it/wp/wp-content/uploads/2023/05/Copertina-MSF-sito_WIDE-scaled-e1694513895786.jpg" "Mantova Summer Festival"
import_img 251 "https://gardawow.it/wp-content/uploads/2025/07/Riva-Musica-Riva.webp" "MusicaRiva Festival"
import_img 252 "https://www.planetmountain.com/uploads/img/1/133962.jpg" "Campionati Mondiali Arrampicata Arco"
import_img 253 "https://www.circolosurftorbole.com/wp-content/uploads/2024/12/italianiWS-thermes.jpeg" "Campionato Italiano Windsurfer Torbole"
import_img 254 "https://www.reteriservealpiledrensi.tn.it/wp-content/uploads/2026/03/Tortel-di-patate-trentino.webp" "Sagra del Tortel di Patate"

# === SETTEMBRE ===
import_img 255 "https://www.visitbrescia.it/wp-content/uploads/festival-vittoriale-tener-a-mente-2017.jpg" "Festival del Vittoriale Equinozio"
import_img 256 "https://www.artapartofculture.net/new/wp-content/uploads/2025/06/Festivaletteratura-Mantova-2025.jpg" "Festivaletteratura Mantova"
import_img 257 "https://www.visitverona.it/files/anteprima/1024/ms-20140919-1538,12576.jpg" "Tocati Festival Verona"
import_img 258 "https://www.wecb.fm/wp-content/uploads/2023/12/1703848991_MUSIC-AWARDS-2024-they-return-to-the-Verona-Arena-on.jpg" "Verona Music Awards"

# === OTTOBRE ===
import_img 259 "https://gardawow.it/wp-content/uploads/2025/10/Arco-Rock-Master.webp" "Rock Master Arco"
import_img 261 "https://www.parksmania.it/media/post/2024/09/Gardaland-Magic-Halloween_DSC05136.jpg" "Gardaland Magic Halloween"
import_img 263 "https://www.mrf-musicfestivals.com/wp-content/uploads/2021/04/LGMF-iStock-154961824-Flavio-Vallenari-min-e1619516260505.jpg" "Festival Cori e Orchestre Lago di Garda"
import_img 265 "https://www.gardapost.it/wp-content/uploads/2024/11/Frantoi-aperti-grande-partecipazione_imagefull.jpg" "Frantoi Aperti Garda Trentino"

# === NOVEMBRE-DICEMBRE ===
import_img 267 "https://mercatininatalerivadelgarda.it/wp-content/uploads/2022/07/Riva-in-centro-consorzio-e1658321361662.png" "Mercatino Natale Riva del Garda"
import_img 268 "https://www.cittadiverona.it/wp-content/uploads/2019/01/Rassegna-Presepi-dal-Mondo-a-Verona.jpg" "Presepi dal Mondo Verona"
import_img 269 "https://www.tourism.verona.it/images/pagine/mercatini-di-natale-verona.jpeg" "Mercatini di Natale Verona"
import_img 270 "https://bucket.lagodigardacamping.com/138210141698715.webp" "Mercatini Natale Desenzano"
import_img 271 "https://www.parksmania.it/media/post/2024/12/35.Gardaland-Magic-Winter-2024_Gardaland-Park_SparklingDSC07464.jpg" "Gardaland Magic Winter"
import_img 272 "https://visitsirmione.com/wp-content/uploads/2024/11/8x2-natale-sirmione-ph-antonello-perin-dicembre-2024.jpg" "Mercatini Natale Sirmione"
import_img 273 "https://www.bikefestivalriva.com/01-immagini-sito/gare/BIKE%20MARATHON/800/image-thumb__800__fullscreenHeader/BikeMarathon_020_DSS09353.3c13e03c.jpg" "Bike Marathon Garda Trentino"
import_img 274 "https://www.colnagocyclingfestival.com/wp-content/uploads/2024/07/gravel-iscriviti.jpg" "Colnago Gravel Garda"

echo ""
echo "============================="
echo "IMPORT IMMAGINI COMPLETATO!"
echo "============================="
