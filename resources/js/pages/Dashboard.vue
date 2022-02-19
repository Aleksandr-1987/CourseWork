<template>
    <div class="container">

        <div class="px-4 py-3 text-center">
            <h1 class="display-5 fw-bold">Добро пожаловать {{ name }}</h1>
            <p class="lead mb-4">Здесь Вы сможете вести списки своих задач,
            задача может быть конечной или иметь список подзадач.
            Вы можете создавать, удалять и изменять свои задачи и подзадачи.</p>

        </div>

        <h4>Для этого перейдите во вкладку <router-link class="root" to="/desks"> Доски </router-link></h4>

    </div>
</template>

<script>
export default {
    name: "Dashboard",
    data() {
        return {
            name: null,
        }
    },
    created() {
        if (window.Laravel.user) {
            this.name = window.Laravel.user.name
        }
    },
    beforeRouteEnter(to, from, next) {
        if (!window.Laravel.isLoggedin) {
            console.log("doshly");
            window.location.href = "/";
        }
        next();
    }
}
</script>

<style scoped>
.fw-bold{
    color: aquamarine;
}
.lead{
    color:blue;
}
.root{
    text-decoration: none;
    color: green;
}
</style>
