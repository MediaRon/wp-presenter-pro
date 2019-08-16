import axios from 'axios';
import classnames from 'classnames';
import revealFonts from '../fonts/fonts.js';
import transitionOptions from '../transitions/transitions.js';

const { Component, Fragment } = wp.element;
const { withSelect } = wp.data;
const { __, _x } = wp.i18n;


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
	InspectorControls,
	RichText,
	PanelColorSettings
} = wp.blockEditor;


class WP_Presenter_Pro_Content extends Component {

	constructor() {

		super( ...arguments );
	};

	getAvatar = ( size, imgId ) => {
		const refThis = this;
		axios.post(wp_presenter_pro.rest_url + `wppp/v1/get_avatar/`, { image_id: imgId, size: size }, { 'headers': { 'X-WP-Nonce': wp_presenter_pro.rest_nonce } } ).then( (response) => {
			this.props.setAttributes( {
				img: response.data.src,
				imgSize: size,
			});
		}).catch(function (error) {

		});
	}

	render() {
		const { post, setAttributes } = this.props;
		const { content, transitions, backgroundColor, textColor, font, fontSize, padding, radius } = this.props.attributes;

		// Get thumbnail sizes in the right format.
		const imageSizes = Object.entries( wp_presenter_pro.image_sizes );
		let thumbnailSizes = [];
		imageSizes.forEach( function( label, index ) {
			thumbnailSizes.push( { value: label[0], label: label[1] } );
		} );

		let slideStyles = {
			backgroundColor: backgroundColor,
			color: textColor,
			padding: padding + 'px',
			borderRadius: radius + 'px',
			fontFamily: `${font}`,
			fontSize: `${fontSize}px`,
		};

		return (
			<Fragment>
				<InspectorControls>
					<PanelBody title={ __( 'WP Presenter Pro Content', 'wp-presenter-pro' ) }>
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
								label={ __( 'Select a Font', 'user-profile-picture-enhanced' ) }
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
					</PanelBody>
				</InspectorControls>
				<Fragment>
					<div className={ classnames(
							'wp-presenter-pro-content'
						) }
						style={slideStyles}
					>
						<RichText
							tagName="div"
							multiline="p"
							value={ content }
							onChange={ ( content ) => setAttributes( { content } ) }
						/>
					</div>
				</Fragment>
			</Fragment>
		);
	}
}
export default WP_Presenter_Pro_Content;