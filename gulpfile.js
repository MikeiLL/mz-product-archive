'use strict';

// Require packages
var gulp       = require('gulp');
var sass       = require('gulp-sass');
var concat     = require('gulp-concat');
var gutil      = require('gulp-util');
var uglify     = require('gulp-uglify');
var sourcemaps = require('gulp-sourcemaps');
var imagemin     = require('gulp-imagemin');


// Define the default task that's run on `gulp`
gulp.task('default', ['styles','scripts', 'images']);

// Concatenate all SCSS files in scss, generate sourcemaps, minify it and output to assets/css/app.min.css
gulp.task('styles', function() {
  return gulp.src('assets/css/**/*.scss')
    .pipe(sourcemaps.init())
    .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
    .pipe(sourcemaps.write())
    .pipe(gulp.dest('dist/css'));
});

// Concatenate all Javascript files in js, generate sourcemaps, minify it and output to assets/js/app.min.js
gulp.task('scripts', function() {
  return gulp.src('assets/js/**/*.js')
    .pipe(sourcemaps.init())
    // Only uglify if gulp is ran with '--type production'
    .pipe(gutil.env.type === 'production' ? uglify() : gutil.noop())
    .pipe(sourcemaps.write())
    .pipe(gulp.dest('dist/js'));
});

// ### Images
// `gulp images` - Run lossless compression on all the images.
gulp.task('images', function() {
  return gulp.src('assets/images/*')
    .pipe(imagemin([
      imagemin.jpegtran({progressive: true}),
      imagemin.gifsicle({interlaced: true}),
      imagemin.svgo({plugins: [
        {removeUnknownsAndDefaults: false},
        {cleanupIDs: false}
      ]})
    ]))
    .pipe(gulp.dest('dist/images'));
});