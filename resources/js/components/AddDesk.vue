<template>
    <div class="container">
        <h1>Добавление задачи:</h1>
        <form @submit.prevent="addNewDesk">
            <div class="form-group">
                <input type="text" v-model="dname" class="form-control" placeholder="Введите название задачи" >
                <input type="date" v-model="dexpiration" class="form-control" placeholder="Введите срок выполнения задачи" >
                <input type="text" v-model="ddescription" class="form-control" placeholder="Введите описание задачи" >
                <input type="text" v-model="dcomment" class="form-control" placeholder="Введите коментарии" >
            </div>
            <button type="submit" class="btn btn-primary mt-1"> Добавить задачу </button>
        </form>
    </div>
</template>

<script>
    export default {
        name: "AddDesk",
        data() {
            return {
                dname: '',
                dexpiration: '',
                ddescription: '',
                dcomment: ''
            }
        },
        methods: {
            addNewDesk(){
                this.loading = true;
                axios.get('/sanctum/csrf-cookie').then(response => {
                    axios.post('/api/desks/', {
                        name:this.dname,
                        expiration:this.dexpiration,
                        description:this.ddescription,
                        comment:this.dcomment,
                        user_id: window.Laravel.user.id
                    })
                        .then(response => {
                            this.errored = false;
                        })
                        .catch(error => {
                            console.log(error.response);
                            this.errored = true;
                        })
                        .finally(() => {
                            this.loading = false;
                            this.$router.push({name: 'Desks'});
                        })
                })
            },
        },

    }
</script>

<style scoped>
h1{
    text-align: center;
    color:darkgreen;
}
</style>
