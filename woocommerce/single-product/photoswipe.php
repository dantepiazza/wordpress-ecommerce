<?php
	// @author  WooThemes
	// @package WooCommerce/Templates
	// @version 3.0.0

	if(!defined('ABSPATH')){ exit; }
?>

<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="pswp__bg"></div>

	<div class="pswp__scroll-wrap">
		<div class="pswp__container">
			<div class="pswp__item"></div>
			<div class="pswp__item"></div>
			<div class="pswp__item"></div>
		</div>

		<div class="pswp__ui pswp__ui--hidden">
			<div class="pswp__top-bar">
				<div class="pswp__counter"></div>

				<button class="pswp__button pswp__button--close" aria-label="Cerrar (Esc)"></button>
				<button class="pswp__button pswp__button--share" aria-label="Compartir"></button>
				<button class="pswp__button pswp__button--fs" aria-label="Pantalla complet"></button>
				<button class="pswp__button pswp__button--zoom" aria-label="Zoom"></button>

				<div class="pswp__preloader">
					<div class="pswp__preloader__icn">
						<div class="pswp__preloader__cut">
							<div class="pswp__preloader__donut"></div>
						</div>
					</div>
				</div>
			</div>

			<div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
				<div class="pswp__share-tooltip"></div>
			</div>

			<button class="pswp__button pswp__button--arrow--left" aria-label="Anterior"></button>

			<button class="pswp__button pswp__button--arrow--right" aria-label="Siguiente"></button>

			<div class="pswp__caption">
				<div class="pswp__caption__center"></div>
			</div>
		</div>
	</div>
</div>
