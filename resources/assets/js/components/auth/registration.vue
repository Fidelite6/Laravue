<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="registration-wrapper">
                    <h3>Registration</h3>
                    <div class="error-server error" v-if="serverError">Registration Error</div>
                    <ul class="error-list error" v-if="registerErrors">
                        <li v-for="error in registerErrors">{{ error[0] }}</li>
                    </ul>
                    <form v-on:submit.prevent="registration">
                        <div>
                            <div class="form-group" >
                                <p class="error" v-if="errors.name">Name must contains at least 3 symbols</p>
                                <input type="text" class="form-control" placeholder="Имя" v-model="data.name"
                                       v-bind:class="{ 'input-error': errors.name}">
                                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                            </div>

                            <div class="form-group">
                                <p class="error" v-if="errors.email">Email in not right</p>
                                <input type="email" class="form-control" placeholder="Email*" v-model="data.email"
                                       v-bind:class="{ 'input-error': errors.email}">
                            </div>
                        </div>
                        <div class="right">
                            <div class="form-group">
                                <p class="error" v-if="errors.password">Password must contains at least 6 symbols</p>
                                <input type="password" class="form-control" placeholder="Пароль*" v-model="data.password"
                                       v-bind:class="{ 'input-error': errors.password}">
                            </div>
                        </div>
                        <div class="row p-3">
                            <div class="col-xs-4">
                                <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script type="text/babel">
    export default {
        data () {
            return {
                data: {
                    name: '',
                    email: '',
                    password: '',
                },
                errors: {
                    name: false,
                    email: false,
                    password: false,
                },
                serverError: false,
                registerErrors: false,
            }
        },
        mounted () {

        },
        methods: {
            registration () {
                if (this.validate()) return false
                this.$http.post('/register', this.data).then(res => {
                    if (res.status === 201) {
                        location.href = '/'
                    }
                }, err => {
                    if (+err.status === 400) {
                        this.serverError = true
                        this.registerErrors = err.data['registerErrors']
                    }
                })
            },
            validate () {
                for (let key in this.data) {
                    switch (key) {
                        case 'name':
                            if (!this.data[key] || this.data[key].length < 3) {
                                this.$set(this.errors, key, true)
                            } else {
                                this.$set(this.errors, key, false)
                            }
                            break
                        case 'password':
                            if (!this.data[key] || this.data[key].length < 4) {
                                this.errors[key] = true
                            } else {
                                this.errors[key] = false
                            }
                            break

                        case 'email':
                            if (!this.checkEmail(this.data[key])) {
                                this.errors[key] = true
                            } else {
                                this.errors[key] = false
                            }
                            break
                    }
                }
                let hasError = false
                for (let key in this.errors) {
                    if (this.errors[key]) {
                        hasError = true
                    }
                }
                return hasError
            },
            checkEmail (email) {
                let re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
                return re.test(email.toLowerCase());
            },
        }
    }
</script>
<style scoped>
    p.error{
        color: red;
        font-size: 12px;
        position: absolute;
        left: auto;
        top: 0;
        width: 100%;
        line-height: 12px;
    }
    .registration .container form > div input {
        margin: 0 0 15px;
    }
    .registration .container form .agree{
        position: relative;
        padding: 10px 0 0 0;
        margin-top: 20px;
    }
    @media screen and (max-width: 680px){
        .agree p.error{
            top: -20px;
        }
    }
    .error-server.error{
        color: red;
    }
    .error-list.error{
        color: red;
        list-style: none;
        padding: 0;
    }
</style>