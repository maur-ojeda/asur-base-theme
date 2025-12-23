<?php
$contact_page = get_page_by_path('contact');
if (!$contact_page) {
    return;
}

$page_id = $contact_page->ID;
$location = carbon_get_post_meta($page_id, 'crb_contact_map_location');

if (empty($location['lat']) || empty($location['lng'])) {
    $location = [
        'lat' => -33.4253,
        'lng' => -70.6087,
        'zoom' => 15,
        'address' => 'Av. Francisco Bilbao 3028, Providencia'
    ];
}

$map_id = 'contact-map-' . uniqid();
$lat = esc_js($location['lat']);
$lng = esc_js($location['lng']);
$zoom = (int) ($location['zoom'] ?? 15);
$address = !empty($location['address']) ? $location['address'] : 'Av. Francisco Bilbao 3028, Providencia';
$address_js = esc_js($address);
?>

<section id="contact-map" class="py-0 bg-light">
    <div class="container-fluid px-0">
        <div id="<?php echo esc_attr($map_id); ?>" class="w-100" style="height: 450px; overflow: hidden;"></div>
    </div>
</section>

<?php
// URLs de navegación
$google_maps_url = 'https://www.google.com/maps/dir/?api=1&destination=' . urlencode($address) . '&travelmode=driving';
$waze_url = 'https://waze.com/ul?ll=' . $lat . ',' . $lng . '&navigate=yes';

$icon_nav = '<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="3 11 22 2 13 21 11 13 3 11"/></svg>';

$btn_google = '<a href="' . esc_url($google_maps_url) . '" target="_blank" style="display: inline-flex; align-items: center; gap: 6px; margin-right: 8px; padding: 6px 12px; background: #4285F4; color: white; text-decoration: none; border-radius: 6px; font-size: 12px; font-weight: 500;">' . $icon_nav . ' Navegar</a>';
$btn_waze = '<a href="' . esc_url($waze_url) . '" target="_blank" style="display: inline-flex; align-items: center; gap: 6px; padding: 6px 12px; background: #33cc99; color: white; text-decoration: none; border-radius: 6px; font-size: 12px; font-weight: 500;">' . $icon_nav . ' Waze</a>';

$info_content = '<div style="font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, sans-serif; font-size: 14px; line-height: 1.4; max-width: 280px;">';
$info_content .= '<strong>📍 ¡Visítanos en nuestras oficinas!</strong><br>';
$info_content .= esc_html($address);
$info_content .= '<br><br>';
$info_content .= $btn_google . $btn_waze;
$info_content .= '<br><small style="color: #666; margin-top: 8px; display: block;">Toca para iniciar navegación</small>';
$info_content .= '</div>';
?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof google === 'undefined') {
            console.warn('Google Maps API no está cargada.');
            return;
        }

        const map = new google.maps.Map(document.getElementById('<?php echo esc_js($map_id); ?>'), {
            zoom: <?php echo (int) $zoom; ?>,
            center: {
                lat: <?php echo $lat; ?>,
                lng: <?php echo $lng; ?>
            },
            mapTypeId: 'roadmap',
            streetViewControl: false,
            fullscreenControl: true,
            mapTypeControl: false
        });

        const marker = new google.maps.Marker({
            position: {
                lat: <?php echo $lat; ?>,
                lng: <?php echo $lng; ?>
            },
            map: map,
            title: 'Nuestra ubicación'
        });

        const infoWindow = new google.maps.InfoWindow({
            content: <?php echo json_encode($info_content); ?>,
            maxWidth: 280
        });

        infoWindow.open(map, marker);
        marker.addListener('click', () => infoWindow.open(map, marker));
    });
</script>