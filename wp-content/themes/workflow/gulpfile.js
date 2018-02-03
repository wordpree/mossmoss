
/*
* project configuration :setting parth requirements 
*/
var name        = 'storefront-child';
var projectRoot = '../' + name + '/';

var path ={
	style: [projectRoot + 'assets/sass/*.*',projectRoot + 'sources/sass/',projectRoot + 'assets/sass/'],
	js:    [projectRoot + 'assets/js/*.*',projectRoot + 'sources/js/',projectRoot + 'assets/js/']
};

/*environment variable*/
var flag = (process.env.NODE_ENV=='development') ? 'development' : 'production';

/* loading plugins */
var gulp            = require('gulp'),
    gulpDel         = require('del'),
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

gulp.task('sass',function(){
	return gulp.src(path.style[1] + 'style.scss')
	       .pipe(sourcemaps.init())
	       .pipe(gulpSass({
	       	outputStyle: 'expanded'
	       }).on('error',gulpSass.logError))
	       .pipe(gulpPcss([gulpPrefix('last 2 versions','> 2%')]))
	       .pipe(gulpIf(flag === 'production',gulpCleanCss()))
	       .pipe(gulpIf(flag === 'production',gulpRename({suffix:'.min'})))
	       .pipe(sourcemaps.write('./maps'))
	       .pipe(gulp.dest(path.style[2]))
	       .pipe(gulpBrowserSync.stream());
});

gulp.task('js',function(){
	return gulp.src(path.js[1]+'*.js')
	       .pipe(sourcemaps.init())
	       .pipe(gulpJshint())
	       .pipe(gulpJshint.reporter('jshint-stylish',{ verbose: true }))
	       .pipe(gulpJshint.reporter('fail'))
	       .pipe(gulpIf(flag === 'production',gulpUglify()))
	       .pipe(gulpIf(flag === 'production',gulpRename({suffix:'.min'})))
	       .pipe(sourcemaps.write('./maps'))
	       .pipe(gulp.dest(path.js[2]))
	       .pipe(gulpBrowserSync.stream());
});


gulp.task('clear',function(){
	return gulpDel.sync([path.style[0],path.style[2]+'maps',path.js[0],path.js[2]+'maps'],{force:true});
});

gulp.task('watch',['browser-sync'],function(){
    gulp.watch(path.style[0] ,['sass']);
    gulp.watch(path.js[0]    ,['js']);
});

/*gulp.task('set-prod',function(){
	return process.env.NODE_ENV='production';
});

gulp.task('set-dev',function(){
	return process.env.NODE_ENV='development';
});

gulp.task('dev',['set-dev','default']);

gulp.task('prod',['set-prod','default']);*/

gulp.task('default',['clear','sass','js','watch']);
