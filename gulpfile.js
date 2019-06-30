"use strict";

// Load plugins
const browsersync = require("browser-sync").create();
const del = require("del");
const eslint = require("gulp-eslint");
const gulp = require("gulp");
const plumber = require("gulp-plumber");
const webpack = require("webpack");
const webpackconfig = require("./webpack.config.js");
const webpackstream = require("webpack-stream");

// Clean assets
function clean() {
  return del(["./dist/"]);
}

// Lint scripts
function scriptsLint() {
  return gulp
    .src(["./src/FormsEngineJS/**/*", "./gulpfile.js"])
    .pipe(plumber())
    .pipe(eslint())
    .pipe(eslint.format())
    .pipe(eslint.failAfterError());
}

// Transpile, concatenate and minify scripts
function scripts() {
  return (
    gulp
      .src(["./src/FormsEngineJS/**/*"])
      .pipe(plumber())
      .pipe(webpackstream(webpackconfig, webpack))
      // folder only, filename is specified in webpack config
      .pipe(gulp.dest("./dist/"))
      .pipe(browsersync.stream())
  );
}

// define complex tasks
const js = gulp.series(scriptsLint, scripts);
const build = gulp.series(clean, gulp.parallel(js));

// export tasks
exports.js = js;
exports.clean = clean;
exports.build = build;
exports.default = build;
