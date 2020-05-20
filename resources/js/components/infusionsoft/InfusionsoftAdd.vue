<template>
    <div class="main">
        <div class="main-content">
            <div class="container-fluid" style="padding-top: 2.5%">
                <h4 class="page-title"><i class="lnr lnr-funnel"> </i> Add Infusionsoft Account
                </h4>
                <div class="row">
                    <div class="col-md-6">
                        <div class="panel">
                            <div class="panel-body">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="lnr lnr-funnel"></i></span>
                                    <input class="form-control" placeholder="Account Name e.g. zl328" type="text">
                                </div>
                                <br/>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                    <input class="form-control" placeholder="(optional) Client ID e.g. 128973624jkhbsdf87i6sayfiugh32q4876tywuyhgdf7849" type="text">
                                </div>
                                <br/>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-keyboard-o"></i></span>
                                    <input class="form-control" placeholder="(optional) Client Secret e.g 219807rhgs78sdayhugf8769342" type="text">
                                </div>
                                <br/>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="lnr lnr-pencil"></i></span>
                                    <input class="form-control" placeholder="(optional) Token Type e.g 'bearer' (default)" type="text">
                                </div>
                                <br/>
                                <div class="row">
                                    <div class="col-md-6">
                                        <button @click="back" type="button" class="btn btn-warning btn-block">Cancel</button>
                                    </div>
                                    <div class="col-md-6">
                                        <button type="button" class="btn btn-danger btn-block">Add</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <!-- PANEL SCROLLING -->
                        <div id="panel-scrolling-demo" class="panel">
                            <div class="panel-heading">
                                <h3 class="panel-title">Panel Scrolling</h3>
                            </div>
                            <div class="panel-body">
                                <p>Objectively network visionary methodologies via best-of-breed users. Phosfluorescently initiate go forward leadership skills before an expanded array of infomediaries. Monotonectally incubate web-enabled communities rather than process-centric.</p>
                                <p>Objectively network visionary methodologies via best-of-breed users. Phosfluorescently initiate go forward leadership skills before an expanded array of infomediaries. Monotonectally incubate web-enabled communities rather than process-centric.</p>
                                <p>Objectively network visionary methodologies via best-of-breed users. Phosfluorescently initiate go forward leadership skills before an expanded array of infomediaries. Monotonectally incubate web-enabled communities rather than process-centric.</p>
                            </div>
                        </div>
                        <!-- END PANEL SCROLLING -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {

            }
        },
        methods: {
            back() {
                this.$router.back();
            }
        }
    }
</script>
