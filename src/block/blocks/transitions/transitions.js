const { __, _x } = wp.i18n;
const wpPresentationTransitions = [
	{ value: '', label: __('None', 'wp-presenter-pro') },
	{ value: 'up', label: __('Up', 'wp-presenter-pro') },
	{ value: 'down', label: __('Down', 'wp-presenter-pro') },
	{ value: 'left', label: __('Left', 'wp-presenter-pro') },
	{ value: 'right', label: __('Right', 'wp-presenter-pro') },
	{ value: 'grow', label: __('Grow', 'wp-presenter-pro') },
	{ value: 'shrink', label: __('Shrink', 'wp-presenter-pro') },
	{ value: 'fade-right', label: __('Fade Right', 'wp-presenter-pro') },
	{ value: 'fade-out', label: __('Fade Out', 'wp-presenter-pro') },
	{ value: 'fade-up', label: __('Fade Up', 'wp-presenter-pro') },
	{ value: 'fade-in-then-out', label: __('Fade In Then Out', 'wp-presenter-pro') },
	{ value: 'fade-in-then-semi-out', label: __('Fade In Then Semi Out', 'wp-presenter-pro') },
]
export default wpPresentationTransitions;