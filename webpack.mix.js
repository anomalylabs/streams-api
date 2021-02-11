let mix = require('laravel-mix');
const path = require('path');

mix
    .js('resources/lib/index.js', '')
    .copyDirectory('resources/public', '../../../public/vendor/streams/api')
    .webpackConfig(

        function (webpack) {

            return {
                externals: {
                    '@laravel-streams/core': ['streams', 'core'],
                    'axios': ['streams', 'core', 'axios'],
                },
                output: {
                    path: path.resolve('./resources/public'),
                    filename: 'js/[name].js',
                    chunkFilename: 'js/chunk.[name].js',
                    library: ['streams', 'api'],
                    publicPath: '/vendor/streams/api/',
                    libraryTarget: 'window',
                    devtoolFallbackModuleFilenameTemplate: 'webpack:///[resource-path]?[hash]',
                    devtoolModuleFilenameTemplate: info => {
                        var $filename = 'sources://' + info.resourcePath;
                        $filename = 'webpack:///' + info.resourcePath; // +'?' + info.hash;
                        if (info.resourcePath.match(/\.vue$/) && !info.allLoaders.match(/type=script/) && !info.query.match(/type=script/)) {
                            $filename = 'webpack-generated:///' + info.resourcePath; // + '?' + info.hash;
                        }
                        return $filename;
                    }
                }
            };
        })
    .sourceMaps();
