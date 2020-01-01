/**
 * Gutenberg Blocks
 *
 * All blocks related JavaScript files should be imported here.
 * You can create a new block folder in this dir and include code
 * for that block here as well.
 *
 * All blocks should be included here since this is the file that
 * Webpack is compiling as the input file.
 */
const { __ } = wp.i18n; // Import __() from wp.i18n
const { registerBlockType } = wp.blocks; // Import registerBlockType() from wp.blocks
const { registerPlugin } = wp.plugins;
const { PluginSidebar, PluginSidebarMoreMenuItem, PluginDocumentSettingPanel } = wp.editPost;
const { Component, Fragment } = wp.element;
const { PanelBody, TextControl, SelectControl, ToggleControl } = wp.components;
const { withSelect, withDispatch, useSelect, useDispatch } = wp.data;

// Register select item.
const updraftCentralSelect = [
	{ value: 'none', label: __( 'None', 'block-for-updraftcentral' ) },
	{ value: 'full', label: __( 'Full-width', 'block-for-updraftcentral' ) },
];

import './block/style.scss';
import './block/editor.scss';
import './block/blocks/slide/block';
import './block/blocks/title/block';
import './block/blocks/text-box/block';
import './block/blocks/code/block';
import './block/blocks/list-item/block';
import './block/blocks/image/block';
import './block/blocks/spacer/block';
import './block/blocks/show-notes/block';
import './block/blocks/content-image/block';
import './block/blocks/content/block';
import './block/blocks/content-two-columns/block';
import './block/blocks/vertical-slide/block';
import './block/blocks/transition/block';

const displayControls = 'slides-display-controls';
const keyboardShortcuts = 'slides-keyboard-shortcuts';
const mouseWheelNavigation = 'slides-mouse-wheel-navigation';
const loopSlides = 'slides-loop-slides';
const rightToLeft = 'slides-right-to-left';
const pushHistory = 'slides-push-history';
const progressBar = 'slides-progress-bar';
const slideNumber = 'slides-slide-number';
const slidesTheme = 'slides-theme';
const slideWidth = 'slides-slide-width';
const slideHeight = 'slides-slide-height';
const slideMargin = 'slides-slide-margin';
const slidesMinScale = 'slides-min-scale';
const maxScale = 'slides-max-scale';

registerPlugin( 'wp-presenter-pro', {
	icon: 'welcome-view-site',
	render: () => {
		const meta = useSelect((select) =>
			select('core/editor').getEditedPostAttribute('meta')
		);
		const { editPost } = useDispatch('core/editor');
		const updateMeta = (value, key) => editPost({
			meta: { ...meta, [key]: value }
		});
		return (
			<Fragment>
			<PluginDocumentSettingPanel
				title={__('Presentation Options', 'wp-presenter-pro')}
			>
				<ToggleControl
					label={__( 'Display Controls', 'wp-presenter-pro' )}
					checked={meta[displayControls] === 'true'}
					onChange={ (value ) => updateMeta( value + '', displayControls ) }
				/>
			</PluginDocumentSettingPanel>
			</Fragment>
		)
	}
}
);