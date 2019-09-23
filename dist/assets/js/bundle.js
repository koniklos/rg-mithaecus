!function(t){var e={};function n(a){if(e[a])return e[a].exports;var i=e[a]={i:a,l:!1,exports:{}};return t[a].call(i.exports,i,i.exports,n),i.l=!0,i.exports}n.m=t,n.c=e,n.d=function(t,e,a){n.o(t,e)||Object.defineProperty(t,e,{enumerable:!0,get:a})},n.r=function(t){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(t,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(t,"__esModule",{value:!0})},n.t=function(t,e){if(1&e&&(t=n(t)),8&e)return t;if(4&e&&"object"==typeof t&&t&&t.__esModule)return t;var a=Object.create(null);if(n.r(a),Object.defineProperty(a,"default",{enumerable:!0,value:t}),2&e&&"string"!=typeof t)for(var i in t)n.d(a,i,function(e){return t[e]}.bind(null,i));return a},n.n=function(t){var e=t&&t.__esModule?function(){return t.default}:function(){return t};return n.d(e,"a",e),e},n.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},n.p="",n(n.s=1)}([function(t,e){t.exports=jQuery},function(t,e,n){t.exports=n(2)},function(t,e,n){"use strict";var a,i=n(0);(a=i)&&a.__esModule;n(3),n(4),n(5)},function(t,e,n){"use strict";!function(){function t(t,e,n,a){return 1>(t/=a/2)?n/2*t*t*t*t+e:-n/2*((t-=2)*t*t*t-2)+e}function e(t){return t?[1,0]:[0,1]}function n(t){this.element=t,this.svg=function t(e){var n=e.parentNode;return"svg"!==n.tagName&&(n=t(n)),n}(this.element),this.getSize(),this.states=this.element.querySelectorAll(".js-transition-icon__state"),this.time={start:null,total:200},this.status={interacted:!1,animating:!1},this.animation={effect:this.element.getAttribute("data-effect"),event:this.element.getAttribute("data-event")},this.init()}if(!window.requestAnimationFrame){var a=null;window.requestAnimationFrame=function(t,e){var n=(new Date).getTime();a||(a=n);var i=Math.max(0,16-(n-a)),r=window.setTimeout(function(){t(n+i)},i);return a=n+i,r}}n.prototype.getSize=function(){var t=this.svg.getAttribute("viewBox");this.size=t?{width:t.split(" ")[2],height:t.split(" ")[3]}:this.svg.getBoundingClientRect()},n.prototype.init=function(){var t=this;this.svg.addEventListener(t.animation.event,function(){t.status.animating||(t.status.animating=!0,window.requestAnimationFrame(t.triggerAnimation.bind(t)))})},n.prototype.triggerAnimation=function(t){var e=this.getProgress(t);this.animateIcon(e),this.checkProgress(e)},n.prototype.getProgress=function(t){return this.time.start||(this.time.start=t),t-this.time.start},n.prototype.checkProgress=function(t){if(this.time.total>t)window.requestAnimationFrame(this.triggerAnimation.bind(this));else{this.status={interacted:!this.status.interacted,animating:!1},this.time.start=null;var n=e(this.status.interacted);this.states[n[0]].removeAttribute("aria-hidden"),this.states[n[1]].setAttribute("aria-hidden","true")}},n.prototype.animateIcon=function(t){t>this.time.total&&(t=this.time.total),0>t&&(t=0);var n=e(this.status.interacted);this.states[n[0]].style.display=t>this.time.total/2?"none":"block",this.states[n[1]].style.display=t>this.time.total/2?"block":"none","scale"==this.animation.effect?this.scaleIcon(t,n[0],n[1]):this.rotateIcon(t,n[0],n[1])},n.prototype.scaleIcon=function(e,n,a){var i=t(Math.min(e,this.time.total/2),1,-.2,this.time.total/2).toFixed(2),r=t(Math.max(e-this.time.total/2,0),.2,-.2,this.time.total/2).toFixed(2);this.states[n].setAttribute("transform","translate("+this.size.width*(1-i)/2+" "+this.size.height*(1-i)/2+") scale("+i+")"),this.states[a].setAttribute("transform","translate("+this.size.width*r/2+" "+this.size.height*r/2+") scale("+(1-r)+")")},n.prototype.rotateIcon=function(e,n,a){var i=t(e,0,180,this.time.total).toFixed(2);this.states[n].setAttribute("transform","rotate(-"+i+" "+this.size.width/2+" "+this.size.height/2+")"),this.states[a].setAttribute("transform","rotate("+(180-i)+" "+this.size.width/2+" "+this.size.height/2+")")};var i=document.querySelectorAll(".js-transition-icon");if(i)for(var r=0;i.length>r;r++)new n(i[r])}()},function(t,e,n){"use strict";var a,i=n(0),r=(a=i)&&a.__esModule?a:{default:a};var s=function(t){t.preventDefault(),t.stopPropagation();var e=(0,r.default)(t.currentTarget),n=e.parent(),a=n.parent();a.hasClass("open")?(a.add(a.find(".menu-item.open")).removeClass("open"),n.add(a.find("a")).attr("aria-expanded","false"),e.find(".menu-button-show").attr("aria-hidden",!1),e.find(".menu-button-hide").attr("aria-hidden",!0)):(a.siblings(".open").find("> a > .menu-button").trigger("click"),a.addClass("open"),n.attr("aria-expanded","true"),e.find(".menu-button-show").attr("aria-hidden",!0),e.find(".menu-button-hide").attr("aria-hidden",!1))},o=function(){(0,r.default)(".navbar__main").hasClass("navbar__main--active")&&(0,r.default)(".navbar__toggle").trigger("click")},u=function(t){var e=(0,r.default)(t.currentTarget).hasClass("open");(0,r.default)(t.currentTarget).toggleClass("open"),(0,r.default)(t.currentTarget).attr("aria-expanded",!e)};(0,r.default)(".navbar__toggle").on("click",function(t){t.preventDefault(),t.stopPropagation(),u(t),(0,r.default)(".navbar__main .menu-item").removeClass("open"),(0,r.default)(".menu").toggleClass("open small"),(0,r.default)(".navbar__main").toggleClass("navbar__main--active navbar__main--not-active"),(0,r.default)(".navbar").toggleClass("navbar--active")}),(0,r.default)(".main-header__wrapper").on("click",".navbar__main.navbar__main--small .menu-button",function(t){s(t)}),(0,r.default)(".main-header__wrapper").on("click",".navbar__main.navbar__main--large .menu-button",function(t){s(t)}),(0,r.default)(".main-header__wrapper").on("mouseenter",".navbar__main--large .menu-item__dropdown",function(t){(0,r.default)(t.currentTarget).parents(".sub-menu").length||(0,r.default)(".menu > .menu-item.open").find("> a > .menu-button").trigger("click"),(0,r.default)(t.currentTarget).addClass("open")}).on("mouseleave",".navbar__main--large .menu-item__dropdown",function(t){(0,r.default)(t.currentTarget).removeClass("open")}),(0,r.default)(".searchbar__toggle").on("click",function(t){t.preventDefault(),t.stopPropagation(),u(t),(0,r.default)("#main-searchbar").toggleClass("open"),(0,r.default)("#main-searchbar .search-form__field").focus()}),(0,r.default)(document).click(function(t){(0,r.default)(".menu-item.open").length&&(0,r.default)(".menu > .menu-item.open > a > .menu-button").trigger("click"),(0,r.default)(".menu.open").hasClass("small")&&(0,r.default)(".navbar__toggle").trigger("click")}),(0,r.default)(window).on("load",function(){var t=0;function e(){var e=window,n="inner";"innerWidth"in window||(n="client",e=document.documentElement||document.body);var a=e[n+"Width"];a<1024?(0,r.default)(".navbar__main").hasClass("navbar__main--large")&&((0,r.default)(".navbar__main").removeClass("navbar__main--large").addClass("navbar__main--small"),(0,r.default)(".navbar__toggle").attr("aria-expanded","false"),(0,r.default)(".navbar__toggle").attr("aria-hidden",!1)):((0,r.default)(".navbar__main").hasClass("navbar__main--small")&&(0,r.default)(".navbar__main").removeClass("navbar__main--small").addClass("navbar__main--large"),(0,r.default)(".navbar__toggle").attr("aria-expanded","true"),(0,r.default)(".navbar__toggle").attr("aria-hidden",!0)),(t=t||a)!==a&&o()}e(),(0,r.default)(window).on("resize",e)})},function(t,e,n){"use strict";document.addEventListener("DOMContentLoaded",function(){var t=[].slice.call(document.querySelectorAll("img.lazy"));if("IntersectionObserver"in window){var e=new IntersectionObserver(function(t){t.forEach(function(t){if(t.isIntersecting){var n=t.target;n.src=n.dataset.src,n.dataset.srcset&&(n.srcset=n.dataset.srcset),n.dataset.sizes&&(n.sizes=n.dataset.sizes),n.classList.remove("lazy"),e.unobserve(n)}})});t.forEach(function(t){e.observe(t)})}else{var n=!1,a=function e(){!1===n&&(n=!0,setTimeout(function(){t.forEach(function(n){n.getBoundingClientRect().top<=window.innerHeight&&0<=n.getBoundingClientRect().bottom&&"none"!==getComputedStyle(n).display&&(n.src=n.dataset.src,n.dataset.srcset&&(n.srcset=n.dataset.srcset),n.dataset.sizes&&(n.sizes=n.dataset.sizes),n.classList.remove("lazy"),0===(t=t.filter(function(t){return t!==n})).length&&(document.removeEventListener("scroll",e),window.removeEventListener("resize",e),window.removeEventListener("orientationchange",e)))}),n=!1},200))};document.addEventListener("scroll",a),window.addEventListener("resize",a),window.addEventListener("orientationchange",a)}})}]);