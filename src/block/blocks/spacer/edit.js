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
	MediaUpload
} = wp.editor;

const {
	RichText,
	InspectorControls,
	PanelColorSettings
} = wp.blockEditor;


class WP_Presenter_Pro_Spacer extends Component {

	constructor() {

		super( ...arguments );
	};

	render() {
		const { post, setAttributes } = this.props;
		const { height } = this.props.attributes;

		return (
			<Fragment>
				<InspectorControls>
					<PanelBody title={ __( 'WP Presenter Pro Spacer', 'wp-presenter-pro' ) }>
						<RangeControl
							label={ __( 'Height', 'wp-presenter-pro' ) }
							value={ height }
							onChange={ ( value ) => setAttributes( { height: value } ) }
							min={ 0 }
							max={ 1000 }
							step={ 1 }
						/>
					</PanelBody>
				</InspectorControls>
				<Fragment>
					<div className={ classnames(
							'wp-presenter-pro-spacer'
						) }
						style={{height: height + 'px'}}
					>
						{__('This is a spacer. No content will be shown.', 'wp-presenter-pro')}
					</div>
				</Fragment>
			</Fragment>
		);
	}
}
export default WP_Presenter_Pro_Spacer;