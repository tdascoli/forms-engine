// Load plugins
var del = require("del");
var gulp = require("gulp");
var concat = require('gulp-concat');
var rename = require('gulp-rename');
var minify = require('gulp-minify');
var inject = require('gulp-inject');

// Clean assets
function clean() {
  return del(["./dist/"]);
}

function cleanDocs() {
  return del(["./docs/js","./docs/css"]);
}

// inject
function injectAll(){
  return (
    gulp.src(['./docs/*.html','./docs/*.php'])
      .pipe(inject(gulp.src(['./docs/css/*.css'], {read: false}), {relative: true, name: 'styles'}))
      .pipe(inject(gulp.src(['./docs/js/*.min.js'], {read: false}), {relative: true}))
      .pipe(gulp.dest('./docs'))
  );
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
    gulp.src(['src/FormsEngineJS/pagination/pagination.js'])
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

function compressAjax(){
  return (
    gulp.src(['src/FormsEngineJS/ajax/*.js'])
      .pipe(concat('formsEngine.ajax.js'))
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

function doCss(){
  return (
    gulp.src(['src/FormsEngineCSS/typeahead/**/*'])
      .pipe(concat('formsEngine.typeahead.css'))
      .pipe(gulp.dest('dist'))
  );
}

function copyJsForDocs(){
  return (
    gulp.src(['./dist/**/*.*.min.js'])
      .pipe(gulp.dest('docs/js'))
  );
}

function copyCssForDocs(){
  return (
    gulp.src(['./dist/**/*.css'])
      .pipe(gulp.dest('docs/css'))
  );
}

// define complex tasks
var js = gulp.series(compressElements, compressPagination, compressAjax);
var docs = gulp.series(cleanDocs, copyJsForDocs, copyCssForDocs, injectAll);
var css = gulp.series(doCss);
var build = gulp.series(clean, gulp.parallel(js, css), docs);

// export tasks
exports.js = js;
exports.css = css;
exports.clean = clean;
exports.build = build;
exports.default = build;
