const fs = require('fs')
const mix = require('laravel-mix')
require('laravel-mix-merge-manifest')
var pjson = require('./package.json')

mix.setPublicPath('public')
mix.setResourceRoot('/vendor/openexam/dashboard')

// Ref: https://laravel-mix.com/docs/4.0/options
mix.options({
    processCssUrls: true,    
    extractVueStyles: false,
    // Ref: https://www.npmjs.com/package/postcss-css-variables
    // postCss: [require('postcss-css-variables')()],
    purifyCss: false,
    //purifyCss: {},
    cssNano: {
        discardComments: {removeAll: true},
    },
    terser: {
        terserOptions: {
            compress: {
                drop_console: false,
                pure_funcs: ['console.log']
            }
        }
    },    
    clearConsole: false,    
    hmrOptions: {
        host: 'localhost',
        port: 9999
    },    
})

var pathsToClean = []
// Do not remove public folder if run webpack for user and admin separately. 
if (!fs.existsSync('webpack.mix.user.js')) {
    pathsToClean = ['public']  
}

const CleanWebpackPlugin = require('clean-webpack-plugin');

mix.webpackConfig(webpack => {
    return {
        plugins: [
            new CleanWebpackPlugin(pathsToClean, {})            
        ],
        externals: {
            // require("jquery") is external and available on the global var jQuery
            "jquery": "jQuery"
        }
    };
});

mix.mergeManifest()
mix.version()
mix.disableNotifications()

// Manage .watch file for browserSync
mix.then(function () {
    let path = '../../../public/.watch'
    if (JSON.parse(process.env.npm_config_argv).remain[0] == '--watch') {
        if (!fs.existsSync(path)) {
            fs.writeFile(path, '', (err) => {
                if (err) { return console.error(err) }
                console.log("===> Create /public/.watch Done!")
            })
        }
    } else {
        if (fs.existsSync(path)) {
            fs.unlink(path, function(err) {
                if (err) { return console.error(err) }
                console.log('===> Remove /public/.watch Done!')
            })
        }
    }
})


if (!mix.inProduction()) {
    // Set browserSync watch files
    mix.browserSync({
        proxy: 'localhost',
        files: [
            './config/**/*',
            './resources/**/*',
            './routes/**/*',
            './src/**/*'
        ]
    })

    // Run bundleAnalyzer to better understannd output
    //    
	//	if (['yes'].includes(process.env.npm_config_unattended)) {
	//		console.log('Unattended install, skip bundleAnalyzerPlugin');
	//	} else {
	//	    const BundleAnalyzerPlugin = require('webpack-bundle-analyzer').BundleAnalyzerPlugin
	//	    mix.webpackConfig(webpack => {
	//	        return {
	//	            plugins: [
	//                 new BundleAnalyzerPlugin({ 
	//                         analyzerHost: '127.0.0.1',        
	//                         analyzerPort: 8888                                        
	//                 })            
	//	            ]
	//	        };
	//	    });
	//	}    

    // Publish files on develop mode, on production it is done by artisan vender:publish
    const fse = require('fs-extra')    
    mix.then(function () {
        console.log('==> Webpack finishes building.')
        let path = '../../../public/vendor/'+pjson.vendor+'/'+pjson.name
        fse.copy('public', path, err => {
            if (err) return console.error(err)
            console.log('===> Copy /public to '+path+' Done!')
        })
    })
}

module.exports = {
    mix: mix
}
