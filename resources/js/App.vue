<template>
    <div class="container">

        <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
            <ul class="nav nav-pills" v-if="isLoggedIn">
                <li class="nav-item">
                    <router-link class="route nav-link" to="/dashboard" > Страница пользователя </router-link>
                </li>
                <li class="nav-item">
                    <router-link class="route nav-link" to="/desks"> Доски </router-link>
                </li>
                <li class="nav-item" >
                    <a id="exit" class="route nav-link" style="cursor: pointer;" @click="logout"> Выход </a>
                </li>
            </ul>

            <ul class="nav nav-pills" v-else>
                <li class="nav-item">
                    <router-link class="route nav-link" to="/" >Домашняя </router-link>
                </li>
                <li class="nav-item">
                    <router-link class="route nav-link" to="/login"> Авторизация </router-link>
                </li>
                <li class="nav-item">
                    <router-link class="route nav-link" to="/register"> Регистрация </router-link>
                </li>
            </ul>
        </header>

        <router-view/>
    </div>
</template>

<script>
export default {
    name: "App",
    data() {
        return {
            isLoggedIn: false,
        }
    },
    created() {
        if (window.Laravel.isLoggedin) {
            this.isLoggedIn = true
        }
    },
    methods: {
        logout(e) {
            console.log('ss')
            e.preventDefault()
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.post('/api/logout')
                    .then(response => {
                        if (response.data.success) {
                            window.location.href = "/"
                        } else {
                            console.log(response)
                        }
                    })
                    .catch(function (error) {
                        console.error(error);
                    });
            })
        }
    },
}
</script>

<style scoped>
.route{
    text-decoration: none;
}
.nav-link:hover{
    color: aquamarine;
}
#exit:hover{
    color: red;
}
.nav-link{
    color: chartreuse;
    font-size: 20px;
}
.nav-link:hover{
    color: yellow;
}
</style>
