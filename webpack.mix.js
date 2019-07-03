// To separate admin/user vendor.js for better performance,
// we need to run webpack for each section separatly and 
// use mix.mergeManifest() to combine mix-manifest.json.
//
// Copy file webpack.mix.admin.js to webpack.mix.user.js,
// update it and run `npm --section=user run dev`

if (['user'].includes(process.env.npm_config_section)) {
    console.log(
        '\x1b[41m%s\x1b[0m',
        '===> Build '+process.env.npm_config_section+' section'
    )
    require(`${__dirname}/webpack.mix.user.js`)
    
    return true;
} else {
    console.log(
        '\x1b[33m%s\x1b[0m',
        '===> Build admin section. Run `npm --section=user run dev` to build user section.'
    )
}

require(`${__dirname}/webpack.mix.admin.js`)
