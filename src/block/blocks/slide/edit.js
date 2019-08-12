import axios from 'axios';
import classnames from 'classnames';

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
	InspectorControls,
	BlockControls,
	MediaUpload,
	PanelColorSettings,
} = wp.editor;

const {
	RichText,
	InnerBlocks
} = wp.blockEditor;


class WP_Presenter_Pro_Slide extends Component {

	constructor() {

		super( ...arguments );
	};

	render() {
		const { post, setAttributes } = this.props;
		const { backgroundColor } = this.props.attributes;

		return (
			<Fragment>
				<Fragment>
					<div className="wp-presenter-pro-slide" style={{backgroundColor: backgroundColor}}>
						<div className="wp-block-group__inner-container">
							<InnerBlocks />
						</div>
					</div>
				</Fragment>
			</Fragment>
		);
	}
}
export default WP_Presenter_Pro_Slide;