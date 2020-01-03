import classnames from 'classnames';
import revealFonts from '../fonts/fonts.js';
import transitionOptions from '../transitions/transitions.js';

const { Component, Fragment } = wp.element;
const { __, _x } = wp.i18n;


const {
	PanelBody,
	SelectControl,
	RangeControl,
	ToggleControl,
	TextControl,
} = wp.components;

const {
	InspectorControls,
	PanelColorSettings
} = wp.blockEditor;


class WP_Presenter_Pro_Dual_Button extends Component {

	constructor() {

		super( ...arguments );
	};

	render() {
		const { setAttributes } = this.props;
		const { contentButtonOne, buttonUrlButtonOne, contentButtonTwo, buttonUrlButtonTwo, transitions, backgroundColorButtonOne, backgroundColorHoverButtonOne, textColorButtonOne, textColorHoverButtonOne, backgroundColorButtonTwo, backgroundColorHoverButtonTwo, textColorButtonTwo, textColorHoverButtonTwo, font, fontSize, paddingLR, paddingTB, borderWidth, borderColorButtonOne, radius, borderColorButtonTwo, btnClassNameButtonOne, btnClassNameButtonTwo, newWindow, noFollow } = this.props.attributes;

		let slideStyles = {
			backgroundColor: backgroundColorButtonOne,
			color: textColorButtonOne,
			padding: `${paddingTB}px ${paddingLR}px`,
			borderRadius: radius + 'px',
			fontFamily: `${font}`,
			fontSize: `${fontSize}px`,
			borderStyle: 'solid',
			borderWidth: borderWidth + 'px',
			borderColor: borderColorButtonOne,
		};

		let slideStylesTwo = {
			backgroundColor: backgroundColorButtonTwo,
			color: textColorButtonTwo,
			padding: `${paddingTB}px ${paddingLR}px`,
			borderRadius: radius + 'px',
			fontFamily: `${font}`,
			fontSize: `${fontSize}px`,
			borderStyle: 'solid',
			borderWidth: borderWidth + 'px',
			borderColor: borderColorButtonTwo,
		};

		return (
			<Fragment>
				<InspectorControls>
					<PanelBody title={ __( 'WP Presenter Pro Button One', 'wp-presenter-pro' ) }>
						<TextControl
							label={__( 'Button Text', 'wp-presenter-pro' )}
							value={contentButtonOne}
							onChange={ ( value ) => setAttributes( { contentButtonOne: value } ) }
						/>
						<TextControl
							label={__( 'Button URL', 'wp-presenter-pro' )}
							value={buttonUrlButtonOne}
							onChange={ ( value ) => setAttributes( { buttonUrlButtonOne: value } ) }
						/>
						<PanelColorSettings
							title={ __( 'Background Color', 'wp-presenter-pro' ) }
							initialOpen={ true }
							colorSettings={ [ {
								value: backgroundColorButtonOne,
								onChange: ( value ) => {
									setAttributes( { backgroundColorButtonOne: value});
								},
								label: __( 'Background Color', 'wp-presenter-pro' ),
							} ] }
						>
						</PanelColorSettings>
						<PanelColorSettings
							title={ __( 'Background Color on Hover', 'wp-presenter-pro' ) }
							initialOpen={ true }
							colorSettings={ [ {
								value: backgroundColorHoverButtonOne,
								onChange: ( value ) => {
									setAttributes( { backgroundColorHoverButtonOne: value});
								},
								label: __( 'Background Color on Hover', 'wp-presenter-pro' ),
							} ] }
						>
						</PanelColorSettings>
						<PanelColorSettings
							title={ __( 'Text Color', 'wp-presenter-pro' ) }
							initialOpen={ true }
							colorSettings={ [ {
								value: textColorButtonOne,
								onChange: ( value ) => {
									setAttributes( { textColorButtonOne: value});
								},
								label: __( 'Text Color', 'wp-presenter-pro' ),
							} ] }
						>
						</PanelColorSettings>
						<PanelColorSettings
							title={ __( 'Text Color on Hover', 'wp-presenter-pro' ) }
							initialOpen={ true }
							colorSettings={ [ {
								value: textColorHoverButtonOne,
								onChange: ( value ) => {
									setAttributes( { textColorHoverButtonOne: value});
								},
								label: __( 'Text Color on Hover', 'wp-presenter-pro' ),
							} ] }
						>
						</PanelColorSettings>
						<PanelColorSettings
							title={ __( 'Border Color', 'wp-presenter-pro' ) }
							initialOpen={ true }
							colorSettings={ [ {
								value: borderColorButtonOne,
								onChange: ( value ) => {
									setAttributes( { borderColorButtonOne: value});
								},
								label: __( 'Border Color', 'wp-presenter-pro' ),
							} ] }
						>
						</PanelColorSettings>
						<TextControl
							label={__( 'Button Class Name', 'wp-presenter-pro' )}
							value={btnClassNameButtonOne}
							onChange={ ( value ) => setAttributes( { btnClassNameButtonOne: value } ) }
						/>
					</PanelBody>
					<PanelBody title={ __( 'WP Presenter Pro Button Two', 'wp-presenter-pro' ) }>
						<TextControl
							label={__( 'Button Text', 'wp-presenter-pro' )}
							value={contentButtonTwo}
							onChange={ ( value ) => setAttributes( { contentButtonTwo: value } ) }
						/>
						<TextControl
							label={__( 'Button URL', 'wp-presenter-pro' )}
							value={buttonUrlButtonTwo}
							onChange={ ( value ) => setAttributes( { buttonUrlButtonTwo: value } ) }
						/>
						<PanelColorSettings
							title={ __( 'Background Color', 'wp-presenter-pro' ) }
							initialOpen={ true }
							colorSettings={ [ {
								value: backgroundColorButtonTwo,
								onChange: ( value ) => {
									setAttributes( { backgroundColorButtonTwo: value});
								},
								label: __( 'Background Color', 'wp-presenter-pro' ),
							} ] }
						>
						</PanelColorSettings>
						<PanelColorSettings
							title={ __( 'Background Color on Hover', 'wp-presenter-pro' ) }
							initialOpen={ true }
							colorSettings={ [ {
								value: backgroundColorHoverButtonTwo,
								onChange: ( value ) => {
									setAttributes( { backgroundColorHoverButtonTwo: value});
								},
								label: __( 'Background Color on Hover', 'wp-presenter-pro' ),
							} ] }
						>
						</PanelColorSettings>
						<PanelColorSettings
							title={ __( 'Text Color', 'wp-presenter-pro' ) }
							initialOpen={ true }
							colorSettings={ [ {
								value: textColorButtonTwo,
								onChange: ( value ) => {
									setAttributes( { textColorButtonTwo: value});
								},
								label: __( 'Text Color', 'wp-presenter-pro' ),
							} ] }
						>
						</PanelColorSettings>
						<PanelColorSettings
							title={ __( 'Text Color on Hover', 'wp-presenter-pro' ) }
							initialOpen={ true }
							colorSettings={ [ {
								value: textColorHoverButtonTwo,
								onChange: ( value ) => {
									setAttributes( { textColorHoverButtonTwo: value});
								},
								label: __( 'Text Color on Hover', 'wp-presenter-pro' ),
							} ] }
						>
						</PanelColorSettings>
						<PanelColorSettings
							title={ __( 'Border Color', 'wp-presenter-pro' ) }
							initialOpen={ true }
							colorSettings={ [ {
								value: borderColorButtonTwo,
								onChange: ( value ) => {
									setAttributes( { borderColorButtonTwo: value});
								},
								label: __( 'Border Color', 'wp-presenter-pro' ),
							} ] }
						>
						</PanelColorSettings>
						<TextControl
							label={__( 'Button Class Name', 'wp-presenter-pro' )}
							value={btnClassNameButtonTwo}
							onChange={ ( value ) => setAttributes( { btnClassNameButtonTwo: value } ) }
						/>
					</PanelBody>
					<PanelBody title={__( 'Button Settings', 'wp-presenter-pro' )}>
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
					</PanelBody>
				</InspectorControls>
				<Fragment>
					<div className="wp-presenter-pro-dual-buttons">
						<div className="button-one" style={slideStyles}>
							{contentButtonOne}
						</div>
						<div className="button-two" style={slideStylesTwo}>
							{contentButtonTwo}
						</div>
					</div>
				</Fragment>
			</Fragment>
		);
	}
}
export default WP_Presenter_Pro_Dual_Button;