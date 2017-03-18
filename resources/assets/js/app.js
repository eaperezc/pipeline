
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will include the javascript files that we want to have on this main
 * app.js file. This should be only the global javascript files we want to have
 * everywhere. But in this case is only the PipelineDiagram.js
 */

require('./network/PipelineDiagram.js');
