<template>
    <div id="sidebar-nav" class="sidebar">
        <div class="sidebar-scroll">
            <nav>
                <ul class="nav">
                    <li><router-link :to="{ name: 'dashboard' }"><i class="lnr lnr-home"></i> <span>Dashboard</span></router-link></li>
                    <li><a href="#" class=""><i class="lnr lnr-code"></i> <span>User</span></a></li>
                    <li><a href="#" class=""><i class="lnr lnr-cog"></i> <span>Settings</span></a></li>
                </ul>
            </nav>
        </div>
    </div>
</template>
<script>
    export default {

    }
</script>
