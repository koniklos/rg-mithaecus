import $ from "jquery";
import stripTags from "./helpers/strip-tags";

wp.customize("blogname", value => {
  value.bind(to => {
    $(".main-header__blogname").html(to);
  });
});

wp.customize("_themename_display_author_info", value => {
  value.bind(to => {
    console.log(to);
    if (to) {
      $(".post-author").show();
    } else {
      $(".post-author").hide();
    }
  });
});

wp.customize("_themename_site_info", value => {
  value.bind(to => {
    $(".site-info__text").html(stripTags(to, "<a>"));
  });
});
