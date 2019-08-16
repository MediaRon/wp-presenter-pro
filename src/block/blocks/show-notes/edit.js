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
	BlockControls,
	MediaUpload
} = wp.editor;

const {
	InspectorControls,
	RichText,
	PanelColorSettings
} = wp.blockEditor;


class WP_Presenter_Pro_Show_Notes extends Component {

	constructor() {

		super( ...arguments );
	};

	render() {
		const { post, setAttributes } = this.props;
		const { notes, listitems } = this.props.attributes;

		return (
			<Fragment>
				<Fragment>
					<div className={ classnames(
							'wp-presenter-pro-show-notes'
						) }
					>
						<RichText
							tagName="div"
							multiline="p"
							value={ notes }
							onChange={ ( notes ) => setAttributes( { notes } ) }
						/>
						<RichText
							tagName="ul"
							multiline="li"
							value={ listitems }
							onChange={ ( listitems ) => setAttributes( { listitems } ) }
						/>
					</div>
				</Fragment>
			</Fragment>
		);
	}
}
export default WP_Presenter_Pro_Show_Notes;