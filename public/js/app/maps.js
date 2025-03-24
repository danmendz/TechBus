function initMap() {
    // Coordenadas específicas (Ejemplo: Puebla, México)
    const location = { lat: 19.0759402, lng: -98.2062169 };

    // Crear el mapa centrado en la ubicación
    const map = new google.maps.Map(document.getElementById("map"), {
        center: location,
        zoom: 17,
    });

    // Agregar un marcador en la ubicación específica
    const marker = new google.maps.Marker({
        position: location,
        map: map,
        title: "ADO CAPU",
    });

    // Agregar InfoWindow con una imagen y calificación
    const infowindow = new google.maps.InfoWindow({
        content: `
            <div style="text-align: center; font-family: Arial, sans-serif;">
                <h3 style="margin: 5px 0;">ADO</h3>
                <img src="" alt="Lugar" style="width: 100%; border-radius: 8px;">
                <p style="margin: 5px 0;">"
				Viaja con comodidad, seguridad y aprovecha nuestras ofertas exclusivas. <br>
				Descubre nuevos destinos con la confianza que solo ADO puede ofrecerte".</p>
                <p style="color: #e2c000; font-size: 18px;">
                    ★★★★★ (4.8)
                </p>
            </div>
        `,
    });

    // Mostrar InfoWindow al hacer clic en el marcador
    marker.addListener("click", () => {
        infowindow.open(map, marker);
    });
}

window.initMap = initMap;