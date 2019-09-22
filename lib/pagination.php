<?php

function _themename_get_pagination() {
	?>
		<nav class="pages clearfix" role="navigation" aria-label="<? esc_attr_e( 'Pagination Navigation', '_themename' ); ?>">
			<?php
				global $wp_query;
				$current = max( 1, absint( get_query_var( 'paged' ) ) );
				$pagination = paginate_links( array(
					'base' 								=> str_replace( PHP_INT_MAX, '%#%', esc_url( get_pagenum_link( PHP_INT_MAX ) ) ),
					'format' 							=> '?paged=%#%',
					'current' 						=> $current,
					'total' 							=> $wp_query->max_num_pages,
					'type' 								=> 'array',
					'prev_text' 					=> '<span>' . __( 'Previous', '_themename' ) . '</span><svg class="icon icon--xsmall pagination__icon"><use xlink:href="#icon-angle-left" /></svg>',
					'next_text' 					=> '<span>' . __( 'Next', '_themename' ) . '</span><svg class="icon icon--xsmall pagination__icon"><use xlink:href="#icon-angle-right" /></svg>',
					'before_page_number' 	=> '<span class="screen-reader-text">' . __( 'Page', '_themename' ) . ' </span>',
				) ); ?>
			<?php if ( ! empty( $pagination ) ) : ?>
				<ul class="pagination">
					<?php foreach ( $pagination as $key => $page_link ) : ?>
						<?php
							$pagination_link_class = ' pagination__link--toggle';
							if ( strpos( $page_link, 'prev' ) ) $pagination_link_class = ' pagination__link--prev';
							if ( strpos( $page_link, 'next' ) ) $pagination_link_class = ' pagination__link--next';
							if ( strpos( $page_link, 'current' ) ) $pagination_link_class = ' pagination__link--current';
						?>
						<li class="pagination__link<?php echo $pagination_link_class; ?>"><?php echo $page_link ?></li>
					<?php endforeach ?>
				</ul>
			<?php endif ?>
		</nav>
	<?php
	$links = ob_get_clean();
	return apply_filters( '_themename_pagination', $links );
}

function _themename_pagination() {
	echo _themename_get_pagination();
}