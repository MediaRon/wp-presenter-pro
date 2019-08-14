import axios from 'axios';
import classnames from 'classnames';
import revealFonts from '../fonts/fonts.js';
import transitionOptions from '../transitions/transitions.js';

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
	MediaUpload,
	PlainText,
} = wp.editor;

const {
	InspectorControls,
	RichText,
	PanelColorSettings
} = wp.blockEditor;


class WP_Presenter_Pro_Image extends Component {

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
		const { img, transitions, imgId, imgSize} = this.props.attributes;

		// Get thumbnail sizes in the right format.
		const imageSizes = Object.entries( wp_presenter_pro.image_sizes );
		let thumbnailSizes = [];
		imageSizes.forEach( function( label, index ) {
			thumbnailSizes.push( { value: label[0], label: label[1] } );
		} );

		let slideStyles = {
		};

		return (
			<Fragment>
				<InspectorControls>
					<PanelBody title={ __( 'WP Presenter Pro Image', 'wp-presenter-pro' ) }>
						{0 !== imgId &&
							<SelectControl
									label={ __( 'Select an Image Size', 'wp-presenter-pro' ) }
									value={imgSize}
									options={ thumbnailSizes }
									onChange={ ( value ) => {
										setAttributes( {imageSize: value} );
										this.props.attributes.imageSize = value;
										this.getAvatar( value, imgId );
									} }
							/>
						}
						<SelectControl
								label={ __( 'Select a Transition', 'wp-presenter-pro' ) }
								value={transitions}
								options={ transitionOptions }
								onChange={ ( value ) => {
									setAttributes( {transitions: value} );
								} }
						/>
					</PanelBody>
				</InspectorControls>
				<Fragment>
					<div className={ classnames(
							'wp-presenter-pro-image'
						) }
						style={slideStyles}
					>
						<div className="media">
							<MediaUpload
								onSelect={ (value) => { setAttributes({img: value.sizes.full.url, imgId: value.id })} }
								render={ ({open}) => {
									return <img
										src={img}
										onClick={open}
										/>;
								}}
							/>
						</div>
					</div>
				</Fragment>
			</Fragment>
		);
	}
}
export default WP_Presenter_Pro_Image;