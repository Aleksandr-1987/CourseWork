<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="alert alert-danger" role="alert" v-if="error !== null">
                    {{ error }}
                </div>

                <div class="card card-default">
                    <div class="card-header">Авторизация</div>
                    <div class="card-body">
                        <form @submit.prevent="handleSubmit">
                            <meta name="csrf-token" content="{{ csrf_token() }}">
                            <div class="form-group row">
                                <label for="email" class="col-sm-4 col-form-label text-md-right">Укажите Ваш email</label>
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" v-model="email" required
                                            autofocus autocomplete="off">
                                </div>
                            </div>

                            <div class="form-group row mb-1">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Укажите Ваш пароль</label>
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" v-model="password"
                                            required autocomplete="off">
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Войти
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            email: "",
            password: "",
            error: null,
        }
    },
    methods: {
        handleSubmit(e) {
            window.csrfToken = document.querySelector('meta[name="csrf-token"]').content;
            e.preventDefault()
            if (this.password.length > 0) {
                this.$axios.get('/sanctum/csrf-cookie').then(response => {
                    this.$axios.post('api/login', {
                        _token: csrfToken,
                        email: this.email,
                        password: this.password,
                    })
                        .then(response => {
                            console.log(response.data)
                            if (response.data.success) {
                                window.location.href="/dashboard";
                            } else {
                                this.error = response.data.message
                            }
                        })
                        .catch(function (error) {
                            console.error(error);
                        });
                })
            }
        }
    },
    beforeRouteEnter(to, from, next) {
        if (window.Laravel.isLoggedin) {
            return next('dashboard');
        }
        next();
    }
}
</script>

<style scoped>
.card-default{
    background-image: url("../components/pict.jpg");
    background-repeat: no-repeat center center fixed;
}
.card-header{
    text-align: center;
    color:cyan;
    font-size: 20px;
    font-weight: bold;
}
.text-md-right{
    color: cyan;
}
</style>
