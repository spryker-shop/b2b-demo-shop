declare function require(moduleName: string): any;

// add es6 polyfill
import 'core-js/fn/promise';
import 'core-js/fn/array';
import 'core-js/fn/set';
import 'core-js/fn/map';

// HTMLTemplateElement, Event, CustomEvent, MouseEvent, Object.assign, Array.from and URL constructor
// are polyfilled by webcomponents API
// https://github.com/webcomponents/webcomponentsjs#webcomponentsjs-v1-spec-polyfills

// if webcomponents are defined as native
// a es5 compile shim is required
if (!!window.customElements) {
    import(/* webpackMode: "eager" */'@webcomponents/webcomponentsjs/custom-elements-es5-adapter');
}

// add webcomponents polyfill
require('@webcomponents/webcomponentsjs/webcomponents-bundle');
