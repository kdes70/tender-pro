var gulp = require('gulp'),
    sass = require('gulp-sass'),
    autoprefixer = require('gulp-autoprefixer'),
    minifycss = require('gulp-minify-css'),
    rename = require('gulp-rename'),
    livereload = require('gulp-livereload');


gulp.task('styles', function () {
    gulp.src('webdev/sass/*.sass')
        .pipe(sass({
            includePaths: require('node-bourbon').includePaths
        }).on('error', sass.logError))
        .pipe(rename({suffix: '.min', prefix : '_'}))
        .pipe(autoprefixer({
            browsers: ['last 15 versions'],
            cascade: false
        }))
        .pipe(minifycss())
        .pipe(gulp.dest('web/css'))
        .pipe(livereload());
});


gulp.task('watch', function() {
    livereload.listen();
    gulp.watch('webdev/sass/*.sass', ['styles']);
});

gulp.task('default', ['styles', 'watch'], function() {
    // place code for your default task here
});