var gulp = require('gulp');
    postcss = require('gulp-postcss');

gulp.task('css', function () {
    var processors = [
        require('postcss-import'),
        require('postcss-nested'),
        require('postcss-mixins'),
        require('postcss-simple-vars'),
        require('postcss-media-minmax'),
        require('autoprefixer')({ browsers: ['last 2 versions', '> 2%'] })
    ];
    return gulp.src('./src/resources/assets/postcss/styles.css')
        .pipe(postcss(processors))
        .pipe(gulp.dest('./public/css'));
});
