const { __, _x } = wp.i18n;
let ALLOWED_BLOCKS = wp_presenter_pro.allowed_blocks;
if ( 'all' === wp_presenter_pro.block_options ) {
	ALLOWED_BLOCKS = true;
}
export default ALLOWED_BLOCKS;