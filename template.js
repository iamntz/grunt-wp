/*
 * http://iamntz.com/
 *
 * Copyright (c) 2013 Ionuț "iamntz" Staicu
 * Licensed under the MIT license.
 */

'use strict';

exports.description = 'Basic templates & structure for WordPress sites';

exports.notes = '';
exports.after = '';
exports.warnOn = '*';

exports.template = function(grunt, init, done) {

  init.process({type: 'ntz-wp'}, [

  init.prompt('name'),
  // init.prompt('description', 'N/A'),
  // init.prompt('version', "0.0.1"),

  // init.prompt('homepage', "N/A"),
  // init.prompt('author_name'),
  // init.prompt('author_email'),
  // init.prompt('author_url', "N/A"),

  // init.prompt('licenses', 'Private'),

  // init.prompt('repository', ""),
  // init.prompt('bugs', ""),

  ], function(err, props) {
    props.projectNamespace = ( props.name.charAt(0).toUpperCase() + props.name.slice(1).toLowerCase() );

    var originalFiles = init.filesToCopy(props);
    var files = {};

    Object.keys(originalFiles).forEach(function(destpath) {
      var newPath = destpath.replace('project_name', props.name);
      files[newPath] = originalFiles[destpath];
    });

    init.copyAndProcess(files, props, {});

    var packageJSON = {
      name       : props.name,
      description: props.description,
      version    : props.version,
      author     : props.author,
      bugs       : props.bugs,
      repository : {
        url : props.repository,
        type: "git"
      },
    };


    packageJSON.devDependencies = {
      "grunt"                  : ">0"
      ,"grunt-contrib-uglify"  : ">0"
      ,"grunt-contrib-jshint"  : ">0"
      ,"grunt-contrib-watch"   : ">0"
      ,"grunt-contrib-concat"  : ">0"
      ,"grunt-contrib-copy"    : ">0"
      ,"grunt-contrib-qunit"   : ">0"
      ,"grunt-csscss"          : ">0"
      ,"grunt-contrib-sass"    : ">0"
    }

    init.writePackageJSON('package.json', packageJSON );
    done();
  });
};
