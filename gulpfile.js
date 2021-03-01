var gulp            = require('gulp');
var concat          = require('gulp-concat');
var sass            = require('gulp-sass');
var sourcemaps      = require('gulp-sourcemaps');
var autoprefixer    = require('gulp-autoprefixer');
var notify          = require("gulp-notify");

// CONFIGS

const scssPaths = [
  './src/sass/main.scss',
];
const scssDest = './dist';

const jsPaths = [
  './src/js/main.js',
  './src/js/vendor/*.js',
  './src/js/components/*.js',
  './src/js/templates/*.js',
];
const jsDest = './dist';

// CONFIGS END

var handleErrors = function() {
  var args = Array.prototype.slice.call(arguments);

  // Send error to notification center with gulp-notify
  notify.onError({
    title: "Compile Error",
    message: "<%= error.message %>"
  }).apply( this, args );

  // Keep gulp from hanging on this task
  this.emit('end');
};

// CSS compilation task
gulp.task('sass', function() {
  return gulp.src( scssPaths )
    .pipe( sourcemaps.init() )
    .pipe( sass( { outputStyle: 'compressed' } ) )
    .pipe( autoprefixer({
      overrideBrowserslist: ['last 6 versions'],
      cascade: false
    }) )
    .pipe( sourcemaps.write( '.', { includeContent: false, sourceRoot: './src/sass' } ) )
    .on  ( 'error', handleErrors )
    .pipe( gulp.dest( scssDest ) );
});

// Javascript compilation
gulp.task('javascript', function() {
  // ASnyc
  return gulp.src( jsPaths )
    .pipe( concat('main.js') )
    .on( 'error', handleErrors )
    .pipe( gulp.dest( jsDest ) );
});

gulp.task('build', gulp.parallel('sass', 'javascript'));

gulp.task('watch', (done) => {
  gulp.watch( './src/sass/**/*.scss', gulp.parallel('sass') );
  gulp.watch( './src/js/**/*.js', gulp.parallel('javascript') );

  global.isWatching = true;

  done();
});
