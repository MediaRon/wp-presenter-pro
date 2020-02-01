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
	ColorPicker,
} = wp.components;

const {
	MediaUpload,
} = wp.editor;

const {
	__experimentalGradientPickerControl,
	InspectorControls,
	RichText,
	PanelColorSettings,
	AlignmentToolbar,
	BlockControls,
} = wp.blockEditor;


class WP_Presenter_Pro_Blockquote extends Component {

	constructor() {

		super( ...arguments );
	};

	render() {
		const { post, setAttributes } = this.props;
		const { backgroundColor, textColor, radius, padding, titleCapitalization, font, fontSize, transitions, content, opacity, quoteStyle, showAuthor, author, backgroundType, backgroundGradient, blockquoteAlign, authorFont, authorFontSize, authorImage, authorWidth, authorRadius, authorColor, quoteFont, quoteFontSize, quoteColor, borderSize, borderColor, paddingLeft, paddingRight, paddingTop, paddingBottom } = this.props.attributes;

		let slideStyles = {
			backgroundColor: backgroundColor ? hexToRgba(backgroundColor, opacity) : '',
			color: textColor,
			padding: `${paddingTop}px ${paddingRight}px ${paddingBottom}px ${paddingLeft}px`,
			borderRadius: radius + 'px',
			fontFamily: `${font}`,
			fontSize: `${fontSize}px`,
		};

		let authorStyles = {
			color: authorColor,
			fontFamily: `${authorFont}`,
			fontSize: `${authorFontSize}px`,
		};

		let quoteStyles = {
			color: quoteColor,
			fontFamily: `${quoteFont}`,
			fontSize: `${quoteFontSize}px`,
		};

		if ( 'gradient' === backgroundType ) {
			slideStyles.backgroundImage = backgroundGradient;	
		}
		if ( 'border' === quoteStyle ) {
			slideStyles.borderLeft = `${borderSize}px solid ${borderColor}`
		}

		const backgroundSelectOptions = [
			{ value: 'background', label: __( 'Background Color', 'wp-presenter-pro' ) },
			{ value: 'gradient', label: __( 'Gradient (Requires Gutenberg plugin)', 'wp-presenter-pro' ) },
		];

		const blockquoteStyles = [
			{ value: 'none', label: __( 'None', 'wp-presenter-pro' ) },
			{ value: 'quotes', label: __( 'Outer Quotes', 'wp-presenter-pro' ) },
			{ value: 'inner-quotes', label: __( 'Inner Quotes', 'wp-presenter-pro' ) },
			{ value: 'border', label: __( 'Border', 'wp-presenter-pro' ) },
		];

		return (
			<Fragment>
				<InspectorControls>
					<PanelBody title={ __( 'WP Presenter Pro Blockquote', 'wp-presenter-pro' ) }>
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
								<RangeControl
									label={ __( 'Opacity', 'wp-presenter-pro' ) }
									value={ opacity }
									onChange={ ( value ) => setAttributes( { opacity: value } ) }
									min={ 0 }
									max={ 1 }
									step={ 0.01 }
								/>
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
							disableAlpha={true}
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
							max={ 140 }
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
							label={ __( 'Padding Top', 'wp-presenter-pro' ) }
							value={ paddingTop }
							onChange={ ( value ) => setAttributes( { paddingTop: value } ) }
							min={ 0 }
							max={ 200 }
							step={ 1 }
						/>
						<RangeControl
							label={ __( 'Padding Right', 'wp-presenter-pro' ) }
							value={ paddingRight }
							onChange={ ( value ) => setAttributes( { paddingRight: value } ) }
							min={ 0 }
							max={ 200 }
							step={ 1 }
						/>
						<RangeControl
							label={ __( 'Padding Bottom', 'wp-presenter-pro' ) }
							value={ paddingBottom }
							onChange={ ( value ) => setAttributes( { paddingBottom: value } ) }
							min={ 0 }
							max={ 200 }
							step={ 1 }
						/>
						<RangeControl
							label={ __( 'Padding Left', 'wp-presenter-pro' ) }
							value={ paddingLeft }
							onChange={ ( value ) => setAttributes( { paddingLeft: value } ) }
							min={ 0 }
							max={ 200 }
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
							label={ __( 'Change Capitilization',  'post-type-archive-mapping' ) }
							checked={ titleCapitalization }
							onChange={ ( value ) => setAttributes( { titleCapitalization: value } ) }
						/>
					</PanelBody>
					<PanelBody title={ __( 'Quotes', 'wp-presenter-pro' ) }>
						<SelectControl
							label={ __( 'Select a Blockquote Type', 'wp-presenter-pro' ) }
							value={quoteStyle}
							options={ blockquoteStyles }
							onChange={ ( value ) => {
								setAttributes( {quoteStyle: value} );
							} }
						/>
						{ 'border' === quoteStyle &&
							<Fragment>
								<RangeControl
									label={ __( 'Border Size', 'wp-presenter-pro' ) }
									value={ borderSize }
									onChange={ ( value ) => setAttributes( { borderSize: value } ) }
									min={ 0 }
									max={ 140 }
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
									disableAlpha={true}
								>
								</PanelColorSettings>
							</Fragment>
						}
						{ 'quotes' === quoteStyle || 'inner-quotes' === quoteStyle &&
							<Fragment>
								<SelectControl
									label={ __( 'Select a Font', 'wp-presenter-pro' ) }
									value={quoteFont}
									options={ revealFonts }
									onChange={ ( value ) => {
										setAttributes( {quoteFont: value} );
									} }
								/>
								<RangeControl
									label={ __( 'Font Size', 'wp-presenter-pro' ) }
									value={ quoteFontSize }
									onChange={ ( value ) => setAttributes( { quoteFontSize: value } ) }
									min={ 12 }
									max={ 140 }
									step={ 1 }
								/>
								<PanelColorSettings
									title={ __( 'Quote Color', 'wp-presenter-pro' ) }
									initialOpen={ true }
									colorSettings={ [ {
										value: quoteColor,
										onChange: ( value ) => {
											setAttributes( { quoteColor: value});
										},
										label: __( 'Quote Color', 'wp-presenter-pro' ),
									} ] }
									disableAlpha={true}
								>
								</PanelColorSettings>
							</Fragment>
						}
					</PanelBody>
					<PanelBody title={ __( 'Author Options', 'wp-presenter-pro' ) }>
						<ToggleControl
							label={ __( 'Show Author',  'post-type-archive-mapping' ) }
							checked={ showAuthor }
							onChange={ ( value ) => setAttributes( { showAuthor: value } ) }
						/>
						{ showAuthor &&
							<Fragment>
								<SelectControl
									label={ __( 'Select a Font', 'wp-presenter-pro' ) }
									value={authorFont}
									options={ revealFonts }
									onChange={ ( value ) => {
										setAttributes( {authorFont: value} );
									} }
								/>
								<RangeControl
									label={ __( 'Font Size', 'wp-presenter-pro' ) }
									value={ authorFontSize }
									onChange={ ( value ) => setAttributes( { authorFontSize: value } ) }
									min={ 12 }
									max={ 80 }
									step={ 1 }
								/>
								<PanelColorSettings
									title={ __( 'Text Color', 'wp-presenter-pro' ) }
									initialOpen={ true }
									colorSettings={ [ {
										value: authorColor,
										onChange: ( value ) => {
											setAttributes( { authorColor: value});
										},
										label: __( 'Text Color', 'wp-presenter-pro' ),
									} ] }
									disableAlpha={true}
								>
								</PanelColorSettings>
							</Fragment>
						}
					</PanelBody>
				</InspectorControls>
				<BlockControls>
					<AlignmentToolbar
						value={ blockquoteAlign }
						onChange={ ( value ) => setAttributes( { blockquoteAlign: value }) }
					/>
				</BlockControls>
				<Fragment>
					<blockquote className={ classnames(
								'wp-presenter-pro-blockquote',
								titleCapitalization ? 'slide-blockquote-capitalized' : '',
								blockquoteAlign
							) }
							style={slideStyles}
					>
						{'quotes' === quoteStyle &&
							<Fragment>
								<div className="wp-presenter-top-left-quote" style={quoteStyles}>
									&ldquo;
								</div>
								<div className="wp-presenter-bottom-right-quote" style={quoteStyles}>
									&rdquo;
								</div>
							</Fragment>
						}
						<RichText
							value={ content }
							onChange={ ( content ) => setAttributes( { content } ) }
							placeholder={ __( 'Enter your blockquote here.', 'wp-presenter-pro' ) }
							aria-label={ __( 'Blockquote content.', 'wp-presenter-pro' ) }
						/>
					</blockquote>
					{showAuthor &&
						<RichText
							style={authorStyles}
							className={ classnames(
								'wp-presenter-pro-blockquote-author',
							) }
							value={ author }
							onChange={ ( author ) => setAttributes( { author } ) }
							placeholder={ __( 'Author name here.', 'wp-presenter-pro' ) }
							aria-label={ __( 'Author name.', 'wp-presenter-pro' ) }
						/>
					}
				</Fragment>
			</Fragment>
		);
	}
}
export default WP_Presenter_Pro_Blockquote;