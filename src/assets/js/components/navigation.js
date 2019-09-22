import $ from "jquery";

const toggleMenuButton = e => {
  e.preventDefault();
  e.stopPropagation();
  let menuButton = $(e.currentTarget);
  let menuLink = menuButton.parent();
  let menuItem = menuLink.parent();

  if (menuItem.hasClass("open")) {
    menuItem.add(menuItem.find(".menu-item.open")).removeClass("open");
    menuLink.add(menuItem.find("a")).attr("aria-expanded", "false");
    menuButton.find(".menu-button-show").attr("aria-hidden", false);
    menuButton.find(".menu-button-hide").attr("aria-hidden", true);
  } else {
    menuItem
      .siblings(".open")
      .find("> a > .menu-button")
      .trigger("click");
    menuItem.addClass("open");
    menuLink.attr("aria-expanded", "true");
    menuButton.find(".menu-button-show").attr("aria-hidden", true);
    menuButton.find(".menu-button-hide").attr("aria-hidden", false);
  }
};

const closeNavBar = () => {
  if ($(".navbar__main").hasClass("navbar__main--active")) {
    // $(".navbar__main .menu-item").removeClass("open");
    $(".navbar__toggle").trigger("click");
  }
};

$(".navbar__toggle").on("click", e => {
  e.preventDefault();
  e.stopPropagation();
  $(e.currentTarget).toggleClass("is-active");
  $(".navbar__main .menu-item").removeClass("open");
  $(".menu").toggleClass("open small");
  $(".navbar__main").toggleClass(
    "navbar__main--active navbar__main--not-active"
  );
  $(".navbar").toggleClass("navbar--active");
});

$(".main-header__wrapper").on(
  "click",
  ".navbar__main.navbar__main--small .menu-button",
  e => {
    toggleMenuButton(e);
  }
);

$(".main-header__wrapper").on(
  "click",
  ".navbar__main.navbar__main--large .menu-button",
  e => {
    toggleMenuButton(e);
  }
);

$(".main-header__wrapper")
  .on("mouseenter", ".navbar__main--large .menu-item__dropdown", e => {
    if (!$(e.currentTarget).parents(".sub-menu").length) {
      // Item not in sub-menu
      $(".menu > .menu-item.open")
        .find("> a > .menu-button")
        .trigger("click");
    }
    // console.log("h");
    $(e.currentTarget).addClass("open");
  })
  .on("mouseleave", ".navbar__main--large .menu-item__dropdown", e => {
    $(e.currentTarget).removeClass("open");
  });

$(".searchbar__toggle").on("click", () => {
  $(".main-header__searchbar").toggleClass("open");
  $(".main-header__searchbar .search-form__field").focus();
});

$(document).click(e => {
  if ($(".menu-item.open").length) {
    $(".menu > .menu-item.open > a > .menu-button").trigger("click");
  }

  if ($(".menu.open").hasClass("small")) {
    $(".navbar__toggle").trigger("click");
  }
});

$(window).on("load", function() {
  let prevSize = 0;

  function windowSizes() {
    let e = window,
      a = "inner";
    if (!("innerWidth" in window)) {
      a = "client";
      e = document.documentElement || document.body;
    }

    let windowSize = e[a + "Width"];

    if (windowSize < 1024) {
      if ($(".navbar__main").hasClass("navbar__main--large")) {
        $(".navbar__main")
          .removeClass("navbar__main--large")
          .addClass("navbar__main--small");
        // $(".navbar__main .menu-item").removeClass("open");
      }
    } else {
      if ($(".navbar__main").hasClass("navbar__main--small")) {
        $(".navbar__main")
          .removeClass("navbar__main--small")
          .addClass("navbar__main--large");
        // $(".navbar__main .menu-item").removeClass("open");
      }
    }

    prevSize = !prevSize ? windowSize : prevSize;

    if (prevSize !== windowSize) closeNavBar();
  }

  windowSizes();

  $(window).on("resize", windowSizes);
});
