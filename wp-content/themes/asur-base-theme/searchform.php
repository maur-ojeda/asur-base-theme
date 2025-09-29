<!-- searchform.php -->
 <form role="search" method="get" class="row row-cols-lg-auto g-3 align-items-center" action="<?php echo esc_url( home_url( '/' ) ); ?>">
  <div class="w-100">
    <div class="input-group"> 
        <input type="search" class="form-control"
                placeholder="<?php echo esc_attr_x( 'Buscar...', 'placeholder', 'textdomain' ); ?>"
                value="<?php echo get_search_query(); ?>"
                name="s"
                required />
                
        <button type="submit" class="btn btn-primary-krom input-group-text">
            <i data-lucide="search"></i>
        </button>
    </div>
  </div>
</form>


