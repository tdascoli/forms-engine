"use strict";

// Load plugins
var del = require("del");
var gulp = require("gulp");
var concat = require('gulp-concat');
var rename = require('gulp-rename');
var minify = require('gulp-minify');

// Clean assets
function clean() {
  return del(["./dist/"]);
}

// achtung reihenfolge!
function compressElements(){
  return (
    gulp.src([
        'src/FormsEngineJS/questions/type.js',
        'src/FormsEngineJS/questions/element/element.js',
        'src/FormsEngineJS/questions/element/elementGroup.js',
        'src/FormsEngineJS/questions/element/input.js',
        'src/FormsEngineJS/questions/element/text.js',
        'src/FormsEngineJS/questions/element/*'])
      .pipe(concat('formsEngine.js'))
      .pipe(gulp.dest('dist'))
      .pipe(minify({
        ext:{
            min:'.min.js'
        },
        noSource: true
      }))
      .pipe(gulp.dest('dist'))
  );
}

function compressPagination(){
  return (
    gulp.src(['src/FormsEngineJS/pagination/**/*'])
      .pipe(concat('formsEngine.pagination.js'))
      .pipe(gulp.dest('dist'))
      .pipe(minify({
        ext:{
            min:'.min.js'
        },
        noSource: true
      }))
      .pipe(gulp.dest('dist'))
  );
}

// define complex tasks
var js = gulp.series(compressElements, compressPagination);
var build = gulp.series(clean, gulp.parallel(js));

// export tasks
exports.js = js;
exports.clean = clean;
exports.build = build;
exports.default = build;
