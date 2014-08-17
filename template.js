/*
 * http://iamntz.com/
 *
 * Copyright (c) 2013 Ionuț "iamntz" Staicu
 * Licensed under the MIT license.
 */

'use strict';

exports.description = 'Basic templates & structure for WordPress sites';

exports.notes = '';
exports.after = "Don't forget to run `npm update --save-dev` & `npm install`!";
exports.warnOn = '*';

exports.template = function(grunt, init, done) {
  init.process({type: 'ntz-wp'}, [

  init.prompt('name'),
  {
    name:'projectNamespace',
    message:'Project Namespace (leave empty to use project name; no spaces, no dashes)',
    default: null
  },

  init.prompt('description', 'N/A'),
  init.prompt('version', "0.0.1"),

  init.prompt('homepage', "N/A"),
  init.prompt('author_name'),
  init.prompt('author_email'),
  init.prompt('author_url', "N/A"),

  init.prompt('licenses', 'GPL'),

  init.prompt('repository', ""),
  init.prompt('bugs', ""),

  ], function(err, props) {
    props.projectNamespace = props.projectNamespace || props.name;
    props.projectNamespace = props.projectNamespace.replace( /[^a-zA-Z]/g, '' );
    props.projectNamespace = ( props.projectNamespace.charAt(0).toUpperCase() + props.projectNamespace.slice(1).toLowerCase() );

    var originalFiles = init.filesToCopy(props);
    var files         = {};

    // removing traces of gitmodules
    delete originalFiles['themes/project_name/assets/.git'];
    delete originalFiles['themes/project_name/assets/package.json'];

    Object.keys(originalFiles).forEach(function(destpath) {
      var newPath    = destpath.replace(/project_name/ig, props.name);
      files[newPath] = originalFiles[destpath];
    });

    init.copyAndProcess(files, props, {});

    var packageJSON = {
      name       : props.name,
      description: props.description,
      version    : props.version,
      author     : props.author,
      bugs       : props.bugs,
      repository : props.repository
    };


    packageJSON.devDependencies = {
      "extend"                   : "*",
      "grunt"                    : "*",
      "grunt-concurrent"         : "*",
      "grunt-contrib-clean"      : "*",
      "grunt-contrib-concat"     : "*",
      "grunt-contrib-copy"       : "*",
      "grunt-contrib-imagemin"   : "*",
      "grunt-contrib-jasmine"    : "*",
      "grunt-contrib-jshint"     : "*",
      "grunt-contrib-jst"        : "*",
      "grunt-contrib-sass"       : "*",
      "grunt-contrib-uglify"     : "*",
      "grunt-contrib-watch"      : "*",
      "grunt-karma"              : "*",
      "grunt-spritesmith"        : "*",
      "jit-grunt"                : "*",
      "jshint-stylish"           : "*",
      "karma"                    : "*",
      "karma-beep-reporter"      : "*",
      "karma-chrome-launcher"    : "*",
      "karma-firefox-launcher"   : "*",
      "karma-ie-launcher"        : "*",
      "karma-jasmine"            : "*",
      "karma-opera-launcher"     : "*",
      "karma-phantomjs-launcher" : "*",
      "karma-safari-launcher"    : "*",
      "load-grunt-config"        : "*",
      "load-grunt-tasks"         : "*",
      "time-grunt"               : "*"
    };

    init.writePackageJSON( 'themes/' + props.name + '/assets/package.json', packageJSON );
    done();
  });
};
