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
	PanelColorSettings
} = wp.blockEditor;


class WP_Presenter_Pro_Unordered_List extends Component {

	constructor() {

		super( ...arguments );
	};

	render() {
		const { post, setAttributes } = this.props;
		const { backgroundColor, textColor, radius, padding, titleCapitalization, font, transitions, content, opacity, fragments} = this.props.attributes;

		let slideStyles = {
			backgroundColor: backgroundColor ? hexToRgba(backgroundColor, opacity) : '',
			color: textColor,
			padding: padding + 'px',
			borderRadius: radius + 'px',
			fontFamily: `${font}`
		};

		return (
			<Fragment>
				<InspectorControls>
					<PanelBody title={ __( 'WP Presenter Pro Unordered List', 'wp-presenter-pro' ) }>
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
							label={ __( 'Break into Fragments',  'post-type-archive-mapping' ) }
							checked={ fragments }
							onChange={ ( value ) => setAttributes( { fragments: value } ) }
						/>
					</PanelBody>
				</InspectorControls>
				<Fragment>
					<div className={ classnames(
							'wp-presenter-pro-unordered-list',
							titleCapitalization ? 'slide-title-capitalized' : '',
							'fragment'
						) }
						style={slideStyles}
					>
						<RichText
							tagName="ul"
							multiline="li"
							value={ content }
							onChange={ ( content ) => setAttributes( { content } ) }
							placeholder={ __( 'Enter text...', 'wp-presenter-pro' ) }
							keepPlaceholderOnFocus={true}
						/>
					</div>
				</Fragment>
			</Fragment>
		);
	}
}
export default WP_Presenter_Pro_Unordered_List;