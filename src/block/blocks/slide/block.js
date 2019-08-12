const { __ } = wp.i18n; // Import __() from wp.i18n
const { registerBlockType } = wp.blocks; // Import registerBlockType() from wp.blocks
const { Component, Fragment } = wp.element;
import edit from './edit';

/**
 * Register Basic Block.
 *
 * Registers a new block provided a unique name and an object defining its
 * behavior. Once registered, the block is made available as an option to any
 * editor interface where blocks are implemented.
 *
 * @param  {string}   name     Block name.
 * @param  {Object}   settings Block settings.
 * @return {?WPBlock}          The block, if it has been successfully
 *                             registered; otherwise `undefined`.
 */
registerBlockType( 'wppp/slide', {
	title: __( 'WP Presenter Slide', 'wp-presenter-pro' ), // Block title.
	icon: 'slides',
	category: 'wp-presenter-pro',
	keywords: [
		__( 'slide', 'wp-presenter-pro' ),
	],
	className: 'wppp',
	supports: {
		align: [ 'wide', 'full' ],
		anchor: true,
		html: false,
	},
	edit: edit,
	save() {return null }
} );