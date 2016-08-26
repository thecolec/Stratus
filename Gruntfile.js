module.exports = function(grunt) {
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    htmlmin: {                                    // Task
      release: {                                      // Target
        options: {                                 // Target options
          removeComments: true,
          collapseWhitespace: true
        },
        files: {                                   // Dictionary of files
          'dist/index.html': 'src/index.html',     // 'destination': 'source'
        }
      },
      test: {                                       // Another target
        files: {
          'test/index.html': 'src/index.html',
        }
      }
    },
    copy: {
      main: {
        files: [
          // includes files within path
          //{expand: true, src: ['path/*'], dest: 'dest/', filter: 'isFile'},

          // includes files within path and its sub-directories
          {expand: true, cwd: 'bower_components/bootstrap/dist/', src: ['**'], dest: 'res/'},
          {expand: true, cwd: 'bower_components/jquery/dist/', src: ['**'], dest:'res/js/'},
          {expand: true, cwd: 'res/', src: ['**'], dest:'test/'}
          // makes all src relative to cwd
          //{expand: true, cwd: 'path/', src: ['**'], dest: 'dest/'},

          // flattens results to a single level
          //{expand: true, flatten: true, src: ['path/**'], dest: 'dest/', filter: 'isFile'},
        ],
      },
      release: {
        files: [
          // includes files within path
          //{expand: true, src: ['path/*'], dest: 'dest/', filter: 'isFile'},

          // includes files within path and its sub-directories
          {expand: true, cwd: 'bower_components/bootstrap/dist/', src: ['**'], dest: 'dist/'},
          {expand: true, cwd: 'bower_components/jquery/dist/', src: ['**'], dest:'dist/js/'}
          // makes all src relative to cwd
          //{expand: true, cwd: 'path/', src: ['**'], dest: 'dest/'},

          // flattens results to a single level
          //{expand: true, flatten: true, src: ['path/**'], dest: 'dest/', filter: 'isFile'},
        ],
      },
      test: {
        files: [
          // includes files within path
          //{expand: true, src: ['path/*'], dest: 'dest/', filter: 'isFile'},

          // includes files within path and its sub-directories
          {expand: true, cwd: 'res/', src: ['**'], dest:'test/'}
          // makes all src relative to cwd
          //{expand: true, cwd: 'path/', src: ['**'], dest: 'dest/'},

          // flattens results to a single level
          //{expand: true, flatten: true, src: ['path/**'], dest: 'dest/', filter: 'isFile'},
        ],
      },
    }
  });

  grunt.loadNpmTasks('grunt-contrib-htmlmin');
  grunt.loadNpmTasks('grunt-contrib-copy');

  grunt.registerTask('default', ['htmlmin', 'copy']);
  grunt.registerTask('publish', ['htmlmin:release', 'copy:release']);
  grunt.registerTask('test', ['htmlmin:test', 'copy:test']);

};
