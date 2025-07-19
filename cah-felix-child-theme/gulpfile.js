var gulp = require('gulp');
var sass = require('gulp-sass');
var rename = require('gulp-rename');
var imagemin = require('gulp-imagemin');
var pngquant = require('imagemin-pngquant');  
var concat = require('gulp-concat');
var rename = require('gulp-rename');
var uglify = require('gulp-uglify');

var scssFiles = './src/scss/*.scss';
// var jsFiles = './src/js/**/*.js';
var jsFiles = './src/js/*.js';
var jsDest = './src/js';
var cssDest = './src/css';
var imagesFiles = './src/images';


gulp.task('scripts', function() {
  return gulp.src(jsFiles)
      .pipe(concat('scripts.js'))
      .pipe(gulp.dest(jsDest))
      .pipe(rename('scripts.min.js'))
      .pipe(uglify())
      .pipe(gulp.dest(jsDest));
});

// Options for development
var sassDevOptions = {
  outputStyle: 'expanded'
}

// Options for production
var sassProdOptions = {
  outputStyle: 'compressed'
}

// Task 'sassdev' - Run with command 'gulp sassdev'
gulp.task('sassdev', function() {
  return gulp.src(scssFiles)
    .pipe(sass(sassDevOptions).on('error', sass.logError))
    .pipe(gulp.dest(cssDest));
});

// Task 'sassprod' - Run with command 'gulp sassprod'
gulp.task('sassprod', function() {
  return gulp.src(scssFiles)
    .pipe(sass(sassProdOptions).on('error', sass.logError))
    // .pipe(rename('app.min.css'))
    .pipe(rename({suffix: '.min'}))
    .pipe(gulp.dest(cssDest));
});


gulp.task('imagesmin', function () {
	gulp.src('app/images/*')
	.pipe(imagemin({
		progressive: true,
		svgoPlugins: [{removeViewBox: false}],
		use: [pngquant()]
	}))
	.pipe(gulp.dest('app/images'));
});


// Task 'watch' - Run with command 'gulp watch'
gulp.task('watch', function() {
  gulp.watch(scssFiles, ['sassdev', 'sassprod', 'imagesmin']);
});

// Default task - Run with command 'gulp'
gulp.task('default', ['sassdev', 'sassprod', 'imagesmin', 'watch']);