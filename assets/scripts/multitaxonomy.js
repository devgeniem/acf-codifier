(function( $, undefined ){
    var Field = acf.models.TaxonomyField.extend({
        type: 'multitaxonomy',
    });

	acf.registerFieldType( Field );

})(jQuery);
