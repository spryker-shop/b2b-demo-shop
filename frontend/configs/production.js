const merge = require('webpack-merge');
const TerserPlugin = require('terser-webpack-plugin');
const OptimizeCSSAssetsPlugin = require('optimize-css-assets-webpack-plugin');
const getConfiguration = require('./development');
const CompressionPlugin = require('compression-webpack-plugin');
const BrotliPlugin = require('brotli-webpack-plugin');

const mergeWithStrategy = merge.smartStrategy({
    plugins: 'prepend'
});

const configurationProdMode = async appSettings => mergeWithStrategy(await getConfiguration(appSettings), {
    webpack: {
        mode: 'production',
        devtool: false,
        plugins: [
            new CompressionPlugin({
                filename: '[path].gz[query]',
            }),

            new BrotliPlugin({
                asset: '[path].br[query]',
                test: /\.js$|\.css$|\.svg$|\.html$/,
                threshold: 10240,
                minRatio: 0.8
            })
        ],

        plugins: [

            new CompressionPlugin({
                filename: '[path].gz[query]',
            }),

            new BrotliPlugin({
                asset: '[path].br[query]',
                test: /\.js$|\.css$|\.svg$|\.html$/,
                threshold: 10240,
                minRatio: 0.8
            })

        ],

        plugins: [

            new CompressionPlugin({
                filename: '[path].gz[query]',
            }),

            new BrotliPlugin({
                asset: '[path].br[query]',
                test: /\.js$|\.css$|\.svg$|\.html$/,
                threshold: 10240,
                minRatio: 0.8
            })

        ],

        plugins: [

            new CompressionPlugin({
                filename: '[path].gz[query]',
            }),

            new BrotliPlugin({
                asset: '[path].br[query]',
                test: /\.js$|\.css$|\.svg$|\.html$/,
                threshold: 10240,
                minRatio: 0.8
            })

        ],

        optimization: {
            minimizer: [
                new TerserPlugin({
                    cache: true,
                    parallel: true,
                    extractComments: false,
                    terserOptions: {
                        output: {
                            beautify: false
                        }
                    }
                }),

                new OptimizeCSSAssetsPlugin({
                    cssProcessorOptions: {
                        discardEmpty: true,
                        discardComments: {
                            removeAll: true
                        }
                    }
                })
            ]
        }
    }
});

module.exports = configurationProdMode;
