// add es6 polyfill
import 'core-js/fn/set';
import 'core-js/fn/map';

// HTMLTemplateElement, Promise, Event, CustomEvent, MouseEvent, Object.assign, Array.from and URL constructor
// are polyfilled by webcomponents API
// https://github.com/webcomponents/webcomponentsjs#webcomponentsjs-v1-spec-polyfills

// add webcomponents polyfill
import '@webcomponents/webcomponentsjs/custom-elements-es5-adapter';
import '@webcomponents/webcomponentsjs/webcomponents-bundle';
