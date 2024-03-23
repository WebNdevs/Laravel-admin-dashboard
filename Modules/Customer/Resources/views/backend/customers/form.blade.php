<div class="row mb-3">
    <div class="col-12 col-sm-4">
        <label class="form-label" for="tags">Name</label> <span class="text-danger">*</span>
        <div class="form-group input-group">
            <?php
            $field_name = 'name';
            $field_lable = label_case($field_name);
            $field_placeholder = $field_lable;
            $required = "required";
            ?>
           
            <span class="input-group-text" id="basic-addon-name"><i class="fa fa-user"></i></span>
            {{ html()->text($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"]) }}
        </div>
    </div>
    <div class="col-12 col-sm-4">
        <label class="form-label" for="tags">Email</label> <span class="text-danger">*</span>
        <div class="form-group input-group">
            <?php
            $field_name = 'email';
            $field_lable = label_case($field_name);
            $field_placeholder = $field_lable;
            $required = "required";
            ?>
            <span class="input-group-text" id="basic-addon-name"><i class="fa fa-envelope"></i></span>
            
            {{ html()->email($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"]) }}
        </div>
    </div>
    <div class="col-12 col-sm-4">
        <label class="form-label" for="tags">Phone Number</label> <span class="text-danger">*</span>
        <div class="form-group input-group">
            <?php
            $field_name = 'contact';
            $field_lable = label_case($field_name);
            $field_placeholder = $field_lable;
            $required = "";
            ?>
             <span class="input-group-text" id="basic-addon-name"><i class="fa-solid fa-address-card"></i></span>
            
            {{ html()->text($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"]) }}
        </div>
    </div>
    <div class="col-12 col-sm-4 mt-4">
        <label class="form-label" for="tags">Group</label> <span class="text-danger">*</span>
        <div class="form-group input-group">
            <?php
            $field_name = 'group';
            $field_label = label_case($field_name);
            $field_placeholder = $field_label;
            $required = "";
            $groups = groups();
            $select_options = [];
            foreach($groups as $group){
                $select_options[$group['id']]= $group['name'];
            }
            ?>
            <span class="input-group-text" id="basic-addon-name"><i class="fa-solid fa-address-card"></i></span>
    
            {{ html()->select($field_name, $select_options)->placeholder($field_placeholder)->class('form-control select2')->attributes(["$required"]) }}
        </div>
    </div>
    
    <div class="col-12 col-sm-4 mt-4">
        <label class="form-label" for="tags">Status</label> <span class="text-danger">*</span>
        <div class="form-group input-group">
            <?php
            $field_name = 'status';
            $field_lable = label_case($field_name);
            $field_placeholder = "-- Select an option --";
            $required = "required";
            $select_options = [
                '1'=>'Published',
                '0'=>'Unpublished',
                '2'=>'Draft'
            ];
            ?>
            <span class="input-group-text" id="basic-addon-name"><i class="fa-solid fa-circle-info"></i></span>
            
            {{-- {{ html()->label($field_lable, $field_name)->class('form-label') }} {!! fielf_required($required) !!} --}}
            {{ html()->select($field_name, $select_options)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"]) }}
        </div>
    </div>
</div>

<?php
    function groups(){

    $module_name = "group";
    $module_model = "Modules\Group\Models\Group";
    $groups = $module_model::all()->toArray();
    return $groups;
    }

?>

{{-- <link rel="stylesheet" href="https://res.cloudinary.com/dxfq3iotg/raw/upload/v1569006288/BBBootstrap/choices.min.css?version=7.0.0">
<script src="https://res.cloudinary.com/dxfq3iotg/raw/upload/v1569006273/BBBootstrap/choices.min.js?version=7.0.0"></script> --}}
