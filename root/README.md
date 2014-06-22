#### Tools that needs to be installed once
1. Install [NodeJS](http://nodejs.org/);
2. Install [Ruby](https://www.ruby-lang.org/en/downloads/). Windows users can download latest version from [rubyinstaller site](http://rubyinstaller.org/downloads/);
3. Install [Python 2.x](http://www.python.org/download/releases/2.7.6/) (for sprites generators);
4. Install [ImageMagick](http://www.imagemagick.org/script/binary-releases.php);
5. Install latest [SASS](http://sass-lang.com) by running `gem install sass --pre` in console;
6. (optional) Install [CSSCSS](http://zmoazeni.github.io/csscss/)
7. Install [Grunt](http://gruntjs.com/) by running `npm install -g grunt-cli`

#### How to use?
You need to init the project inside of `wp-content` folder (remove all files within this folder then run `grunt-init ntz-wp`). After that, all commands needs to be ran inside of `wp-content/themes/project_name/assets`.

#### Commands that needs to be run for the first time on every project
1. `npm update --save-dev` to get latest version of all Grunt plugins;
2. `npm install`. If you have both Python 3.x and Python 2.x installed you need to run `npm install --python=c:\python27` (you need to change the path accordingly);
3. That's it.


#### List All Available Commands
`grunt` will run all tasks. For development, you should run `grunt dev` which is an alias for `grunt` and `grunt watch`. For a completely list of tasks, please run `grunt --help`




#### Useful Tools
1. [Git](http://git-scm.com)
2. [Git Flow](https://github.com/nvie/gitflow)


#### For Windows Users
1. [Gow](https://github.com/bmatzelle/gow/wiki)
2. [Conemu](http://conemu-maximus5.googlecode.com/)
3. [Rapid Environment Editor](http://www.rapidee.com/en/download)