<template>
    <div>
        <hr/>
        <div class="row">
            <div class="col-md-12">
                <h3>Instructions</h3>
                <p>To create a new contact from a http post, simply put the field name on the left, and merge in the desired data on the right.</p>

                <h4>Required fields:</h4>
                <ul>
                    <li>account = the app name that you want to create the contact in (this can be the sending or another account - but it must be authorised above).</li>
                    <li>auth_key = used to protect data inside the Infusionsoft account and block people sending in data that are not allowed. Copy and paste from the destination account above.</li>
                    <li>Email = we use the email for matching and creating the contact.</li>
                </ul>


                <h4>Option fields:</h4>
                <ul>
                    <li>tags = a comma list of tags you want to apply to the destination contact.</li>
                </ul>
            </div>
        </div>
        <hr/>
        <div class="row">
            <div class="col-sm-4">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Field Name</th>
                            <th>Type</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr><td>AccountId</td><td>Id</td></tr>
                        <tr><td>Address1Type</td><td>String</td></tr>
                        <tr><td>Address2Street1</td><td>String</td></tr>
                        <tr><td>Address2Street2</td><td>String</td></tr>
                        <tr><td>Address2Type</td><td>String</td></tr>
                        <tr><td>Address3Street1</td><td>String</td></tr>
                        <tr><td>Address3Street2</td><td>String</td></tr>
                        <tr><td>Address3Type</td><td>String</td></tr>
                        <tr><td>Anniversary</td><td>Date</td></tr>
                        <tr><td>AssistantName</td><td>String</td></tr>
                        <tr><td>AssistantPhone</td><td>String</td></tr>
                        <tr><td>BillingInformation</td><td>String</td></tr>
                        <tr><td>Birthday</td><td>Date</td></tr>
                        <tr><td>City</td><td>String</td></tr>
                        <tr><td>City2</td><td>String</td></tr>
                        <tr><td>City3</td><td>String</td></tr>
                        <tr><td>Company</td><td>String</td></tr>
                        <tr><td>CompanyID</td><td>Id</td></tr>
                        <tr><td>ContactNotes</td><td>String</td></tr>
                        <tr><td>ContactType</td><td>String</td></tr>
                        <tr><td>Country</td><td>String</td></tr>
                        <tr><td>Country2</td><td>String</td></tr>
                        <tr><td>Country3</td><td>String</td></tr>
                        <tr><td>Email</td><td>String</td></tr>
                        <tr><td>EmailAddress2</td><td>String</td></tr>
                    </tbody>
                </table>
            </div>

            <div class="col-sm-4">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Field Name</th>
                            <th>Type</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr><td>EmailAddress3</td><td>String</td></tr>
                        <tr><td>Fax1</td><td>String</td></tr>
                        <tr><td>Fax1Type</td><td>String</td></tr>
                        <tr><td>Fax2</td><td>String</td></tr>
                        <tr><td>Fax2Type</td><td>String</td></tr>
                        <tr><td>FirstName</td><td>String</td></tr>
                        <tr><td>JobTitle</td><td>String</td></tr>
                        <tr><td>Language</td><td>String</td></tr>
                        <tr><td>LastName</td><td>String</td></tr>
                        <tr><td>LeadSourceId</td><td>Id</td></tr>
                        <tr><td>Leadsource</td><td>String</td></tr>
                        <tr><td>MiddleName</td><td>String</td></tr>
                        <tr><td>Nickname</td><td>String</td></tr>
                        <tr><td>OwnerID</td><td>Id</td></tr>
                        <tr><td>Password</td><td>String</td></tr>
                        <tr><td>Phone1</td><td>String</td></tr>
                        <tr><td>Phone1Ext</td><td>String</td></tr>
                        <tr><td>Phone1Type</td><td>String</td></tr>
                        <tr><td>Phone2</td><td>String</td></tr>
                        <tr><td>Phone2Ext</td><td>String</td></tr>
                        <tr><td>Phone2Type</td><td>String</td></tr>
                        <tr><td>Phone3</td><td>String</td></tr>
                        <tr><td>Phone3Ext</td><td>String</td></tr>
                        <tr><td>Phone3Type</td><td>String</td></tr>
                    </tbody>
                </table>
            </div>

            <div class="col-sm-4">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Field Name</th>
                            <th>Type</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr><td>Phone4</td><td>String</td></tr>
                        <tr><td>Phone4Ext</td><td>String</td></tr>
                        <tr><td>Phone4Type</td><td>String</td></tr>
                        <tr><td>Phone5</td><td>String</td></tr>
                        <tr><td>Phone5Ext</td><td>String</td></tr>
                        <tr><td>Phone5Type</td><td>String</td></tr>
                        <tr><td>PostalCode</td><td>String</td></tr>
                        <tr><td>PostalCode2</td><td>String</td></tr>
                        <tr><td>PostalCode3</td><td>String</td></tr>
                        <tr><td>ReferralCode</td><td>String</td></tr>
                        <tr><td>SpouseName</td><td>String</td></tr>
                        <tr><td>State</td><td>String</td></tr>
                        <tr><td>State2</td><td>String</td></tr>
                        <tr><td>State3</td><td>String</td></tr>
                        <tr><td>StreetAddress1</td><td>String</td></tr>
                        <tr><td>StreetAddress2</td><td>String</td></tr>
                        <tr><td>Suffix</td><td>String</td></tr>
                        <tr><td>TimeZone</td><td>String</td></tr>
                        <tr><td>Title</td><td>String</td></tr>
                        <tr><td>Username</td><td>String</td></tr>
                        <tr><td>Website</td><td>String</td></tr>
                        <tr><td>ZipFour1</td><td>String</td></tr>
                        <tr><td>ZipFour2</td><td>String</td></tr>
                        <tr><td>ZipFour3</td><td>String</td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
</script>
