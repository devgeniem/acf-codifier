(function( $, undefined ){
    var Field = acf.models.TaxonomyField.extend({
        type: 'multisite_post_object',
    });

	acf.registerFieldType( Field );

})(jQuery);
