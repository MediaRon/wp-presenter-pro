import classnames from 'classnames';
import revealFonts from '../fonts/fonts.js';
import transitionOptions from '../transitions/transitions.js';

const { Component, Fragment } = wp.element;
const { __, _x } = wp.i18n;


const {
	PanelBody,
	SelectControl,
	RangeControl,
	IconButton,
	Dashicon,
	ToggleControl,
	TextControl,
} = wp.components;

const {
	URLInput,
} = wp.editor;

const {
	__experimentalGradientPickerControl,
	InspectorControls,
	RichText,
	PanelColorSettings
} = wp.blockEditor;


class WP_Presenter_Pro_Button extends Component {

	constructor() {

		super( ...arguments );
	};

	render() {
		const { setAttributes, isSelected } = this.props;
		const { buttonUrl, content, transitions, backgroundColor, backgroundColorHover, textColor, textColorHover, font, fontSize, paddingLR, paddingTB, radius, borderColor, borderWidth, newWindow, noFollow, btnClassName, backgroundType, backgroundGradient, backgroundGradientHover } = this.props.attributes;

		let slideStyles = {
			backgroundColor: backgroundColor,
			color: textColor,
			padding: `${paddingTB}px ${paddingLR}px`,
			borderRadius: radius + 'px',
			fontFamily: `${font}`,
			fontSize: `${fontSize}px`,
			borderStyle: 'solid',
			borderWidth: borderWidth + 'px',
			borderColor: borderColor,
		};
		if ( 'gradient' === backgroundType ) {
			slideStyles.backgroundImage = backgroundGradient;	
		}

		const backgroundSelectOptions = [
			{ value: 'background', label: __( 'Background Color', 'wp-presenter-pro' ) },
			{ value: 'gradient', label: __( 'Gradient (Requires Gutenberg plugin)', 'wp-presenter-pro' ) },
		];

		return (
			<Fragment>
				<InspectorControls>
					<PanelBody title={ __( 'WP Presenter Pro Button', 'wp-presenter-pro' ) }>
						<SelectControl
							label={ __( 'Select a Background Type', 'wp-presenter-pro' ) }
							value={backgroundType}
							options={ backgroundSelectOptions }
							onChange={ ( value ) => {
								setAttributes( {backgroundType: value} );
							} }
						/>
						{'background' === backgroundType &&
							<Fragment>
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
								<PanelColorSettings
									title={ __( 'Background Color on Hover', 'wp-presenter-pro' ) }
									initialOpen={ true }
									colorSettings={ [ {
										value: backgroundColorHover,
										onChange: ( value ) => {
											setAttributes( { backgroundColorHover: value});
										},
										label: __( 'Background Color on Hover', 'wp-presenter-pro' ),
									} ] }
								>
								</PanelColorSettings>
							</Fragment>
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
								<__experimentalGradientPickerControl	
									label={__( 'Choose a Background Hover Gradient', 'wp-presenter-pro' )}
									value={backgroundGradientHover}
									onChange={( value ) => {
										setAttributes( {backgroundGradientHover: value});	
									}}
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
						<PanelColorSettings
							title={ __( 'Text Color on Hover', 'wp-presenter-pro' ) }
							initialOpen={ true }
							colorSettings={ [ {
								value: textColorHover,
								onChange: ( value ) => {
									setAttributes( { textColorHover: value});
								},
								label: __( 'Text Color on Hover', 'wp-presenter-pro' ),
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
						<RangeControl
							label={ __( 'Left/Right Padding', 'wp-presenter-pro' ) }
							value={ paddingLR }
							onChange={ ( value ) => setAttributes( { paddingLR: value } ) }
							min={ 0 }
							max={ 100 }
							step={ 1 }
						/>
						<RangeControl
							label={ __( 'Top/Bottom Padding', 'wp-presenter-pro' ) }
							value={ paddingTB }
							onChange={ ( value ) => setAttributes( { paddingTB: value } ) }
							min={ 0 }
							max={ 100 }
							step={ 1 }
						/>
						<PanelColorSettings
							title={ __( 'Border Color', 'wp-presenter-pro' ) }
							initialOpen={ true }
							colorSettings={ [ {
								value: borderColor,
								onChange: ( value ) => {
									setAttributes( { borderColor: value});
								},
								label: __( 'Border Color', 'wp-presenter-pro' ),
							} ] }
						>
						</PanelColorSettings>
						<RangeControl
							label={ __( 'Border Width', 'wp-presenter-pro' ) }
							value={ borderWidth }
							onChange={ ( value ) => setAttributes( { borderWidth: value } ) }
							min={ 0 }
							max={ 20 }
							step={ 1 }
						/>
						<RangeControl
							label={ __( 'Border Radius', 'wp-presenter-pro' ) }
							value={ radius }
							onChange={ ( value ) => setAttributes( { radius: value } ) }
							min={ 0 }
							max={ 20 }
							step={ 1 }
						/>
						<ToggleControl
							label={__( 'New Window', 'wp-presenter-pro' )}
							checked={newWindow}
							onChange={ ( value ) => setAttributes( { newWindow: value } ) }
						/>
						<ToggleControl
							label={__( 'No Follow', 'wp-presenter-pro' )}
							checked={noFollow}
							onChange={ ( value ) => setAttributes( { noFollow: value } ) }
						/>
						<TextControl
							label={__( 'Button Class Name', 'wp-presenter-pro' )}
							value={btnClassName}
							onChange={ ( value ) => setAttributes( { btnClassName: value } ) }
						/>
					</PanelBody>
				</InspectorControls>
				<Fragment>
					<div className={ classnames(
							'wp-presenter-pro-button'
						) }
					>
						<RichText
							tagName="span"
							value={ content }
							onChange={ ( content ) => setAttributes( { content } ) }
							placeholder={ __( 'Button text...', 'wp-presenter-pro' ) }
							keepPlaceholderOnFocus
							formattingControls={ [] }
							className={classnames('wppp-button')}
							style={slideStyles}
						/>
					</div>
					{ isSelected && 
						<form
							key="form-link"
							className={ `blocks-button__inline-link wppp-button-link`}
							onSubmit={ event => event.preventDefault() }
						>
							<Dashicon icon={ 'admin-links' } />
							<URLInput
								className="button-url"
								value={ buttonUrl }
								onChange={ ( value ) => setAttributes({ buttonUrl: value }) }
							/>
							<IconButton
								icon="editor-break"
								label={ __( 'Apply', 'wp-presenter-pro' ) }
								type="submit"
							/>
						</form>
					}
				</Fragment>
			</Fragment>
		);
	}
}
export default WP_Presenter_Pro_Button;