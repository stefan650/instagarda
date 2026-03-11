#!/bin/bash
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
        local EXT="${URL##*.}"
        EXT="${EXT%%\?*}"
        [ ${#EXT} -gt 5 ] && EXT="jpg"
        local TMPFILE="/tmp/att_img_${POST_ID}.${EXT}"
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

import_img 327 "https://visitsirmione.com/wp-content/uploads/2019/12/terme-sirmione-02-sirmione-turismo.jpg" "Terme di Sirmione"
import_img 328 "https://upload.wikimedia.org/wikipedia/commons/c/c3/Italy_-_Sirmione_-_Scaligero_Castle.jpg" "Castello Scaligero di Sirmione"
import_img 329 "https://upload.wikimedia.org/wikipedia/commons/0/05/Grotte_di_Catullo_-_Sirmione.jpg" "Grotte di Catullo Sirmione"
import_img 330 "https://upload.wikimedia.org/wikipedia/commons/d/df/Jamaica_Beach_Sirmione.jpg" "Jamaica Beach Sirmione"
import_img 331 "https://www.lanaplanet.it/images/site/claudio_home1.jpg" "Lanaplanet SUP Sirmione"
import_img 332 "https://upload.wikimedia.org/wikipedia/commons/1/1f/Castello_di_Desenzano-4.jpg" "Castello di Desenzano"
import_img 333 "https://upload.wikimedia.org/wikipedia/commons/f/fa/Densenzano_Villa_Romana%2C_floor_mosaics.jpg" "Villa Romana Desenzano"
import_img 334 "https://www.navigazionelaghi.it/wp-content/uploads/2024/08/motonave-ibrida-Ander-8-3.jpg" "Navigazione Lago di Garda"
import_img 335 "https://noleggiobarchedesenzano.com/wp-content/uploads/2018/04/barca-senza-patente-brava-18.jpg" "Noleggio Barche Desenzano"
import_img 336 "https://upload.wikimedia.org/wikipedia/commons/2/2d/La_Rocca_di_Manerba_del_Garda_con_croce.jpg" "Rocca di Manerba del Garda"
import_img 337 "https://upload.wikimedia.org/wikipedia/commons/5/53/Isola_del_Garda.jpg" "Isola del Garda"
import_img 338 "https://upload.wikimedia.org/wikipedia/commons/1/19/MUSA_-_Museo_di_Sal%C3%B2.jpg" "MuSa Museo di Salo"
import_img 339 "https://upload.wikimedia.org/wikipedia/commons/6/6d/Duomo_di_Sal%C3%B2_facciata_a_Sal%C3%B2.jpg" "Duomo di Salo"
import_img 340 "https://www.visitgarda.com/upload/cms/770_x/rimbalzello-adventure-park.jpg" "Rimbalzello Adventure Park"
import_img 341 "https://upload.wikimedia.org/wikipedia/commons/d/d0/Castello_di_Padenghe_sul_Garda_03.jpg" "Castello di Padenghe"
import_img 342 "https://upload.wikimedia.org/wikipedia/commons/e/e0/Moniga_del_Garda_Castello_001.JPG" "Castello di Moniga del Garda"
import_img 343 "https://upload.wikimedia.org/wikipedia/commons/9/96/Rocca%2C_Parco%2C_Lonato_del_Garda.jpg" "Rocca di Lonato"
import_img 344 "https://upload.wikimedia.org/wikipedia/commons/1/1c/Gardone_Riviera_Vittoriale_degli_italiani_002.JPG" "Il Vittoriale degli Italiani"
import_img 345 "https://www.contithun.com/cdn/shop/files/img-CHI_SIAMO_2000x1012_07_1445x.jpg" "Cantina Conti Thun"
import_img 346 "https://manestrini.it/wp-content/uploads/2021/08/frantoio-manestrini-prodotti-olio.jpg" "Frantoio Manestrini"
import_img 347 "https://www.cavabike.it/wp-content/uploads/2019/03/ciclabile-desenzano.jpg" "Pista Ciclabile Desenzano-Salo"

echo ""
echo "============================="
echo "IMPORT IMMAGINI COMPLETATO!"
echo "============================="
