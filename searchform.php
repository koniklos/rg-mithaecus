<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
  <label class="search-form__label">
    <span class="screen-reader-text"><?php echo esc_html_x( 'Search for:', 'label', '_themename' ); ?></span>
    <input type="search" class="search-form__field" placeholder="<?php echo esc_attr_x( 'Search for &hellip;', 'placeholder', '_themename' ); ?>" value="<?php echo esc_attr(get_search_query()); ?>" name="s" />
  </label>
  <button class="btn search-form__button" type="submit">
    <span class="screen-reader-text"><?php echo esc_html_x( 'Search', 'submit button', '_themename' ); ?></span>
    <!-- <i class="fas fa-search" aria-hidden="true"></i> -->
    <span class="btn__content" tabindex="-1">
      <svg class="icon icon--xsmall search-form__icon"><use xlink:href="#icon-search" /></svg>
    </span>
  </button>
</form>