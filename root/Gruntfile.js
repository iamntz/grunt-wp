module.exports = function(grunt) {
  require('time-grunt')(grunt);

  require('jit-grunt')(grunt, {
    sprite: 'grunt-spritesmith'
  });

  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    assets : grunt.file.readJSON('assets/assets.json'),

    jshint: {
      files: [
        'Gruntfile.js'
        ,'<%= uglify.app.src %>'
        ,'<%= uglify.admin.src %>'
      ],
      options: {
        reporter: require('jshint-stylish')
        ,globals: {
          jQuery   : true
          ,console : true
          ,module  : true
          ,document: true
        },
        laxcomma : true
        ,laxbreak: true
        ,sub     : true
      }
    },


    uglify: {
      options : {
        sourceMap: function( path ){ return path + 'map'; }
      }

      ,app: {
        src : '<%= assets.js.app %>',
        dest: 'assets/dist/javascripts/<%= pkg.name %>.min.js'
      }

      ,admin: {
        src : '<%= assets.js.admin %>',
        dest: 'assets/dist/javascripts/<%= pkg.name %>.admin.min.js'
      }

      ,vendor : {
        src : '<%= assets.js.vendor %>',
        dest: 'assets/dist/vendor/vendor.min.js'
      }
    },



    sass: {
      options: {
        style    : 'compressed',
        sourcemap: true,
        // compass  : true
      },

      screen: {
        src : '<%= assets.css.screen %>',
        dest: 'assets/dist/stylesheets/screen.css'
      },
      admin: {
        src : '<%= assets.css.admin %>',
        dest: 'assets/dist/stylesheets/admin.css'
      }
    },


    copy : {
      assets: {
        files: [
          {
            expand: true,
            cwd: 'assets/src',
            src: [
              'images/*'
              ,'images/**/*'
              ,'fonts/**/*'
            ],
            dest: 'assets/dist/'
          }
        ]
      }
    },


    sprite:{
      all: {
        src         : ['assets/src/images/sprites/*.png']
        ,destImg    : 'assets/dist/images/sprites.png'
        ,imgPath    : '../images/sprites.png'
        ,algorithm  : 'binary-tree'
        ,padding    : 10
        ,engine     : 'auto'
        ,destCSS    : 'assets/src/stylesheets/sprites/_sprites.scss'
        ,cssTemplate: 'assets/helpers/spritesmith.sass.template.mustache'
        ,engineOpts : {
          'imagemagick': true
        }
      }
    },


    clean: {
      build: ["assets/dist"]
    },



    watch: {
      options: {
        nospawn       : true
        ,livereload   : true
      },

      css: {
        files: [ '<%= sass.screen.src %>' ],
        tasks: [ "css" ]
      },

      admin : {
        files: [
          '<%= sass.admin.src %>'
          ,'<%= uglify.admin.src %>'
        ],
        tasks : [ "admin" ]
      },

      assets : {
        files: [
          'assets/src/images/*'
          ,'assets/src/images/**/*'
          ,'assets/src/fonts/**/*'
        ],
        tasks: [ 'copy' ]
      },

      js : {
        files: [ '<%= uglify.app.src %>' ],
        tasks: [ 'js' ]
      }
    },
  });

  grunt.registerTask('js', [ 'jshint', 'uglify']);
  grunt.registerTask('css', [ 'sprite', 'sass' ]);
  grunt.registerTask('assets', [ 'copy' ]);
  grunt.registerTask('admin', [ 'sass:admin', 'uglify:admin' ]);

  grunt.registerTask('default', [ 'clean', 'js', 'css', 'assets' ]);
  grunt.registerTask('dev', [ 'default', 'watch' ]);
};