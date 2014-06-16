module.exports = function(grunt) {
  var extend = require( 'extend' );
  var args = process.argv;

  var isDev = args.indexOf( 'dev' ) != -1;

  require('time-grunt')(grunt);

  require('jit-grunt')(grunt, {
    sprite: 'grunt-spritesmith'
  });

  var jsFilesToLint = [ 'Gruntfile.js' ];

  var filesToWatch = {};

  var package_json = grunt.file.readJSON('package.json');
  var assets       = grunt.file.readJSON('assets/assets.json');

  var javascripts  = assets.javascripts;
  var jsKeys  = Object.keys( javascripts );
  var uglifyFiles = [];

  jsKeys.forEach(function( taskName ){
    var task    = javascripts[taskName];
    var options = task.options || {};
    var dest    = task.dest || 'assets/dist/javascripts/' + taskName + '.min.js';

    if( !task.src ){ return; }

    if( !options.skipUglify ){
      uglifyFiles[taskName] = {
        src : task.src,
        dest: dest
      };
    }

    if( !options.skipLint ){
      jsFilesToLint.push( task.src );
    }

    filesToWatch[taskName] = {
      files : task.src,
      tasks : [ 'js' ]
    };
  });

  var stylesheets  = assets.stylesheets;
  var cssKeys = Object.keys( stylesheets );
  var sassFiles = [];

  cssKeys.forEach(function( taskName ){
    var task    = stylesheets[taskName];
    var options = typeof task.options !== 'undefined' ? task.options : {};
    var dest    = task.dest || 'assets/dist/stylesheets/' + taskName + '.css';

    if( !task.src ){ return; }

    sassFiles[taskName] = {
      src : task.src,
      dest: dest
    };

    if( !options.skipWatch ){
      filesToWatch[taskName] = {
        files : task.src,
        tasks : [ 'css' ]
      };
    }
  });


  var defaultSpriteOptions = {
    algorithm  : 'binary-tree',
    padding    : 10,
    engine     : 'auto',
    cssTemplate: 'assets/helpers/spritesmith.sass.template.mustache',
    engineOpts : {
      'imagemagick': true
    }
  };


  grunt.initConfig({
    pkg: package_json,


    jshint: {
      files: jsFilesToLint,
      options: {
        reporter: require('jshint-stylish'),
        globals: {
          jQuery   : true,
          console : true,
          module  : true,
          document: true
        },
        laxcomma: true,
        laxbreak: true,
        sub     : true
      }
    },


    uglify: extend( uglifyFiles, {
      options : {
        sourceMap: !isDev ? false : function( path ){ return path + 'map'; }
      },
    }),


    sass: extend( sassFiles, {
      options: {
        style    : 'compressed',
        sourcemap: isDev,
        // compass  : true
      }
    }),


    copy : {
      assets: {
        files: [
          {
            expand: true,
            cwd: 'assets/src',
            src: [
              'images/*',
              'images/**/*',
              'fonts/**/*'
            ],
            dest: 'assets/dist/'
          }
        ]
      }
    },


    sprite:{
      all: extend( defaultSpriteOptions, {
        src        : [ 'assets/src/images/sprites/*.png' ],
        destImg    : 'assets/dist/images/sprites.png',
        imgPath    : '../images/sprites.png',
        destCSS    : 'assets/src/stylesheets/sprites/_sprites.scss',

        cssOpts : {
          "baseClass" : "spr",
          "functions" : true
        },
      })
    },


    clean: {
      build: ["assets/dist"]
    },


    watch: extend( filesToWatch, {
      options: {
        nospawn       : true,
        livereload   : true
      },

      assets : {
        files: [
          'assets/src/images/*',
          'assets/src/images/**/*',
          'assets/src/fonts/**/*'
        ],
        tasks: [ 'copy' ]
      }
    })
  });

  grunt.registerTask('js', [ 'jshint', 'uglify']);
  grunt.registerTask('css', [ 'sprite', 'sass' ]);
  grunt.registerTask('assets', [ 'copy' ]);

  grunt.registerTask('default', [ 'clean', 'js', 'css', 'assets' ]);
  grunt.registerTask('dev', [ 'default', 'watch' ]);
};