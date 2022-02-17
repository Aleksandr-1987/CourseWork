<template>
    <div class="container">
        <h1>Изменение задачи: {{name}}</h1>
        <form @submit.prevent="saveDesk">
            <div class="form-group">
                <input type="text" v-model="dname" class="form-control" placeholder="Введите название задачи" >
                <input type="date" v-model="dexpiration" class="form-control" placeholder="Введите название доски" >
                <input type="text" v-model="ddescription" class="form-control" placeholder="Введите описание задачи" >
                <input type="text" v-model="dcomment" class="form-control" placeholder="Введите коментарии" >
            </div>
            <button type="submit" class="btn btn-primary mt-1"> Сохранить изменения </button>
        </form>

    </div>
</template>

<script>
    export default {
        name: "showDesk",
        props: [
            'deskId', 'name', 'expiration', 'description', 'comment'
        ],
        data() {
            return {
                dname: '',
                dexpiration: '',
                ddescription: '',
                dcomment: ''
            }
        },
        methods: {
            saveDesk(){
                this.loading = true;
                axios.get('/sanctum/csrf-cookie').then(response => {
                    axios.post('/api/desks/' + this.deskId, {
                        _method: 'PUT',
                        name:this.dname,
                        expiration:this.dexpiration,
                        description:this.ddescription,
                        comment:this.dcomment
                    })
                    .then(response => {
                        //this.name = response.data.data.name;
                        console.log(response.data);
                    })
                    .catch(error => {
                        console.log(error);
                        this.errored = true;
                    })
                    .finally(() => {
                        this.loading = false;
                        this.$router.push({name: 'Desks'});
                    })
                })
            }
        },
        mounted() {
            this.dname = this.name;
            this.dexpiration = this.expiration;
            this.ddescription = this.description;
            this.dcomment = this.comment;
        },
    }
</script>

<style scoped>
h1{
    color: green;
}
</style>
