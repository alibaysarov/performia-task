<script>
import {Link} from "@inertiajs/vue3"
export default {
    name:"Header",
    components:{Link}
}
</script>
<template>
    <div class="container my-2">
        <div class="d-flex justify-content-end">
            <div class="d-flex gap-1">
                <Link class="btn btn-primary" href="/login" as="button" type="button">Login</Link>
                <Link class="btn btn-secondary" href="/register" as="button" type="button">Register</Link>
            </div>
        </div>
    </div>
</template>

