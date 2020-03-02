'use strict';

miniShop2.plugin.ms2Collection = {
    //Product form
    getFields: function (config) {
        return {
            ms2collection_parent_id: {xtype: 'hidden', decimalPrecision: 0, description: '<b>[[+ms2collection_parent_id]]</b>'}
        }
    },

    //Products grid
    getColumns: function () {
        return {}
    }
};
