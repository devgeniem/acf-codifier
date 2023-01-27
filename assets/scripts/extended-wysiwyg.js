(function( $, undefined ){
    var Field = acf.models.WysiwygField.extend({
        type: 'extended_wysiwyg',
    });

	acf.registerFieldType( Field );

})(jQuery);
