<template>
    <div class="main">
        <div class="container-fluid" style="padding-top: 2.5%">
            <h4 class="page-title"><i class="lnr lnr-book"> </i> Copy Logs - Account Name : <b>{{ this.$route.params.app }}</b>
                &nbsp;<a class="btn btn-xs btn-info" href="/" >Back</a>
            </h4>
            <div class="col-md-12">
                <div class="table">
                    <table class="table table-responsive table-sm table-hover table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>App Name</th>
                                <th>Data</th>
                                <th>Result</th>
                                <th>Created</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-if="logs.length > 0" v-for="(log,index) in logs">
                                <td>{{ log.id }}</td>
                                <td>{{ log.name }}</td>
                                <td class="col-3">{{ log.data }}</td>
                                <td>{{ log.result }}</td>
                                <td>{{ log.created_at }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        data() {
            return {
                logs: [],
            }
        },

        created() {
            this.getAccountLogs();
        },
        methods: {
            getAccountLogs() {
                let app = this.$route.params.app;

                this.$http.get('/api/v1/infusionsoft/account/' + app + '/logs')
                    .then(({data}) => {
                        // console.log(data.data)
                        this.logs = data.data.map(log => {
                            return {
                                id: parseInt(log.id),
                                name: log.app_name,
                                data: log.data,
                                result: log.results,
                                created: log.created_at,
                            }
                        });
                    })
            }
        }
    }
</script>
