/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};

/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {

/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId])
/******/ 			return installedModules[moduleId].exports;

/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};

/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);

/******/ 		// Flag the module as loaded
/******/ 		module.l = true;

/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}


/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;

/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;

/******/ 	// identity function for calling harmony imports with the correct context
/******/ 	__webpack_require__.i = function(value) { return value; };

/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};

/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};

/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };

/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "./";

/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 45);
/******/ })
/************************************************************************/
/******/ ({

/***/ 11:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__components_NodeDetails_vue__ = __webpack_require__(39);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__components_NodeDetails_vue___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0__components_NodeDetails_vue__);


window.diagram = new Vue({
    el: '#pipeline-diagram-app',
    components: {
        'node-details': __WEBPACK_IMPORTED_MODULE_0__components_NodeDetails_vue___default.a
    },
    data: {
        node: null
    },
    methods: {
        changeNode: function changeNode(node) {
            this.node = node;
        }
    }
});

/***/ }),

/***/ 31:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = {
    props: ['node'],
    methods: {
        deleteNode: function deleteNode() {

            if (app.pipeline.selected_node !== null) {

                swal({
                    title: "Are you sure?",
                    text: "You will not be able to undo this action!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, delete it!",
                    closeOnConfirm: true
                }, function () {

                    app.pipeline.selected_node.destroy(function () {
                        app.pipeline.loadData();
                        diagram.node = null;
                        swal("Delete Successful", "The node was deleted!", "success");
                    }, function () {
                        swal("Oops...", "Something went wrong! Make sure you're not trying to delete a node that has child nodes or is the start node of the pipeline.", "error");
                    });
                });
            } else {
                swal("There's no node selected", "Please select the node you want to remove from this pipeline.", "info");
            }
        }
    }
};

/***/ }),

/***/ 39:
/***/ (function(module, exports, __webpack_require__) {

var Component = __webpack_require__(40)(
  /* script */
  __webpack_require__(31),
  /* template */
  __webpack_require__(41),
  /* scopeId */
  null,
  /* cssModules */
  null
)
Component.options.__file = "/home/vagrant/pipeline/resources/assets/js/components/NodeDetails.vue"
if (Component.esModule && Object.keys(Component.esModule).some(function (key) {return key !== "default" && key !== "__esModule"})) {console.error("named exports are not supported in *.vue files.")}
if (Component.options.functional) {console.error("[vue-loader] NodeDetails.vue: functional components are not supported with templates, they should use render functions.")}

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-75122e5a", Component.options)
  } else {
    hotAPI.reload("data-v-75122e5a", Component.options)
  }
})()}

module.exports = Component.exports


/***/ }),

/***/ 40:
/***/ (function(module, exports) {

module.exports = function normalizeComponent (
  rawScriptExports,
  compiledTemplate,
  scopeId,
  cssModules
) {
  var esModule
  var scriptExports = rawScriptExports = rawScriptExports || {}

  // ES6 modules interop
  var type = typeof rawScriptExports.default
  if (type === 'object' || type === 'function') {
    esModule = rawScriptExports
    scriptExports = rawScriptExports.default
  }

  // Vue.extend constructor export interop
  var options = typeof scriptExports === 'function'
    ? scriptExports.options
    : scriptExports

  // render functions
  if (compiledTemplate) {
    options.render = compiledTemplate.render
    options.staticRenderFns = compiledTemplate.staticRenderFns
  }

  // scopedId
  if (scopeId) {
    options._scopeId = scopeId
  }

  // inject cssModules
  if (cssModules) {
    var computed = options.computed || (options.computed = {})
    Object.keys(cssModules).forEach(function (key) {
      var module = cssModules[key]
      computed[key] = function () { return module }
    })
  }

  return {
    esModule: esModule,
    exports: scriptExports,
    options: options
  }
}


/***/ }),

/***/ 41:
/***/ (function(module, exports, __webpack_require__) {

module.exports={render:function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('div', {
    staticClass: "panel panel-default"
  }, [_c('div', {
    staticClass: "panel-body"
  }, [_c('h3', [_vm._v("Node Details")]), _vm._v(" "), (_vm.node) ? _c('div', {
    staticClass: "form-horizontal"
  }, [_c('div', {
    staticStyle: {
      "text-align": "center"
    }
  }, [_c('img', {
    staticStyle: {
      "margin-bottom": "15px"
    },
    attrs: {
      "src": _vm.node.icon
    }
  })]), _vm._v(" "), _c('div', {
    staticClass: "form-group"
  }, [_c('label', {
    staticClass: "col-xs-2 control-label"
  }, [_vm._v("Name")]), _vm._v(" "), _c('div', {
    staticClass: "col-xs-10"
  }, [_c('p', {
    staticClass: "form-control-static"
  }, [_vm._v(_vm._s(_vm.node.name))])]), _vm._v(" "), _c('label', {
    staticClass: "col-xs-2 control-label"
  }, [_vm._v("Type")]), _vm._v(" "), _c('div', {
    staticClass: "col-xs-10"
  }, [_c('p', {
    staticClass: "form-control-static",
    attrs: {
      "id": "node-type"
    }
  }, [_vm._v(_vm._s(_vm.node.type))])])]), _vm._v(" "), _c('div', {
    staticClass: "btn-group",
    attrs: {
      "data-toggle": "buttons"
    }
  }, [_vm._m(0), _vm._v(" "), _vm._m(1), _vm._v(" "), _c('label', {
    staticClass: "btn btn-danger",
    on: {
      "click": this.deleteNode
    }
  }, [_c('i', {
    staticClass: "fa fa-trash"
  }), _vm._v(" Delete\n                    ")])])]) : _c('div', {
    staticClass: "well",
    attrs: {
      "id": "details-info"
    }
  }, [_c('p', [_vm._v("Please select a node to get more options and see all the details for it.")])])])])
},staticRenderFns: [function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('label', {
    staticClass: "btn btn-success",
    attrs: {
      "data-toggle": "modal",
      "data-target": "#new-node-modal"
    }
  }, [_c('i', {
    staticClass: "fa fa-plus"
  }), _vm._v(" Add Child\n                    ")])
},function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('label', {
    staticClass: "btn btn-primary"
  }, [_c('i', {
    staticClass: "fa fa-pencil"
  }), _vm._v(" Setup\n                    ")])
}]}
module.exports.render._withStripped = true
if (false) {
  module.hot.accept()
  if (module.hot.data) {
     require("vue-hot-reload-api").rerender("data-v-75122e5a", module.exports)
  }
}

/***/ }),

/***/ 45:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(11);


/***/ })

/******/ });