<?php
/**
 * Template of Bitcoin section
 *
 * @package Bitcoin
 */

?>

<section class="bitcoin-rate">

	<h2 class="bitcoin-rate-title">
		<?php esc_html_e( 'BTC PRICE', 'bitcoin' ); ?>
	</h2>

	<?php $currencies = array( 'usd', 'gbp', 'eur' ); ?>

	<div class="bitcoin-rate-row">
		<?php foreach ( $currencies as $currency ) { ?>
			<div class="bitcoin-rate-item bitcoin-rate-item--<?php echo esc_attr( $currency ); ?>">
				<span class="bitcoin-rate-item-value">...</span>
				<span class="bitcoin-rate-item-currency"><?php echo esc_attr( strtoupper( $currency ) ); ?></span>
			</div>
		<?php } ?>
	</div>

	<button class="bitcoin-rate-fetch"><?php esc_html_e( 'FETCH NOW', 'bitcoin' ); ?></button>

</section>
