<style type="text/css">
    .permission_table label{
        margin-left: 10px;
        font-weight: 600;
    }
   .btn-green {
        background: #33c543;
        color: #fff;
        -webkit-border-radius: 0;
        -moz-border-radius: 0;
        border-radius: 4px;
        font-family: 'Barlow', sans-serif;
        border: #33c543 1px solid;
        padding: 6px 16px;
        font-size: 13px;
        font-weight: 400;
        text-decoration: none;
        transition-duration: 0.5s;
        -webkit-transition-duration: 0.5s;
        display: inline-block;
    }

    .btn-green:focus,
    .btn-green:hover {
        background: #000;
        color: #33c543;
        border: #33c543 1px solid;
        transition-duration: 0.5s;
        -webkit-transition-duration: 0.5s;
        outline: 0;
    }
    .btn-yellow {
        background: #ff9600;
        color: #fff;
        -webkit-border-radius: 0;
        -moz-border-radius: 0;
        border-radius: 4px;
        font-family: 'Barlow', sans-serif;
        border: #ff9600 1px solid;
        padding: 6px 16px;
        font-size: 13px;
        font-weight: 400;
        text-decoration: none;
        transition-duration: 0.5s;
        -webkit-transition-duration: 0.5s;
        display: inline-block;
    }

    .btn-yellow:focus,
    .btn-yellow:hover {
        background: #000;
        color: #33c543;
        border: #33c543 1px solid;
        transition-duration: 0.5s;
        -webkit-transition-duration: 0.5s;
        outline: 0;
    }
    .table-striped>tbody>tr:nth-of-type(odd) {
        --bs-table-accent-bg: #f9f9f9;
        color: var(--bs-table-striped-color);
    }

    .spinner-span{
        margin: 6px 10px;
    }
    .parent-info{
        background: #246fc938;
    }
    .parent-info td{
        font-weight: 600;
    }
</style>
<div class="app-content pt-3 p-md-3 p-lg-3">
    <div class="container-xl">
        <div class="row g-3 mb-4 align-items-center justify-content-between">
            <div class="col-auto">
                <h1 class="app-page-title mb-0">Role Permission Manage</h1>
            </div>
            <div class="col-auto">
                <div class="page-utilities">
                    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                        <!--//col--> 
                    </div>
                    <!--//row-->
                </div>
                <!--//table-utilities-->
            </div>
            <!--//col-auto-->
        </div>
        <!--//row-->

        <div class="app-card app-card-orders-table shadow-sm mb-5">
            <div class="app-card-body">
                <div class="col-lg-4 col-sm-12 col-md-6 m-3" style="padding-top: 15px; display: inline-flex">
                        <select name="tax_status" class="form-select select2" id="user_role" required onchange="getRolePermission(this.value)">
                            <option value="" selected>Select Role</option>
                            <?php
                                if($roles){
                                    foreach($roles as $role){
                                        ?>
                                            <option value="<?= $role['role_id'] ?>"> <?= $role['role_name'] ?></option>
                                        <?php
                                    }
                                }
                            ?>
                        </select>
                        <span class="spinner-span">
                            <i class="fa fa-spinner fa-spin user-role-spinner" style="font-size:24px; display: none"></i>
                        </span>
                    </div>
                <div class="table-responsive permission_table">
                        <table class="table app-table-hover table-striped mb-0 text-left" id="sports_facilities">
                        <thead>
                            <tr>
                            <th class="cell">Menu Name</th>
                                <th class="cell">Menu type</th>
                                <th class="cell">Add </th>
                                <th class="cell">Edit</th>
                                <th class="cell">Listing </th>
                                <th class="cell">Download</th>
                                <th class="cell">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr  class="menu-tree">
                                <td class="cell"></td>
                                <td class="cell"></td>
                                <td class="cell">
                                    <input type="checkbox" id="select_all_add" class="select_all" name="" value="1" onclick="updateMenuAction(this, 'cls_add')">
                                    <label for="select_all_add">Select All</label>
                                </td>
                                <td class="cell">
                                    <input type="checkbox" id="select_all_edit" class="select_all" name="" value="1" onclick="updateMenuAction(this, 'cls_edit')">
                                    <label for="select_all_edit">Select All</label>
                                </td>
                                <td class="cell">
                                    <input type="checkbox" id="select_all_delete" class="select_all" name="" value="1" onclick="updateMenuAction(this, 'cls_delete')">
                                    <label for="select_all_delete">Select All</label>
                                </td>
                                <td class="cell">
                                    <input type="checkbox" id="select_all_print" class="select_all" name="" value="1" onclick="updateMenuAction(this, 'cls_print')">
                                    <label for="select_all_download">Select All</label>
                                </td>
                                <td class="cell">
                                <?php
                                    if(check_user_permission($menu_id, 'add_flag') && check_user_permission($menu_id, 'edit_flag')){
                                ?>
                                    <button type="button" id="save_all_btn" class="btn btn-yellow" onclick="saveMenuPermission('all', 'all')">
                                        <i class="fa fa-save"></i>&nbsp; Save All &nbsp;<i class="fa fa-spinner fa-spin button-all" style="font-size:24px; display: none"></i>
                                    </button>
                                <?php
                                    }
                                ?>
                                </td>
                            </tr>
                            <?php
                                if($menues){
                                    foreach($menues as $menu){
                                        ?>
                                        <tr class="menu-tree <?= $menu['parent_id'] ==0?'parent-info':''?>" data-id="<?= $menu['menu_id'] ?>">
                                            <td class="cell"><?= $menu['menu_name'] ?></td>
                                            <td class="cell"><?= $menu['menu_type'] ?></td>
                                            <?php
                                                if($menu['parent_id'] >0){
                                            ?>
                                                <td class="cell">
                                                    <input type="checkbox" id="add_<?=$menu['menu_id']?>" name="add_<?=$menu['menu_id']?>" value="1" onchange="not_selected(this, 'cls_add', 'select_all_add')" class="checkBoxClass cls_add">
                                                    <label for="add_<?=$menu['menu_id']?>">Yes</label>
                                                </td>
                                                <td class="cell">
                                                    <input type="checkbox" id="edit_<?=$menu['menu_id']?>" name="edit_<?=$menu['menu_id']?>" value="1" onchange="not_selected(this, 'cls_edit', 'select_all_edit')" class="checkBoxClassEdit cls_edit">
                                                    <label for="edit_<?=$menu['menu_id']?>">Yes</label>
                                                </td>                                                
                                                <td class="cell">
                                                    <input type="checkbox" id="delete_<?=$menu['menu_id']?>" name="delete_<?=$menu['menu_id']?>" value="1" onchange="not_selected(this, 'cls_delete', 'select_all_delete')" class="checkBoxClassDelete cls_delete">
                                                    <label for="delete_0">Yes</label>
                                                </td>
                                                <td class="cell">
                                                    <input type="checkbox" id="print_<?=$menu['menu_id']?>" name="print_<?=$menu['menu_id']?>" value="1" onchange="not_selected(this, 'cls_print', 'select_all_print')" class="checkBoxClassPrint cls_print">
                                                    <label for="print_0">Yes</label>
                                                </td>
                                                <td class="cell">
                                                <?php
                                                    if(check_user_permission($menu_id, 'add_flag') && check_user_permission($menu_id, 'edit_flag')){
                                                ?>
                                                    <button type="button" class="btn btn-green" onclick="saveMenuPermission(<?=$menu['menu_id']?>, '<?= $menu['menu_name'] ?>')" data-id="<?=$menu['menu_id']?>">
                                                        <i class="fa fa-save"></i>&nbsp; Save &nbsp;<i class="fa fa-spinner fa-spin button-<?=$menu['menu_id']?>" style="font-size:24px; display: none"></i>
                                                    </button>
                                                <?php
                                                    }
                                                ?>
                                                </td>
                                            <?php
                                                }else{
                                                    echo '<td class="cell" colspan="5"></td>';
                                                }
                                            ?>
                                        </tr>
                                        <?php
                                    }
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
                <!--//table-responsive-->
            </div>
            <!--//app-card-body-->
        </div>
    </div>
    <!--//container-fluid-->
</div>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    const menu_length = <?= count($menues); ?>;
    $(document).ready(function(){
        //
    })
    function updateMenuAction(state, action){
        if(state.checked){
            $('.'+action).prop('checked', true);
        }else{
            $('.'+action).prop('checked', false);
        }
    }

    function not_selected(state, action, parent){
        if(state.checked){
            if($('.'+action+':checked').length == menu_length){
                $('#'+parent).prop('checked', true);
            }
        }else{
            $('#'+parent).prop('checked', false);
        }
    }

    function saveMenuPermission(menu_id, menu_name){
        var permission_to_user = new Array();
        if(!isNaN(menu_id)){
            if($('#add_'+menu_id).prop('checked')){
                permission_to_user.push({'menu_id': menu_id, 'menu_name': menu_name, 'action': 'add', 'status': 1});
            }else{
                permission_to_user.push({'menu_id': menu_id, 'menu_name': menu_name, 'action': 'add', 'status': 0});
            }
            if($('#edit_'+menu_id).prop('checked')){
                permission_to_user.push({'menu_id': menu_id, 'menu_name': menu_name, 'action': 'edit', 'status': 1});
            }else{
                permission_to_user.push({'menu_id': menu_id, 'menu_name': menu_name, 'action': 'edit', 'status': 0});
            }
            if($('#delete_'+menu_id).prop('checked')){
                permission_to_user.push({'menu_id': menu_id, 'menu_name': menu_name, 'action': 'delete', 'status': 1});
            }else{
                permission_to_user.push({'menu_id': menu_id, 'menu_name': menu_name, 'action': 'delete', 'status': 0});
            }
            if($('#print_'+menu_id).prop('checked')){
                permission_to_user.push({'menu_id': menu_id, 'menu_name': menu_name, 'action': 'print', 'status': 1});
            }else{
                permission_to_user.push({'menu_id': menu_id, 'menu_name': menu_name, 'action': 'print', 'status': 0});
            }
        }
        if(isNaN(menu_id) && menu_id == 'all'){
            if($('#select_all_add').prop('checked')){
                permission_to_user.push({'menu_id': 0, 'menu_name': menu_name, 'action': 'add', 'status': 1});
            }else{
                permission_to_user.push({'menu_id': 0, 'menu_name': menu_name, 'action': 'add', 'status': 0});
            }
            if($('#select_all_edit').prop('checked')){
                permission_to_user.push({'menu_id': 0, 'menu_name': menu_name, 'action': 'edit', 'status': 1});
            }else{
                permission_to_user.push({'menu_id': 0, 'menu_name': menu_name, 'action': 'edit', 'status': 0});
            }
            if($('#select_all_delete').prop('checked')){
                permission_to_user.push({'menu_id': 0, 'menu_name': menu_name, 'action': 'delete', 'status': 1});
            }else{
                permission_to_user.push({'menu_id': 0, 'menu_name': menu_name, 'action': 'delete', 'status': 0});
            }
            if($('#select_all_print').prop('checked')){
                permission_to_user.push({'menu_id': 0, 'menu_name': menu_name, 'action': 'print', 'status': 1});
            }else{
                permission_to_user.push({'menu_id': 0, 'menu_name': menu_name, 'action': 'print', 'status': 0});
            }
        }
        if(permission_to_user.length <= 0){
            swal("Alert", "Please select permission and try to save", "warning");
            return false;
        }

        let user_role = $('#user_role').val();
        if(user_role.length <= 0){
            swal("Alert", "Please select user role and continue", "warning");
            return false;
        }

        $.ajax({
            type: 'POST',	
            url: "<?php echo base_url('admin/UserPermission/ajaxUserPermissionHandler'); ?>",
            data: {
                user_role: user_role,
                permission: permission_to_user,
				csrf_test_name: '<?php echo $this->csrf['hash']; ?>',
            },
            dataType: 'json',
            encode: true,
            async: false,
            beforeSend: function(){
                console.log('.button-'+menu_id);
                $('.button-'+menu_id).show();
            }
        })
        //ajax response
        .done(function(response){
            if(response.success){
                swal("Permission Saved", response.message, "success");
            }
            else{
                swal("Alert", response.message, "warning");
            }
            $('.button-'+menu_id).hide();
            return false;
        })
        .fail(function(data){
            // show the any errors
            console.log(data);
        });

    }

    function getRolePermission(role_id){
        $.ajax({
            type: 'GET',	
            url: "<?php echo base_url('admin/UserPermission/ajaxGetUserPermission'); ?>",
            data: {
                role_id: role_id,
				csrf_test_name: '<?php echo $this->csrf['hash']; ?>',
            },
            dataType: 'json',
            encode: true,
            async: false,
            beforeSend: function(){
                $('.user-role-spinner').show();
            }
        })
        //ajax response
        .done(function(response){
            if(response.success){
                $('.menu-tree input[type="checkbox"]').prop('checked', false);
                $('.menu-tree input[type="checkbox"]').prop('checked', false);
                if(response.data.length >0 ){
                    response.data.forEach((data, i)=> {
                        if(parseInt(data.menu_id) > 0){
                            if(data.add_flag == "1"){
                                $('#add_'+data.menu_id).prop('checked', true);
                            }
                            if(data.edit_flag == "1"){
                                $('#edit_'+data.menu_id).prop('checked', true);
                            }
                            if(data.delete_flag == "1"){
                                $('#delete_'+data.menu_id).prop('checked', true);
                            }
                            if(data.download_flag == "1"){
                                $('#print_'+data.menu_id).prop('checked', true);
                            }
                        }else{
                            if(data.add_flag == "1"){
                                $('#select_all_add').prop('checked', true);
                                $('.cls_add').prop('checked', true);
                            }
                            if(data.edit_flag == "1"){
                                $('#select_all_edit').prop('checked', true);
                                $('.cls_edit').prop('checked', true);
                            }
                            if(data.delete_flag == "1"){
                                $('#select_all_delete').prop('checked', true);
                                $('.cls_delete').prop('checked', true);
                            }
                            if(data.download_flag == "1"){
                                $('#select_all_print').prop('checked', true);
                                $('.cls_print').prop('checked', true);
                            }
                        }
                    })
                }
            }
            else{
                swal("Alert", response.message, "warning");
                return false;
            }
            $('.user-role-spinner').hide();
        })
        .fail(function(data){
            // show the any errors
            console.log(data);
        });
    }
</script>