const webpack = require('webpack');
const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const FixStyleOnlyEntriesPlugin = require("webpack-fix-style-only-entries");

// paths
let rootPath = path.resolve(__dirname);
const corePath = rootPath;
const srcPath = corePath + '/src';
const distPath = corePath + '/assets';



module.exports = {
    entry:getEntryFiles(),
    output: {
        path: distPath,
        filename: '[name].js',
    },
    plugins:[
        new FixStyleOnlyEntriesPlugin(),
        // create css file
        new MiniCssExtractPlugin({
            filename: '[name].css',
        }),
    ],
    module:{
        rules:[
            {
                test: /\.css$/,
                use: [
                    MiniCssExtractPlugin.loader,
                    'css-loader',
                ],
            },
            {
                test: /\.scss$/,
                use: [
                    MiniCssExtractPlugin.loader,
                    {
                        loader: 'css-loader',
                    },
                    {
                        loader: "sass-loader",
                        options: {
                            // Prefer `dart-sass`
                            implementation: require("sass"),
                            sourceMap: false,
                            sassOptions: {
                                includePaths: [
                                    srcPath+'/assets/scss',
                                    path.resolve(__dirname, 'node_modules')
                                ]
                            }
                        },
                    },
                ],
            },
        ]
    },
    experiments: {
        topLevelAwait: true,
    },
}

function getEntryFiles() {

    const entries = {
        // Theme css/js
        'js/scripts.bundle': srcPath+'/assets/index.js',
        'js/admin_option.bundle': srcPath+'/assets/admin_option.js',
        
        // 'css/style.bundle': [distPath+'/scss/main.scss',distPath+'/scss/styles.scss'],
        'css/style.bundle': srcPath+'/assets/index.scss',

        // 'js/scripts': {
        //     dependOn: 'js/scripts.bundle',
        //     import: distPath+'/js/scripts.js'
        // },
    };

    return entries;
}