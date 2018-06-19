const webpack = require('webpack');
const UglifyJsPlugin = require('uglifyjs-webpack-plugin');
const OptimizeCSSAssetsPlugin = require('optimize-css-assets-webpack-plugin');
const config = require('./development');

module.exports = {
    ...config,

    mode: 'production',
    devtool: false,

    optimization: {
        ...config.optimization,

        minimizer: [
            new UglifyJsPlugin({
                cache: true,
                parallel: true,
                sourceMap: false,
                uglifyOptions: {
                    output: {
                        comments: false,
                        beautify: false
                    }
                }
            }),

            new OptimizeCSSAssetsPlugin({
                cssProcessorOptions: {
                    discardComments: {
                        removeAll: true
                    }
                }
            })
        ]
    },

    plugins: [
        ...config.plugins,

        new webpack.DefinePlugin({
            __PRODUCTION__: true
        }),
    ]
}
