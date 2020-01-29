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


class WP_Presenter_Pro_Code extends Component {

	constructor() {

		super( ...arguments );
	};

	render() {
		const { post, setAttributes } = this.props;
		const { content, transitions, fontSize} = this.props.attributes;

		let slideStyles = {
		};

		return (
			<Fragment>
				<InspectorControls>
					<PanelBody title={ __( 'WP Presenter Pro Code Editor', 'wp-presenter-pro' ) }>
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
					</PanelBody>
				</InspectorControls>
				<Fragment>
					<div className={ classnames(
							'wp-presenter-pro-code-editor',
							'wp-block-code'
						) }
						style={slideStyles}
					>
					<PlainText
						value={ content }
						onChange={ ( content ) => setAttributes( { content } ) }
						placeholder={ __( 'Enter your code here.', 'wp-presenter-pro' ) }
						aria-label={ __( 'Presentation code', 'wp-presenter-pro' ) }
					/>
					</div>
				</Fragment>
			</Fragment>
		);
	}
}
export default WP_Presenter_Pro_Code;