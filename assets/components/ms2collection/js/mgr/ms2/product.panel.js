'use strict';

Ext.namespace('ms2Collection.extend');

Ext.ComponentMgr.onAvailable('minishop2-product-tabs', function () {
    this.on('beforerender', function () {
        if (ms2Collection.config.recordCollectionParentId) {
            return;
        }
        new ms2Collection.extend.product({
            panel: this,
            recordId: ms2Collection.config.recordId,
            parentId: ms2Collection.config.recordParentId,
        });
    });
});

ms2Collection.extend.product = function (config) {
    config = config || {};
    ms2Collection.extend.product.superclass.constructor.call(this, config);
};
Ext.extend(ms2Collection.extend.product, Ext.Component, {
    panel: {},
    recordId: 0,
    parentId: 0,
    html: {},

    initComponent: function () {
        var html = {
            xtype: 'ms2collection-grid-product',
            ms2collection_parent_id: this.recordId,
            parent_id: this.parentId,
            cls: 'main-wrapper'
        };
        if (!this.recordId) {
            html = {xtype: 'ms2collection-notice-undefined'};
        }
        this.html = ms2Collection.function.getPanelMainPart([
            ms2Collection.function.getPanelDescription(_('ms2collection.tab.collection.management')),
            html
        ]);
        this.updatePanel();
    },

    updatePanel: function () {
        this.panel.add({
            title: _('ms2collection.tab.collection'),
            items: this.html
        });
    }
});
