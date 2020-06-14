<template>
    <div class="main">
        <div class="container-fluid" style="padding-top: 2.5%">
            <h4 class="page-title"><i class="lnr lnr-funnel"> </i> Infusionsoft Accounts
                &nbsp;<button @click="showInfusionsoftModal" class="btn btn-xs btn-success" ><i class="lnr lnr-plus-circle"> </i> New </button>
            </h4>
            <div v-if="showAlertSuccess" id="" class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <i class="fa fa-check-circle"></i> {{ alertSuccessMessage }}
            </div>
            <div v-if="showAlertWarning" class="alert alert-warning alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <i class="fa fa-warning"></i> {{ alertWarningMessage }}
            </div>
            <div v-if="showAlertError" class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <i class="fa fa-times-circle"></i> {{ alertErrorMessage }}
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-responsive table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>App Name</th>
                                <th>Auth Key</th>
                                <th>Status</th>
                                <th>Created</th>
                                <th>Updated</th>
                                <th width="300px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(account, index) in accounts" v-if="account">
                                <td>{{ account.id }}</td>
                                <td>{{ account.name }}</td>
                                <td>{{ account.auth_key }}</td>
                                <td>{{ account.status }}</td>
                                <td>{{ account.created }}</td>
                                <td>{{ account.updated }}</td>
                                <td>
                                    <button class="btn btn-xs btn-info" @click="goToLogs(account.name)" title="Logs">Show Logs</button>
                                    <button class="btn btn-xs btn-warning" title="Reauth Account">Reauth</button>
                                    <button class="btn btn-xs btn-danger" @click="deleteInfusionsoft(account.id, index)" title="Delete Account">Delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal fade" id="modalAddAccount" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <form v-on:submit.prevent="infusionsoftSubmit">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Infusionsoft Account</h4>
                            </div>
                            <div class="modal-body">
                                <p class="small">Fill up the form to add a new Infusionsoft Account.</p>
                                <br/>
                                <div class="form-group row">
                                    <div class="col-md-8 col-md-offset-2">
                                        <input v-model="infusionsoft.appname" type="text" required placeholder="App Name e.g l328" class="form-control" />
                                    </div>
                                </div>
                                <div class="form-check">
                                    <input v-model="customClient" type="checkbox" class="form-check-input" id="customClient">
                                    <label class="small" for="customClient">Use custom client details ?</label>
                                </div>
                                <div v-if="customClient">
                                    <div class="form-group row">
                                        <div class="col-md-8 col-md-offset-2">
                                            <p class="small" for="customClient">Client ID</p>
                                            <input v-model="infusionsoft.client" :required="customClient" type="text" placeholder="ggqwrwuestsq3gxrygx4b9yp" class="form-control"/>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-8 col-md-offset-2">
                                            <p class="small" for="customClient">Client Secret</p>
                                            <input v-model="infusionsoft.clientSecret" :required="customClient" type="text" placeholder="8s3HDf99ZA" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Add Account</button>
                            </div>
                        </div>
                    </form>
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
                infsModal: false,
                customClient: false,
                infusionsoft: {
                    appname: '',
                    client: '',
                    clientSecret: '',
                },
                accounts: [],
                showAlertSuccess: false,
                showAlertWarning: false,
                showAlertError: false,
                alertSuccessMessage: '',
                alertWarningMessage: '',
                alertErrorMessage: '',
            }
        },
        created() {
            console.log('drew')
            this.infusionsoftAccounts()
        },
        components: {
            'app-legend': Legend,
            'nav-bar': NavBar,
            'side-bar': SideBar,
        //    'infs-modal': InfusionsoftAdd,
        },
        watch: {
            showAlertSuccess: function(oldval, newval) {
                if(oldval != newval) {
                    setTimeout(function() {
                        this.showAlertSuccess = false;
                        $(".alert").slideUp(300);
                    }, 2500)

                }
            }
        },
        methods: {
            showInfusionsoftModal(){
                $('#modalAddAccount').modal('show');
            },

            infusionsoftSubmit() {

                let data = {
                  'appname' : this.infusionsoft.appname,
                  'customClient': this.customClient,
                  'client': this.infusionsoft.client,
                  'clientSecret': this.infusionsoft.clientSecret,
                  'user' : this.$store.state.user.id,
                };

                this.$http.post('/api/v1/infusionsoft', data);

            },

            infusionsoftAccounts() {
                this.$http.get('/api/v1/infusionsoft')
                    .then( ({data}) => {
                        //console.log(data);
                        this.accounts = data.data.map(account => {
                            return {
                                id: parseInt(account.id),
                                name: account.app_name,
                                auth_key: account.auth_key,
                                status: account.status,
                                created: account.created_at,
                                updated: account.updated_at,
                            }
                        });
                    })
                    .catch();
            },

            deleteInfusionsoft(id, index) {
                // console.log(id);
                if(confirm('Are you sure you want to delete this account?')) {
                    this.$http.delete('/api/v1/infusionsoft/' + id)
                        .then(response => {
                            console.log(response)
                            this.showAlertSuccess = true;
                            this.alertSuccessMessage = response.data.message
                            this.accounts.splice(index,1)
                        })
                        .catch(error => {
                            console.log(error)
                        });
                }

                return null;
            },

            goToLogs(name) {
                this.$router.push({
                    name: 'applogs',
                    params: {
                        app: name
                    }
                })
            },

        },


    }
</script>
