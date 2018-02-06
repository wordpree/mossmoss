

/*environment variable*/
var flag = (process.env.NODE_ENV=='development') ? 'development' : 'production';
var status = (flag === 'development') ? true :false;

/* loading plugins */
var gulp        = require('gulp'),
    del         = require('del'),
    dir         = require('path'),
    gIf         = require('gulp-if'),
    util        = require('gulp-util'),
    notify      = require('gulp-notify'),
    sourcemaps  = require('gulp-sourcemaps'),
    sass        = require('gulp-compass'),
    cleanCss    = require('gulp-clean-css'),
    jshint      = require('gulp-jshint'),
    uglify      = require('gulp-uglify'),
    concat      = require('gulp-concat'),
    prefix      = require('autoprefixer'),
    postcss     = require('gulp-postcss'),
    browserSync = require('browser-sync').create(),
    runSeq      = require('run-sequence'),
    rename      = require('gulp-rename');

/*
* setting parth requirements 
*/
var name        = 'storefront-child';
var projectRoot = dir.dirname(__dirname) + '/' + name + '/';
var path        = {
	                style: [projectRoot + 'assets/sass/*.*'  ,projectRoot + 'sources/sass/'  ,projectRoot + 'assets/sass/'  ],
	                js:    [projectRoot + 'assets/js/*.*'    ,projectRoot + 'sources/js/'    ,projectRoot + 'assets/js/'    ],
	                fonts: [projectRoot + 'assets/fonts/*.*' ,projectRoot + 'sources/fonts/' ,projectRoot + 'assets/fonts/' ],
	                img:   [projectRoot + 'assets/images/*.*',projectRoot + 'sources/images/',projectRoot + 'assets/images/']
                  };

/*
* gulp tasks: 
*/

gulp.task('browser-sync',function(){
      browserSync.init({
      	proxy:"localhost:8888"
      });
});

gulp.task('sass',function(){
	return gulp.src(path.style[1] + 'style.scss')
	       .pipe(sass({
	       	   project:projectRoot,
               sass:'sources/sass',
               css:'assets/sass',
	       	   style: 'expanded',
	       	   sourcemap:status
	       }).on('error',util.log))
	       .pipe(postcss([prefix('last 2 versions','> 2%')]))
	       .pipe(gIf(flag === 'production',cleanCss()))
	       .pipe(gIf(flag === 'production',rename({suffix:'.min'})))
	       .pipe(gulp.dest(path.style[2]))
	       .pipe(browserSync.stream());
});

gulp.task('js',function(){
	return gulp.src(path.js[1]+'*.js')
	       .pipe(sourcemaps.init())
	       .pipe(jshint())
	       .pipe(jshint.reporter('jshint-stylish',{ verbose: true }))
	       .pipe(jshint.reporter('fail'))
	       .pipe(gIf(flag === 'production',uglify()))
	       .pipe(gIf(flag === 'production',rename({suffix:'.min'})))
	       .pipe(sourcemaps.write('../maps'))
	       .pipe(gulp.dest(path.js[2]))
	       .pipe(browserSync.stream());
});

gulp.task('fonts',function(){
    return gulp.src(path.fonts[1]+ '*.*')
           .pipe(gulp.dest(path.fonts[2]))
           .pipe(browserSync.stream());
});

gulp.task('clear',function(){
	return del.sync([path.style[0],path.js[0],projectRoot + 'assets/maps'],{force:true});
});

gulp.task('watch',['browser-sync'],function(){
    gulp.watch(path.style[0],['sass']);
    gulp.watch(path.js[0]   ,['js']);
    gulp.watch(path.fonts[0],['fonts']);
});

gulp.task('default',['clear','fonts','sass','js','watch']);


/*gulp.task('set-prod',function(){
	return process.env.NODE_ENV='production';
});

gulp.task('set-dev',function(){
	return process.env.NODE_ENV='development';
});

gulp.task('dev',['set-dev','default']);

gulp.task('prod',['set-prod','default']);*/
