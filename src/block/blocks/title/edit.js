import axios from 'axios';
import classnames from 'classnames';
import revealFonts from '../fonts/fonts.js';
import transitionOptions from '../transitions/transitions.js';
import hexToRgba from 'hex-to-rgba';

const { Component, Fragment } = wp.element;
const { withSelect } = wp.data;
const { __, _x } = wp.i18n;
const { compose } =  wp.compose;


const {
	PanelBody,
	Placeholder,
	SelectControl,
	TextControl,
	Toolbar,
	ToggleControl,
	Button,
	RangeControl,
	ButtonGroup,
	PanelRow,
	Spinner,
} = wp.components;

const {
	BlockControls,
	MediaUpload
} = wp.editor;

const {
	RichText,
	InspectorControls,
	PanelColorSettings,
	AlignmentToolbar,
} = wp.blockEditor;


class WP_Presenter_Pro_Slide_Title extends Component {

	constructor() {

		super( ...arguments );
	};

	render() {
		const { post, setAttributes } = this.props;
		const { backgroundColor, textColor, radius, padding, title, titleCapitalization, font, fontSize, transitions, opacity, slideTitleAlign } = this.props.attributes;

		let slideStyles = {
			backgroundColor: backgroundColor ? hexToRgba(backgroundColor, opacity) : '',
			color: textColor,
			padding: padding + 'px',
			borderRadius: radius + 'px',
			fontFamily: `${font}`,
			fontSize: `${fontSize}px`,
		};

		return (
			<Fragment>
				<InspectorControls>
					<PanelBody title={ __( 'WP Presenter Pro Title', 'wp-presenter-pro' ) }>
						<PanelColorSettings
							title={ __( 'Background Color', 'wp-presenter-pro' ) }
							initialOpen={ true }
							colorSettings={ [ {
								value: backgroundColor,
								onChange: ( value ) => {
									setAttributes( { backgroundColor: value});
								},
								label: __( 'Background Color', 'wp-presenter-pro' ),
							} ] }
						>
						</PanelColorSettings>
						<RangeControl
							label={ __( 'Opacity', 'wp-presenter-pro' ) }
							value={ opacity }
							onChange={ ( value ) => setAttributes( { opacity: value } ) }
							min={ 0 }
							max={ 1 }
							step={ 0.01 }
						/>
						<PanelColorSettings
							title={ __( 'Text Color', 'wp-presenter-pro' ) }
							initialOpen={ true }
							colorSettings={ [ {
								value: textColor,
								onChange: ( value ) => {
									setAttributes( { textColor: value});
								},
								label: __( 'Text Color', 'wp-presenter-pro' ),
							} ] }
						>
						</PanelColorSettings>
						<SelectControl
								label={ __( 'Select a Font', 'wp-presenter-pro' ) }
								value={font}
								options={ revealFonts }
								onChange={ ( value ) => {
									setAttributes( {font: value} );
								} }
						/>
						<RangeControl
							label={ __( 'Font Size', 'wp-presenter-pro' ) }
							value={ fontSize }
							onChange={ ( value ) => setAttributes( { fontSize: value } ) }
							min={ 12 }
							max={ 80 }
							step={ 1 }
						/>
						<SelectControl
								label={ __( 'Select a Transition', 'wp-presenter-pro' ) }
								value={transitions}
								options={ transitionOptions }
								onChange={ ( value ) => {
									setAttributes( {transitions: value} );
								} }
						/>

						<RangeControl
							label={ __( 'Padding', 'wp-presenter-pro' ) }
							value={ padding }
							onChange={ ( value ) => setAttributes( { padding: value } ) }
							min={ 0 }
							max={ 100 }
							step={ 1 }
						/>
						<RangeControl
							label={ __( 'Radius', 'wp-presenter-pro' ) }
							value={ radius }
							onChange={ ( value ) => setAttributes( { radius: value } ) }
							min={ 0 }
							max={ 20 }
							step={ 1 }
						/>
						<ToggleControl
							label={ __( 'Change Capitilization',  'post-type-archive-mapping' ) }
							checked={ titleCapitalization }
							onChange={ ( value ) => setAttributes( { titleCapitalization: value } ) }
						/>
					</PanelBody>
				</InspectorControls>
				<Fragment>
					<div className={ classnames(
							'wp-presenter-pro-slide-title',
							titleCapitalization ? 'slide-title-capitalized' : '',
							slideTitleAlign,
						) }
						style={slideStyles}
					>
						<BlockControls>
							<AlignmentToolbar
								value={ slideTitleAlign }
								onChange={ ( value ) => setAttributes( { slideTitleAlign: value }) }
							/>
						</BlockControls>
						<RichText
							placeholder={__('Enter a slide title here...', 'wp-presenter-pro')}
							value={ title }
							onChange={ ( content ) => setAttributes( { title: content } ) }
						/>
					</div>
				</Fragment>
			</Fragment>
		);
	}
}
export default WP_Presenter_Pro_Slide_Title;