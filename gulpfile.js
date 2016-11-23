var gulp = require('gulp');
var webpack = require('gulp-webpack');
var del = require('del');

gulp.task('clean', (cb) => {
    return del(["public/poly"], cb);
});

gulp.task('compile', () => {
    return gulp.src('resources/assets/typescript/main.ts')
        .pipe(webpack({
            output: {
                filename: 'main.js'
            },
            resolve: {
                extensions: ['', '.webpack.js', '.web.js', '.ts', '.js']
            },
            module: {
                loaders: [
                    { test: /\.ts$/, loader: 'ts-loader'}
                ]
            }
        }))
        .pipe(gulp.dest('public/js'));
});

gulp.task("libs", () => {
    return gulp.src([
            'core-js/client/shim.min.js',
            'systemjs/dist/system-polyfills.js',
            'systemjs/dist/system.src.js',
            'reflect-metadata/Reflect.js',
            'rxjs/**',
            'zone.js/dist/**',
            '@angular/**'
        ], {cwd: "node_modules/**"}) /* Glob required here. */
        .pipe(gulp.dest("public/poly"));
});

gulp.task("build", ['clean', 'compile', 'libs'], () => {
    console.log("Building the project ...");
});
