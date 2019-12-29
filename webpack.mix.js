const mix = require("laravel-mix");

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js("resources/js/app.js", "public/js")
    .sass("resources/sass/app.scss", "public/css")
    .copy("resources/images", "../../public/vendor/backend/images")
    // fonts文件全部提取到public/fonts
    .webpackConfig({
        module: {
            rules: [
                {
                    test: /(\.(woff2?|ttf|eot|otf)$|font.*\.svg$)/,
                    loader: "file-loader",
                    options: {
                        publicPath: Config.resourceRoot,
                        name: path => {
                            return (
                                Config.fileLoaderDirs.fonts +
                                "/[name].[ext]?[hash:8]"
                            );
                        }
                    }
                }
            ]
        },
        resolve: {
            extensions: [".js", ".json", ".vue"],
            alias: {
                "@": path.join(__dirname, "./resources/js"),
                "@images": path.join(__dirname, "./resources/images"),
                "@sass": path.join(__dirname, "./resources/sass")
            }
        },
        output: {
            publicPath: Config.resourceRoot,
            chunkFilename: "js/chunks/chunk.[chunkhash:8].js"
        }
    })
    .options({
        extractVueStyles: true
    });

if (mix.inProduction()) {
    mix.version();
}
