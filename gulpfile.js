const gulp = require('gulp');

// CSS
const sass = require('gulp-sass');
const postcss = require('gulp-postcss');
const autoprefixer = require('autoprefixer');
const mqpacker = require('css-mquery-packer');
const cssnano = require('cssnano');

// JS
const babel = require('gulp-babel');
const uglify = require('gulp-uglify-es').default;
const rename = require('gulp-rename');

//Gzip
//const gzip = require('gulp-gzip');

// CSS
gulp.task('scss', function() {
    const postmetal = [
        mqpacker(),
        autoprefixer({
            cascade: false,
            grid: true
        }),
        cssnano()
    ];
    return gulp.src(['asset/scss/*.scss', '!asset/scss/**/_*.scss'])
        .pipe(sass())
        .pipe(postcss(postmetal))
        .pipe(gulp.dest('asset/css/'))
        //.pipe(gzip())
        .pipe(gulp.dest('asset/css/'));
});

// JS
gulp.task('js', function() {
    return gulp.src(['asset/js/src/*.js'])
        .pipe(babel({
            presets: ['@babel/preset-env']
        }))
        .pipe(uglify())
        .pipe(rename({
            extname: '.min.js'
        }))
        .pipe(gulp.dest('asset/js/'))
        //.pipe(gzip())
        .pipe(gulp.dest('asset/js/'));
});

gulp.task('watch', function(){
    gulp.watch(['asset/scss/**/*.scss'], gulp.parallel('scss'));
    gulp.watch(['asset/js/src/*.js'], gulp.parallel('js'));
});

gulp.task('default', gulp.parallel('scss', 'js', 'watch'));
