(function ($) {
    $('.js-example-basic-single').select2();
    $(".title-tab li:eq(0)").addClass('active');

    $(".content-tab-vali .content-tab").not(':eq(0)').addClass('hide');

    $(".title-tab li a").click(function () {

        var $this = $(this),
            $href = this.hash,
            $tab = $($href),

            $currentTab = $(".content-tab-vali .content-tab:visible");

        $(".title-tab li").removeClass('active');

        $this.parent().addClass('active');

        $currentTab.addClass('hide');

        $tab.removeClass('hide');

        return false;

    });
    $(".title-proppsal .title-tab li:eq(0)").addClass('active');

    $(".content-tab-proposal .content-tab").not(':eq(0)').addClass('hide');

    $(".title-proppsal .title-tab li a").click(function () {

      var $this = $(this),
          $href = this.hash,
          $tab = $($href),

            $currentTab = $(".content-tab-proposal .content-tab:visible");

        $(".title-proppsal .title-tab li").removeClass('active');

        $this.parent().addClass('active');

        $currentTab.addClass('hide');

        $tab.removeClass('hide');

        return false;

    });
    $('.new-cowl').owlCarousel({
        center: true,
        items: 1,
        loop: true,
        margin: 10,
        autoplay: true,
        autoplayTimeout: 3000,
        dots: true
    });
    jQuery(document).ready(function () {
        ImgUpload();
        ImgUploads()
    });

    function ImgUpload() {
        var imgWrap = "";
        var imgArray = [];

        $('.upload__inputfile').each(function () {
            $(this).on('change', function (e) {
                imgWrap = $(this).closest('.upload__box').find('.upload__img-wrap');
                var maxLength = $(this).attr('data-max_length');

                var files = e.target.files;
                var filesArr = Array.prototype.slice.call(files);
                var iterator = 0;
                filesArr.forEach(function (f, index) {

                    if (!f.type.match('image.*')) {
                        return;
                    }

                    if (imgArray.length > maxLength) {
                        return false
                    } else {
                        var len = 0;
                        for (var i = 0; i < imgArray.length; i++) {
                            if (imgArray[i] !== undefined) {
                                len++;
                            }
                        }
                        if (len > maxLength) {
                            return false;
                        } else {
                            imgArray.push(f);

                            var reader = new FileReader();
                            reader.onload = function (e) {
                                var html = "<div class='upload__img-box'><div style='background-image: url(" + e.target.result + ")' data-number='" + $(".upload__img-close").length + "' data-file='" + f.name + "' class='img-bg'><div class='upload__img-close'></div></div></div>";
                                imgWrap.append(html);
                                iterator++;
                            }
                            reader.readAsDataURL(f);
                        }
                    }
                });
            });
        });

        $('body').on('click', ".upload__img-close", function (e) {
            var file = $(this).parent().data("file");
            for (var i = 0; i < imgArray.length; i++) {
                if (imgArray[i].name === file) {
                    imgArray.splice(i, 1);
                    break;
                }
            }
            $(this).parent().parent().remove();
        });
    }

    function ImgUploads() {
        var imgWrap = "";
        var imgArray = [];

        $('.upload__inputfiles').each(function () {
            $(this).on('change', function (e) {
                imgWrap = $(this).closest('.upload__boxs').find('.upload__img-wraps');
                var maxLength = $(this).attr('data-max_length');

      var files = e.target.files;
      var filesArr = Array.prototype.slice.call(files);
      var iterator = 0;
      // filesArr.forEach(function (f, index) {
      //
      //   if (!f.type.match('image.*')) {
      //     return;
      //   }
      //
      //   if (imgArray.length > maxLength) {
      //     return false
      //   } else {
      //     var len = 0;
      //     for (var i = 0; i < imgArray.length; i++) {
      //       if (imgArray[i] !== undefined) {
      //         len++;
      //       }
      //     }
      //     if (len > maxLength) {
      //       return false;
      //     } else {
      //       imgArray.push(f);
      //
      //       var reader = new FileReader();
      //       reader.onload = function (e) {
      //         var html = "<div class='upload-images_input'>" +
      //             "<div class='upload__img-boxs'>" +
      //             "<div style='background-image: url(" + e.target.result + ")' data-number='" + $(".upload__img-close").length + "' data-file='" + f.name + "' class='img-bg'>" +
      //             "<div class='upload__img-close'>" +
      //             "</div>" +
      //             "</div>" +
      //             "<div class='content__input'>" +
      //             "<label>Comment</label>" +
      //             "<input class='form-control comment' name='comment[]' value=' ' type='text' placeholder='comment'/>" +
      //             "</label>" +
      //             "</div>" +
      //             "</div>";
      //         imgWrap.append(html);
      //         iterator++;
      //       }
      //       reader.readAsDataURL(f);
      //     }
      //   }
      // });
    });
  });

        $('body').on('click', ".upload__img-close", function (e) {
            var file = $(this).parent().data("file");
            for (var i = 0; i < imgArray.length; i++) {
                if (imgArray[i].name === file) {
                    imgArray.splice(i, 1);
                    break;
                }
            }
            $(this).parent.parent().parent().remove();
        });
    }
})(jQuery);
