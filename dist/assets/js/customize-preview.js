!function(e){var t={};function n(o){if(t[o])return t[o].exports;var r=t[o]={i:o,l:!1,exports:{}};return e[o].call(r.exports,r,r.exports,n),r.l=!0,r.exports}n.m=e,n.c=t,n.d=function(e,t,o){n.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:o})},n.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},n.t=function(e,t){if(1&t&&(e=n(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var o=Object.create(null);if(n.r(o),Object.defineProperty(o,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var r in e)n.d(o,r,function(t){return e[t]}.bind(null,r));return o},n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,"a",t),t},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.p="",n(n.s=6)}([function(e,t){e.exports=jQuery},,,,,,function(e,t,n){e.exports=n(7)},function(e,t,n){"use strict";var o=u(n(0)),r=u(n(8));function u(e){return e&&e.__esModule?e:{default:e}}wp.customize("blogname",function(e){e.bind(function(e){(0,o.default)(".main-header__blogname").html(e)})}),wp.customize("_themename_display_author_info",function(e){e.bind(function(e){console.log(e),e?(0,o.default)(".post-author").show():(0,o.default)(".post-author").hide()})}),wp.customize("_themename_site_info",function(e){e.bind(function(e){(0,o.default)(".site-info__text").html((0,r.default)(e,"<a>"))})})},function(e,t,n){"use strict";Object.defineProperty(t,"__esModule",{value:!0});t.default=function(e,t){t=(((t||"")+"").toLowerCase().match(/<[a-z][a-z0-9]*>/g)||[]).join("");return e.replace(/<!--[\s\S]*?-->|<\?(?:php)?[\s\S]*?\?>/gi,"").replace(/<\/?([a-z][a-z0-9]*)\b[^>]*>/gi,function(e,n){return t.indexOf("<"+n.toLowerCase()+">")>-1?e:""})}}]);