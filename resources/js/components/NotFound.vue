<template>
        <div
            class="text-center container"
            style="height: calc(100vh - 258px);">
            <div class="row" style="text-align: center">
                <div>
                    <h1 class="display-2 primary--text">Whoops, 404</h1>
                    <p>The page you were looking for does not exist</p>
                    <button @click="goToHome">
                        Get me out of here!
                    </button>
                </div>
            </div>
        </div>
</template>

<script>
    export default  {
        methods: {
            goToHome() {
                this.$router.push({ name: 'dashboard' })
            }
        }
    }
</script>
