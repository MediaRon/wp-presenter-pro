import axios from 'axios';
import classnames from 'classnames';
import revealFonts from '../fonts/fonts.js';
import transitionOptions from '../transitions/transitions.js';
import hexToRgba from 'hex-to-rgba';
import parse from 'html-react-parser';

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


class WP_Presenter_Pro_HTML extends Component {

	constructor() {

		super( ...arguments );

		this.state = {
			html: '',
		};
	};

	render() {
		const { post, setAttributes } = this.props;
		const { content, transitions, backgroundColor, textColor, radius, padding, titleCapitalization, font, fontSize, opacity } = this.props.attributes;

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
					<PanelBody title={ __( 'WP Presenter Pro HTML Editor', 'wp-presenter-pro' ) }>
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
							'wp-presenter-pro-html-editor',
							'wp-block-html'
						) }
					>
					<PlainText
						value={ content }
						onChange={ ( content ) => setAttributes( { content } ) }
						placeholder={ __( 'Enter your HTML here.', 'wp-presenter-pro' ) }
						aria-label={ __( 'Presentation HTML', 'wp-presenter-pro' ) }
					/>
					<div className="html-preview-button">
						<Button isSecondary
							onClick={ ( e ) => {
								this.setState( { html: content } )
							}
						}
						>
							{__('Preview HTML', 'wp-presenter-pro')}
						</Button>
						<div>
							{parse(this.state.html)}
						</div>
					</div>
					</div>
				</Fragment>
			</Fragment>
		);
	}
}
export default WP_Presenter_Pro_HTML;