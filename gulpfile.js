
var gulp = require( 'gulp' ),
	eslint = require( 'gulp-eslint' ),
	less = require( 'gulp-less' ),
	concat = require( 'gulp-concat' ),
	minify = require( 'gulp-clean-css' ),
	image = require( 'gulp-image' ),
	uglify = require( 'gulp-uglify' ),
	del = require( 'del' );

// clean
gulp.task( 'clean', function () {
	del( [
		'src/www/css/*',
		'src/www/fonts/*',
		'src/www/images/*',
		'src/www/js/*'
	] ).then( function ( paths ) {
		console.log( 'Removed:\n', paths.join( '\n' ) );
	} );
} );

// lint javascript
gulp.task( 'lint', function () {
	return gulp.src( [ 'assets/scripts/**/*.js' ] )
		.pipe( eslint() )
		.pipe( eslint.format() )
		.pipe( eslint.failAfterError() );
} );

// styles
gulp.task( 'styles', function () {
	return gulp.src(
		[
			'bower_components/bootstrap/dist/css/bootstrap.css',
			'bower_components/bootstrap/dist/css/bootstrap-theme.css',
			'assets/styles/**/*.less',
			'assets/styles/**/*.css'
		] )
		.pipe( less() )
		.pipe( concat( 'main.css' ) )
		.pipe( minify() )
		.pipe( gulp.dest( 'src/www/css' ) );
} );

// fonts
gulp.task( 'fonts', function () {
	gulp.src( [
		'bower_components/bootstrap/fonts/*'
	] )
		.pipe( gulp.dest( 'src/www/fonts' ) );
} );

// images
gulp.task( 'images', function () {
	return gulp.src( 'assets/images/*' )
		.pipe( image( {
			pngquant: true,
			optipng: true,
			zopflipng: true,
			advpng: true
		} ) )
		.pipe( gulp.dest( 'src/www/images' ) );
} );

// main scripts
gulp.task( 'scripts:main', function () {
	gulp.src( [
		'bower_components/jquery/dist/jquery.js',
		'bower_components/bootstrap/dist/js/bootstrap.js',
		'bower_components/geocomplete/jquery.geocomplete.js',
		'assets/scripts/*.js',
		'assets/scripts/nette/*'
	] )
		.pipe( concat( 'main.js' ) )
		.pipe( uglify() )
		.pipe( gulp.dest( 'src/www/js' ) );
} );

// special scripts
gulp.task( 'scripts:special', function () {
	gulp.src( [
		'assets/scripts/special/*'
	] )
		.pipe( concat( 'special.js' ) )
		.pipe( gulp.dest( 'src/www/js' ) );
} );

// default
gulp.task( 'default', [ 'clean', 'lint', 'styles', 'fonts', 'images',
	'scripts:main', 'scripts:special' ] );

// only main javascripts
gulp.task( 'scr', [ 'lint', 'scripts:main' ] );
