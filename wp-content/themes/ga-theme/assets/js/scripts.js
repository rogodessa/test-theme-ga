(function($){
    const genreFilter = {
        select: $('.genre-select'),
        parent: null,
        filter: function(genre) {
            let list = genreFilter.parent.find('.album-item');
            if('all' === genre) {
                list.removeClass('d-none');
            }
            else {
                list.addClass('d-none');
                genreFilter.parent.find('.album-item[data-genre="'+ genre +'"]').removeClass('d-none');
            }
        },
        init: function(){
            if(genreFilter.select.length) {
                genreFilter.select.on('change', function(){
                    genreFilter.parent = $(this).closest('.genre-filter');
                    genreFilter.filter($(this).val());
                });
            }
        }
    };

    $(document).ready(function(){
        genreFilter.init();
    });
})(jQuery);