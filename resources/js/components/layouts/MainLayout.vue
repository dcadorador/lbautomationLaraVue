<template>
    <div id="wrapper">
        <nav-bar/>
        <side-bar/>
            <slot/>
    </div>
</template>

<script>
    import NavBar from "../layouts/NavBar";
    import SideBar from "../layouts/SideBar";

    export default {
        components: {
            'nav-bar': NavBar,
            'side-bar': SideBar,
        }
    }
</script>
