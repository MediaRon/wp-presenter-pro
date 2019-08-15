const gulp = require( 'gulp' );
const del = require( 'del' );
const run = require( 'gulp-run' );
const zip = require( 'gulp-zip' );

gulp.task( 'bundle', function() {
	return gulp.src( [
		'**/*',
		'!bin/**/*',
		'!node_modules/**/*',
		'!vendor/**/*',
		'!composer.*',
		'!release/**/*',
		'!src/**/*',
		'!src',
		'!tests/**/*',
		'!phpcs.xml'
	] )
		.pipe( gulp.dest( 'release/wp-presenter-pro' ) );
} );

gulp.task( 'remove:bundle', function() {
	return del( [
		'release/wp-presenter-pro',
	] );
} );

gulp.task( 'wporg:prepare', function() {
	return run( 'mkdir -p release' ).exec();
} );

gulp.task( 'release:copy-for-zip', function() {
	return gulp.src('release/wp-presenter-pro/**')
		.pipe(gulp.dest('wp-presenter-pro'));
} );

gulp.task( 'release:zip', function() {
	return gulp.src('wp-presenter-pro/**/*', { base: "." })
	.pipe(zip('wp-presenter-pro.zip'))
	.pipe(gulp.dest('.'));
} );

gulp.task( 'cleanup', function() {
	return del( [
		'release',
		'wp-presenter-pro'
	] );
} );

gulp.task( 'clean:bundle', function() {
	return del( [
		'release/wp-presenter-pro/bin',
		'release/wp-presenter-pro/node_modules',
		'release/wp-presenter-pro/vendor',
		'release/wp-presenter-pro/tests',
		'release/wp-presenter-pro/trunk',
		'release/wp-presenter-pro/gulpfile.js',
		'release/wp-presenter-pro/Makefile',
		'release/wp-presenter-pro/package*.json',
		'release/wp-presenter-pro/phpunit.xml.dist',
		'release/wp-presenter-pro/README.md',
		'release/wp-presenter-pro/CHANGELOG.md',
		'release/wp-presenter-pro/webpack.config.js',
		'release/wp-presenter-pro/.editorconfig',
		'release/wp-presenter-pro/.eslistignore',
		'release/wp-presenter-pro/.eslistrcjson',
		'release/wp-presenter-pro/.git',
		'release/wp-presenter-pro/.gitignore',
		'release/wp-presenter-pro/src/block',
		'package/prepare',
	] );
} );

gulp.task( 'default', gulp.series(
	'remove:bundle',
	'bundle',
	'wporg:prepare',
	'clean:bundle',
	'release:copy-for-zip',
	'release:zip',
	'cleanup'
) );
