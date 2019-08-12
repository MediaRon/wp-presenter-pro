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
		const { backgroundColor, backgroundType, backgroundImageOptions, backgroundVideo, backgroundImg } = this.props.attributes;
		const allowedBlocks = [ 'core/image' ];

		// Get Theme Settings.
		const backgroundSelectOptions = [
			{ value: 'none', label: __( 'None', 'wp-presenter-pro' ) },
			{ value: 'background', label: __( 'Background Color', 'wp-presenter-pro' ) },
			{ value: 'image', label: __( 'Background Image', 'wp-presenter-pro' ) },
			{ value: 'video', label: __( 'Video', 'wp-presenter-pro' ) },
		];
		const backgroundImageSelectOptions = [
			{ value: 'cover', label: __( 'Cover', 'wp-presenter-pro' ) },
			{ value: 'repeat', label: __( 'Repeat Image', 'wp-presenter-pro' ) },
		];

		let slideStyles = {
			backgroundColor: backgroundColor,
		};
		if ( backgroundImg && 'background' !== backgroundType ) {
			slideStyles.backgroundImage = `url(${backgroundImg})`;
		}
		if ( backgroundImageOptions == 'cover' && 'background' !== backgroundType ) {
			slideStyles.backgroundSize = backgroundImageOptions;
			slideStyles.backgroundPosition = 'center';
		}
		if ( backgroundImageOptions == 'repeat' && 'background' !== backgroundType ) {
			slideStyles.backgroundRepeat = 'repeat';
		}


		return (
			<Fragment>
				<InspectorControls>
					<PanelBody title={ __( 'WP Presenter Pro Settings', 'wp-presenter-pro' ) }>
						<SelectControl
							label={ __( 'Select a Background Type', 'wp-presenter-pro' ) }
							value={backgroundType}
							options={ backgroundSelectOptions }
							onChange={ ( value ) => {
								setAttributes( {backgroundType: value} );
							} }
						/>
						{'background' === backgroundType &&
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
						}
						{'image' === backgroundType &&
							<Fragment>
								<MediaUpload
								onSelect={ ( imageObject ) => {
									this.props.setAttributes( { backgroundImg: imageObject.url } );
								} }
								type="image"
								value={ backgroundImg }
								render={ ( { open } ) => (
									<Fragment>
										<button className="components-button is-button" onClick={ open }>
											{ __( 'Background Image', 'wp-presenter-pro' ) }
										</button>
										{ backgroundImg &&
											<Fragment>
												<div>
													<img src={ backgroundImg } alt={ __( 'Background Image', 'wp-presenter-pro' ) } width="250" height="250" />
												</div>
												<div>
													<button className="components-button is-button" onClick={ ( event ) => {
														this.props.setAttributes( { backgroundImg: '' } );
													} }>
														{ __( 'Remove Background Image', 'wp-presenter-pro' ) }
													</button>
												</div>
											</Fragment>
										}
									</Fragment>
								) }
								/>
								<SelectControl
									label={ __( 'Select a Background Type', 'wp-presenter-pro' ) }
									value={backgroundImageOptions}
									options={ backgroundImageSelectOptions }
									onChange={ ( value ) => {
										setAttributes( {backgroundImageOptions: value} );
									} }
								/>
							</Fragment>
						}
						{'video' === backgroundType &&
							<Fragment>
								<MediaUpload
								onSelect={ ( imageObject ) => {
									this.props.setAttributes( { backgroundVideo: imageObject.url } );
								} }
								type="video"
								value={ backgroundVideo }
								render={ ( { open } ) => (
									<Fragment>
										<button className="components-button is-button" onClick={ open }>
											{ __( 'Background Video', 'wp-presenter-pro' ) }
										</button>
										{ backgroundVideo &&
											<Fragment>
												<div>
													<button className="components-button is-button" onClick={ ( event ) => {
														this.props.setAttributes( { backgroundVideo: '' } );
													} }>
														{ __( 'Remove Background Video', 'wp-presenter-pro' ) }
													</button>
												</div>
											</Fragment>
										}
									</Fragment>
								) }
								/>
								<SelectControl
									label={ __( 'Select a Background Type', 'wp-presenter-pro' ) }
									value={backgroundImageOptions}
									options={ backgroundImageOptions }
									onChange={ ( value ) => {
										setAttributes( {backgroundImageOptions: value} );
									} }
								/>
							</Fragment>
						}
					</PanelBody>
				</InspectorControls>
				<Fragment>
					<div className="wp-presenter-pro-slide" style={slideStyles}>
						<div className="wp-block-group__inner-container">
							<InnerBlocks
								allowedBlocks={allowedBlocks}
							/>
						</div>
					</div>
				</Fragment>
			</Fragment>
		);
	}
}
export default WP_Presenter_Pro_Slide;