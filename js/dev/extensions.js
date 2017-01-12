(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);var f=new Error("Cannot find module '"+o+"'");throw f.code="MODULE_NOT_FOUND",f}var l=n[o]={exports:{}};t[o][0].call(l.exports,function(e){var n=t[o][1][e];return s(n?n:e)},l,l.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){
//KB.Backbone.Backend.ModuleMenuItemView
module.exports = Backbone.View.extend({
  tagName: 'div',
  className: '',
  isValid: function () {
    return true;
  }
});
},{}],2:[function(require,module,exports){
//KB.Ajax
var Notice = require('common/Notice');
module.exports =
{
  send: function (data, callback, scope, options) {
    var pid;
    var addPayload = options || {};

    if (data.postId) {
      pid = data.postId;
    } else {
      pid = (KB.Environment && KB.Environment.postId) ? KB.Environment.postId : false;
    }

    var sned = _.extend({
      supplemental: data.supplemental || {},
      nonce: jQuery('#_kontentblocks_ajax_nonce').val(),
      post_id: pid,
      postId: pid,
      kbajax: true
    }, data);

    jQuery('#publish').attr('disabled', 'disabled');

    return jQuery.ajax({
      url: ajaxurl,
      data: sned,
      type: 'POST',
      dataType: 'json',
      success: function (data) {
        if (data) {
          if (scope && callback) {
            callback.call(scope, data, addPayload);
          } else if (callback) {
            callback(data, addPayload);
          }
        }
      },
      error: function () {
        // generic error message
        Notice.notice('<p>Generic Ajax Error</p>', 'error');
      },
      complete: function () {
        jQuery('#publish').removeAttr('disabled');
      }
    });
  }
};
},{"common/Notice":8}],3:[function(require,module,exports){
var Config = require('common/Config');
module.exports = {
  blockLimit: function (areamodel) {
    var limit = areamodel.get('limit');
    // todo potentially wrong, yeah it's wrong
    var children = jQuery('#' + areamodel.get('id') + ' li.kb-module').length;
    return !(limit !== 0 && children === limit);


  },
  userCan: function (cap) {
    var check = jQuery.inArray(cap, Config.get('caps'));
    return check !== -1;
  }
}
},{"common/Config":4}],4:[function(require,module,exports){
var Config = (function ($) {
  var config = KB.appData.config || {};
  return {
    /**
     * General getter
     * Return complete config object if no key is given
     * @param key
     * @returns {*}
     */
    get: function (key) {
      if (!key) {
        return config;
      }
      if (config[key]) {
        return config[key];
      }
      return null;

    },
    /**
     * Shortcut getter to nonces
     * @param mode
     * @returns {*}
     */
    getNonce: function (mode) {
      // possible modes: update, create, delete, read
      var modes = ['update', 'create', 'delete', 'read'];

      if (_.indexOf(modes, mode) !== -1) {
        return config.nonces[mode];
      } else {
        console.error('Invalid nonce requested in kb.cm.Config.js');
        return null;
      }
    },
    isAdmin: function(){
      return !config.frontend;
    },
    inDevMode: function () {
      return config.env.dev;
    },
    getRootURL: function () {
      return config.env.rootUrl;
    },
    getFieldJsUrl: function () {
      return config.env.fieldJsUrl;
    },
    getHash: function () {
      return config.env.hash;
    },
    getLayoutMode: function(){
      return config.layoutMode || 'default-boxes';
    }


  }
})(jQuery);
module.exports = Config;
},{}],5:[function(require,module,exports){
var Utilities = require('common/Utilities');
module.exports = {
  getString: function (path) {
    if (!path || !KB || !KB.i18n) {
      return null;
    }
    return Utilities.getIndex(KB.i18n, path);
  }
};
},{"common/Utilities":9}],6:[function(require,module,exports){
module.exports = {
  fields: [],
  strings: [],
  getFields: function(){
    this.fields = [];
    this.strings = [];
    var $fields = jQuery('[data-kbfuid]');
    _.each($fields, function(el){
      var id = jQuery(el).data('kbfuid');
      var field = KB.FieldControls.get(id);
      if (field){
        this.fields.push(field);
      }
    }, this);
  },
  getStrings: function(){
    this.getFields();
    _.each(this.fields, function(field){
      if (field.FieldControlView){
        this.strings.push(field.FieldControlView.toString()); 
      }
    }, this);
  },
  concatStrings:function(){
    this.getStrings();
    var res = '';
    _.each(this.strings, function(string){
      res = res + string + '\n';
    });

    return res;

  }

};
},{}],7:[function(require,module,exports){
var Config = require('common/Config');
if (Function.prototype.bind && window.console && typeof console.log == "object") {
  [
    "log", "info", "warn", "error", "assert", "dir", "clear", "profile", "profileEnd"
  ].forEach(function (method) {
      console[method] = this.bind(console[method], console);
    }, Function.prototype.call);
}

Logger.useDefaults();
var _K = Logger.get('_K');
var _KS = Logger.get('_KS'); // status bar only
_K.setLevel(_K.INFO);
_KS.setLevel(_KS.INFO);
if (!Config.inDevMode()) {
  _K.setLevel(Logger.OFF);
}
Logger.setHandler(function (messages, context) {
  // is Menubar exists and log message is of type INFO
  if (KB.Menubar && context.level.value === 2 && context.name === '_KS') {
    if (messages[0]) {
      KB.Menubar.StatusBar.setMsg(messages[0]);
    }
  } else {
    var console = window.console;
    var hdlr = console.log;

    // Prepend the logger's name to the log message for easy identification.
    if (context.name) {
      messages[0] = "[" + context.name + "] " + messages[0];
    }

    // Delegate through to custom warn/error loggers if present on the console.
    if (context.level === Logger.WARN && console.warn) {
      hdlr = console.warn;
    } else if (context.level === Logger.ERROR && console.error) {
      hdlr = console.error;
    } else if (context.level === Logger.INFO && console.info) {
      hdlr = console.info;
    }
    hdlr.apply(console, messages);
  }
});

module.exports = {
  Debug: _K,
  User: _KS
};
},{"common/Config":4}],8:[function(require,module,exports){
'use strict';
//KB.Notice
module.exports =
{
  notice: function (msg, type, delay) {
    var timeout = delay || 3;
    window.alertify.notify(msg, type, timeout);
  },
  confirm: function (title, msg, yes, no, scope) {
    var t = title || 'Title';
    window.alertify.confirm(t, msg, function () {
      yes.call(scope);
    }, function () {
      no.call(scope);
    });
  },
  prompt: function (title, msg, value, yes, no, scope) {
    var t = title || 'Title';
    window.alertify.prompt(t, msg, value, function () {
      yes.call(scope);
    }, function () {
      no.call(scope);
    });
  }
};

},{}],9:[function(require,module,exports){
var Utilities = function ($) {
  return {
    // store with expiration
    stex: {
      set: function (key, val, exp) {
        store.set(key, {val: val, exp: exp, time: new Date().getTime()})
      },
      get: function (key) {
        var info = store.get(key)
        if (!info) {
          return null
        }
        if (new Date().getTime() - info.time > info.exp) {
          return null
        }
        return info.val
      }
    },
    store: {
      set: function(key,val){
          store.set(key,val);
        },
      get: function(key){
          return store.get(key);
      }
    },
    setIndex: function (obj, is, value) {
      if (!_.isObject(obj)){
        obj = {};
      }

      if (typeof is == 'string'){
        return this.setIndex(obj, is.split('.'), value);
      }
      else if (is.length == 1 && value !== undefined){
        return obj[is[0]] = value;
      }
      else if (is.length == 0){
        return obj;
      }
      else{
        return this.setIndex(obj[is[0]], is.slice(1), value);
      }
    },
    getIndex: function (obj, s) {
      s = s.replace(/\[(\w+)\]/g, '.$1'); // convert indexes to properties
      s = s.replace(/^\./, '');           // strip a leading dot
      var a = s.split('.');
      while (a.length) {
        var n = a.shift();
        if (_.isObject(obj) && n in obj) {
          obj = obj[n];
        } else {
          return {};
        }
      }
      return obj;
    },
    hashString : function(str) {
    var hash = 0, i, chr, len;
    if (str == 0) return hash;
    for (i = 0, len = str.length; i < len; i++) {
      chr   = str.charCodeAt(i);
      hash  = ((hash << 5) - hash) + chr;
      hash |= 0; // Convert to 32bit integer
    }
    return Math.abs(hash);
  },
    // deprecated in favor of kpath
    //cleanArray: function (actual) {
    //  var newArray = new Array();
    //  for (var i = 0; i < actual.length; i++) {
    //
    //    if (!_.isUndefined(actual[i]) && !_.isEmpty(actual[i])) {
    //      newArray.push(actual[i]);
    //    }
    //  }
    //  return newArray;
    //},
    sleep: function (milliseconds) {
      var start = new Date().getTime();
      for (var i = 0; i < 1e7; i++) {
        if ((new Date().getTime() - start) > milliseconds) {
          break;
        }
      }
    }
  }

}(jQuery);
module.exports = Utilities;
},{}],10:[function(require,module,exports){
var Ajax = require('common/Ajax');
var Notice = require('common/Notice');
var Config = require('common/Config');
var tplSummary = require('templates/backend/extensions/backup-summary.hbs');
var BackupUi = Backbone.View.extend({
  lastItem: null,
  firstRun: true,
  initialize: function () {
    var that = this;
    this.listEl = jQuery('<ul></ul>').appendTo(this.$el);
    if (this.listEl.length > 0) {
      this.update();
    }

    // Heartbeat send data1
    jQuery(document).on('heartbeat-send', function (e, data) {
      data.kbBackupWatcher = that.lastItem;
      data.post_id = KB.Environment.postId || 0;
    });

    // Heartbeat receive data
    jQuery(document).on('heartbeat-tick', function (e, data) {
      if (data.kbHasNewBackups && _.isObject(data.kbHasNewBackups)) {
        that.renderList(data.kbHasNewBackups);
      }
    });
    return this;
  },
  update: function () {
    var that = this;
    Ajax.send(
      {
        action: 'get_backups',
        _ajax_nonce: Config.getNonce('read')
      },
      function (response) {
        that.items = response;
        that.renderList(response);
      });

  },
  renderList: function (items) {
    var that = this;
    this.listEl.empty();
    _.each(items, function (item, key) {
      that.lastItem = key;
      var data = {
        time: new Date(key * 1000).toGMTString(),
        item: item,
        key: key
      };
      that.listEl.append(tplSummary(data));
    });
    // no notice on first run
    if (!this.firstRun) {
      Notice.notice('<p>' + KB.i18n.Extensions.backups.newBackupcreated + '</p>', 'success');
    }
    this.firstRun = false;

    this.listEl.on('click', '.js-restore', function (e) {
      var id = jQuery(this).parent().attr('data-id');
      that.restore(id);
    })
  },
  restore: function (id) {
    var that = this;
    var location = window.location.href + '&amp;restore_backup=' + id + '&amp;post_id=' + jQuery('#post_ID').val();
    window.location = location;
  }
});
module.exports = new BackupUi({
  el: '#kb-backup-inspect .inside'
});
},{"common/Ajax":2,"common/Config":4,"common/Notice":8,"templates/backend/extensions/backup-summary.hbs":25}],11:[function(require,module,exports){
var ClipboardController = require('extensions/clipboard/ClipboardController');
module.exports = {

  init: function(){
    var $el = jQuery('#kontentblocks-clipboard');
      return new ClipboardController({
        el : $el.find('.inside')
      })
  }

};
},{"extensions/clipboard/ClipboardController":18}],12:[function(require,module,exports){
var ExtensionsModel = require('extensions/ExtensionsModel');
window.KB.Extensions = new ExtensionsModel();

},{"extensions/ExtensionsModel":13}],13:[function(require,module,exports){
module.exports = Backbone.Model.extend({

  initialize: function () {
    var LayoutConfigurations = require('extensions/LayoutConfigurations').init();
    this.set('backup-ui', require('extensions/BackupUI'));
    this.set('clipboard', require('extensions/Clipboard').init());
    this.set('yoast', require('extensions/YoastSeo'));

  }

});
},{"extensions/BackupUI":10,"extensions/Clipboard":11,"extensions/LayoutConfigurations":14,"extensions/YoastSeo":15}],14:[function(require,module,exports){
var Logger = require('common/Logger');
var Ajax = require('common/Ajax');
var Notice = require('common/Notice');
var Config = require('common/Config');
var tplItem = require('templates/backend/extensions/layout-item.hbs');

var LayoutConfigurations =
{
  el: jQuery('#kb-layout-configurations'),
  init: function () {
    if (KB.appData.config.frontend) {
      return false;
    }


    if (this.el.length === 0) {
      return false;
    }

    this.options = {};
    this.areaConfig = this._areaConfig();
    this.selectContainer = this._selectContainer();
    this.selectMenuEl = this._createSelectMenu();
    this.loadButton = this._loadButton();
    this.deleteButton = this._deleteButton();
    this.createContainer = this._createContainer();
    this.createInput = this._createInput();
    this.createButton = this._createButton();

    this.update();
  },
  _selectContainer: function () {
    return jQuery("<div class='select-container clearfix'>" + KB.i18n.Extensions.layoutConfigs.info + "</div>").appendTo(this.el);
  },
  _createSelectMenu: function () {
    jQuery('<select name="kb-layout-configuration"></select>').appendTo(this.selectContainer);
    return jQuery('select', this.el);
  },
  update: function () {
    var that = this;
    Ajax.send(
      {
        action: 'getLayoutConfig',
        _ajax_nonce: Config.getNonce('read'),
        data: {
          areaConfig: this.areaConfig
        }
      },
      function (response) {
        that.options = response;
        that.renderSelectMenu(response);
      });

  },
  save: function () {
    var that = this;
    var value = this.createInput.val();

    if (_.isEmpty(value)) {
      Notice.notice('Please enter a Name for the template', 'error');
      return false;
    }

    Ajax.send
    (
      {
        action: 'setLayoutConfig',
        _ajax_nonce: Config.getNonce('update'),
        data: {
          areaConfig: this.areaConfig,
          name: value
        }
      },
      function (response) {
        that.update();
        that.createInput.val('');
        Notice.notice('Saved', 'success');
      });

  },
  delete: function () {
    var that = this;
    var value = this.selectMenuEl.val();

    if (_.isEmpty(value)) {
      Notice.notice('Please chose a template to delete', 'error');
      return false;
    }

    Ajax.send(
      {
        action: 'deleteLayoutConfig',
        _ajax_nonce: Config.getNonce('delete'),
        data: {
          areaConfig: this.areaConfig,
          name: value
        }
      },
      function (response) {
        that.update();
        Notice.notice('Deleted', 'success');
      });

  },
  renderSelectMenu: function (data) {
    var that = this;
    that.selectMenuEl.empty();
    if (data.success){
      _.each(data.data, function (item, key, s) {
        that.selectMenuEl.append(tplItem({
            key: key,
            name: item.name
        }));
      });
    }

  },
  _areaConfig: function () {

    var concat = '';

    if (KB.payload.Areas) {
      _.each(KB.payload.Areas, function (context) {
        concat += context.id;
        Logger.Debug.debug('Layout Configurations: Concat', concat);
      });
    }
    return this.hash(concat.replace(',', ''));
  },
  hash: function (s) {
    return s.split("").reduce(function (a, b) {
      a = ((a << 5) - a) + b.charCodeAt(0);
      return a & a
    }, 0);

  },
  _createContainer: function () {
    return (jQuery("<div class='create-container'></div>").appendTo(this.el));
  },
  _createInput: function () {
    return jQuery("<input type='text' >").appendTo(this.createContainer);

  },
  _createButton: function () {
    var that = this;
    var button = jQuery("<a class='button kb-lc-save'>Save</a>").appendTo(this.createContainer);
    button.on('click', function (e) {
      e.preventDefault();
      that.save();
    })
    return button;
  },
  _loadButton: function () {
    var that = this;
    var button = jQuery("<a class='button-primary kb-lc-load'>Load</a>").appendTo(this.selectContainer);
    button.on('click', function (e) {
      e.preventDefault();
      that.load();
    });
    return button;
  },
  _deleteButton: function () {
    var that = this;
    var button = jQuery("<a class='delete-js kb-lc-delete'>delete</a>").appendTo(this.selectContainer);
    button.on('click', function (e) {
      e.preventDefault();
      that.delete();
    });
    return button;
  },
  load: function () {
    var location = window.location.href + '&kb_load_configuration=' + this.selectMenuEl.val() + '&post_id=' + jQuery('#post_ID').val() + '&config=' + this.areaConfig;
    window.location = location;
  }

};
module.exports = LayoutConfigurations;
},{"common/Ajax":2,"common/Config":4,"common/Logger":7,"common/Notice":8,"templates/backend/extensions/layout-item.hbs":26}],15:[function(require,module,exports){
var Index = require('common/Index');
KBFieldContent = function () {
  var that = this;
  YoastSEO.app.registerPlugin('kbfieldcontent', {status: 'ready'});

  /**
   * @param modification    {string}    The name of the filter
   * @param callable        {function}  The callable
   * @param pluginName      {string}    The plugin that is registering the modification.
   * @param priority        {number}    (optional) Used to specify the order in which the callables
   *                                    associated with a particular filter are called. Lower numbers
   *                                    correspond with earlier execution.
   */
  YoastSEO.app.registerModification('content', this.contentModification, 'kbfieldcontent', 5);
  if (KB.ChangeObserver) {
    KB.ChangeObserver.on('change', function () {
      // YoastSEO.app.refresh();
    });
  }

};

/**
 * @param data The data to modify
 */
KBFieldContent.prototype.contentModification = function (data) {
  return data + Index.concatStrings();
};

jQuery(document).ready(function () {
  if (window.YoastSEO) {
    new KBFieldContent();
  }
});

},{"common/Index":6}],16:[function(require,module,exports){
var ModuleBrowserList = require('shared/ModuleBrowser/ModuleBrowserList');
var ListItem = require('extensions/clipboard/ClipboardListItem');
var Ajax = require('common/Ajax');
var Config = require('common/Config');
module.exports = ModuleBrowserList.extend({
  initialize:function(){
    this.synced = false;
    ModuleBrowserList.prototype.initialize.apply(this, arguments);
  },
  update: function () {
    if (!this.synced){
      this.augmentModels();
    } else {
      this.renderItems();
    }
  },
  renderItems: function(){
    var that = this;
    // flag the first
    var first = false;
    this.$el.empty();
    _.each(this.cat.model.get('modules'), function (module) {
      that.subviews[module.cid] = new ListItem({
        model: module,
        parent: that,
        browser: that.options.browser
      });
      if (first === false) {
        that.options.browser.loadDetails(module);
        first = !first;
      }
      that.$el.append(that.subviews[module.cid].render(that.$el));
    });
  },
  /**
   * get related post object information from the server
   * in order to display information about the origin
   */
  augmentModels: function(){
    var that = this;
    var modules = this.cat.model.get('modules');
    var postIds = _.map(modules, function(model){
      return model.get('postId');
    });
    var xhr = Ajax.send({
      postIds: postIds,
      action: 'getPostObjects',
      _ajax_nonce: Config.getNonce('read')
    }).done(function(res){
      var posts = res.data.posts;
      var post;
      _.each(modules, function(model){
        if (post = _.findWhere(posts, {ID: model.get('postId')})){
          model.set('postObject', post);
        }
      });
      that.synced = true;
      that.renderItems();
    });

  }
});
},{"common/Ajax":2,"common/Config":4,"extensions/clipboard/ClipboardListItem":19,"shared/ModuleBrowser/ModuleBrowserList":22}],17:[function(require,module,exports){
var Utilities = require('common/Utilities');
module.exports = Backbone.Collection.extend({
  initialize: function () {
    this.listenTo(this, 'add', this.modelAdded);
    this.listenTo(this, 'remove', this.modelRemove);

  },
  modelAdded: function (model) {
    var value = this.getStorage() || {};
    value[model.get('hash')] = model.toJSON();
    this.setStorage(value);
  },
  modelRemove: function(model){
    var value = this.getStorage() || {};
    if (value[model.get('hash')]){
      delete value[model.get('hash')];
      this.setStorage(value);
    }
  },
  fetch: function () {
    var storage;
    this.ensureStorage();
    if (storage = this.getStorage()) {
      _.each(storage, function (module) {
        if (module.mid) {
          this.add(module, {silent: true});
        }
      }, this)
    }
  },
  ensureStorage: function () {
    var storage = this.getStorage();
    if (!storage) {
      this.clean();
    }
  },
  clean: function () {
    this.reset();
  },
  getStorage: function () {
    return Utilities.store.get('kb-clipboard') || null;
  },
  setStorage: function (val) {
    var value = val || {};
    Utilities.store.set('kb-clipboard', value);
  }
});
},{"common/Utilities":9}],18:[function(require,module,exports){
var ClipboardModel = require('extensions/clipboard/ClipboardModel');
var ClipboardControl = require('extensions/clipboard/controls/ClipboardControl');
var ClipboardCollection = require('extensions/clipboard/ClipboardCollection');
var ClipboardBrowserListRenderer = require('extensions/clipboard/ClipboardBrowserListRenderer');
module.exports = Backbone.View.extend({
  initialize: function () {
    var that = this;
    this.listenTo(KB.Modules, 'add', function (model) {
      that.listenTo(model, 'module.model.view.connected', that.bindHandler);
    });
    this.listenTo(KB.Events, 'module.browser.setup.cats', this.augmentBrowserCats); //hook into module browser tabs
    this.listenTo(KB.Events, 'module.browser.setup.defs', this.augmentAssignedModules); // hook into available module definitions
    this.items = new ClipboardCollection([], {
      model: ClipboardModel
    });
    this.items.fetch();
  },
  bindHandler: function (ModuleView) {
    this.listenTo(ModuleView, 'module.view.setup.menu', this.addControl);
    this.listenTo(ModuleView.model, 'remove', this.handleModuleRemove);
  },
  addControl: function (ControlManager, model, view) {
    ControlManager.addItem(new ClipboardControl({model: model, parent: this}));
  },
  add: function (object) {
    this.items.add(object);
  },
  remove: function (hash) {
    this.items.remove(hash);
  },
  entryExists: function (hash) {
    return !_.isUndefined(this.items.get(hash));
  },
  handleModuleRemove: function (model) {
    if (model.clipboardHash) {
      this.remove(model.clipboardHash);
    }
  },
  augmentBrowserCats: function (cats) {
    if (!cats.clipboard) {
      cats['clipboard'] = {
        id: 'clipboard',
        name: 'Clipboard',
        modules: [],
        listRenderer: ClipboardBrowserListRenderer
      };
    }
    return cats;
  },
  augmentAssignedModules: function (browser, defs) {
    var areaId = browser.area.model.get('id');
    var models = this.items.where({'area': areaId});
    var currentPid = KB.Environment.postId;
    _.each(models, function (model) {
      var json = model.toJSON();
      json.settings.category = 'clipboard';
      if (json.postId != currentPid) {
        defs.push(json);
      }
    }, this);
    return defs;
  }
});
},{"extensions/clipboard/ClipboardBrowserListRenderer":16,"extensions/clipboard/ClipboardCollection":17,"extensions/clipboard/ClipboardModel":20,"extensions/clipboard/controls/ClipboardControl":21}],19:[function(require,module,exports){
var ListItem = require('shared/ModuleBrowser/ModuleBrowserListItem');
var tplListItem = require('templates/backend/clipboard/module-list-item.hbs');
var Ajax = require('common/Ajax');
var Config = require('common/Config');
module.exports = ListItem.extend({
// render list
  className: 'modules-list-item clipboard-list-item',
  render: function (el) {
    this.$el.html(tplListItem({module: this.model.toJSON()}));
    el.append(this.$el);
  },
  events:{
    'click .kb-js-duplicate-clipboard' : 'handleDuplicate',
    'click .kb-js-move-clipboard' : 'handleMove'
  },
  handleDuplicate: function(){
    this.mode = 'duplicate';
    this.createModule();
  },
  handleMove: function(){
    this.mode = 'move';
    this.createModule();

  },
  createModule: function () {
    var that = this;
    var data = {
      targetPid: KB.Environment.postId,
      sourcePid: this.model.get('postId'),
      mid: this.model.get('mid'),
      mode: this.mode
    };

    var xhr = Ajax.send({
      data: data,
      action: 'handleClipboard',
      _ajax_nonce: Config.getNonce('update')
    }).done(function(res){
      that.Browser.success(res);
    });

  }
});
},{"common/Ajax":2,"common/Config":4,"shared/ModuleBrowser/ModuleBrowserListItem":23,"templates/backend/clipboard/module-list-item.hbs":24}],20:[function(require,module,exports){
module.exports = Backbone.Model.extend({
  idAttribute: 'hash'
});
},{}],21:[function(require,module,exports){
//KB.Backbone.Backend.ModuleStatus
var BaseView = require('backend/Views/BaseControlView');
var Checks = require('common/Checks');
var Config = require('common/Config');
var Notice = require('common/Notice');
var Ajax = require('common/Ajax');
var I18n = require('common/I18n');
var Utilities = require('common/Utilities');
module.exports = BaseView.extend({
  id: 'clipboard',
  initialize: function (options) {
    this.options = options || {};
    this.ClipboardController = options.parent;
    var pid = this.model.get('postId');
    this.hash = Utilities.hashString(pid.toString() + this.model.get('mid'));
    this.model.clipboardHash = this.hash;
    this.statusClass();
  },
  className: 'module-clipboard block-menu-icon',
  events: {
    'click': 'toggleClipboard'
  },
  toggleClipboard: function () {
    if (!this.ClipboardController.entryExists(this.hash)) {
      var json = this.model.toJSON();
      json.hash = this.hash;
      this.ClipboardController.add(json);
    } else {
      this.ClipboardController.remove(this.hash);
    }
    this.statusClass();

  },
  isValid: function () {
    if (!this.model.get('disabled') &&
      Checks.userCan('deactivate_kontentblocks') && (this.model.get('globalModule') !== true) && !this.model.get('submodule')) {
      return true;
    } else {
      return false;
    }
  },
  success: function () {
  },
  statusClass: function () {
    var strings = I18n.getString('Modules.tooltips');
    if (this.ClipboardController.entryExists(this.hash)) {
      this.$el.addClass('kb-in-clipboard');
      this.$el.attr('data-kbtooltip', strings.tooltipRemoveFromClipboard);
    } else {
      this.$el.removeClass('kb-in-clipboard');
      this.$el.attr('data-kbtooltip', strings.tooltipAddToClipboard);

    }
  }
});
},{"backend/Views/BaseControlView":1,"common/Ajax":2,"common/Checks":3,"common/Config":4,"common/I18n":5,"common/Notice":8,"common/Utilities":9}],22:[function(require,module,exports){
//KB.Backbone.ModuleBrowserModulesList
var ListItem = require('shared/ModuleBrowser/ModuleBrowserListItem');
module.exports = Backbone.View.extend({
  initialize: function (options) {
    this.options = options || {};
    this.cat = options.cat;
  },
  modules: {},
  subviews: {},
  // set modules to render
  setModules: function (modules) {
    this.modules = modules;
    return this;
  },
  // render current modules to list
  update: function () {
    var that = this;
    // flag the first
    var first = false;
    this.$el.empty();
    _.each(this.cat.model.get('modules'), function (module) {
      that.subviews[module.cid] = new ListItem({
        model: module,
        parent: that,
        browser: that.options.browser
      });

      if (first === false) {
        that.options.browser.loadDetails(module);
        first = !first;
      }
      that.$el.append(that.subviews[module.cid].render(that.$el));
    });
  },
  render: function(){
  }
});
},{"shared/ModuleBrowser/ModuleBrowserListItem":23}],23:[function(require,module,exports){
//KB.Backbone.ModuleBrowserListItem
var tplTemplateListItem = require('templates/backend/modulebrowser/module-template-list-item.hbs');
var tplListItem = require('templates/backend/modulebrowser/module-list-item.hbs');
module.exports = Backbone.View.extend({
  tagName: 'li',
  className: 'modules-list-item',
  initialize: function (options) {
    this.options = options || {};
    this.Browser = options.browser;
    // shorthand to parent area
    this.area = options.browser.area;
    // listen to browser close event
//        this.options.parent.options.browser.on('browser:close', this.close, this);
  },
  // render list
  render: function (el) {
    if (this.model.get('globalModule')) {
      this.$el.html(tplTemplateListItem({module: this.model.toJSON()}));
    } else {
      this.$el.html(tplListItem({module: this.model.toJSON()}));
    }
    el.append(this.$el);
  },
  events: {
    'click': 'handleClick',
    'click .kb-js-create-module': 'handlePlusClick'
  },
  handleClick: function () {
    if (this.Browser.viewMode === 'list') {
      this.createModule();
    } else {
      this.Browser.loadDetails(this.model);
    }
  },
  handlePlusClick: function () {
    if (this.Browser.viewMode === 'list') {
      this.handleClick();
      return false;
    } else {
      this.createModule();
    }
  },
  createModule: function () {
    this.Browser.createModule(this.model);
  },
  close: function () {
    this.remove();
  }

});
},{"templates/backend/modulebrowser/module-list-item.hbs":27,"templates/backend/modulebrowser/module-template-list-item.hbs":28}],24:[function(require,module,exports){
// hbsfy compiled Handlebars template
var HandlebarsCompiler = require('hbsfy/runtime');
module.exports = HandlebarsCompiler.template({"compiler":[6,">= 2.0.0-beta.1"],"main":function(depth0,helpers,partials,data) {
    var stack1, alias1=this.lambda, alias2=this.escapeExpression;

  return "<h4>"
    + alias2(alias1(((stack1 = ((stack1 = (depth0 != null ? depth0.module : depth0)) != null ? stack1.settings : stack1)) != null ? stack1.publicName : stack1), depth0))
    + "</h4>\n<p class=\"description\">\n    <em>Post ID:</em>"
    + alias2(alias1(((stack1 = ((stack1 = (depth0 != null ? depth0.module : depth0)) != null ? stack1.postObject : stack1)) != null ? stack1.ID : stack1), depth0))
    + "<br>\n    <em>Post Title:</em>"
    + alias2(alias1(((stack1 = ((stack1 = (depth0 != null ? depth0.module : depth0)) != null ? stack1.postObject : stack1)) != null ? stack1.post_title : stack1), depth0))
    + "<br>\n</p>\n<div class=\"kb-js-duplicate-clipboard kb-clipboard-action\">duplicate</div>\n<div class=\"kb-js-move-clipboard kb-clipboard-action\">move</div>";
},"useData":true});

},{"hbsfy/runtime":37}],25:[function(require,module,exports){
// hbsfy compiled Handlebars template
var HandlebarsCompiler = require('hbsfy/runtime');
module.exports = HandlebarsCompiler.template({"compiler":[6,">= 2.0.0-beta.1"],"main":function(depth0,helpers,partials,data) {
    var stack1, helper, alias1=helpers.helperMissing, alias2="function", alias3=this.escapeExpression;

  return "<li>\n    <details>\n        <summary>\n            "
    + alias3(((helper = (helper = helpers.time || (depth0 != null ? depth0.time : depth0)) != null ? helper : alias1),(typeof helper === alias2 ? helper.call(depth0,{"name":"time","hash":{},"data":data}) : helper)))
    + "\n        </summary>\n        <div class='actions' data-id='"
    + alias3(((helper = (helper = helpers.key || (depth0 != null ? depth0.key : depth0)) != null ? helper : alias1),(typeof helper === alias2 ? helper.call(depth0,{"name":"key","hash":{},"data":data}) : helper)))
    + "'>\n            <span class='js-restore'>Restore</span>\n            <p class='description'><b>Comment:</b> "
    + alias3(this.lambda(((stack1 = (depth0 != null ? depth0.item : depth0)) != null ? stack1.msg : stack1), depth0))
    + "</p>\n        </div>\n    </details>\n</li>";
},"useData":true});

},{"hbsfy/runtime":37}],26:[function(require,module,exports){
// hbsfy compiled Handlebars template
var HandlebarsCompiler = require('hbsfy/runtime');
module.exports = HandlebarsCompiler.template({"compiler":[6,">= 2.0.0-beta.1"],"main":function(depth0,helpers,partials,data) {
    var stack1, helper, alias1=helpers.helperMissing, alias2="function";

  return "<option value='"
    + ((stack1 = ((helper = (helper = helpers.key || (depth0 != null ? depth0.key : depth0)) != null ? helper : alias1),(typeof helper === alias2 ? helper.call(depth0,{"name":"key","hash":{},"data":data}) : helper))) != null ? stack1 : "")
    + "'>"
    + ((stack1 = ((helper = (helper = helpers.name || (depth0 != null ? depth0.name : depth0)) != null ? helper : alias1),(typeof helper === alias2 ? helper.call(depth0,{"name":"name","hash":{},"data":data}) : helper))) != null ? stack1 : "")
    + "</option>";
},"useData":true});

},{"hbsfy/runtime":37}],27:[function(require,module,exports){
// hbsfy compiled Handlebars template
var HandlebarsCompiler = require('hbsfy/runtime');
module.exports = HandlebarsCompiler.template({"compiler":[6,">= 2.0.0-beta.1"],"main":function(depth0,helpers,partials,data) {
    var stack1, alias1=this.lambda, alias2=this.escapeExpression;

  return "<div class=\"dashicons dashicons-plus kb-js-create-module\"></div>\n<h4>"
    + alias2(alias1(((stack1 = ((stack1 = (depth0 != null ? depth0.module : depth0)) != null ? stack1.settings : stack1)) != null ? stack1.name : stack1), depth0))
    + "</h4>\n<p class=\"description\">"
    + alias2(alias1(((stack1 = ((stack1 = (depth0 != null ? depth0.module : depth0)) != null ? stack1.settings : stack1)) != null ? stack1.description : stack1), depth0))
    + "</p>";
},"useData":true});

},{"hbsfy/runtime":37}],28:[function(require,module,exports){
// hbsfy compiled Handlebars template
var HandlebarsCompiler = require('hbsfy/runtime');
module.exports = HandlebarsCompiler.template({"compiler":[6,">= 2.0.0-beta.1"],"main":function(depth0,helpers,partials,data) {
    var stack1;

  return "<div class=\"dashicons dashicons-plus kb-js-create-module\"></div>\n<h4>"
    + this.escapeExpression(this.lambda(((stack1 = ((stack1 = (depth0 != null ? depth0.module : depth0)) != null ? stack1.parentObject : stack1)) != null ? stack1.post_title : stack1), depth0))
    + "</h4>";
},"useData":true});

},{"hbsfy/runtime":37}],29:[function(require,module,exports){
'use strict';

var _interopRequireWildcard = function (obj) { return obj && obj.__esModule ? obj : { 'default': obj }; };

exports.__esModule = true;

var _import = require('./handlebars/base');

var base = _interopRequireWildcard(_import);

// Each of these augment the Handlebars object. No need to setup here.
// (This is done to easily share code between commonjs and browse envs)

var _SafeString = require('./handlebars/safe-string');

var _SafeString2 = _interopRequireWildcard(_SafeString);

var _Exception = require('./handlebars/exception');

var _Exception2 = _interopRequireWildcard(_Exception);

var _import2 = require('./handlebars/utils');

var Utils = _interopRequireWildcard(_import2);

var _import3 = require('./handlebars/runtime');

var runtime = _interopRequireWildcard(_import3);

var _noConflict = require('./handlebars/no-conflict');

var _noConflict2 = _interopRequireWildcard(_noConflict);

// For compatibility and usage outside of module systems, make the Handlebars object a namespace
function create() {
  var hb = new base.HandlebarsEnvironment();

  Utils.extend(hb, base);
  hb.SafeString = _SafeString2['default'];
  hb.Exception = _Exception2['default'];
  hb.Utils = Utils;
  hb.escapeExpression = Utils.escapeExpression;

  hb.VM = runtime;
  hb.template = function (spec) {
    return runtime.template(spec, hb);
  };

  return hb;
}

var inst = create();
inst.create = create;

_noConflict2['default'](inst);

inst['default'] = inst;

exports['default'] = inst;
module.exports = exports['default'];
},{"./handlebars/base":30,"./handlebars/exception":31,"./handlebars/no-conflict":32,"./handlebars/runtime":33,"./handlebars/safe-string":34,"./handlebars/utils":35}],30:[function(require,module,exports){
'use strict';

var _interopRequireWildcard = function (obj) { return obj && obj.__esModule ? obj : { 'default': obj }; };

exports.__esModule = true;
exports.HandlebarsEnvironment = HandlebarsEnvironment;
exports.createFrame = createFrame;

var _import = require('./utils');

var Utils = _interopRequireWildcard(_import);

var _Exception = require('./exception');

var _Exception2 = _interopRequireWildcard(_Exception);

var VERSION = '3.0.1';
exports.VERSION = VERSION;
var COMPILER_REVISION = 6;

exports.COMPILER_REVISION = COMPILER_REVISION;
var REVISION_CHANGES = {
  1: '<= 1.0.rc.2', // 1.0.rc.2 is actually rev2 but doesn't report it
  2: '== 1.0.0-rc.3',
  3: '== 1.0.0-rc.4',
  4: '== 1.x.x',
  5: '== 2.0.0-alpha.x',
  6: '>= 2.0.0-beta.1'
};

exports.REVISION_CHANGES = REVISION_CHANGES;
var isArray = Utils.isArray,
    isFunction = Utils.isFunction,
    toString = Utils.toString,
    objectType = '[object Object]';

function HandlebarsEnvironment(helpers, partials) {
  this.helpers = helpers || {};
  this.partials = partials || {};

  registerDefaultHelpers(this);
}

HandlebarsEnvironment.prototype = {
  constructor: HandlebarsEnvironment,

  logger: logger,
  log: log,

  registerHelper: function registerHelper(name, fn) {
    if (toString.call(name) === objectType) {
      if (fn) {
        throw new _Exception2['default']('Arg not supported with multiple helpers');
      }
      Utils.extend(this.helpers, name);
    } else {
      this.helpers[name] = fn;
    }
  },
  unregisterHelper: function unregisterHelper(name) {
    delete this.helpers[name];
  },

  registerPartial: function registerPartial(name, partial) {
    if (toString.call(name) === objectType) {
      Utils.extend(this.partials, name);
    } else {
      if (typeof partial === 'undefined') {
        throw new _Exception2['default']('Attempting to register a partial as undefined');
      }
      this.partials[name] = partial;
    }
  },
  unregisterPartial: function unregisterPartial(name) {
    delete this.partials[name];
  }
};

function registerDefaultHelpers(instance) {
  instance.registerHelper('helperMissing', function () {
    if (arguments.length === 1) {
      // A missing field in a {{foo}} constuct.
      return undefined;
    } else {
      // Someone is actually trying to call something, blow up.
      throw new _Exception2['default']('Missing helper: "' + arguments[arguments.length - 1].name + '"');
    }
  });

  instance.registerHelper('blockHelperMissing', function (context, options) {
    var inverse = options.inverse,
        fn = options.fn;

    if (context === true) {
      return fn(this);
    } else if (context === false || context == null) {
      return inverse(this);
    } else if (isArray(context)) {
      if (context.length > 0) {
        if (options.ids) {
          options.ids = [options.name];
        }

        return instance.helpers.each(context, options);
      } else {
        return inverse(this);
      }
    } else {
      if (options.data && options.ids) {
        var data = createFrame(options.data);
        data.contextPath = Utils.appendContextPath(options.data.contextPath, options.name);
        options = { data: data };
      }

      return fn(context, options);
    }
  });

  instance.registerHelper('each', function (context, options) {
    if (!options) {
      throw new _Exception2['default']('Must pass iterator to #each');
    }

    var fn = options.fn,
        inverse = options.inverse,
        i = 0,
        ret = '',
        data = undefined,
        contextPath = undefined;

    if (options.data && options.ids) {
      contextPath = Utils.appendContextPath(options.data.contextPath, options.ids[0]) + '.';
    }

    if (isFunction(context)) {
      context = context.call(this);
    }

    if (options.data) {
      data = createFrame(options.data);
    }

    function execIteration(field, index, last) {
      if (data) {
        data.key = field;
        data.index = index;
        data.first = index === 0;
        data.last = !!last;

        if (contextPath) {
          data.contextPath = contextPath + field;
        }
      }

      ret = ret + fn(context[field], {
        data: data,
        blockParams: Utils.blockParams([context[field], field], [contextPath + field, null])
      });
    }

    if (context && typeof context === 'object') {
      if (isArray(context)) {
        for (var j = context.length; i < j; i++) {
          execIteration(i, i, i === context.length - 1);
        }
      } else {
        var priorKey = undefined;

        for (var key in context) {
          if (context.hasOwnProperty(key)) {
            // We're running the iterations one step out of sync so we can detect
            // the last iteration without have to scan the object twice and create
            // an itermediate keys array.
            if (priorKey) {
              execIteration(priorKey, i - 1);
            }
            priorKey = key;
            i++;
          }
        }
        if (priorKey) {
          execIteration(priorKey, i - 1, true);
        }
      }
    }

    if (i === 0) {
      ret = inverse(this);
    }

    return ret;
  });

  instance.registerHelper('if', function (conditional, options) {
    if (isFunction(conditional)) {
      conditional = conditional.call(this);
    }

    // Default behavior is to render the positive path if the value is truthy and not empty.
    // The `includeZero` option may be set to treat the condtional as purely not empty based on the
    // behavior of isEmpty. Effectively this determines if 0 is handled by the positive path or negative.
    if (!options.hash.includeZero && !conditional || Utils.isEmpty(conditional)) {
      return options.inverse(this);
    } else {
      return options.fn(this);
    }
  });

  instance.registerHelper('unless', function (conditional, options) {
    return instance.helpers['if'].call(this, conditional, { fn: options.inverse, inverse: options.fn, hash: options.hash });
  });

  instance.registerHelper('with', function (context, options) {
    if (isFunction(context)) {
      context = context.call(this);
    }

    var fn = options.fn;

    if (!Utils.isEmpty(context)) {
      if (options.data && options.ids) {
        var data = createFrame(options.data);
        data.contextPath = Utils.appendContextPath(options.data.contextPath, options.ids[0]);
        options = { data: data };
      }

      return fn(context, options);
    } else {
      return options.inverse(this);
    }
  });

  instance.registerHelper('log', function (message, options) {
    var level = options.data && options.data.level != null ? parseInt(options.data.level, 10) : 1;
    instance.log(level, message);
  });

  instance.registerHelper('lookup', function (obj, field) {
    return obj && obj[field];
  });
}

var logger = {
  methodMap: { 0: 'debug', 1: 'info', 2: 'warn', 3: 'error' },

  // State enum
  DEBUG: 0,
  INFO: 1,
  WARN: 2,
  ERROR: 3,
  level: 1,

  // Can be overridden in the host environment
  log: function log(level, message) {
    if (typeof console !== 'undefined' && logger.level <= level) {
      var method = logger.methodMap[level];
      (console[method] || console.log).call(console, message); // eslint-disable-line no-console
    }
  }
};

exports.logger = logger;
var log = logger.log;

exports.log = log;

function createFrame(object) {
  var frame = Utils.extend({}, object);
  frame._parent = object;
  return frame;
}

/* [args, ]options */
},{"./exception":31,"./utils":35}],31:[function(require,module,exports){
'use strict';

exports.__esModule = true;

var errorProps = ['description', 'fileName', 'lineNumber', 'message', 'name', 'number', 'stack'];

function Exception(message, node) {
  var loc = node && node.loc,
      line = undefined,
      column = undefined;
  if (loc) {
    line = loc.start.line;
    column = loc.start.column;

    message += ' - ' + line + ':' + column;
  }

  var tmp = Error.prototype.constructor.call(this, message);

  // Unfortunately errors are not enumerable in Chrome (at least), so `for prop in tmp` doesn't work.
  for (var idx = 0; idx < errorProps.length; idx++) {
    this[errorProps[idx]] = tmp[errorProps[idx]];
  }

  if (Error.captureStackTrace) {
    Error.captureStackTrace(this, Exception);
  }

  if (loc) {
    this.lineNumber = line;
    this.column = column;
  }
}

Exception.prototype = new Error();

exports['default'] = Exception;
module.exports = exports['default'];
},{}],32:[function(require,module,exports){
'use strict';

exports.__esModule = true;
/*global window */

exports['default'] = function (Handlebars) {
  /* istanbul ignore next */
  var root = typeof global !== 'undefined' ? global : window,
      $Handlebars = root.Handlebars;
  /* istanbul ignore next */
  Handlebars.noConflict = function () {
    if (root.Handlebars === Handlebars) {
      root.Handlebars = $Handlebars;
    }
  };
};

module.exports = exports['default'];
},{}],33:[function(require,module,exports){
'use strict';

var _interopRequireWildcard = function (obj) { return obj && obj.__esModule ? obj : { 'default': obj }; };

exports.__esModule = true;
exports.checkRevision = checkRevision;

// TODO: Remove this line and break up compilePartial

exports.template = template;
exports.wrapProgram = wrapProgram;
exports.resolvePartial = resolvePartial;
exports.invokePartial = invokePartial;
exports.noop = noop;

var _import = require('./utils');

var Utils = _interopRequireWildcard(_import);

var _Exception = require('./exception');

var _Exception2 = _interopRequireWildcard(_Exception);

var _COMPILER_REVISION$REVISION_CHANGES$createFrame = require('./base');

function checkRevision(compilerInfo) {
  var compilerRevision = compilerInfo && compilerInfo[0] || 1,
      currentRevision = _COMPILER_REVISION$REVISION_CHANGES$createFrame.COMPILER_REVISION;

  if (compilerRevision !== currentRevision) {
    if (compilerRevision < currentRevision) {
      var runtimeVersions = _COMPILER_REVISION$REVISION_CHANGES$createFrame.REVISION_CHANGES[currentRevision],
          compilerVersions = _COMPILER_REVISION$REVISION_CHANGES$createFrame.REVISION_CHANGES[compilerRevision];
      throw new _Exception2['default']('Template was precompiled with an older version of Handlebars than the current runtime. ' + 'Please update your precompiler to a newer version (' + runtimeVersions + ') or downgrade your runtime to an older version (' + compilerVersions + ').');
    } else {
      // Use the embedded version info since the runtime doesn't know about this revision yet
      throw new _Exception2['default']('Template was precompiled with a newer version of Handlebars than the current runtime. ' + 'Please update your runtime to a newer version (' + compilerInfo[1] + ').');
    }
  }
}

function template(templateSpec, env) {
  /* istanbul ignore next */
  if (!env) {
    throw new _Exception2['default']('No environment passed to template');
  }
  if (!templateSpec || !templateSpec.main) {
    throw new _Exception2['default']('Unknown template object: ' + typeof templateSpec);
  }

  // Note: Using env.VM references rather than local var references throughout this section to allow
  // for external users to override these as psuedo-supported APIs.
  env.VM.checkRevision(templateSpec.compiler);

  function invokePartialWrapper(partial, context, options) {
    if (options.hash) {
      context = Utils.extend({}, context, options.hash);
    }

    partial = env.VM.resolvePartial.call(this, partial, context, options);
    var result = env.VM.invokePartial.call(this, partial, context, options);

    if (result == null && env.compile) {
      options.partials[options.name] = env.compile(partial, templateSpec.compilerOptions, env);
      result = options.partials[options.name](context, options);
    }
    if (result != null) {
      if (options.indent) {
        var lines = result.split('\n');
        for (var i = 0, l = lines.length; i < l; i++) {
          if (!lines[i] && i + 1 === l) {
            break;
          }

          lines[i] = options.indent + lines[i];
        }
        result = lines.join('\n');
      }
      return result;
    } else {
      throw new _Exception2['default']('The partial ' + options.name + ' could not be compiled when running in runtime-only mode');
    }
  }

  // Just add water
  var container = {
    strict: function strict(obj, name) {
      if (!(name in obj)) {
        throw new _Exception2['default']('"' + name + '" not defined in ' + obj);
      }
      return obj[name];
    },
    lookup: function lookup(depths, name) {
      var len = depths.length;
      for (var i = 0; i < len; i++) {
        if (depths[i] && depths[i][name] != null) {
          return depths[i][name];
        }
      }
    },
    lambda: function lambda(current, context) {
      return typeof current === 'function' ? current.call(context) : current;
    },

    escapeExpression: Utils.escapeExpression,
    invokePartial: invokePartialWrapper,

    fn: function fn(i) {
      return templateSpec[i];
    },

    programs: [],
    program: function program(i, data, declaredBlockParams, blockParams, depths) {
      var programWrapper = this.programs[i],
          fn = this.fn(i);
      if (data || depths || blockParams || declaredBlockParams) {
        programWrapper = wrapProgram(this, i, fn, data, declaredBlockParams, blockParams, depths);
      } else if (!programWrapper) {
        programWrapper = this.programs[i] = wrapProgram(this, i, fn);
      }
      return programWrapper;
    },

    data: function data(value, depth) {
      while (value && depth--) {
        value = value._parent;
      }
      return value;
    },
    merge: function merge(param, common) {
      var obj = param || common;

      if (param && common && param !== common) {
        obj = Utils.extend({}, common, param);
      }

      return obj;
    },

    noop: env.VM.noop,
    compilerInfo: templateSpec.compiler
  };

  function ret(context) {
    var options = arguments[1] === undefined ? {} : arguments[1];

    var data = options.data;

    ret._setup(options);
    if (!options.partial && templateSpec.useData) {
      data = initData(context, data);
    }
    var depths = undefined,
        blockParams = templateSpec.useBlockParams ? [] : undefined;
    if (templateSpec.useDepths) {
      depths = options.depths ? [context].concat(options.depths) : [context];
    }

    return templateSpec.main.call(container, context, container.helpers, container.partials, data, blockParams, depths);
  }
  ret.isTop = true;

  ret._setup = function (options) {
    if (!options.partial) {
      container.helpers = container.merge(options.helpers, env.helpers);

      if (templateSpec.usePartial) {
        container.partials = container.merge(options.partials, env.partials);
      }
    } else {
      container.helpers = options.helpers;
      container.partials = options.partials;
    }
  };

  ret._child = function (i, data, blockParams, depths) {
    if (templateSpec.useBlockParams && !blockParams) {
      throw new _Exception2['default']('must pass block params');
    }
    if (templateSpec.useDepths && !depths) {
      throw new _Exception2['default']('must pass parent depths');
    }

    return wrapProgram(container, i, templateSpec[i], data, 0, blockParams, depths);
  };
  return ret;
}

function wrapProgram(container, i, fn, data, declaredBlockParams, blockParams, depths) {
  function prog(context) {
    var options = arguments[1] === undefined ? {} : arguments[1];

    return fn.call(container, context, container.helpers, container.partials, options.data || data, blockParams && [options.blockParams].concat(blockParams), depths && [context].concat(depths));
  }
  prog.program = i;
  prog.depth = depths ? depths.length : 0;
  prog.blockParams = declaredBlockParams || 0;
  return prog;
}

function resolvePartial(partial, context, options) {
  if (!partial) {
    partial = options.partials[options.name];
  } else if (!partial.call && !options.name) {
    // This is a dynamic partial that returned a string
    options.name = partial;
    partial = options.partials[partial];
  }
  return partial;
}

function invokePartial(partial, context, options) {
  options.partial = true;

  if (partial === undefined) {
    throw new _Exception2['default']('The partial ' + options.name + ' could not be found');
  } else if (partial instanceof Function) {
    return partial(context, options);
  }
}

function noop() {
  return '';
}

function initData(context, data) {
  if (!data || !('root' in data)) {
    data = data ? _COMPILER_REVISION$REVISION_CHANGES$createFrame.createFrame(data) : {};
    data.root = context;
  }
  return data;
}
},{"./base":30,"./exception":31,"./utils":35}],34:[function(require,module,exports){
'use strict';

exports.__esModule = true;
// Build out our basic SafeString type
function SafeString(string) {
  this.string = string;
}

SafeString.prototype.toString = SafeString.prototype.toHTML = function () {
  return '' + this.string;
};

exports['default'] = SafeString;
module.exports = exports['default'];
},{}],35:[function(require,module,exports){
'use strict';

exports.__esModule = true;
exports.extend = extend;

// Older IE versions do not directly support indexOf so we must implement our own, sadly.
exports.indexOf = indexOf;
exports.escapeExpression = escapeExpression;
exports.isEmpty = isEmpty;
exports.blockParams = blockParams;
exports.appendContextPath = appendContextPath;
var escape = {
  '&': '&amp;',
  '<': '&lt;',
  '>': '&gt;',
  '"': '&quot;',
  '\'': '&#x27;',
  '`': '&#x60;'
};

var badChars = /[&<>"'`]/g,
    possible = /[&<>"'`]/;

function escapeChar(chr) {
  return escape[chr];
}

function extend(obj /* , ...source */) {
  for (var i = 1; i < arguments.length; i++) {
    for (var key in arguments[i]) {
      if (Object.prototype.hasOwnProperty.call(arguments[i], key)) {
        obj[key] = arguments[i][key];
      }
    }
  }

  return obj;
}

var toString = Object.prototype.toString;

exports.toString = toString;
// Sourced from lodash
// https://github.com/bestiejs/lodash/blob/master/LICENSE.txt
/*eslint-disable func-style, no-var */
var isFunction = function isFunction(value) {
  return typeof value === 'function';
};
// fallback for older versions of Chrome and Safari
/* istanbul ignore next */
if (isFunction(/x/)) {
  exports.isFunction = isFunction = function (value) {
    return typeof value === 'function' && toString.call(value) === '[object Function]';
  };
}
var isFunction;
exports.isFunction = isFunction;
/*eslint-enable func-style, no-var */

/* istanbul ignore next */
var isArray = Array.isArray || function (value) {
  return value && typeof value === 'object' ? toString.call(value) === '[object Array]' : false;
};exports.isArray = isArray;

function indexOf(array, value) {
  for (var i = 0, len = array.length; i < len; i++) {
    if (array[i] === value) {
      return i;
    }
  }
  return -1;
}

function escapeExpression(string) {
  if (typeof string !== 'string') {
    // don't escape SafeStrings, since they're already safe
    if (string && string.toHTML) {
      return string.toHTML();
    } else if (string == null) {
      return '';
    } else if (!string) {
      return string + '';
    }

    // Force a string conversion as this will be done by the append regardless and
    // the regex test will do this transparently behind the scenes, causing issues if
    // an object's to string has escaped characters in it.
    string = '' + string;
  }

  if (!possible.test(string)) {
    return string;
  }
  return string.replace(badChars, escapeChar);
}

function isEmpty(value) {
  if (!value && value !== 0) {
    return true;
  } else if (isArray(value) && value.length === 0) {
    return true;
  } else {
    return false;
  }
}

function blockParams(params, ids) {
  params.path = ids;
  return params;
}

function appendContextPath(contextPath, id) {
  return (contextPath ? contextPath + '.' : '') + id;
}
},{}],36:[function(require,module,exports){
// Create a simple path alias to allow browserify to resolve
// the runtime on a supported path.
module.exports = require('./dist/cjs/handlebars.runtime')['default'];

},{"./dist/cjs/handlebars.runtime":29}],37:[function(require,module,exports){
module.exports = require("handlebars/runtime")["default"];

},{"handlebars/runtime":36}]},{},[12]);