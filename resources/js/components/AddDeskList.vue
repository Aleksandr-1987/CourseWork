<template>
    <div class="container">
        <h1>Добавление подзадачи к задаче: {{name}}</h1>
        <form @submit.prevent="addList">
                <div class="form-group">
                    <input type="text" v-model="list_name" class="form-control" placeholder="Введите название подзадачи" >
                </div>
                <button type="submit" class="btn btn-primary mt-1"> Добавить подзадачу </button>
        </form>

    </div>
</template>

<script>
    export default {
        name: "AddDeskList",
        props:['deskId', 'name'],
        data() {
            return {
                list_name:''
            }
        },
        methods: {
            addList(){
                this.loading = true;
                axios.get('/sanctum/csrf-cookie').then(response => {
                    axios.post('/api/desk-lists/', {
                        name:this.list_name,
                        desk_id: this.deskId
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
            }
        },
    }
</script>

<style scoped>
h1{
    color:fuchsia;
}

</style>
