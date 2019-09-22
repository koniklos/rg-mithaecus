// https://blog.nucleoapp.com/create-2-state-svg-powered-animated-icons-76ed19160a7e

!(function() {
  // https://github.com/danro/jquery-easing/blob/master/jquery.easing.js//
  function easeInOutQuart(t, b, c, d) {
    return 1 > (t = t / (d / 2))
      ? (c / 2) * t * t * t * t + b
      : (-c / 2) * ((t = t - 2) * t * t * t - 2) + b;
  }

  function getStatusIndex(interacted) {
    return interacted ? [1, 0] : [0, 1];
  }

  function TransitionIcon(element) {
    this.element = element;
    this.svg = (function callback(box) {
      var target = box.parentNode;
      if (target.tagName !== "svg") {
        target = callback(target);
      }
      return target;
    })(this.element);
    this.getSize();
    this.states = this.element.querySelectorAll(".js-transition-icon__state");
    this.time = { start: null, total: 200 };
    this.status = { interacted: false, animating: false };
    this.animation = {
      effect: this.element.getAttribute("data-effect"),
      event: this.element.getAttribute("data-event")
    };
    this.init();
  }

  if (!window.requestAnimationFrame) {
    // requestAnimationFrame polyfill
    // https://gist.github.com/paulirish/1579671/19b7f94bdba2a98227ebb1787b246a647e146e9f
    var lastTime = null;

    window.requestAnimationFrame = function(callback, element) {
      var currTime = new Date().getTime();
      if (!lastTime) {
        lastTime = currTime;
      }

      var timeToCall = Math.max(0, 16 - (currTime - lastTime));
      var id = window.setTimeout(function() {
        callback(currTime + timeToCall);
      }, timeToCall);
      return (lastTime = currTime + timeToCall), id;
    };
  }

  TransitionIcon.prototype.getSize = function() {
    var size = this.svg.getAttribute("viewBox");
    this.size = size
      ? {
          width: size.split(" ")[2],
          height: size.split(" ")[3]
        }
      : this.svg.getBoundingClientRect();
  };

  TransitionIcon.prototype.init = function() {
    var self = this;
    this.svg.addEventListener(self.animation.event, function() {
      if (!self.status.animating) {
        /** @type {boolean} */
        self.status.animating = true;
        window.requestAnimationFrame(self.triggerAnimation.bind(self));
      }
    });
  };

  TransitionIcon.prototype.triggerAnimation = function(timestamp) {
    var progress = this.getProgress(timestamp);
    this.animateIcon(progress);
    this.checkProgress(progress);
  };

  TransitionIcon.prototype.getProgress = function(timestamp) {
    return (
      this.time.start || (this.time.start = timestamp),
      timestamp - this.time.start
    );
  };

  TransitionIcon.prototype.checkProgress = function(progress) {
    // check if animation is complete
    var self = this;

    if (this.time.total > progress) {
      // animation is not over - start new animation loop
      window.requestAnimationFrame(self.triggerAnimation.bind(self));
    } else {
      // animation is over - update object properties and group aria attributes
      this.status = {
        interacted: !this.status.interacted,
        animating: false
      };
      this.time.start = null;
      var index = getStatusIndex(this.status.interacted);
      this.states[index[0]].removeAttribute("aria-hidden");
      this.states[index[1]].setAttribute("aria-hidden", "true");
    }
  };

  TransitionIcon.prototype.animateIcon = function(progress) {
    if (progress > this.time.total) {
      progress = this.time.total;
    }

    if (0 > progress) {
      progress = 0;
    }

    var index = getStatusIndex(this.status.interacted);

    this.states[index[0]].style.display =
      progress > this.time.total / 2 ? "none" : "block";
    this.states[index[1]].style.display =
      progress > this.time.total / 2 ? "block" : "none";

    if ("scale" == this.animation.effect) {
      this.scaleIcon(progress, index[0], index[1]);
    } else {
      this.rotateIcon(progress, index[0], index[1]);
    }
  };

  TransitionIcon.prototype.scaleIcon = function(progress, i, j) {
    var scale1 = easeInOutQuart(
      Math.min(progress, this.time.total / 2),
      1,
      -0.2,
      this.time.total / 2
    ).toFixed(2);
    var scale2 = easeInOutQuart(
      Math.max(progress - this.time.total / 2, 0),
      0.2,
      -0.2,
      this.time.total / 2
    ).toFixed(2);

    this.states[i].setAttribute(
      "transform",
      "translate(" +
        (this.size.width * (1 - scale1)) / 2 +
        " " +
        (this.size.height * (1 - scale1)) / 2 +
        ") scale(" +
        scale1 +
        ")"
    );
    this.states[j].setAttribute(
      "transform",
      "translate(" +
        (this.size.width * scale2) / 2 +
        " " +
        (this.size.height * scale2) / 2 +
        ") scale(" +
        (1 - scale2) +
        ")"
    );
  };

  TransitionIcon.prototype.rotateIcon = function(progress, i, j) {
    var rotate1 = easeInOutQuart(progress, 0, 180, this.time.total).toFixed(2);
    this.states[i].setAttribute(
      "transform",
      "rotate(-" +
        rotate1 +
        " " +
        this.size.width / 2 +
        " " +
        this.size.height / 2 +
        ")"
    );
    this.states[j].setAttribute(
      "transform",
      "rotate(" +
        (180 - rotate1) +
        " " +
        this.size.width / 2 +
        " " +
        this.size.height / 2 +
        ")"
    );
  };

  var transitionIcons = document.querySelectorAll(".js-transition-icon");
  if (transitionIcons) {
    for (var i = 0; transitionIcons.length > i; i++) {
      new TransitionIcon(transitionIcons[i]);
    }
  }
})();
