import axios from 'axios';
import classnames from 'classnames';

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
	InspectorControls,
	BlockControls,
	MediaUpload,
	PanelColorSettings,
} = wp.editor;

const {
	RichText
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
					<InspectorControls>
						<PanelBody title={ __( 'Slide Settings', 'wp-presenter-pro' ) }>
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
						</PanelBody>
					</InspectorControls>
				</Fragment>
			</Fragment>
		);
	}
}
export default withSelect(select => {
	const { getCurrentPost } = select("core/editor");

	return {
		post: getCurrentPost(),
	};
})(WP_Presenter_Pro_Slide);