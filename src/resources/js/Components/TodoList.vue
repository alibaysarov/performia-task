
<script>
import {computed, onMounted, ref, watch} from "vue";
export default {
    name:"TodoList",
    props:['todos','isLoaded','error','isLoaded'],
    setup(props){

        const todoItems = ref([])
        const loaded = ref(props.isLoaded)
        const hasTodos = computed(()=>todoItems.value.length>0)
        const toggleTodo = (idx)=>{
            todoItems.value = todoItems.value.map(el=>{
                if(el.id===idx) {
                    el.isCompleted = !el.isCompleted
                    fetch(`/todos/update/${idx}`,{
                        method:"PUT"
                    }).then(r=>r.json()).then(console.log)
                    return el;
                } else {
                    return el;
                }
            })
        }
        watch(
            () => props.todos,
            (newTodos) => {
                todoItems.value = props.todos;
                loaded.value = true
            }
        );
        watch(
            () => props.error,
            (newTodos) => {
                if(!props.error.empty) {
                    loaded.value = false;
                }
            }
        );

        const removeTodo = (idx)=> {
            todoItems.value = todoItems.value.filter((el,id)=>el.id !== idx);
            fetch(`/todos/remove/${idx}`,{
                method:"DELETE"
            }).then(r=>r.json())
                .then(console.log)
        }
        return {
            todoItems,
            removeTodo,
            toggleTodo,
            loaded,
            hasTodos
        }
    },
}
</script>
<template>
    <div v-auto-animate class="d-flex flex-grow-1 flex-column gap-1 todo-list">
        <div v-if="loaded" v-for="(item,id) in todoItems" :key="item.id" class="d-flex justify-content-between align-items-center gap-2 todo-list-item">
            <div class="todo-list-item__mark form-check">
                <input @change="()=>toggleTodo(item.id)" role="button" :checked=item.isCompleted class="form-check-input" type="checkbox" value="">
            </div>
            <div class="todo-list-item__text">
                {{item.title}}
            </div>
            <div class="todo-list-item__delete">
                <img @click="()=>removeTodo(item.id)" role="button" src="img/icons-close.png" width="20" height="20" alt="">
            </div>
        </div>
        <div v-else-if="!error.empty" class="d-flex justify-content-center align-items-center">
            <h2>{{error.text}}</h2>
        </div>
        <div v-else class="d-flex justify-content-center align-items-center">
            <h2>Loading</h2>
        </div>
        <div v-if="loaded && !hasTodos" class="d-flex justify-content-center align-items-center">
            <h2>No todos</h2>
        </div>
    </div>
</template>
<style>
    .todo-list {
        margin: 20px 0px;
        max-width: 600px;
    }
    .todo-list-item {
        padding: 10px;
        border-radius: 5px;
        border:1px solid #645d5d;
    }
</style>
