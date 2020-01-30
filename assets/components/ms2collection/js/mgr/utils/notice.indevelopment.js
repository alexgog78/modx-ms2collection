'use strict';

ms2Collection.notice.indevelopment = function (config) {
    config = config || {};
    Ext.applyIf(config, {});
    ms2Collection.notice.indevelopment.superclass.constructor.call(this, config);
};
Ext.extend(ms2Collection.notice.indevelopment, ms2Collection.notice.abstract, {
    panelHtml: _('ms2collection.field.indevelopment')
});
Ext.reg('ms2collection-notice-indevelopment', ms2Collection.notice.indevelopment);
