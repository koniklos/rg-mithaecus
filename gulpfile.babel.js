/*
 ************************************************************************
 ****************************  DEPENDENCIES  ****************************
 ************************************************************************
 */

import browserSync from "browser-sync";
import cleanCSS from "gulp-clean-css";
import del from "del";
import fs from "fs";
import gulp from "gulp";
import gulpif from "gulp-if";
import imagemin from "gulp-imagemin";
import modernizr from "modernizr";
import modernizrConfig from "./modernizr-config.json";
import named from "vinyl-named";
import packageDotJSON from "./package.json";
import rename from "gulp-rename";
import replace from "gulp-replace";
import sass from "gulp-sass";
import sourcemaps from "gulp-sourcemaps";
import svgSprite from "gulp-svg-sprite";
import webpack from "webpack-stream";
import wpPot from "gulp-wp-pot";
import yargs from "yargs";
import zip from "gulp-zip";

/*
 ************************************************************************
 ******************  BROWSER-SYNC SERVER & ENVIRONMENT  *****************
 ************************************************************************
 */

// BrowserSync: Create Server
const server = browserSync.create();

// Environment Setup
const PRODUCTION = yargs.argv.prod;

/*
 ************************************************************************
 *******************************  PATHS  ********************************
 ************************************************************************
 */

// Paths for folders and files
const paths = {
  styles: {
    src: "src/assets/scss/bundle.scss",
    dest: "dist/assets/css",
    watch: "src/assets/scss/**/*.scss"
  },
  scripts: {
    src: [
      "src/assets/js/bundle.js",
      "src/assets/js/customize-preview.js",
      "src/assets/js/vendors/lazyload.js",
      "src/assets/js/vendors/scroll-out.js"
    ],
    dest: "dist/assets/js",
    watch: "src/assets/js/**/*.js"
  },
  images: {
    src: "src/assets/images/**/*.{jpg,jpeg,png,gif,svg}",
    dest: "dist/assets/images"
  },
  svg: {
    src: "src/assets/svg/**/*.svg",
    dest: "dist/assets/images/svg-sprite"
  },
  etc: {
    src: [
      "src/assets/**/*",
      "!src/assets/{images,js,scss,svg}",
      "!src/assets/{images,js,scss,svg}/**/*"
    ],
    dest: "dist/assets"
  },
  rename: {
    src: ["single-_themename_recipe.php"]
  },
  plugins: {
    src: [
      "../../plugins/_themename-post-layout-metabox/packaged/*",
      "../../plugins/_themename-recipes/packaged/*"
    ],
    dest: ["lib/plugins"]
  },
  modernizr: {
    dest: "dist/assets/js/modernizr-build.js"
  },
  php: {
    watch: "**/*.php"
  },
  server: {
    url: "http://127.0.0.1/wptest1/"
  },
  package: {
    src: [
      "**/*",
      "!.vscode",
      "!node_modules{,/**}",
      "!packaged{,/**}",
      "!src{,/**}",
      "!.babelrc",
      "!.gitignore",
      "!gulpfile.babel.js",
      "!modernizr-config.json",
      "!package.json",
      "!package-lock.json",
      "!README.md",
      "!archive-_themename_portfolio.php",
      "!single-_themename_portfolio.php",
      "!taxonomy-_themename_skills.php",
      "!taxonomy-_themename_project_type.php"
    ],
    dest: "packaged"
  }
};

/*
 ************************************************************************
 *******************************  TASKS  ********************************
 ************************************************************************
 */

// BrowserSync: Server config
export const serve = done => {
  server.init({
    proxy: paths.server.url
  });

  done();
};

// BrowserSync: Reload
export const reload = done => {
  server.reload();
  done();
};

// Clean the "dist" folder
export const clean = () => del(["dist"]);

// Compile scss
export const styles = () =>
  gulp
    .src(paths.styles.src)
    .pipe(gulpif(!PRODUCTION, sourcemaps.init()))
    .pipe(sass().on("error", sass.logError))
    .pipe(gulpif(PRODUCTION, cleanCSS({ combatibility: "ie8" })))
    .pipe(gulpif(!PRODUCTION, sourcemaps.write()))
    .pipe(gulp.dest(paths.styles.dest))
    .pipe(server.stream());

// Compile JS
export const scripts = () =>
  gulp
    .src(paths.scripts.src)
    .pipe(named())
    .pipe(
      webpack({
        module: {
          rules: [
            {
              test: /\.js$/,
              use: {
                loader: "babel-loader",
                options: { presets: ["babel-preset-env"] }
              }
            }
          ]
        },
        output: {
          filename: "[name].js"
        },
        externals: {
          jquery: "jQuery"
        },
        devtool: !PRODUCTION ? "inline-source-map" : false,
        mode: PRODUCTION ? "production" : "development"
      })
    )
    .pipe(gulp.dest(paths.scripts.dest));

// Minify images
export const images = () =>
  gulp
    .src(paths.images.src)
    .pipe(gulpif(PRODUCTION, imagemin()))
    .pipe(gulp.dest(paths.images.dest));

// SVG Sprites
export const generateSvgSprite = () =>
  gulp
    .src(paths.svg.src)
    .pipe(
      svgSprite({
        shape: {
          id: {
            generator: "icon-%s" // Shape's ID
          }
        },
        svg: {
          xmlDeclaration: false // Remove xml declaration to avoid WP errors
        },
        mode: {
          symbol: {
            dest: ".", // Save to root of the dest folder
            sprite: "svg-icon-sprite.svg", // Name of the sprite
            inline: true // Sprite does not appear in page
          }
        }
      })
    )
    .pipe(gulp.dest(paths.svg.dest));

// Copy additional files
export const copy = () =>
  gulp.src(paths.etc.src).pipe(gulp.dest(paths.etc.dest));

// Build modernizr
export const modernizrBuild = done => {
  modernizr.build(modernizrConfig, code => {
    fs.writeFile(__dirname + "/" + paths.modernizr.dest, code, done);
  });
};

// Copy Plugins
export const copyPlugins = () =>
  gulp.src(paths.plugins.src).pipe(gulp.dest(paths.plugins.dest));

// Rename files
export const rename_files = () =>
  gulp
    .src(paths.rename.src)
    .pipe(
      rename(path => {
        path.basename = path.basename.replace(
          "_themename",
          packageDotJSON.name
        );
      })
    )
    .pipe(gulp.dest("./"));

// Delete renamed files
export const delete_renamed_files = () =>
  del(
    paths.rename.src.map(filename =>
      filename.replace("_themename", packageDotJSON.name)
    )
  );

// Translations
export const pot = () =>
  gulp
    .src("**/*.php")
    .pipe(
      wpPot({
        domain: "_themename",
        package: packageDotJSON.name
      })
    )
    .pipe(gulp.dest(`languages/${packageDotJSON.name}.pot`));

// Watchers
export const watch = () => {
  gulp.watch(paths.styles.watch, styles);
  gulp.watch(paths.scripts.watch, gulp.series(scripts, reload));
  gulp.watch(paths.images.src, gulp.series(images, reload));
  gulp.watch(paths.svg.src, gulp.series(generateSvgSprite, reload));
  gulp.watch(paths.etc.src, gulp.series(copy, reload));
  gulp.watch(paths.php.watch, reload);
};

// Zip for distribution
export const compress = () =>
  gulp
    .src(paths.package.src)
    .pipe(
      gulpif(
        file => file.relative.split(".").pop() !== "zip",
        replace("_themename", packageDotJSON.name)
      )
    )
    .pipe(zip(`${packageDotJSON.name}.zip`))
    .pipe(gulp.dest(paths.package.dest));

export const dev = gulp.series(
  clean,
  gulp.parallel(styles, images, generateSvgSprite, scripts, copy),
  modernizrBuild,
  serve,
  watch
);

export const build = gulp.series(
  clean,
  gulp.parallel(styles, images, generateSvgSprite, scripts, copy),
  modernizrBuild,
  copyPlugins
);

export const bundle = gulp.series(
  build,
  rename_files,
  compress,
  delete_renamed_files
);

export default dev;
