/*
 * grunt-baseproject
 * http://iamntz.com/
 *
 * Copyright (c) 2013 Ionuț "iamntz" Staicu
 * Licensed under the MIT license.
 */

'use strict';

// Basic template description.
exports.description = 'Basic templates & structure for WordPress & static sites';

// Template-specific notes to be displayed before question prompts.
exports.notes = '';

// Template-specific notes to be displayed after question prompts.
exports.after = '';

// Any existing file or directory matching this wildcard will cause a warning.
exports.warnOn = '*';

// The actual init template.
exports.template = function(grunt, init, done) {

  init.process({type: 'ntz-baseproject'}, [
    // Prompt for these values.
    init.prompt('name'),

    init.prompt('title', function(value, data, done) {
      // Fix jQuery capitalization.
      value = value.replace(/jquery/gi, 'jQuery');
      done(null, value);
    }),

    init.prompt('description', 'N/A'),
    init.prompt('version', 0.0.1),
    init.prompt('homepage'),
    init.prompt('licenses', 'MIT'),

    init.prompt('author_name'),
    init.prompt('author_email'),
    init.prompt('author_url'),

    // init.prompt('repository'),
    // init.prompt('bugs'),

  ], function(err, props) {
    // // A few additional properties.
    // props.jqueryjson = props.name + '.jquery.json';
    // props.dependencies = {jquery: props.jquery_version || '>= 1'};

    // props.keywords = [];

    // // Files to copy (and process).
    // var files = init.filesToCopy(props);

    // // Add properly-named license files.
    // init.addLicenseFiles(files, props.licenses);

    // // Actually copy (and process) files.
    // init.copyAndProcess(files, props, {noProcess: 'libs/**'});

    // // Generate package.json file, used by npm and grunt.
    // // init.writePackageJSON('package.json', {
    // //   name: 'jquery-plugin',
    // //   version: '0.0.0-ignored',
    // //   npm_test: 'grunt qunit',
    // //   // TODO: pull from grunt's package.json
    // //   node_version: '>= 0.8.0',
    // //   devDependencies: {
    // //     'grunt-contrib-jshint': '~0.6.0',
    // //     'grunt-contrib-qunit': '~0.2.0',
    // //     'grunt-contrib-concat': '~0.3.0',
    // //     'grunt-contrib-uglify': '~0.2.0',
    // //     'grunt-contrib-watch': '~0.4.0',
    // //     'grunt-contrib-clean': '~0.4.0',
    // //   },
    // // });

    // // Generate jquery.json file.
    // init.writePackageJSON(props.jqueryjson, props, function(pkg, props) {
    //   // The jQuery site needs the "bugs" value as a string.
    //   if ('bugs' in props) { pkg.bugs = props.bugs; }
    //   return pkg;
    // });

    // All done!
    done();
  });

};
