module.exports = function(grunt) {
    var path = 'src/';
    var dist = 'src/public/dist/';
    var brand = 'adventurecamp';

    grunt.initConfig({
        pkg: grunt.file.readJSON('composer.json'),
        watch: {
          concat: {
              files: [path + 'app/*.js', path + 'app/**/*.js', path + 'less/*.less'],
              tasks: ['concat', 'less']
          }
        },
        less: {
            development: {
                options: {
                    paths: ['./src/less'],
                    yuicompress: true
                },
                files: {
                    //path + 'public/dist/gui.css':  path + 'less/boot.less'
                    './src/public/dist/adventurecamp.css': './src/less/boot.less'
                }
            }
        },
        concat: {
                options: {

                },
                controllers: {
                        dest: dist + brand + '.js',
                        src: [
                                path + 'app/module.js',
                                path + 'app/**/module.js',
                                path + 'app/**/*.js',
                                path + 'app/tests/*.!js'
                                ]
                }
        }
    });
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-less');
    grunt.registerTask('default', ['concat', 'less']);
};