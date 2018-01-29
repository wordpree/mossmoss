
var gulp       = require('gulp'),
    gUtil      = require('gulp-util'),
    gIf        = require('gulp-if'),
    Sourcempas =require('gulp-sourcemaps'),
    gulpSass   = require('gulp-compass'),
    gulpJslint   = require('gulp-jslint'),
    gulpUglify = require('gulp-uglify'),
    gulpCat    = require('gulp-concat'),
    gulpRename = require('gulp-rename'),
    livereload = require('gulp-livereload'),
    styleMode,flag,dir;

 flag = process.env.NODE_ENV
 if (flag =='development'){
    styleMode = 'expanded';
    dir       = 'development';
 }else{
    styleMode = 'compressed';
    dir       = 'production';
 }
gulp.task('sass',function(){
	return gulp.src('source/scss/style.scss')
	       .pipe(gulpSass({
	       	 sass: 'source/scss',
	       	 css:  'build/' + dir + '/css',
	       	 style: styleMode,
	       	 sourcemap: 'true'
	       }))
	       .pipe(gulp.dest('build/' + dir + '/css'))
	       .pipe(livereload());
	       
});

gulp.task('jsLint',function(){
	return gulp.src('source/js/**.js')
	    .pipe(gulpJslint())
	    .pipe(gulpJslint.reporter('default'));
});

gulp.task('js',function(){
	return gulp.src('source/js/**.js')
	   .pipe(Sourcempas.init())
	   .pipe(gulpCat('main.js',{newline:'\r\n'}))
	   .pipe(gIf(flag == 'production',gulpUglify()))
	   .pipe(gIf(flag == 'production',gulpRename({suffix:'.min'})))
	   .pipe(Sourcempas.write())
	   .pipe(gulp.dest('build/' +dir+ '/js'))
	   .pipe(livereload());
});

gulp.task('watch',function(){
	 livereload.listen();
	 gulp.watch(['source/scss/**.scss'],['sass']);
	 gulp.watch(['source/js/**.js'],['jsLint','js']);
});
gulp.task('default',['jsLint','js','sass','watch']);

