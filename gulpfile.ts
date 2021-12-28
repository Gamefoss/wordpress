'use strict'
import {series, src, dest, task, parallel} from 'gulp';

const jade = require('gulp-jade-php');

const sass  = require('gulp-dart-sass');
const assetFunctions = require('@localnerve/sass-asset-functions');
const postcss = require('gulp-postcss');
const autoprefixer = require('autoprefixer');

const ts = require('gulp-typescript');
const tsProject = ts.createProject('tsconfig.json');

const uglify = require('gulp-uglify');
const rename = require('gulp-rename');

const babel = require('gulp-babel');

const concat = require('gulp-concat');


const DEST_PATH = `./wp-content/themes/gamefoss/`;

task('theme', () => {
	return src(['./src/theme/*','./src/theme/**/*'])
		.pipe(dest(DEST_PATH));
});

task('jade', () => {
	return src(['./src/jade/**/*.jade', '!./src/jade/**/_*.jade'])
		.pipe(jade({
			locals: {
				'echo': (str: string) => `<?php echo ${str} ?>`,
				'image': (path: string) => `<?php echo get_template_directory_uri() ?>/library/images/${path}`,
				'background': (path: string, fromWP: boolean) => (fromWP)? `background-image:url('<?php echo ${path} ?>')` : `background-image:url('<?php echo get_template_directory_uri() . "/library/images/${path}" ?>')`,
				'css': (path: string) => `<?php echo get_template_directory_uri() ?>/library/css/${path}`,
				'js': (path: string) => `<?php echo get_template_directory_uri() ?>/library/js/${path}`,
				'library': (path: string) => `<?php echo get_template_directory_uri() ?>/library/${path}`
			}
		}))
		.pipe(dest(DEST_PATH));
});

task('styles', () => {
	return src('src/scss/**/*.scss')
		.pipe(sass({
			quietDeps: true,
			imagePaths: ['../images/'],
			includePaths: ['node_modules'],
			functions: assetFunctions({
				images_path: "../images/",
				http_images_path: "../images/"
			})
		}))
		.pipe(postcss([
			autoprefixer()
		]))
		.pipe(dest(`${DEST_PATH}/library/css`))
});

task('images', () => {
	return src(['**/*.{png,jpg,gif,svg}'], {
		base: './src/images/'
	})
		.pipe(dest(`${DEST_PATH}/library/images/`))
});

task('scripts', () => {
	const tsResult = src('./src/scripts/**/*.ts')
		.pipe(tsProject())
		.on('error', () => {});
		return tsResult.js
			.pipe(rename({suffix: '.min'}))
			.pipe(dest(`${DEST_PATH}/library/js`))
});

task('babel', () => {
	return src(`${DEST_PATH}/library/js/**/*.js`)
		.pipe(babel({
			presets: ["@babel/preset-env"],
			plugins: [
				"@babel/plugin-transform-modules-commonjs"
			]
		}))
		.pipe(dest(`${DEST_PATH}/library/js`));
});

task('layout', () => {
	return src(`${DEST_PATH}/library/js/layout/*`)
		.pipe(concat('layout.min.js'))
		.pipe(dest(`${DEST_PATH}/library/js/layout`));
});

task('libs', () => {
	const libs = ['node_modules/owl.carousel/dist/owl.carousel.js'];
	return src(libs)
		.pipe(rename({suffix: '.min'}))
		.pipe(dest(`${DEST_PATH}/library/js/libs/`))
});

task('uglify', () => {
	return src(`${DEST_PATH}/library/js/**/*`)
		.pipe(uglify({
			mangle: false,
			ie: true,
			toplevel: true
		}))
		.pipe(dest(`${DEST_PATH}/library/js`));
});

export default series('theme', parallel('jade', 'styles', 'images', series('scripts', 'babel', 'layout', 'libs', 'uglify')));
