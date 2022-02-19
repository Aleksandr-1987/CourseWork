<template>
    <div class="container">
        <div class="px-4 py-3 text-center">
            <h1 class="display-5 fw-bold">Веб-планировщик задач 2</h1>
            <div class="col-lg-6 mx-auto"> </div>
            <p class="lead mb-4">Если бы Юлий Цезарь жил в наше время, он вряд ли бы делал три дела одновременно: «долой work in progress», знаете ли. И он уж точно бы не хранил весь свой ворох задач на стикерах и бумажках, а пользовался бы онлайн-планировщиком. Осталось только выяснить, каким именно.</p>
            <div class="d-grid gap-2 d-sm-flex justify-content-sm-center"> </div>
        </div>

        <h3>Наши пользователи:</h3>
        <div v-for="user in users" :key="user.id">
            <h5>- {{user.name}}</h5>
        </div>

    </div>
</template>

<script>
    export default {
        name: 'home',
        data() {
            return {
                users: [],
            }
        },
        mounted() {
            axios.get('/api/users')
                    .then(response => {
                        this.users = response.data;
                        //console.log(this.desks);
                    })
                    .catch(error => {
                        console.log(error);
                    })
                    .finally(() => {

                    })
        },

    }
</script>

<style scoped>
.fw-bold{
    color: aquamarine;
}
.lead{
    color:blue;
}
h3{
    color: darkorchid;
    font-weight: bold;
}
h5{
    font-size: 30px;
    color: chartreuse;
    font-weight: bold;

}
</style>
