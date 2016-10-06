module.exports = function(grunt) {
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    htmlmin: {                                    // Task
      release: {                                  // Target
        options: {                                // Target options
          removeComments: true,
          collapseWhitespace: true
        },
        files: {
          'dist/index.php': 'src/index.php',    // 'destination': 'source'
          'dist/login.php': 'src/login.php',
          'dist/options.php': 'src/options.php'
        }
      },
    },
    copy: {
      release: {
        files: [
          {expand: true, cwd: 'bower_components/bootstrap/dist/', src: ['**'], dest: 'dist/'},
          {expand: true, cwd: 'src/', src: ['**'], dest: 'dist/'},
          {expand: true, cwd: 'bower_components/jquery/dist/', src: ['**'], dest:'dist/js/'},
          //{expand: true, flatten: true, src: ['path/**'], dest: 'dest/', filter: 'isFile'},
        ],
      },
      test: {
        files: [
          {expand: true, cwd: 'bower_components/bootstrap/dist/', src: ['**'], dest: 'test/'},
          {expand: true, cwd: 'src/', src: ['**'], dest: 'test/'},
          {expand: true, cwd: 'bower_components/jquery/dist/', src: ['**'], dest:'test/js/'},
        ],
      },
    },
    watch: {
      options: {
      livereload: true,
      },
      src: {
        files: ['src/**'],
        tasks: ['test'],
      },
    }
  });

// Load Tasks
  grunt.loadNpmTasks('grunt-contrib-htmlmin');
  grunt.loadNpmTasks('grunt-contrib-copy');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-uglify');

// Register Tasks
  // builds project, and configures dev environment.
  grunt.registerTask('setup', ['copy', 'htmlmin']);
  // builds release candidate to /dist
  grunt.registerTask('release', ['copy:release','htmlmin:release']);
  // builds test version to /test
  grunt.registerTask('test', ['copy:test']);
  // starts watch for rapid repeat testing
  grunt.registerTask('devmode', ['watch']);

};
