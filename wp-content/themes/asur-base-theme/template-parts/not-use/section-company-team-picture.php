<?php
$post_name = "page";

$item = new WP_Query([
  'post_type'      => $post_name,
  'posts_per_page' => -1,
  'post_status'    => 'publish',
  'orderby'        => 'menu_order',
  'order'          => 'ASC',
]);

if ($item->have_posts()):

  $teamImageBg = carbon_get_the_post_meta('crb_company_bg');
  $teamImageOp = carbon_get_the_post_meta('crb_company_op');
  $teamImage = carbon_get_the_post_meta('crb_company_img');
endif;
?>
<div class="companyTeamPicture">
  <div class="container mb-20">
    <div class="text-start mb-4">
      <p class="over-title">EXPERTOS</p>
      <h1 class="title">NUESTRO EQUIPO</h1>
    </div>
  </div>



  <div class="container-fluid p-0">
    <div class="position-relative">

      <div class="companyTeamPicture-overlay <?= esc_attr($teamImageOp); ?>" style="background-color: <?= esc_attr($teamImageBg); ?>;"></div>
      <img src="<?php echo esc_url(ensure_https($teamImage)); ?>" class="companyTeamPicture-image" alt="Nuestro Equipo">

      <div class="companyTeamPicture-shape">
        <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="auto" viewBox="0 0 1440 95" fill="none">
          <path d="M0 95V23.8827L287.342 0L1133.23 24.9441L1440 1.06145V95H0Z" fill="#EE5135" fill-opacity="0.6" />
        </svg>

      </div>
    </div>
  </div>
</div>