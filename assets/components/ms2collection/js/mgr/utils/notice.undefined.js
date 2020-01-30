'use strict';

ms2Collection.notice.undefined = function (config) {
    config = config || {};
    Ext.applyIf(config, {});
    ms2Collection.notice.undefined.superclass.constructor.call(this, config);
};
Ext.extend(ms2Collection.notice.undefined, ms2Collection.notice.abstract, {
    panelHtml: _('ms2collection.field.undefined')
});
Ext.reg('ms2collection-notice-undefined', ms2Collection.notice.undefined);
