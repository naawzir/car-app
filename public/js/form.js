/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/form.js":
/*!******************************!*\
  !*** ./resources/js/form.js ***!
  \******************************/
/*! no static exports found */
/***/ (function(module, exports) {

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

var Errors =
/*#__PURE__*/
function () {
  /**
   * Create a new Errors instance.
   */
  // this will store the errors
  function Errors() {
    _classCallCheck(this, Errors);

    this.errors = {};
  }
  /**
   * Retrieve the error message for a field.
   * @param field
   * @returns {*}
   */


  _createClass(Errors, [{
    key: "get",
    value: function get(field) {
      if (this.errors[field]) {
        return this.errors[field][0];
      }
    }
    /**
     * Determine if an error exists for the given field.
     * @param field
     * @returns {boolean}
     */

  }, {
    key: "has",
    value: function has(field) {
      // if this.errors contains a "field" property which it will if there is an error
      return this.errors.hasOwnProperty(field);
    } // this will delete the relevant error when keying down in the input element

  }, {
    key: "clear",
    value: function clear(field) {
      if (field) {
        // delete is a JavaScript keyword
        delete this.errors[field];
        return;
      }

      this.errors = {};
    }
    /**
     * Determine if we have any errors.
     * @returns {boolean}
     */

  }, {
    key: "any",
    value: function any() {
      // if the length is greater than 0 then we have errors in which case it will return true
      return Object.keys(this.errors).length > 0;
    } // update our errors object in the constructor

  }, {
    key: "record",
    value: function record(errors) {
      this.errors = errors;
    }
  }, {
    key: "reset",
    value: function reset() {
      for (var field in originalData) {
        this[field] = '';
      }
    }
  }]);

  return Errors;
}();

var Form =
/*#__PURE__*/
function () {
  function Form(data) {
    _classCallCheck(this, Form);

    this.originalData = data;

    for (var field in data) {
      this[field] = data[field];
    }

    this.errors = new Errors();
  }

  _createClass(Form, [{
    key: "reset",
    value: function reset() {
      for (var field in this.originalData) {
        this[field] = '';
      }

      this.errors.clear();
    }
  }, {
    key: "post",
    value: function post(url) {
      return this.submit('post', url);
    }
    /**
     * Fetch all relevant data for the form.
     */

  }, {
    key: "data",
    value: function data() {
      // we're cloning the object
      //let data = Object.assign({}, this); // {name, description, originalData, errors}
      //delete data.originalData;
      //delete data.errors;
      var data = {};

      for (var property in this.originalData) {
        data[property] = this[property];
      }

      return data;
    }
  }, {
    key: "onSuccess",
    value: function onSuccess(response) {
      this.reset();
    }
  }, {
    key: "onFail",
    value: function onFail(errors) {
      this.errors.record(errors);
    }
  }, {
    key: "submit",
    value: function submit(requestType, url) {
      var _this = this;

      return new Promise(function (resolve, reject) {
        axios[requestType](url, _this.data()).then(function (response) {
          // got a 200 response from the server
          _this.onSuccess(response.data);

          resolve(response.data); // this points to the then method in the Vue instance.
        }).catch(function (error) {
          _this.onFail(error.response.data.errors);

          reject(error.response.data.errors); // this points to the catch method in the Vue instance.
        });
      });
    }
  }]);

  return Form;
}();

new Vue({
  el: '#car-form',
  data: {
    form: new Form({
      make: makeInput ? makeInput : '',
      model: modelInput ? modelInput : '',
      registration_number: registrationInput ? registrationInput : '' //image: '',

    })
  },
  methods: {
    onSubmit: function onSubmit() {
      this.form.post(slug ? '/cars/' + slug : '/cars/create')
      /*.then(response => {
          alert(response);
          console.log(response);
          //location.href = '/home';
      })*/
      .catch(function (errors) {
        //alert(errors)
        console.log(errors); //return false;
      });
    }
  },
  computed: {
    carDetails: function carDetails() {
      var registrationNumber = this.form.registration_number;

      if (!registrationNumber) {
        registrationNumber.replace(/()/g, '');
      } else {
        registrationNumber = " (";
        registrationNumber += this.form.registration_number;
        ;
        registrationNumber += ")";
      }

      return this.form.make + ' ' + this.form.model + registrationNumber;
    }
    /*, computed: {
        showLoader() {
            submitted: true
        }
    }*/

  }
});
/*
new Vue({
    el: '#create-car-form',
    data: {
        form: new Form ({
            make: make ? make : '',
            model: model ? model : '',
            registration_number: registration ? registration : ''
        })
    },
    methods: {
        onSubmit() {
            this.form.post(slug ? '/cars/' + slug : '/cars/create')
                .then(window.location.href = '/home')
                .catch(errors => {
                    console.log(errors);
                });
        },
    },
    computed: {
        carDetails: function() {
            let registrationNumber = this.form.registration_number;
            if (!registrationNumber) {
                registrationNumber.replace(/()/g, '')
            } else {
                registrationNumber = " (";
                registrationNumber += this.form.registration_number;;
                registrationNumber += ")";
            }
            return this.form.make + ' ' + this.form.model + registrationNumber;
        }
    }
        /!*, computed: {
            showLoader() {
                submitted: true
            }
        }*!/
});*/

/***/ }),

/***/ 1:
/*!************************************!*\
  !*** multi ./resources/js/form.js ***!
  \************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\xampp\htdocs\car-app\resources\js\form.js */"./resources/js/form.js");


/***/ })

/******/ });