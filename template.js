/*
 * grunt-baseproject
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

  init.process({type: 'ntz-baseproject'}, [

  init.prompt('name'),
  init.prompt('description', 'N/A'),
  init.prompt('version', "0.0.1"),

  init.prompt('homepage', "N/A"),
  init.prompt('author_name'),
  init.prompt('author_email'),
  init.prompt('author_url', "N/A"),

  init.prompt('licenses', 'Private'),

  init.prompt('repository', ""),
  init.prompt('bugs', ""),

  ], function(err, props) {
    var files = init.filesToCopy(props);
    init.copyAndProcess(files, props, {

    });



    var packageJSON = {
      name       : props.name,
      description: props.description,
      version    : props.version,
      author     : props.author,
      repository : {
        url : props.repository,
        type: "git"
      },
      bugs       : props.bugs
    };


    packageJSON.devDependencies = {
      "grunt"                 : "~0.4.1",
      "grunt-contrib-uglify"  : "~0.2.2",
      "grunt-contrib-jshint"  : "~0.6.0",
      "grunt-contrib-watch"   : "~0.4.4",
      "grunt-contrib-concat"  : "~0.3.0",
      "grunt-contrib-copy"    : "~0.4.1",
      "grunt-contrib-qunit"   : "~0.2.2",
      "grunt-csscss"          : "~0.6.0",
      "grunt-contrib-sass"    : "~0.4.1",
      "grunt-contrib-compass" : "~0.5.0"
    }

    init.writePackageJSON('package.json', packageJSON );
    done();
  });
};
