var gulp			= require('gulp'),
	plumber			= require('gulp-plumber'),
	rename			= require('gulp-rename'),
	runSequence 	= require('run-sequence');
	args			= require('yargs').argv,
	gulpif			= require('gulp-if'),
	notify			= require('gulp-notify'),
	concat			= require('gulp-concat'),

	jade			= require('gulp-jade-php'),

	coffee			= require('gulp-coffee'),
	uglify			= require('gulp-uglify-es').default,

	imagemin		= require('gulp-imagemin'),

	sass			= require('gulp-sass'),
	compass			= require('compass-importer'),
	assetFunctions	= require('node-sass-asset-functions'),
	autoprefixer	= require('gulp-autoprefixer'),
	sourcemaps		= require('gulp-sourcemaps'),

	isRelease = args.release || false;

	sass.compile	= require('node-sass');

// JADE
gulp.task('jade', function buildHTML() {
	return gulp.src(['../assets/jade/**/*.jade', '!../assets/jade/**/_*.jade'])
		.pipe(plumber({
			errorHandler: notify.onError("Error: <%= error.message %>")
		}))
		.pipe(jade({
			'pretty': (!isRelease) ? true : false,
			'locals': {
				'echo': function(str) {
					return "<?php echo " + str + " ?>"
				},
				'image': function(src) {
					return ("<?php echo get_template_directory_uri() ?>/library/images/" + src);
				},
				'background': function(src, fromWP) {
					var url = "/library/images/";
					url += src;
					if (fromWP) {
						return ("background-image:url('<?php echo " + src + "?>')");
					} else {
						return ("background-image:url('<?php echo get_template_directory_uri() . \"" + url + "\" ?>')");
					}
				},
				'css': function(value) {
					return ("<?php echo get_template_directory_uri() ?>/library/css/" + value);
				},
				'js': function(value) {
					return ("<?php echo get_template_directory_uri() ?>/library/js/" + value);
				},
				'library': function(src) {
					return ("<?php echo get_template_directory_uri() ?>/library/" + src);
				}
			}
		}))
		.pipe(plumber.stop())
		.pipe(gulp.dest("../"))
});

// IMAGES
gulp.task('images', function(){
	if (!isRelease) {
		console.warn("WARNING: running whitout --release, skipping image minification");
	}
	return gulp.src('../assets/images/**/*')
		.pipe((plumber({
			errorHandler: notify.onError("Error: <%= error.message %>")
		})))
		.pipe(imagemin({ optimizationLevel: 3, progressive: true, interlaced: true }))
		.pipe(plumber.stop())
		.pipe(gulp.dest('../library/images/'));
});

// STYLES
gulp.task('styles', function(){
	gulp.src(['../assets/sass/**/*.scss'])
	.pipe(plumber({
		errorHandler: function (error) {
			console.log(error.message);
			this.emit('end');
	}}))
	.pipe(gulpif(!isRelease, sourcemaps.init()))
	.pipe(sass({
		importer	: compass,
		outputStyle : isRelease? "compressed" : "nested",
		functions	: assetFunctions({
			images_path			: "../images/",
			http_images_path	: "../images/",
			fonts_path			: "../fonts/",
			http_fonts_path		: "../fonts/"
		  }
		)
	}))
	.pipe(gulpif(!isRelease, sourcemaps.write('./')))
	.pipe(plumber.stop())
	.pipe(gulp.dest('../library/css/'))
});

gulp.task('autoprefixer', function () {
	gulp.src(['../library/css/**/*.css'])
	.pipe(autoprefixer({
		browsers : ['last 2 versions']
	}))
	.pipe(gulp.dest('../library/css/'));
});

gulp.task('coffee', function(){
	return gulp.src(['../assets/coffee/**/*.coffee', '!../assets/coffee/libs/**/*.coffee', '!../assets/coffee/layout/**/*.coffee'])
		.pipe(plumber({
			errorHandler: function (error) {
				console.log(error.message);
				this.emit('end');
		}}))
		.pipe(coffee({bare: true}))
		.pipe(rename({suffix: '.min'}))
		.pipe(gulpif(isRelease, uglify()))
		.pipe(plumber.stop())
		.pipe(gulp.dest('../library/js/'))
});

gulp.task('coffee-libs', function(){
	return gulp.src(['../assets/coffee/libs/**/*.coffee'])
		.pipe(plumber({
			errorHandler: function (error) {
				console.log(error.message);
				this.emit('end');
		}}))
		.pipe(coffee({bare: true}))
		.pipe(rename({suffix: '.min'}))
		.pipe(gulpif(isRelease, uglify()))
		.pipe(plumber.stop())
		.pipe(gulp.dest('../library/js/libs/'))
});

gulp.task('coffee-layout', function(){
	return gulp.src(['../assets/coffee/layout/**/*.coffee'])
		.pipe(plumber({
			errorHandler: function (error) {
				console.log(error.message);
				this.emit('end');
		}}))
		.pipe(coffee({bare: true}))
		.pipe(concat('layout.js'))
		.pipe(rename({suffix: '.min'}))
		.pipe(gulpif(isRelease, uglify()))
		.pipe(plumber.stop())
		.pipe(gulp.dest('../library/js/layout/'))
});

gulp.task('libs', function () {
	return gulp.src('../assets/js/**/*')
		.pipe(plumber({
			errorHandler: function (error) {
				console.log(error.message);
				this.emit('end');
		}}))
		.pipe(gulpif(isRelease, uglify()))
		.pipe(rename({suffix: '.min'}))
		.pipe(plumber.stop())
		.pipe(gulp.dest('../library/js/libs/'))
});

gulp.task('fonts', function () {
	return gulp.src('../assets/fonts/**/*')
		.pipe(gulp.dest('../library/fonts/'))
});


gulp.task('build', function(){
	runSequence(['jade','libs', 'coffee-libs', 'coffee-layout', 'coffee', 'styles', 'fonts', 'images'], 'autoprefixer');
});

gulp.task('default', ['build']);

gulp.task('watch', function() {
	runSequence(['build']);
	gulp.watch("../assets/jade/**/*.jade", ['jade']);
	gulp.watch("../assets/sass/**/*.scss", ['styles']);
	gulp.watch("../assets/js/**/*.js", ['libs']);
	gulp.watch(["../assets/coffee/**/*.coffee", "!../assets/coffee/libs/**/*.coffee"], ['coffee']);
	gulp.watch("../assets/coffee/libs/**/*.coffee", ['coffee-libs']);
	gulp.watch("../assets/coffee/layout/**/*.coffee", ['coffee-layout']);
	gulp.watch("../assets/fonts/**/*", ['fonts']);
	gulp.watch("../assets/images/**/*", ['images']);
});
