

new Vue({
    el: '#create-car-form',
    data: {
        form: new Form ({
            make: '',
            model: '',
            registration_number: ''
        })
    },
    methods: {
        onSubmit() {
            this.form.post('/cars/create')
            //.then()
                .catch(errors => {
                    console.log(errors);
                });
        }
        /*, computed: {
            showLoader() {
                submitted: true
            }
        }*/
    }
});