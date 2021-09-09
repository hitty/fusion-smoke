jQuery(document).ready(function(){
    /**
     * Form managment
     */

    jQuery('.chapter-item.with-gallery').each( function(){
        let handle;
        typeof
            jQuery(this).mouseenter( function(){
                handle = setInterval( changePic, 1500, jQuery( this ) );
            }).mouseleave(function( ){
                clearInterval(handle);
                handle = 0;
            });
    });


});
function changePic (parent){
    let img = jQuery('.chapter-image.is-active', parent );
    let next = img.next();
    if( next.length == 0 ) next = jQuery('.chapter-image:first', parent )
    img.removeClass('is-active');
    next.addClass('is-active');
}