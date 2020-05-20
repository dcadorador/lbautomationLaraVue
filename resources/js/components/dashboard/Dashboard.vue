<template>
    <div class="main">
        <div class="container-fluid" style="padding-top: 2.5%">
            <h4 class="page-title"><i class="lnr lnr-funnel"> </i> Infusionsoft Accounts
                &nbsp;<button @click="addInfusionsoft" class="btn btn-xs btn-success" ><i class="lnr lnr-plus-circle"> </i> New </button>
            </h4>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-responsive table-bordered table-striped">
                        <tr>
                            <th>ID</th>
                            <th>App Name</th>
                            <th>Auth Key</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th>Updated</th>
                            <th width="300px">Action</th>
                        </tr>
                    </table>
                </div>
            </div>
            <app-legend/>
        </div>
    </div>
</template>

<script>
    import Legend from "./Legend";
    import NavBar from "../layouts/NavBar";
    import SideBar from "../layouts/SideBar";

    export default {
        data() {
            return {

            }
        },
        created() {

        },
        components: {
            'app-legend': Legend,
            'nav-bar': NavBar,
            'side-bar': SideBar,
        },
        methods: {
            addInfusionsoft() {
                this.$router.push('/infusionsoft')
            }
        },

    }
</script>
