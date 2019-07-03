const { mix } = require('./webpack.base.js')

// ============================ //
// mix.js('resources/js/admin/index.js', 'js/admin/app.js')

// mix.sass('resources/sass/admin/app.scss', 'css/admin/app.css')

mix.copyDirectory('resources/images', 'public/images')



// ============================ //
//Extract all vendors to vendor.js, 
//Ref: https://laravel-mix.com/docs/4.0/extract

// mix.extract()

// Set splitChunks below to extract both vendor and commons
// mix.extract() IS still required.
//
// mix.webpackConfig(webpack => {
//     return {
//         // Ref: https://webpack.js.org/plugins/split-chunks-plugin
//          optimization: {
//              splitChunks: {
//                  cacheGroups: {
//                      commons: {
//                          name: "admin/commons",
//                          chunks: "initial",
//                          minChunks: 2
//                      },
//                      vendor: {
//                        test: /node_modules/,
//                        chunks: "all",
//                        name: "admin/vendor",
//                        priority: 10,
//                        enforce: true,
//                        minChunks: 1
//                      }                     
//                  }
//              },
//          },
//     };
// });
