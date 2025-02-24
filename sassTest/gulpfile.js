var gulp = require ( 'gulp' ) , sass = require ( 'gulp-sass' );
gulp.task ( 'sass' , function () {
    return gulp.src ( 'sass/**/*.{sass,scss}' ).pipe ( sass ( { outputStyle : 'expanded' } ).on ( 'error' , sass.logError ) ).pipe ( gulp.dest ( 'css' ) )
} );
gulp.task ( 'watch' , function () {
    gulp.watch ( 'sass/**/*.{sass,scss}' , gulp.parallel ( 'sass' ) );
} );
gulp.task ( 'default' , gulp.parallel ( 'watch' ) )﻿