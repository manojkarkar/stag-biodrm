!function(n){function o(t){if(e[t])return e[t].exports;var i=e[t]={i:t,l:!1,exports:{}};return n[t].call(i.exports,i,i.exports,o),i.l=!0,i.exports}var e={};o.m=n,o.c=e,o.d=function(n,e,t){o.o(n,e)||Object.defineProperty(n,e,{configurable:!1,enumerable:!0,get:t})},o.n=function(n){var e=n&&n.__esModule?function(){return n.default}:function(){return n};return o.d(e,"a",e),e},o.o=function(n,o){return Object.prototype.hasOwnProperty.call(n,o)},o.p="/wp-content/themes/thegem/",o(o.s=26)}({26:function(n,o,e){n.exports=e(27)},27:function(n,o,e){"use strict";function t(n){return-1!==m.indexOf(n)}function i(n){return p.className.match(new RegExp(n,"i"))}function r(n){var o=null;i(n)||(o=p.className.replace(/^\s+|\s+$/g,""),p.className=o+" "+n)}function a(n){i(n)&&(p.className=p.className.replace(" "+n,""))}function d(){f.landscape()?(a("portrait"),r("landscape"),c("landscape")):(a("landscape"),r("portrait"),c("portrait")),l()}function c(n){for(var o in w)w[o](n)}function u(n){for(var o=0;o<n.length;o++)if(f[n[o]]())return n[o];return"unknown"}function l(){f.orientation=u(["portrait","landscape"])}Object.defineProperty(o,"__esModule",{value:!0});var s="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(n){return typeof n}:function(n){return n&&"function"==typeof Symbol&&n.constructor===Symbol&&n!==Symbol.prototype?"symbol":typeof n},b=window.device,f={},w=[];window.device=f;var p=window.document.documentElement,m=window.navigator.userAgent.toLowerCase(),h=["googletv","viera","smarttv","internet.tv","netcast","nettv","appletv","boxee","kylo","roku","dlnadoc","roku","pov_tv","hbbtv","ce-html"];f.macos=function(){return t("mac")},f.ios=function(){return f.iphone()||f.ipod()||f.ipad()},f.iphone=function(){return!f.windows()&&t("iphone")},f.ipod=function(){return t("ipod")},f.ipad=function(){return t("ipad")},f.android=function(){return!f.windows()&&t("android")},f.androidPhone=function(){return f.android()&&t("mobile")},f.androidTablet=function(){return f.android()&&!t("mobile")},f.blackberry=function(){return t("blackberry")||t("bb10")||t("rim")},f.blackberryPhone=function(){return f.blackberry()&&!t("tablet")},f.blackberryTablet=function(){return f.blackberry()&&t("tablet")},f.windows=function(){return t("windows")},f.windowsPhone=function(){return f.windows()&&t("phone")},f.windowsTablet=function(){return f.windows()&&t("touch")&&!f.windowsPhone()},f.fxos=function(){return(t("(mobile")||t("(tablet"))&&t(" rv:")},f.fxosPhone=function(){return f.fxos()&&t("mobile")},f.fxosTablet=function(){return f.fxos()&&t("tablet")},f.meego=function(){return t("meego")},f.cordova=function(){return window.cordova&&"file:"===location.protocol},f.nodeWebkit=function(){return"object"===s(window.process)},f.mobile=function(){return f.androidPhone()||f.iphone()||f.ipod()||f.windowsPhone()||f.blackberryPhone()||f.fxosPhone()||f.meego()},f.tablet=function(){return f.ipad()||f.androidTablet()||f.blackberryTablet()||f.windowsTablet()||f.fxosTablet()},f.desktop=function(){return!f.tablet()&&!f.mobile()},f.television=function(){for(var n=0;n<h.length;){if(t(h[n]))return!0;n++}return!1},f.portrait=function(){return window.innerHeight/window.innerWidth>1},f.landscape=function(){return window.innerHeight/window.innerWidth<1},f.noConflict=function(){return window.device=b,this},f.ios()?f.ipad()?r("ios ipad tablet"):f.iphone()?r("ios iphone mobile"):f.ipod()&&r("ios ipod mobile"):f.macos()?r("macos desktop"):f.android()?r(f.androidTablet()?"android tablet":"android mobile"):f.blackberry()?r(f.blackberryTablet()?"blackberry tablet":"blackberry mobile"):f.windows()?r(f.windowsTablet()?"windows tablet":f.windowsPhone()?"windows mobile":"windows desktop"):f.fxos()?r(f.fxosTablet()?"fxos tablet":"fxos mobile"):f.meego()?r("meego mobile"):f.nodeWebkit()?r("node-webkit"):f.television()?r("television"):f.desktop()&&r("desktop"),f.cordova()&&r("cordova"),f.onChangeOrientation=function(n){"function"==typeof n&&w.push(n)};var v="resize";Object.prototype.hasOwnProperty.call(window,"onorientationchange")&&(v="onorientationchange"),window.addEventListener?window.addEventListener(v,d,!1):window.attachEvent?window.attachEvent(v,d):window[v]=d,d(),f.type=u(["mobile","tablet","desktop"]),f.os=u(["ios","iphone","ipad","ipod","android","blackberry","windows","fxos","meego","television"]),l(),o.default=f}});