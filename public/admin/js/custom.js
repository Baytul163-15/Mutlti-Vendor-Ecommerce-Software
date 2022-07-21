$(document).ready(function(){

    // Call data table
    $('#sections').DataTable();
    $('#categorys').DataTable();
    $('#brands').DataTable();
    $('#products').DataTable();

    // For active color
    $(".nav-item").removeClass("active");
    $(".nav-link").removeClass("active");

    // Update Superadmin and Admin password.
    $("#current_password").keyup(function(){
        var current_password = $("#current_password").val();
        // alert(current_password);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'post',
            url:'/admin/check-current-password',
            data:{current_password:current_password},
            success:function(resp){ 
                // alert(resp);
                if (resp=="false") {
                    $("#check_password").html("<font color='red'>Current Password is Incorrect !!</font>");
                }else if(resp=="true"){
                    $("#check_password").html("<font color='green'>Current Password is Corrected !!</font>");
                }
            },
            error:function(){
                alert('Error');
            }
        });
    })

    //Update Admin Status for Admin/Superadmin/Vendor
    $(document).on("click",".updateAdminStatus", function(){
        // alert("Test");
        var status = $(this).children("i").attr("status"); 
        var admin_id = $(this).attr("admin_id");

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'post',
            url:'/admin/update-admin-status',
            data:{status:status,admin_id:admin_id},
            success:function(resp){
                // alert(resp);
                if (resp['status']==0) {
                    $("#admin-"+admin_id).html("<i style='font-size: 23px; color:gray;' class='fa-solid fa-circle' status='Active'></i>");
                }else if (resp['status']==1) {
                    $("#admin-"+admin_id).html("<i style='font-size: 23px; color:#5050B2;' class='fa-solid fa-circle-check' status='Inactive'></i>");
                }
            },
            error:function(){
                alert("Error"); 
            }
        })
    });

    //Update Status for Section
    $(document).on("click",".updateSectionStatus", function(){
        // alert("Test");
        var status = $(this).children("i").attr("status"); 
        var section_id = $(this).attr("section_id");

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'post',
            url:'/admin/update-section-status',
            data:{status:status,section_id:section_id},
            success:function(resp){
                // alert(resp);
                if (resp['status']==0) {
                    $("#section-"+section_id).html("<i style='font-size: 23px; color:gray;' class='fa-solid fa-circle' status='Active'></i>");
                }else if (resp['status']==1) {
                    $("#section-"+section_id).html("<i style='font-size: 23px; color:#5050B2;' class='fa-solid fa-circle-check' status='Inactive'></i>");
                }
            },
            error:function(){
                alert("Error"); 
            }
        })
    });

    // Confirm Delete Section (Simple alert)
    // $(".confirmDelete").click(function(){
    //     var title = $(this).attr("title");
    //     if(confirm("Are you sure to delete this "+title+"?")){
    //         return true;
    //     }else{
    //         return false;
    //     }
    // })

    // Confirm Delete Section (Sweet alert)
    $(".confirmDelete").click(function(){
        var module = $(this).attr('module');
        var moduleid = $(this).attr('moduleid');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                )
                window.location = "/admin/delete-"+module+"/"+moduleid;    
            }
        })
    })

    //Update Status for Category
    $(document).on("click",".updateCategoryStatus", function(){
        // alert("Test");
        var status = $(this).children("i").attr("status"); 
        var category_id = $(this).attr("category_id");

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'post',
            url:'/admin/update-category-status',
            data:{status:status,category_id:category_id},
            success:function(resp){
                // alert(resp);
                if (resp['status']==0) {
                    $("#category-"+category_id).html("<i style='font-size: 23px; color:gray;' class='fa-solid fa-circle' status='Active'></i>");
                }else if (resp['status']==1) {
                    $("#category-"+category_id).html("<i style='font-size: 23px; color:#5050B2;' class='fa-solid fa-circle-check' status='Inactive'></i>");
                }
            },
            error:function(){
                alert("Error"); 
            }
        })
    });

    //Append Category Lavel
    $("#section_id").change(function(){
        var section_id = $(this).val();
        // alert(section_id);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'get',
            url:'/admin/append-categories-level',
            data:{section_id:section_id},
            success:function(resp){
                // alert(resp);
                $("#appendCategoriesLeval").html(resp);
            },error:function(){
                alert("Error");
            }
        })
    });

    //Update Status for Brands
    $(document).on("click",".updateBrandStatus", function(){
        // alert("Test");
        var status = $(this).children("i").attr("status"); 
        var brand_id = $(this).attr("brand_id");

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'post',
            url:'/admin/update-brand-status',
            data:{status:status,brand_id:brand_id},
            success:function(resp){
                // alert(resp);
                if (resp['status']==0) {
                    $("#brand-"+brand_id).html("<i style='font-size: 23px; color:gray;' class='fa-solid fa-circle' status='Active'></i>");
                }else if (resp['status']==1) {
                    $("#brand-"+brand_id).html("<i style='font-size: 23px; color:#5050B2;' class='fa-solid fa-circle-check' status='Inactive'></i>");
                }
            },
            error:function(){
                alert("Error"); 
            }
        })
    });

    //Update Status for Product
    $(document).on("click",".updateProductStatus", function(){
        // alert("Test");
        var status = $(this).children("i").attr("status"); 
        var product_id = $(this).attr("product_id");

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'post',
            url:'/admin/update-product-status',
            data:{status:status,product_id:product_id},
            success:function(resp){
                // alert(resp);
                if (resp['status']==0) {
                    $("#product-"+product_id).html("<i style='font-size: 23px; color:gray;' class='fa-solid fa-circle' status='Active'></i>");
                }else if (resp['status']==1) {
                    $("#product-"+product_id).html("<i style='font-size: 23px; color:#5050B2;' class='fa-solid fa-circle-check' status='Inactive'></i>");
                }
            },
            error:function(){
                alert("Error"); 
            }
        })
    });

    // Product Attributes add/removed script
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = '<div><div style="height: 10px;"></div><input type="text" name="size[]" placeholder="Size" style="width:120px;" required/>&nbsp;<input type="text" name="price[]" placeholder="Price" style="width:120px;" required/>&nbsp;<input type="text" name="stock[]" placeholder="Stock" style="width:120px;" required/>&nbsp;<input type="text" name="sku[]" placeholder="SKU" style="width:120px;" required/>&nbsp;<a href="javascript:void(0);" class="remove_button">&nbsp;Remove</a></div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });

    //Update Product Attribute Status 
    $(document).on("click",".updateAttributeStatus", function(){
        // alert("Test");
        var status = $(this).children("i").attr("status"); 
        var attribute_id = $(this).attr("attribute_id");

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'post',
            url:'/admin/update-attribute-status',
            data:{status:status,attribute_id:attribute_id},
            success:function(resp){
                // alert(resp);
                if (resp['status']==0) {
                    $("#attribute-"+attribute_id).html("<i style='font-size: 15px; color: gray;' class='mdi mdi-checkbox-blank-circle' status='Active'></i>");
                }else if (resp['status']==1) {
                    $("#attribute-"+attribute_id).html("<i style='font-size: 15px; color: green;' class='mdi mdi-checkbox-blank-circle' status='Inactive'></i>");
                }
            },
            error:function(){
                alert("Error"); 
            }
        })
    });

    //Update Product Attribute Status 
    $(document).on("click",".updateImagesStatus", function(){
        // alert("Test");
        var status = $(this).children("i").attr("status"); 
        var images_id = $(this).attr("images_id");

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'post',
            url:'/admin/update-images-status',
            data:{status:status,images_id:images_id},
            success:function(resp){
                // alert(resp);
                if (resp['status']==0) {
                    $("#images-"+images_id).html("<i style='font-size: 15px; color: gray;' class='mdi mdi-checkbox-blank-circle' status='Active'></i>");
                }else if (resp['status']==1) {
                    $("#images-"+images_id).html("<i style='font-size: 15px; color: green;' class='mdi mdi-checkbox-blank-circle' status='Inactive'></i>");
                }
            },
            error:function(){
                alert("Error"); 
            }
        })
    });

    //Update Section Status
    //Update Status for Product
    $(document).on("click",".updateSliderStatus", function(){
        // alert("Test");
        var status = $(this).children("i").attr("status"); 
        var slider_id = $(this).attr("slider_id");

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'post',
            url:'/admin/update-slider-status',
            data:{status:status,slider_id:slider_id},
            success:function(resp){
                // alert(resp);
                if (resp['status']==0) {
                    $("#slider-"+slider_id).html("<i style='font-size: 23px; color:gray;' class='fa-solid fa-circle' status='Active'></i>");
                }else if (resp['status']==1) {
                    $("#slider-"+slider_id).html("<i style='font-size: 23px; color:#5050B2;' class='fa-solid fa-circle-check' status='Inactive'></i>");
                }
            },
            error:function(){
                alert("Error"); 
            }
        })
    });


});