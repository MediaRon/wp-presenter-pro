import axios from 'axios';
import classnames from 'classnames';
import allowedBlocks from '../allowed-blocks/allowed-blocks.js';

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
	RichText,
	BlockControls,
	MediaUpload
} = wp.editor;

const {
	__experimentalGradientPickerControl,
	InnerBlocks,
	InspectorControls,
	PanelColorSettings
} = wp.blockEditor;


class WP_Presenter_Pro_Slide extends Component {

	constructor() {

		super( ...arguments );
	};

	render() {
		const { post, setAttributes } = this.props;
		const { backgroundColor, textColor, backgroundType, videoType, backgroundImageOptions, backgroundVideo, backgroundImg, transition, backgroundTransition, iframeUrl, speakerNotes, backgroundGradient } = this.props.attributes;

		// Get Theme Settings.
		const transitions = [
			{ value: 'none', label: __( 'None', 'wp-presenter-pro' ) },
			{ value: 'fade', label: __( 'Fade', 'wp-presenter-pro' ) },
			{ value: 'slide', label: __( 'Slide', 'wp-presenter-pro' ) },
			{ value: 'convex', label: __( 'Convex', 'wp-presenter-pro' ) },
			{ value: 'concave', label: __( 'Concave', 'wp-presenter-pro' ) },
			{ value: 'zoom', label: __( 'Zoom', 'wp-presenter-pro' ) },
		];

		// Get Theme Settings.
		const backgroundSelectOptions = [
			{ value: 'background', label: __( 'Background Color', 'wp-presenter-pro' ) },
			{ value: 'image', label: __( 'Background Image', 'wp-presenter-pro' ) },
			{ value: 'gradient', label: __( 'Gradient (Requires Gutenberg plugin)', 'wp-presenter-pro' ) },
			{ value: 'video', label: __( 'Video', 'wp-presenter-pro' ) },
			{ value: 'iframe', label: __( 'iFrame', 'wp-presenter-pro' ) },
		];
		const backgroundImageSelectOptions = [
			{ value: 'cover', label: __( 'Cover', 'wp-presenter-pro' ) },
			{ value: 'repeat', label: __( 'Repeat Image', 'wp-presenter-pro' ) },
		];

		const videoSelectOptions = [
			{ value: 'media', label: __( 'Media Library', 'wp-presenter-pro' ) },
			{ value: 'url', label: __( 'URL', 'wp-presenter-pro' ) },
		];

		let slideStyles = {
			backgroundColor: backgroundColor,
			color: textColor
		};
		if ( backgroundImg && 'image' === backgroundType ) {
			slideStyles.backgroundImage = `url(${backgroundImg})`;
		}
		if ( 'gradient' === backgroundType ) {
			slideStyles.backgroundImage = backgroundGradient;	
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
						{'iframe' === backgroundType &&
							<TextControl
								placeholder={__( 'Enter your iFrame URL here. No other blocks will be shown', 'wp-presenter-pro' )}
								value={iframeUrl}
								onChange={ ( value ) => {
									setAttributes( {iframeUrl: value} );
								} }
							/>
						}
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
						{ 'gradient' === backgroundType && __experimentalGradientPickerControl && 
							<Fragment>
								<__experimentalGradientPickerControl	
									label={__( 'Choose a Background Gradient', 'wp-presenter-pro' )}
									value={backgroundGradient}
									onChange={( value ) => {
										setAttributes( {backgroundGradient: value});	
									}}
								/>
							</Fragment>
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
							<SelectControl
								label={ __( 'Select a Video Type', 'wp-presenter-pro' ) }
								value={videoType}
								options={ videoSelectOptions }
								onChange={ ( value ) => {
									setAttributes( {videoType: value} );
								} }
							/>
						}
						{'media' === videoType && 'video' === backgroundType &&
							<Fragment>
								<MediaUpload
								onSelect={ ( imageObject ) => {
									this.props.setAttributes( { backgroundVideo: imageObject.url } );
								} }
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
							</Fragment>
						}
						{'url' === videoType && 'video' === backgroundType &&
							<Fragment>
								<TextControl
									placeholder={__( 'Enter your video URL here.', 'wp-presenter-pro' )}
									value={backgroundVideo}
									onChange={ ( value ) => {
										setAttributes( {backgroundVideo: value} );
									} }
								/>
							</Fragment>
						}
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
							label={ __( 'Select a Transition', 'wp-presenter-pro' ) }
							value={transition}
							options={ transitions }
							onChange={ ( value ) => {
								setAttributes( {transition: value} );
							} }
						/>
						<SelectControl
							label={ __( 'Select a Background Transition', 'wp-presenter-pro' ) }
							value={backgroundTransition}
							options={ transitions }
							onChange={ ( value ) => {
								setAttributes( {backgroundTransition: value} );
							} }
						/>
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
					<div className="wp-presenter-pro-speaker-notes">
						<h3>{__('Speaker Notes', 'wp-presenter-pro')}</h3>
						<RichText 
							value={speakerNotes}
							onChange={(value) => {
								this.props.setAttributes( {
									speakerNotes: value,
								});
							}}
						/>
					</div>
				</Fragment>
			</Fragment>
		);
	}
}
export default WP_Presenter_Pro_Slide;