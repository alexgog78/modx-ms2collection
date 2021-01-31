'use strict';

var ms2Collection = function (config) {
    config = config || {};
    ms2Collection.superclass.constructor.call(this, config);
};
Ext.extend(ms2Collection, Ext.Component, abstractModule);
Ext.reg('ms2collection', ms2Collection);
ms2Collection = new ms2Collection();
