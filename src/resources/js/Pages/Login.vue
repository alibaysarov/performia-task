<script>
import {router} from "@inertiajs/vue3";
import {reactive} from "vue";
export default  {
    name:"Login",
    setup(){
        const form = reactive({
            email: '',
            password:''
        })

        function submit() {
            router.post('/login', form)
        }
        return{
            submit,
            form
        }
    }
}

</script>

<template>
<div class="d-flex flex-column align-items-center container">
    <h1>Login</h1>
    <form @submit.prevent="submit">
        <label for="first_name" class="form-label">Email:</label>
        <input id="first_name" class="form-control" v-model="form.email" />
        <label class="form-label" for="email">Password:</label>
        <input class="form-control mb-3" v-model="form.password" />
        <button class="btn btn-primary w-100" type="submit">Login</button>
    </form>
</div>
</template>

