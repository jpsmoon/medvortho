(function ($) {
 // "use strict";
 $('.searcDrop').each(function () {
  $(this).select2({
    theme: 'bootstrap4',
    width: 'style',
    language: {
      noResults: function () {
        return $("<a href='/patients/create/'>Add New Patient</a>");
    }
  },
    placeholder: $(this).attr('placeholder'),
    allowClear: Boolean($(this).data('allow-clear')),
  });
});

})(jQuery);
