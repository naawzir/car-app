class Errors {

    /**
     * Create a new Errors instance.
     */

    // this will store the errors
    constructor() {
        this.errors = {};
    }

    /**
     * Retrieve the error message for a field.
     * @param field
     * @returns {*}
     */
    get(field) {
        if (this.errors[field]) {
            return this.errors[field][0];
        }
    }

    /**
     * Determine if an error exists for the given field.
     * @param field
     * @returns {boolean}
     */
    has(field) {
        // if this.errors contains a "field" property which it will if there is an error
        return this.errors.hasOwnProperty(field);
    }

    // this will delete the relevant error when keying down in the input element
    clear(field) {
        if(field) {
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
    any() {
        // if the length is greater than 0 then we have errors in which case it will return true
        return Object.keys(this.errors).length > 0;
    }

    // update our errors object in the constructor
    record(errors) {
        this.errors = errors;
    }

    reset() {
        for (let field in originalData) {
            this[field] = '';
        }
    }
}

class Form {

    constructor(data) {
        this.originalData = data;

        for (let field in data) {
            this[field] = data[field];
        }

        this.errors = new Errors();
    }

    reset() {
        for (let field in this.originalData) {
            this[field] = '';
        }
        this.errors.clear();
    }

    post(url) {
        return this.submit('post', url);
    }

    /**
     * Fetch all relevant data for the form.
     */
    data() {

        // we're cloning the object
        //let data = Object.assign({}, this); // {name, description, originalData, errors}
        //delete data.originalData;
        //delete data.errors;

        let data = {};
        for (let property in this.originalData) {
            data[property] = this[property];
        }

        return data;
    }

    onSuccess(response) {
        this.reset();
    }

    onFail(errors) {
        this.errors.record(errors);
    }

    submit(requestType, url) {
        return new Promise((resolve, reject) => {
            axios[requestType](url, this.data())
                .then(response => { // got a 200 response from the server
                    this.onSuccess(response.data);
                    resolve(response.data); // this points to the then method in the Vue instance.
                })
                .catch(error => {
                    this.onFail(error.response.data.errors);
                    reject(error.response.data.errors); // this points to the catch method in the Vue instance.
                });
        });
    }
}

new Vue({
    el: '#car-form',
    data: {
        form: new Form ({
            make: makeInput ? makeInput : '',
            model: modelInput ? modelInput : '',
            registration_number: registrationInput ? registrationInput : '',
            //image: '',
        })
    },
    methods: {
        onSubmit() {
            this.form.post(slug ? '/cars/' + slug : '/cars/create')
                /*.then(response => {
                    alert(response);
                    console.log(response);
                    //location.href = '/home';
                })*/
                .catch(errors => {
                    //alert(errors)
                    console.log(errors);
                    //return false;
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
    /*, computed: {
        showLoader() {
            submitted: true
        }
    }*/
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
