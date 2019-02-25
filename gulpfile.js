var gulp = require('gulp');

// CSS
var sass = require('gulp-sass');
var postcss = require('gulp-postcss');
var autoprefixer = require('autoprefixer');
var mqpacker = require('css-mqpacker');
var cssnano = require('cssnano');

// JS
var uglify = require('gulp-uglify');
var rename = require('gulp-rename');

// CSS
gulp.task('scss', function() {
    var postmetal = [
        autoprefixer({
            browsers: [
                '> 0.5%',
                'not dead'
            ],
            cascade: false,
            grid: 'autoplace'
        }),
        mqpacker(),
        cssnano()
    ];
    return gulp.src(['asset/scss/*.scss', '!asset/scss/**/_*.scss'])
        .pipe(sass())
        .pipe(postcss(postmetal))
        .pipe(gulp.dest('asset/css/'));
});

// JS
gulp.task('js', function() {
    return gulp.src(['asset/js/src/*.js'])
        .pipe(uglify())
        .pipe(rename({
            extname: '.min.js'
        }))
        .pipe(gulp.dest('asset/js/'));
});

gulp.task('watch', function(){
    gulp.watch(['asset/scss/**/*.scss'], gulp.parallel('scss'));
    gulp.watch(['asset/js/src/*.js'], gulp.parallel('js'));
});

gulp.task('default', gulp.parallel('scss', 'js', 'watch'));