/* 
Installation instructions:
ddev npm install
ddev npm install -g gulp
ddev npm run gulp sass 
*/

const gulp = require('gulp');
const browserSync = require('browser-sync');
const sass = require('gulp-sass')(require('node-sass'));
const sourceMaps = require('gulp-sourcemaps');

gulp.task('sass', () => {
    return gulp.src('web/**/*.scss')
        .pipe(sourceMaps.init())
        .pipe(sass({
            outputStyle: 'compressed'
        }).on('error', sass.logError))
        .pipe(sourceMaps.write('/'))
        .pipe(gulp.dest('web'));
});
gulp.task('sass-watcher', gulp.series('sass', browserSync.reload));

gulp.task('serve', gulp.series(
    'sass',
    () => {
        browserSync.init({
            port: 443,
            proxy: "localhost:8080"
        });

        gulp.watch('templates/**/*').on('change', browserSync.reload);
        gulp.watch('web/**/*.scss').on('change', gulp.series('sass-watcher'));
        gulp.watch('web/js/**/*').on('change', browserSync.reload);
    }));
