document.addEventListener("DOMContentLoaded", e => {
    class FrontValidator {
        constructor(form, fields) {
            this.form = form
            this.fields = fields
        }

        initialize() {
            this.validateOnEntry()
            this.validateOnSubmit()
        }

        validateOnSubmit() {
            let self = this

            this.form.addEventListener('submit', e => {

                let i = 0
                self.fields.forEach(field => {
                    const input = document.querySelector(`#${field}`)
                    self.validateFields(input)
                    if (!input.classList.contains('input')) {
                        i++;
                    }
                })

                if (i != this.fields.length) { // nese nuk ka errore ne form behet submit
                    e.preventDefault()
                }
            })
        }

        validateOnEntry() {
            let self = this
            this.fields.forEach(field => {
                const input = document.querySelector(`#${field}`)
                input.addEventListener('input', event => {
                    self.validateFields(input)

                })
            })
        }

        validateFields(field) {

            // nese eshte bosh
            if (field.value.trim() === "") {
                this.setStatus(field, `${field.previousElementSibling.innerText} cannot be blank`, "error")
            } else {
                this.setStatus(field, null, "success")
            }

            if (this.form.classList.contains("form-signup") || this.form.classList.contains("form-reset")) { //nese eshte signup form

                // validimet e emailit
                if (field.type === "email") {
                    const re = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i
                    if ((re.test(field.value) && (field.value.length < 128))) {
                        this.setStatus(field, null, "success")
                    } else if (field.value.length >= 128) {
                        this.setStatus(field, "Does not have valid length", "error")
                    } else {
                        this.setStatus(field, "Please enter valid email address", "error")
                    }
                }

                //Validimet e Emrit
                if ((field.id === "first_name") && (field.value.trim() != "")) {

                    const re = /\s/g
                    if ((!re.test(field.value)) && (field.value.length >= 3) && (field.value.length < 32)) {
                        this.setStatus(field, null, "success")
                    } else if ((field.value.length < 3) || (field.value.length >= 32)) {
                        this.setStatus(field, "Does not have valid length", "error")
                    } else {
                        this.setStatus(field, "Please remove spaces", "error")
                    }
                }

                //Validimimet e Mbiemrit
                if ((field.id === "last_name") && (field.value.trim() != "")) {

                    const re = /\s/g
                    if ((!re.test(field.value)) && (field.value.length >= 3) && (field.value.length < 32)) {
                        this.setStatus(field, null, "success")
                    } else if ((field.value.length < 3) || (field.value.length >= 32)) {
                        this.setStatus(field, "Does not have valid length", "error")
                    } else {
                        this.setStatus(field, "Please remove spaces", "error")
                    }
                }


                // Validimet e passwordit
                if (field.id === "password") {
                    const re = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{8,}$/
                    const reLower = /[a-z]/  // At least one lowercase English letter.
                    const reUpper = /[A-Z]/  // At least one uppercase English letter.
                    const reDigit = /\d/  // At least one digit.


                    if (re.test(field.value)) {
                        this.setStatus(field, null, "success")
                        this.onTyping("", "success")
                    } else if (!re.test(field.value)) {
                        this.onTyping("", "error")
                        this.setStatus(field, null, "error")
                    }
                    if (reLower.test(field.value)) {
                        this.onTyping("lower", "success")
                    } else if (!reLower.test(field.value)) {
                        this.onTyping("lower", "error")
                    }
                    if (reUpper.test(field.value)) {
                        this.onTyping("upper", "success")
                    } else if (!reUpper.test(field.value)) {
                        this.onTyping("upper", "error")
                    }
                    if (reDigit.test(field.value)) {
                        this.onTyping("digit", "success")
                    } else if (!reDigit.test(field.value)) {
                        this.onTyping("digit", "error")
                    }
                    if (field.value.length >= 8) {
                        this.onTyping("charE", "success")
                    } else if (field.value.length < 8) {
                        this.onTyping("charE", "error")
                    }
                }


                // Validimete e  konfigurimit te passwordit
                if (field.id === "password1") {
                    const passwordField = this.form.querySelector('#password')

                    if (field.value.trim() == "") {
                        this.setStatus(field, "Password confirmation required", "error")
                    } else if (field.value != passwordField.value) {
                        this.setStatus(field, "Password does not match", "error")
                    } else {
                        this.setStatus(field, null, "success")
                    }
                }
            }
        }

        onTyping(message, status) {

            let validimePass = document.querySelector('.validimePass')
            let charE = document.querySelector('.charE')
            let upper = document.querySelector('.upper')
            let lower = document.querySelector('.lower')
            let digit = document.querySelector('.digit')


            if (status === "success") {

                if (message == "charE") {
                    charE.classList.add('hidden')
                } else if (message == "upper") {
                    upper.classList.add('hidden')
                } else if (message == "lower") {
                    lower.classList.add('hidden')
                } else if (message == "digit") {
                    digit.classList.add('hidden')
                } else {
                    validimePass.classList.add('hidden')
                }
            }
            if (status === "error") {

                if (message == "charE") {
                    charE.classList.remove('hidden')
                } else if (message == "upper") {
                    upper.classList.remove('hidden')
                } else if (message == "lower") {
                    lower.classList.remove('hidden')
                } else if (message == "digit") {
                    digit.classList.remove('hidden')
                } else {
                    validimePass.classList.remove('hidden')
                }
            }
        }

        setStatus(field, message, status) {

            const errorMessage = field.parentElement.querySelector('.error_form')


            if (status === "success") {

                if (errorMessage) {
                    errorMessage.innerText = ""
                }
                field.classList.remove('input')
            }

            if (status === "error") {

                field.parentElement.querySelector('.error_form').innerText = message
                field.classList.add('input')
            }
        }
    }

    class ServerValidator {
        constructor(idx) {
            this.idx = idx
        }

        initialize() {
            this.validate()
        }

        validate() {

            e.preventDefault()
            const input = document.querySelector(`#${this.idx}`)
            const params = new URLSearchParams(window.location.search);
            input.classList.add('hidden')

            if ((params.has("err")) || (params.has("msg"))) {
                input.classList.remove('hidden')
                if (this.idx == "uiMess") {
                    input.innerHTML += "! Server error msg: " + params.get("msg")
                }
            }

        }
    }


    const formLogin = document.querySelector('.form-login')
    const fieldsLogin = ["email", "password"]
    const validatorLogin = new FrontValidator(formLogin, fieldsLogin)
    const validator_Login = new ServerValidator('uiMessage_Login')
    if (formLogin != null) { // shfaq  brenda kushtit, nese brenda classes se formes gjendet .form-login
        validator_Login.initialize()  // validimet ne backend
        validatorLogin.initialize()     // validimet ne frontend
    }


    const formSignup = document.querySelector('.form-signup');
    const fields = ["email", "first_name", "last_name", "password", "password1"];
    const validator = new FrontValidator(formSignup, fields);
    const validator_Signup = new ServerValidator('uiMess');
    if (formSignup != null) { // shfaq brenda kushtit, nese brenda classes se formes gjendet .form-signup
        validator_Signup.initialize() // validimet ne backend
        validator.initialize()     // validimet ne frontend
    }


    // Validimet e adminit:
    const formRole = document.querySelector('.role');
    const fieldsRole = ["role-name"];
    const validatorRole = new FrontValidator(formRole, fieldsRole);
    const validator_Role = new ServerValidator('uiMess');
    if (formRole != null) {
        validatorRole.initialize();
        validator_Role.initialize();
    }

    const formGenre = document.querySelector('.genre');
    const fieldsGenre = ["genre-name", "description"];
    const validatorGenre = new FrontValidator(formGenre, fieldsGenre);
    const validator_Genre = new ServerValidator('uiMess');
    if (formGenre != null) {
        validatorGenre.initialize();
        validator_Genre.initialize();
    }


    const formPerson = document.querySelector('.person-name');
    const validator_Person = new ServerValidator('uiMess');
    const fieldsPerson = ["person-name"];
    const validatorPerson = new FrontValidator(formPerson, fieldsPerson);
    if (formPerson != null) {
        validatorPerson.initialize();
        validator_Person.initialize();
    }

    //reset pwd
    const formReset = document.querySelector('.form-reset');
    const validator_Reset = new ServerValidator('uiMess');
    const fieldsReset = ["password", "password1"];
    const validatorReset = new FrontValidator(formReset, fieldsReset);
    if (formReset != null) {
        validatorReset.initialize();
        validator_Reset.initialize();
    }
});
