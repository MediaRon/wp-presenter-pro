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
const { registerPlugin } = wp.plugins;
const { PluginDocumentSettingPanel } = wp.editPost;
const { Fragment } = wp.element;
const { PanelBody, TextControl, SelectControl, ToggleControl, TextareaControl } = wp.components;
const { useSelect, useDispatch } = wp.data;

import './block/style.scss';
import './block/editor.scss';
import './block/blocks/slide/block';
import './block/blocks/title/block';
import './block/blocks/text-box/block';
import './block/blocks/code/block';
import './block/blocks/list-item/block';
import './block/blocks/image/block';
import './block/blocks/spacer/block';
import './block/blocks/content-image/block';
import './block/blocks/content/block';
import './block/blocks/content-two-columns/block';
import './block/blocks/vertical-slide/block';
import './block/blocks/transition/block';
import './block/blocks/blockquote/block';

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
const headerLeft = 'slides-header-left';
const headerRight = 'slides-header-right';
const footerLeft = 'slides-footer-left';
const footerRight = 'slides-footer-right';
const skipFirstSlide = 'slides-skip-first-slide';

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
		const themeSelect = [
			{ value: 'none', label: __( 'None', 'wp-presenter-pro' ) },
			{ value: 'beige', label: __( 'Beige', 'wp-presenter-pro' ) },
			{ value: 'black', label: __( 'Black', 'wp-presenter-pro' ) },
			{ value: 'blood', label: __( 'Blood', 'wp-presenter-pro' ) },
			{ value: 'league', label: __( 'League', 'wp-presenter-pro' ) },
			{ value: 'moon', label: __( 'Moon', 'wp-presenter-pro' ) },
			{ value: 'night', label: __( 'Night', 'wp-presenter-pro' ) },
			{ value: 'serif', label: __( 'Serif', 'wp-presenter-pro' ) },
			{ value: 'solarized', label: __( 'Solarized', 'wp-presenter-pro' ) },
			{ value: 'white', label: __( 'White', 'wp-presenter-pro' ) },
		];
		return (
			<Fragment>
			<PluginDocumentSettingPanel
				title={__('Presentation Options', 'wp-presenter-pro')}
			>
				<PanelBody title={__('Navigation', 'wp-presenter-pro')}>
					<ToggleControl
						label={__( 'Display Controls', 'wp-presenter-pro' )}
						checked={meta[displayControls] === 'true'}
						onChange={ (value ) => updateMeta( value + '', displayControls ) }
					/>
					<ToggleControl
						label={__( 'Keyboard Shortcuts', 'wp-presenter-pro' )}
						checked={meta[keyboardShortcuts] === 'true'}
						onChange={ (value ) => updateMeta( value + '', keyboardShortcuts ) }
					/>
					<ToggleControl
						label={__( 'Mousewheel Navigation', 'wp-presenter-pro' )}
						checked={meta[mouseWheelNavigation] === 'true'}
						onChange={ (value ) => updateMeta( value + '', mouseWheelNavigation ) }
					/>
				</PanelBody>
				<PanelBody title={__('Presentation Settings', 'wp-presenter-pro')}>
					<ToggleControl
						label={__( 'Loop Slides', 'wp-presenter-pro' )}
						checked={meta[loopSlides] === 'true'}
						onChange={ (value ) => updateMeta( value + '', loopSlides ) }
					/>
					<ToggleControl
						label={__( 'Right to Left', 'wp-presenter-pro' )}
						checked={meta[rightToLeft] === 'true'}
						onChange={ (value ) => updateMeta( value + '', rightToLeft ) }
					/>
					<ToggleControl
						label={__( 'Push History', 'wp-presenter-pro' )}
						checked={meta[pushHistory] === 'true'}
						onChange={ (value ) => updateMeta( value + '', pushHistory ) }
					/>
				</PanelBody>
				<PanelBody title={__('Visual Settings', 'wp-presenter-pro')}>
					<ToggleControl
						label={__( 'Progress Bar', 'wp-presenter-pro' )}
						checked={meta[progressBar] === 'true'}
						onChange={ (value ) => updateMeta( value + '', progressBar ) }
					/>
					<ToggleControl
						label={__( 'Slide Number', 'wp-presenter-pro' )}
						checked={meta[slideNumber] === 'true'}
						onChange={ (value ) => updateMeta( value + '', slideNumber ) }
					/>
					<SelectControl
						label={ __( 'Theme', 'block-for-updraftcentral' ) }
						options={themeSelect}
						value={meta[slidesTheme]}
						onChange={ (value ) => updateMeta( value + '', slidesTheme ) }
					/>
				</PanelBody>
				<PanelBody title={__('Slide Size', 'wp-presenter-pro')}>
					<TextControl
						label={__( 'Width', 'wp-presenter-pro' )}
						placeholder={'960'}
						value={meta[slideWidth]}
						onChange={ (value ) => updateMeta( value + '', slideWidth ) }
					/>
					<TextControl
						label={__( 'Width', 'wp-presenter-pro' )}
						placeholder={'700'}
						value={meta[slideHeight]}
						onChange={ (value ) => updateMeta( value + '', slideHeight ) }
					/>
					<TextControl
						label={__( 'Margin', 'wp-presenter-pro' )}
						placeholder={'0.1'}
						value={meta[slideMargin]}
						onChange={ (value ) => updateMeta( value + '', slideMargin ) }
					/>
					<TextControl
						label={__( 'Minimum Scale', 'wp-presenter-pro' )}
						placeholder={'0.2'}
						value={meta[slidesMinScale]}
						onChange={ (value ) => updateMeta( value + '', slidesMinScale ) }
					/>
					<TextControl
						label={__( 'Maximum Scale', 'wp-presenter-pro' )}
						placeholder={'1.5'}
						value={meta[maxScale]}
						onChange={ (value ) => updateMeta( value + '', maxScale ) }
					/>
				</PanelBody>
				<PanelBody title={__('Headers and Footers', 'wp-presenter-pro')}>
					<TextareaControl
						label={__( 'Left Header', 'wp-presenter-pro' )}
						value={meta[headerLeft]}
						help={__('HTML Allowed', 'wp-presenter-pro' )}
						onChange={ (value ) => updateMeta( value + '', headerLeft ) }
					/>
					<TextareaControl
						label={__( 'Right Header', 'wp-presenter-pro' )}
						value={meta[headerRight]}
						help={__('HTML Allowed', 'wp-presenter-pro' )}
						onChange={ (value ) => updateMeta( value + '', headerRight ) }
					/>
					<TextareaControl
						label={__( 'Left Footer', 'wp-presenter-pro' )}
						value={meta[footerLeft]}
						help={__('HTML Allowed', 'wp-presenter-pro' )}
						onChange={ (value ) => updateMeta( value + '', footerLeft ) }
					/>
					<TextareaControl
						label={__( 'Right Footer', 'wp-presenter-pro' )}
						value={meta[footerRight]}
						help={__('HTML Allowed', 'wp-presenter-pro' )}
						onChange={ (value ) => updateMeta( value + '', footerRight ) }
					/>
				</PanelBody>
			</PluginDocumentSettingPanel>
			</Fragment>
		)
	}
}
);