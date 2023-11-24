<script>
import TodoList from "../Components/TodoList.vue";
import {router} from '@inertiajs/vue3'
import {ref} from 'vue';
import {onMounted} from "vue";

export default {
    name: "Home",
    components: {TodoList},
    props: ['title', 'des'],
    setup() {
        const inputVal = ref('');
        const todos = ref([])
        const error = ref({
            empty: false,
            text: ''
        })
        const isLoaded = ref(false)
        const addTodo = () => {
            fetch('/todos/new', {
                method: "POST",
                body: JSON.stringify({title: inputVal.value}),
                headers: {
                    "Content-type": "application/json"
                }
            }).then(r => {
                const {status} = r;
                if (status >= 200 && status !== 500) {
                    return r.json()
                }
            }).then(() => {
                todos.value = [...todos.value, {
                    title: inputVal.value,
                    isCompleted: 0
                }]
                inputVal.value = ''
            })

        };

        onMounted(() => {
            fetch('/todos/all')
                .then(r => r.json())
                .then((data) => {
                    todos.value = data.map(el => {
                        el.isCompleted = Boolean(el.isCompleted)
                        return el
                    })
                    isLoaded.value = true
                })
                .catch((e) => {
                    error.value = {
                        empty: true,
                        text: "An error occurred"
                    }
                });

        })

        return {
            inputVal,
            addTodo,
            todos,
            error
        };
    }
}
</script>

<template>
    <div class="todo__container container">
        <div class="d-flex flex-column align-items-center">
            <h1 class="text-center">{{ title }}</h1>
            <div class="d-flex gap-1 align-items-center todo-input">
                <input v-model="inputVal" type="text" class="input-group p-1" placeholder="Add Todo">
                <button :disabled="!inputVal.length" @click="addTodo" class="btn btn-primary w-50 ">Add Item</button>
            </div>
        </div>
        <div class="d-flex justify-content-center container">
            <TodoList :todos="todos" :error="error"/>
        </div>


    </div>
</template>

<style lang="css">
.todo-input {
    max-width: 900px;
}
</style>
