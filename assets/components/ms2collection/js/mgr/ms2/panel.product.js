'use strict';

Ext.namespace('ms2Collection.extend.panel');

Ext.ComponentMgr.onAvailable('minishop2-product-tabs', function () {
    this.on('beforerender', function () {
        let panel = Ext.getCmp('modx-panel-resource');
        let productFields = panel.getAllProductFields(panel);
        let field = miniShop2.utils.getExtField(panel, 'ms2collection_parent_id', productFields['ms2collection_parent_id'])
        miniShop2.config.extra_fields.push('ms2collection_parent_id');
        Ext.getCmp('minishop2-product-data').add(field);

        if (!ms2Collection.config.collection_parent_id) {
            this.add({
                title: _('ms2collection_collection'),
                xtype: 'ms2collection-extend-panel-product',
                record_id: ms2Collection.config.record_id,
                parent_id: ms2Collection.config.parent_id,
            });
        }
    });
});

ms2Collection.extend.panel.product = function (config) {
    config = config || {};
    if (!config.id) {
        config.id = 'ms2collection-extend-panel-product';
    }
    Ext.applyIf(config, {
        items: [
            ms2Collection.component.panelDescription(_('ms2collection_collection_desc')),
            MODx.PanelSpacer,
            this.getGrid(config),
        ],
    });
    ms2Collection.extend.panel.product.superclass.constructor.call(this, config);
};
Ext.extend(ms2Collection.extend.panel.product, MODx.Panel, {
    record_id: 0,
    parent_id: 0,

    initComponent: function () {
        ms2Collection.extend.panel.product.superclass.initComponent.call(this);
    },

    getGrid: function (config) {
        if (!config.record_id) {
            return ms2Collection.component.notice(_('ms2collection_undefined'));
        }
        return {
            xtype: 'ms2collection-grid-product',
            ms2collection_parent_id: config.record_id,
            parent_id: config.parent_id,
            cls: 'main-wrapper'
        };
    }
});
Ext.reg('ms2collection-extend-panel-product', ms2Collection.extend.panel.product);
