'use strict';

ms2Collection.grid.product = function (config) {
    config = config || {};
    if (!config.id) {
        config.id = 'ms2collection-grid-product';
    }
    Ext.applyIf(config, {
        url: ms2Collection.config.connectorUrl,
        baseParams: {
            action: 'mgr/product/getlist',
            collection_parent_id: config.collection_parent_id,
        },
        save_action: 'mgr/product/updatefromgrid',
    });
    ms2Collection.grid.product.superclass.constructor.call(this, config);
};
Ext.extend(ms2Collection.grid.product, miniShop2.grid.Products, {
    getTopBar: function () {
        return [{
            text: '<i class="icon icon-tag"></i> ' + _('ms2_product_create'),
            handler: this.createProduct,
            scope: this
        }, '->', this.getSearchField()];
    },

    createProduct: function () {
        MODx.loadPage('resource/create', 'class_key=msProduct&parent=' + this.config.parent_id + '&collection_parent_id=' + this.config.collection_parent_id + '&context_key=' + MODx.ctx);
    }
});
Ext.reg('ms2collection-grid-product', ms2Collection.grid.product);
