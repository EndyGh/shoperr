var gulp = require('gulp');
var sass = require('gulp-sass');
var ts = require('gulp-typescript');
var browserSync = require('browser-sync').create();
var proxyPath = 'http://shop.loc/';

//Connect task
gulp.task('connect',['styles'], function() {

    browserSync.init({
        proxy:proxyPath,
        open: true
    });

    gulp.watch('resources/assets/common/**/*.scss',['styles']);
    gulp.watch("public/*.html").on('change', browserSync.reload);
});

//Styles task
gulp.task('styles', function() {
    gulp.src('resources/assets/common/**/*.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(sass({ noCache: true }))
        .pipe(gulp.dest('public/css/build'))
        .pipe(browserSync.stream());
});

gulp.task('js', function () {
    return gulp.src('resources/assets/typescript/**/*.ts')
        .pipe(ts({
            noImplicitAny: true,
            out: 'output.js'
        }))
        .pipe(gulp.dest('public/js/build'))
});


//Watch task
//gulp.task('watch', function () {
  //  gulp.watch('resources/assets/common/**/*.scss',['styles']);
    //gulp.watch("public/*.html").on('change', browserSync.reload);
//});


//Default task
gulp.task('default',['connect']);
