<template>
    <div class="main">
        <div class="main-content">
            <div class="container-fluid">
                <h4 class="page-title"><i class="lnr lnr-funnel"> </i> Infusionsoft Accounts
                    &nbsp;<button class="btn btn-xs btn-success new-accnt-btn" ><i class="lnr lnr-plus-circle"> </i> New </button>
                </h4>
                <div v-if="false" class="container">
                    <div id="session-message" class="alert alert-success" style="text-align: center">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-responsive table-bordered table-striped">
                        </table>
                    </div>
                </div>
                <legend></legend>
            </div>
        </div>
    </div>
</template>

<script>
    import Legend from "./Legend";

    export default {
        components: {
            Legend
        }
    }
</script>
