
/*
* project configuration :setting parth requirements 
*/
var name        = 'storefront-child';
var projectRoot = '../' + name + '/';

var path ={
	src      : projectRoot + 'assets/**/source/',
	styleSrc : projectRoot + 'assets/sass/source/',
    jsSrc    : projectRoot + 'assets/js/source/',

    dev      : projectRoot + 'assets/**/development/',
	styleDev : projectRoot + 'assets/sass/development/',
    jsDev    : projectRoot + 'assets/js/development/',

    dist      : projectRoot + 'assets/**/production/',
	styleDist : projectRoot + 'assets/sass/production/',
    jsDist    : projectRoot + 'assets/js/production/',

    css  : projectRoot + 'assets/sass/',
    js   : projectRoot + 'assets/js/'
};

/*environment variable*/
var dir = (process.env.NODE_ENV=='development') ? 'development' : 'production';

/* loading plugins */
var gulp            = require('gulp'),
    gulpIf          = require('gulp-if'),
    gUtil           = require('gulp-util'),
    gulpNotify      = require('gulp-notify'),
    sourcemaps      = require('gulp-sourcemaps'),
    gulpSass        = require('gulp-sass'),
    gulpCleanCss    = require('gulp-clean-css'),
    gulpJshint      = require('gulp-jshint'),
    gulpUglify      = require('gulp-uglify'),
    gulpCat         = require('gulp-concat'),
    gulpPrefix      = require('autoprefixer'),
    gulpPcss        = require('gulp-postcss'),
    gulpDel         = require('del'),
    gulpBrowserSync = require('browser-sync').create(),
    gulpRunSeq      = require('run-sequence'),
    gulpRename      = require('gulp-rename');
    
/*
* gulp tasks: 
*/

gulp.task('browser-sync',function(){
      gulpBrowserSync.init({
      	proxy:"localhost:8888"
      });
});

gulp.task('sass:dev',function(){
	return gulp.src(path.styleSrc + 'style.scss')
	       .pipe(sourcemaps.init())
	       .pipe(gulpSass({
	       	outputStyle: 'expanded'
	       }).on('error',gulpSass.logError))
	       .pipe(gulpPcss([gulpPrefix('last 2 versions','> 2%')]))
	       .pipe(sourcemaps.write('./maps'))
	       .pipe(gulp.dest(path.styleDev))
	       .pipe(gulpBrowserSync.stream());
});

gulp.task('jshint:dev',function(){
	return gulp.src(path.jsSrc +'**.js')
	    .pipe(gulpJshint())
	    .pipe(gulpJshint.reporter('jshint-stylish',{ verbose: true }))
	    .pipe(gulpJshint.reporter('fail'));
});

gulp.task('js:dev',function(){
	return gulp.src(path.jsSrc +'**.js')
	   .pipe(gulp.dest(path.jsDev))
	   .pipe(gulpBrowserSync.stream());;
});

gulp.task('dev',gulpRunSeq('sass:dev','jshint:dev','js:dev'));

/*dev pipe into production/release version*/
gulp.task('css:dist',function(){
	return gulp.src(path.styleDev + '**.css')
	    .pipe(gulpCleanCss())
	    .pipe(gulpRename({suffix:'.min'}))
	    .pipe(gulp.dest(path.styleDist));
});

gulp.task('js:dist',function(){
	return gulp.src(path.jsDev + '**.js')
	    .pipe(gulpUglify())
	    .pipe(gulpRename({suffix:'.min'}))
	    .pipe(gulp.dest(path.jsDist));
});

gulp.task('dist',['css:dist','js:dist']);

/*copy assets to reference directory depending on either development or production environment */
gulp.task('build:css',['css:dist'],function(){
	return gulp.src(path.css + dir + '/**.css')
	    .pipe(gulp.dest(path.css));
});

gulp.task('build:js',['js:dist'],function(){
	return gulp.src(path.js + dir + '/**.js')
	    .pipe(gulp.dest(path.js));
});


gulp.task('build',['build:css','build:js']);

/*delete unwanted folders*/
gulp.task('delete',function(){
	return gulpDel.sync([path.src,path.dev,path.dist],{force:true});
});

gulp.task('watch',['browser-sync'],function(){
    gulp.watch(path.styleSrc + '*.scss',gulpRunSeq('sass:dev','build:css'));
    gulp.watch(path.jsSrc + '*.js',gulpRunSeq('jshint:dev','js:dev','build:js'));
});

gulp.task('default',gulpRunSeq('dev','dist','build','watch'));