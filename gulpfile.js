var elixir = require('laravel-elixir');
var cocktail = require('asset-cocktail');
var gulp = require('gulp');

function build(source, build) {
    return function() {
        return cocktail(source, build);
    }
}

var argv = require('minimist')(process.argv.slice(2), {
    string: 'theme',
    default: {
        theme: 'default'
    }
});

var theme = argv.theme;

gulp.task('general', build('resources/assets', 'public/build'));

gulp.task('themes', build('resources/themes/' + theme + '/assets', 'public/theme'));

gulp.task('default', ['general', 'themes']);
