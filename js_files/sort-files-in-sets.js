$(function() {

    var sortFilesInSets = (function ($, window, document, undefined) {

        var htmlContainer = $('#sort-files-in-sets');

        var filterByName = function() {

            var searchedPhrase = $(this).val().toLowerCase();

            $('.js-file-set').each(function(index) {

                var fileSetName = $(this).attr('data-file-set-name').toLowerCase();

                if (fileSetName.indexOf(searchedPhrase) >= 0) {

                    $(this).show();

                    $('.js-file-set').unmark({
                        done: function() {
                            $('.js-file-set').mark(searchedPhrase);
                        }
                    });

                } else {

                    $(this).hide();

                }

            });

        };

        var toggleAllVisible = function() {

            if ($(this).prop('checked')) {

                $('.js-file-set-input').each(function () {
                    if ($(this).is(':visible')) {
                        $(this).prop('checked', true).trigger('change');
                    }
                });

            } else {

                $('.js-file-set-input').each(function () {
                    if ($(this).is(':visible')) {
                        $(this).prop('checked', false).trigger('change');
                    }
                });

            }

        };

        var bindFunctions = function() {
            htmlContainer.on('input',  '#filterByName',     filterByName);
            htmlContainer.on('change', '#toggleAllVisible', toggleAllVisible);
        };

        var init = function() {
            bindFunctions();
        };

        return {
            init: init
        };

    })(jQuery, window, document);

    sortFilesInSets.init();

});