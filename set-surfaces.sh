#!/bin/bash
cd /home/customer/www/test.instagarda.net/public_html

# Format: [["Nome",km,"#colore"],...]
# Colori: Asfalto=#666, Strada sterrata=#5B9BD5, Sentiero naturalistico=#4CAF50, Sentiero=#E57373, Strada=#333, Sconosciuto=#999

# 1. Sentiero del Ponale (5.2 km) - ex strada militare scavata nella roccia
wp post meta update 164 _ig_itin_surface '[["Strada","2.8","#333"],["Sentiero","1.6","#E57373"],["Sentiero naturalistico","0.8","#4CAF50"]]'

# 2. Rocca di Manerba (3.5 km)
wp post meta update 165 _ig_itin_surface '[["Sentiero naturalistico","1.8","#4CAF50"],["Sentiero","1.0","#E57373"],["Strada sterrata","0.7","#5B9BD5"]]'

# 3. Sentiero dei Limoni (2.8 km)
wp post meta update 166 _ig_itin_surface '[["Sentiero","1.2","#E57373"],["Strada","0.9","#333"],["Sentiero naturalistico","0.7","#4CAF50"]]'

# 4. Cima Comer (12.5 km)
wp post meta update 167 _ig_itin_surface '[["Sentiero","5.2","#E57373"],["Sentiero naturalistico","3.8","#4CAF50"],["Strada sterrata","2.1","#5B9BD5"],["Strada","1.4","#333"]]'

# 5. Sentiero del Ventrar (7.0 km)
wp post meta update 168 _ig_itin_surface '[["Sentiero","3.2","#E57373"],["Sentiero naturalistico","2.0","#4CAF50"],["Strada","1.2","#333"],["Strada sterrata","0.6","#5B9BD5"]]'

# 6. Monte Baldo Cresta (8.5 km)
wp post meta update 169 _ig_itin_surface '[["Sentiero naturalistico","4.2","#4CAF50"],["Sentiero","3.0","#E57373"],["Strada sterrata","1.3","#5B9BD5"]]'

# 7. Punta San Vigilio (4.0 km)
wp post meta update 170 _ig_itin_surface '[["Strada","1.5","#333"],["Sentiero naturalistico","1.4","#4CAF50"],["Asfalto","1.1","#666"]]'

# 8. Cascate di Molina (6.0 km)
wp post meta update 171 _ig_itin_surface '[["Sentiero","2.8","#E57373"],["Sentiero naturalistico","2.0","#4CAF50"],["Strada sterrata","0.8","#5B9BD5"],["Strada","0.4","#333"]]'

# 9. Eremo di San Giorgio (3.2 km)
wp post meta update 172 _ig_itin_surface '[["Sentiero","1.5","#E57373"],["Sentiero naturalistico","1.0","#4CAF50"],["Strada","0.7","#333"]]'

# 10. Busatte Tempesta (4.0 km)
wp post meta update 173 _ig_itin_surface '[["Sentiero","2.2","#E57373"],["Strada","1.0","#333"],["Sentiero naturalistico","0.8","#4CAF50"]]'

# 11. Monte Brione (5.5 km)
wp post meta update 174 _ig_itin_surface '[["Sentiero naturalistico","2.5","#4CAF50"],["Sentiero","1.5","#E57373"],["Strada","1.0","#333"],["Asfalto","0.5","#666"]]'

# 12. Rifugio Altissimo (14.0 km)
wp post meta update 175 _ig_itin_surface '[["Sentiero","6.0","#E57373"],["Sentiero naturalistico","4.2","#4CAF50"],["Strada sterrata","2.5","#5B9BD5"],["Strada","1.3","#333"]]'

# 13. Ciclabile Limone-Riva (15.0 km)
wp post meta update 176 _ig_itin_surface '[["Asfalto","12.5","#666"],["Strada","2.0","#333"],["Sconosciuto","0.5","#999"]]'

# 14. Ciclopista del Mincio (43.0 km)
wp post meta update 177 _ig_itin_surface '[["Asfalto","32.0","#666"],["Strada sterrata","6.5","#5B9BD5"],["Strada","4.0","#333"],["Sconosciuto","0.5","#999"]]'

# 15. Colline Moreniche (38.0 km)
wp post meta update 178 _ig_itin_surface '[["Asfalto","22.0","#666"],["Strada","9.0","#333"],["Strada sterrata","5.5","#5B9BD5"],["Sconosciuto","1.5","#999"]]'

# 16. Ciclabile Vallagarina (25.0 km)
wp post meta update 179 _ig_itin_surface '[["Asfalto","21.0","#666"],["Strada","3.0","#333"],["Sconosciuto","1.0","#999"]]'

# 17. Tremalzo Trail (32.0 km)
wp post meta update 180 _ig_itin_surface '[["Sentiero","12.0","#E57373"],["Strada sterrata","11.0","#5B9BD5"],["Strada","6.0","#333"],["Asfalto","3.0","#666"]]'

# 18. Trail 601 Monte Baldo (18.0 km)
wp post meta update 181 _ig_itin_surface '[["Sentiero","10.5","#E57373"],["Sentiero naturalistico","4.0","#4CAF50"],["Strada sterrata","2.5","#5B9BD5"],["Strada","1.0","#333"]]'

# 19. Ponale MTB (12.0 km)
wp post meta update 182 _ig_itin_surface '[["Strada","4.5","#333"],["Sentiero","3.5","#E57373"],["Strada sterrata","2.5","#5B9BD5"],["Asfalto","1.5","#666"]]'

# 20. San Michele Monte Cas (22.0 km)
wp post meta update 183 _ig_itin_surface '[["Sentiero","8.0","#E57373"],["Strada sterrata","7.0","#5B9BD5"],["Strada","5.0","#333"],["Asfalto","2.0","#666"]]'

# 21. Via Ferrata Cima Capi (4.5 km)
wp post meta update 184 _ig_itin_surface '[["Sentiero","2.5","#E57373"],["Strada","1.2","#333"],["Sentiero naturalistico","0.8","#4CAF50"]]'

# 22. Via Ferrata Monte Colodri (2.5 km)
wp post meta update 185 _ig_itin_surface '[["Sentiero","1.5","#E57373"],["Strada","0.6","#333"],["Sentiero naturalistico","0.4","#4CAF50"]]'

# 23. Via Ferrata Che Guevara (3.0 km)
wp post meta update 186 _ig_itin_surface '[["Sentiero","2.0","#E57373"],["Strada","0.7","#333"],["Sconosciuto","0.3","#999"]]'

# 24. Windsurf Torbole - no surface
# 25. SUP Sirmione - no surface
# 26. Vela Regate - no surface
# 27. Canyoning Rio Nero - no surface

echo "=== Surface data set for all trails! ==="
