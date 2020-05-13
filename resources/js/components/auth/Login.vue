<template>
    <div>
        <p>Login</p>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex';
    import { mapActions } from 'vuex';
    export default {

        computed: {
            ...mapGetters({
                getUser: 'getUser'
            })
        },

        methods: {
            ...mapActions({
                login: 'authentication'
            })
        }
    }
</script>
