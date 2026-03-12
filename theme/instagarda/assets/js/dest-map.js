(function () {
    var el = document.getElementById('ig-dest-map');
    if (!el) return;

    var lat = parseFloat(el.dataset.lat);
    var lng = parseFloat(el.dataset.lng);
    if (isNaN(lat) || isNaN(lng)) return;

    var map = L.map('ig-dest-map', {
        scrollWheelZoom: false,
        zoomControl: true,
    }).setView([45.65, 10.72], 10);

    L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
        attribution: 'Tiles &copy; Esri &mdash; Source: Esri, Maxar, Earthstar Geographics, and the GIS User Community',
        maxZoom: 18,
    }).addTo(map);

    // Custom pin marker
    var icon = L.divIcon({
        className: 'ig-map-pin',
        html: '<svg width="32" height="42" viewBox="0 0 32 42" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M16 0C7.163 0 0 7.163 0 16c0 12 16 26 16 26s16-14 16-26C32 7.163 24.837 0 16 0z" fill="#1a8cff"/><circle cx="16" cy="16" r="6" fill="#fff"/></svg>',
        iconSize: [32, 42],
        iconAnchor: [16, 42],
    });

    L.marker([lat, lng], { icon: icon }).addTo(map);
})();
