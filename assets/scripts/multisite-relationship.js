(function( $, undefined ){
    var Field = acf.models.RelationshipField.extend({
        type: 'multisite_relationship',

        getAjaxData: function() {
			// load data based on element attributes
			var ajaxData = this.$control().data();
			for( var name in ajaxData ) {
				ajaxData[ name ] = this.get( name );
			}

			// extra
			ajaxData.action = 'acf/fields/multisite_relationship/query';
			ajaxData.field_key = this.get('key');

			// Filter.
			ajaxData = acf.applyFilters( 'relationship_ajax_data', ajaxData, this );

			// return
			return ajaxData;
		}
    });

	acf.registerFieldType( Field );

})(jQuery);