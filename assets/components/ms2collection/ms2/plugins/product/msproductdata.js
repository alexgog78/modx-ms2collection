'use strict';

miniShop2.plugin.ms2Collection = {
    //Product form
    getFields: function (config) {
        return {
            collection_parent_id: {xtype: 'hidden', decimalPrecision: 0, description: '<b>[[+collection_parent_id]]</b>'}
        }
    },

    //Products grid
    getColumns: function () {
        return {}
    }
};
