<template>
    <div class="container">
        <router-link class="btn btn-success " :to="{name: 'AddDesk'}">
                        Добавить задачу
        </router-link>

        <h1 class="mt-3">Все задачи:</h1>
        <div class="d-flex justify-content-center" v-if="loading">
            <div class="spinner-border text-success" role="status"> </div>
        </div>
        <div class="alert alert-danger" role="alert" v-if="errored">
            Ошибка загрузки данных!
        </div>

        <div class="row" v-if="!loading">
            <div class="col-lg-6" v-for="desk in desks" :key="desk.id">
                <div class="myClass">
                    <div class="card">
                    <h3 class="card-header">Задача: {{desk.name}}</h3>
                    <div class="card-body">
                        <h5 class="card-title">Срок выполнения: {{desk.expiration}}</h5>
                        <p class="card-text"><span class="tags">Описание:</span> {{desk.description}}</p>
                        <p class="card-text"><span class="tags">Комментарии:</span> {{desk.comment}}</p>
                    </div>

                    <router-link class="btn btn-success " :to="{name: 'AddDeskList', params: {deskId: desk.id, name: desk.name}}">
                        Добавить подзадачу
                    </router-link>

                    <div  v-for="desk_list in desk_lists" :key="desk_list.id">
                        <span class="d-flex justify-content-between" v-if="desk.id==desk_list.desk_id"><span><span class="tags">Подзадача:</span> {{desk_list.name}}</span>
                            <button @click="deleteDeskList(desk_list.id)" type="button" class="btn btn-info">Удалить</button>
                        </span>

                    </div>

                </div>
                <router-link class="btn btn-warning" :to="{name: 'showDesk', params: {
                    deskId: desk.id, name: desk.name, expiration: desk.description,
                    description: desk.description, comment: desk.comment}}">
                        Изменить задачу
                </router-link>
                <button @click="deleteDesk(desk.id)" type="button" class="btn btn-danger">Удалить задачу</button>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        name: "Desks",
        data() {
            return {
                desks: [],
                desklists: [],
                errored: false,
                loading: true
            }
        },
        methods: {
            getAllDesks() {
                this.loading = true;
                axios.get('/sanctum/csrf-cookie').then(response => {
                    axios.get('/api/desks', {
                        params: {
                            user_id: window.Laravel.user.id
                        }
                    })
                    .then(response => {
                        this.desks = response.data;
                        console.log(this.desks);
                    })
                    .catch(error => {
                        console.log(error);
                        this.errored = true;
                    })
                    .finally(() => {
                        this.loading = false;
                    })
                })
            },
            deleteDesk(id){
                if(confirm('Вы действительно хотите удалить задачу?')){
                    this.loading = true;
                    axios.get('/sanctum/csrf-cookie').then(response => {
                        axios.post('/api/desks/' + id, {
                            _method: 'DELETE'
                        })
                            .then(response => {
                                this.desks = [];
                                this.getAllDesks();
                            })
                            .catch(error => {
                                console.log(error);
                                this.errored = true;
                            })
                            .finally(() => {
                                this.loading = false;
                            })
                    })
                }
            },
            getDeskLists(){
                this.loading = true;
                axios.get('/sanctum/csrf-cookie').then(response => {
                    axios.get('/api/desk-lists')
                    .then(response => {
                        this.desk_lists = response.data;
                        console.log(response.data);
                    })
                    .catch(error => {
                        console.log(error);
                        this.errored = true;
                    })
                    .finally(() => {
                        this.loading = false;
                    })
                })
            },
            deleteDeskList(id){
                this.loading = true;
                axios.get('/sanctum/csrf-cookie').then(response => {
                    axios.post('/api/desk-lists/' + id, {
                        _method: 'DELETE'
                    })
                        .then(response => {
                            this.desks = [];
                            this.desklists = [];
                            this.getDeskLists();
                            this.getAllDesks();
                        })
                        .catch(error => {
                            console.log(error);
                            this.errored = true;
                        })
                        .finally(() => {
                            this.loading = false;
                        })
                })
            }
        },
        mounted() {
            this.getDeskLists();
            this.getAllDesks();
        }
    }
</script>

<style scoped>
h1{
    text-align: center;
    color: chartreuse;
}
.card-title{
    text-align: center;
    color: coral;
}
.card-body{
    text-decoration: none;
}
.btn{
    width: 50%;
}
.btn-success{
    width: 100%;
}
h3{
    color:deepskyblue;
    text-align: center;
}
.myClass{
    border: 5px solid dodgerblue;
    border-radius: 5px;
    margin-top: 15px;
    margin-bottom: 15px;
}
.btn-info{
    width: 83px;
}
.tags{
    color:red
}
</style>
