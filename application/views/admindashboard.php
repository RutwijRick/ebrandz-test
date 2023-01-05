<style>
    .update-type {
        display: none;
    }
    .notify {
        background-color: antiquewhite;
    }
</style>

<div class="container-fluid">
    <br>
    <div class="row">
        <div class="col-xs-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"><?php echo $title;?> 
                        <a class="btn btn-danger" href="<?php echo base_url("Home/logout");?>">Logout</a>
                        <!-- <button class="btn btn-outline-danger btn-sm update-type" onclick="deactivateEditing()"> Cancel Editing</button>  -->
                        <button class="btn btn-success btn-sm update-type" onclick="updateAllEdits('update')" style="float: right;"> Update All</button> 
                    </h4>
                    <h6 class="notify"></h6>
                    <div class="table-responsive">
                        <table class="table table-bordered no-wrap" id="main-table">
                            <thead>
                                <tr>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Age</th>
                                    <th>Edit</th>
                                </tr>
                            </thead>
                            <tbody id="main-table-tbody"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>