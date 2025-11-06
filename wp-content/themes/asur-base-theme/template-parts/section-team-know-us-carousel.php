<?php
// Obtener el ID de la página actual (asumiendo que estás en el loop)
$page_id = get_the_ID();

// Obtener los miembros del equipo desde Carbon Fields
$team_members = carbon_get_post_meta($page_id, 'crb_knowus_team');
$team_members_overtitle = carbon_get_post_meta($page_id, 'over-title');
$team_members_title = carbon_get_post_meta($page_id, 'title');

// Solo mostrar el bloque si hay al menos un miembro
if (!empty($team_members)) :
?>


  <div class="container mb-20">
    <div class="row">
      <div class="col-12 text-start mb-4 px-5">
        <p class="over-title"><?php echo esc_attr($team_members_overtitle); ?></p>
        <h1 class="title"><?php echo esc_attr($team_members_title); ?> </h1>
      </div>
    </div>
  </div>


  <div class="container-fluid mt-5">


    <div class="swiper team-swiper">
      <div class="swiper-wrapper">
        <?php foreach ($team_members as $member) :
          $photo_url = !empty($member['photo'])
            ? esc_url($member['photo'])
            : 'https://picsum.photos/300/400?random=' . abs(crc32($member['name'] ?? 'default'));
        ?>
          <div class="swiper-slide team-member-card">
            <div class="team-member-card-inner">
              <img src="<?php echo $photo_url; ?>" alt="<?php echo esc_attr($member['name'] ?? 'Miembro del equipo'); ?>">
              <div class="overlay text-start">
                <h4 class="text-white"><?php echo esc_html($member['name'] ?? ''); ?></h4>
                <div class="description">
                  <?php echo isset($member['description']) ? wp_kses_post($member['description']) : ''; ?>
                </div>
              </div>
            </div>



          </div>
        <?php endforeach; ?>
      </div>

      <div class="swiper-button-prev"></div>
      <div class="swiper-button-next"></div>
    </div>
  </div>

  <script>
    document.addEventListener("DOMContentLoaded", function() {
      new Swiper('.team-swiper', {
        slidesPerView: 4,
        spaceBetween: 50,
        loop: true,
        freeMode: true,
        grabCursor: true,
        autoplay: {
          delay: 0,
          disableOnInteraction: false,
        },
        speed: 5000,
        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev',
        },
        breakpoints: {
          320: {
            slidesPerView: 1.5,
            spaceBetween: 10,
          },
          768: {
            slidesPerView: 3,
            spaceBetween: 20,
          },
          1024: {
            slidesPerView: 4,
            spaceBetween: 20,
          },
        }
      });
    });
  </script>

<?php endif; ?>