// node release.js
var spawn = require('child_process').spawn;
var releaseFile = 'release/' + Date.now() + '.zip';

var release = spawn('git', [
	'archive',
	'--format',
	'zip',
	'--output',
	releaseFile,
	'dev'
] );



release.on('close', function(code, signal){
	var message =  'ZIP file generated: ' + releaseFile;
	console.log( "\n" );
	console.log( Array( message.length + 1 ).join("=") );
	console.log( message );
	console.log( Array( message.length + 1 ).join("=") );
});
