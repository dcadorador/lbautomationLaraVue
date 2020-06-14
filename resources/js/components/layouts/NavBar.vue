<template>
    <!-- NAVBAR -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="brand">
            <a href="#"><img src="img/logo.png" alt="Klorofil Logo" class="img-responsive logo" width="30%" height="30px"></a>
        </div>
        <div class="container-fluid">
            <div id="navbar-menu">
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="img/user.png" class="img-circle" alt="Avatar"> <span>{{ name }}</span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#"><i class="lnr lnr-pencil"></i>Edit Profile</a></li>
                            <li><a href="/login" @click="logout"><i class="lnr lnr-exit"></i> <span>Logout</span></a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script>
    export default {
        data() {
            return {
                name : JSON.parse(localStorage.getItem('user')).name
            }
        },

        methods : {
            logout() {
                localStorage.removeItem('jwt');
                localStorage.removeItem('user');
            }
        }
    }
</script>
