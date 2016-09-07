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
          'dist/index.html': 'src/index.html',    // 'destination': 'source'
        }
      },
      test: {
        files: {
          'test/index.html': 'src/index.html',
        }
      }
    },
    copy: {
      main: {
        files: [
          {expand: true, cwd: 'bower_components/bootstrap/dist/', src: ['**'], dest: 'res/'},
          {expand: true, cwd: 'bower_components/jquery/dist/', src: ['**'], dest:'res/js/'},
          {expand: true, cwd: 'res/', src: ['**'], dest:'test/'}
        ],
      },
      release: {
        files: [
          {expand: true, cwd: 'bower_components/bootstrap/dist/', src: ['**'], dest: 'dist/'},
          {expand: true, cwd: 'src/', src: ['**'], dest: 'dist/'},
          {expand: true, cwd: 'bower_components/jquery/dist/', src: ['**'], dest:'dist/js/'}
          //{expand: true, flatten: true, src: ['path/**'], dest: 'dest/', filter: 'isFile'},
        ],
      },
      test: {
        files: [

          {expand: true, cwd: 'res/', src: ['**'], dest:'test/'}
        ],
      },
    },
    watch: {
      options: {
      livereload: true,
      },
      src: {
        files: ['src/**'],
        tasks: ['publish'],
      },
    }
  });

// Load Tasks
  grunt.loadNpmTasks('grunt-contrib-htmlmin');
  grunt.loadNpmTasks('grunt-contrib-copy');
  grunt.loadNpmTasks('grunt-contrib-watch');

// Register Tasks
  grunt.registerTask('default', ['htmlmin', 'copy']);
  grunt.registerTask('publish', ['htmlmin:release', 'copy:release']);
  grunt.registerTask('test', ['htmlmin:test', 'copy:test']);
  grunt.registerTask('devmode', ['default',]);

};
