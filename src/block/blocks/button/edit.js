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
} = wp.components;

const {
	URLInput,
} = wp.editor;

const {
	InspectorControls,
	RichText,
	PanelColorSettings
} = wp.blockEditor;


class WP_Presenter_Pro_Button extends Component {

	constructor() {

		super( ...arguments );
	};

	render() {
		const { setAttributes } = this.props;
		const { buttonUrl, content, transitions, backgroundColor, textColor, font, fontSize, paddingLR, paddingTR, radius, borderColor, borderWidth } = this.props.attributes;

		let slideStyles = {
			backgroundColor: backgroundColor,
			color: textColor,
			paddingTop: paddingTR,
			paddingBottom: paddingTR,
			paddingLeft: paddingLR,
			paddingRight: paddingLR,
			borderRadius: radius + 'px',
			fontFamily: `${font}`,
			fontSize: `${fontSize}px`,
			borderStyle: 'solid',
			borderWidth: borderWidth + 'px',
			borderColor: borderColor,
		};

		return (
			<Fragment>
				<InspectorControls>
					<PanelBody title={ __( 'WP Presenter Pro Button', 'wp-presenter-pro' ) }>
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
							value={ paddingTR }
							onChange={ ( value ) => setAttributes( { paddingTR: value } ) }
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
					</PanelBody>
				</InspectorControls>
				<Fragment>
					<div className={ classnames(
							'wp-presenter-pro-button'
						) }
						style={slideStyles}
					>
						<RichText
							tagName="span"
							value={ content }
							onChange={ ( content ) => setAttributes( { content } ) }
							placeholder={ __( 'Button text...', 'wp-presenter-pro' ) }
							keepPlaceholderOnFocus
							formattingControls={ [] }
							className={classnames('wppp-button')}
						/>
					</div>
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