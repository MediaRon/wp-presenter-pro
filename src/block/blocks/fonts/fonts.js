const { __, _x } = wp.i18n;
let wpPresenterProFonts = [];
const presenterFonts = Object.entries(wp_presenter_pro.fonts);
for (const key of presenterFonts) {
	wpPresenterProFonts.push( {
		value: key[0],
		label: key[1],
	} );
}
export default wpPresenterProFonts;