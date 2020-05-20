<template>
    <div>
        <component :is="layout">
            <router-view></router-view>
        </component>
    </div>
</template>

<script>
    export default {
        computed: {
            layout() {
                if(this.$route.meta.layout) {
                    return 'main-layout';
                } else {
                    return 'div';
                }
            }
        }
    }
</script>
