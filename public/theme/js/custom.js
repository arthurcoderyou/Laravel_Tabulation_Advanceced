$(function() {
    "use strict";

    $(".preloader").fadeOut();
    // this is for close icon when navigation open in mobile view
    $(".nav-toggler").on('click', function() {
        $("#main-wrapper").toggleClass("show-sidebar");
        $(".nav-toggler i").toggleClass("ti-menu");
    });
    $(".search-box a, .search-box .app-search .srh-btn").on('click', function() {
        $(".app-search").toggle(200);
        $(".app-search input").focus();
    });

    // ============================================================== 
    // Resize all elements
    // ============================================================== 
    $("body, .page-wrapper").trigger("resize");
    $(".page-wrapper").delay(20).show();
    
    //****************************
    /* This is for the mini-sidebar if width is less then 1170*/
    //**************************** 
    var setsidebartype = function() {
        var width = (window.innerWidth > 0) ? window.innerWidth : this.screen.width;
        if (width < 1170) {
            $("#main-wrapper").attr("data-sidebartype", "mini-sidebar");
        } else {
            $("#main-wrapper").attr("data-sidebartype", "full");
        }
    };
    $(window).ready(setsidebartype);
    $(window).on("resize", setsidebartype);


    //  [ CONTEST TABLE ] for the update and add form 
        $('.update_form').hide();
        

        $('#add').on('click',function(){
            $('#add_form').slideDown();
        });

        var update_form_id

        $('.update_btn').on('click',function(){
            //hide all opened update form first
            $('.update_form').hide();

            var parent = $(this).parent().attr('id');
            update_form_id = "update_form_" + parent; 
            //alert(update_form_id);

            $('#'+update_form_id).fadeIn();
            $('#'+update_form_id).fadeIn("slow");
            $('#'+update_form_id).fadeIn(3000);

        });
        
        $('.hide_btn').on('click',function(){
            $('#'+update_form_id).fadeOut();
            $('#'+update_form_id).fadeOut("slow");
            $('#'+update_form_id).fadeOut(3000);
        });
    // end of [ CONTEST TABLE ] for the update and add form 

    

    // [ SUBCONTEST TABLE ] for the update and delete form
        $('.subcontests_tr').hide(); //hide all subcontests
        $('.sub_con_hide_btn_con').hide(); //hide the subcontest hide button
        $('.add_sub_con').hide();
        $('.add_form_con').hide();

        // [CONTESTANT TABLE HEADER]
        $('.con_header').hide();
        

        var sub_cons_tr;
        var sub_con_btn;
        var add_con;
        var add_form;
        var parent2;
        //show all subcontests
        $('.view_sub_cons').on('click',function(){
            $('.subcontests_tr').hide(); //show all subcontests
            $('.sub_con_hide_btn_con').hide(); //show the hide btn

            //hide all opened update form first
            $('.update_form').hide();

            $('.add_sub_con').hide();
            $('.add_form_con').hide();

            // [CONTESTANT TABLE HEADER]
            $('.con_header').hide();

            parent2 = $(this).parent().attr('id');
            sub_cons_tr = "subcontests_tr_" + parent2; 
            sub_con_btn = "sub_con_hide_btn_con_" + parent2;
            add_con = "add_sub_"  + parent2;
            
            //alert(update_form_id);

            $('.'+sub_cons_tr).fadeIn();
            $('.'+sub_cons_tr).fadeIn("slow");
            $('.'+sub_cons_tr).fadeIn(3000);

            $('#'+sub_con_btn).fadeIn();
            $('#'+sub_con_btn).fadeIn("slow");
            $('#'+sub_con_btn).fadeIn(3000);

            $('#'+add_con).fadeIn();
            $('#'+add_con).fadeIn("slow");
            $('#'+add_con).fadeIn(3000);


            //show CONTESTANT HEADER 
            var con_header_class_id = "con_header_" + parent2;
            $('.'+con_header_class_id).fadeIn();
            $('.'+con_header_class_id).fadeIn("slow");
            $('.'+con_header_class_id).fadeIn(3000);

        }); 


        //for the add form show
        $('.add_con_btn').on('click',function(){
            $('.add_form_con').hide();//hide other add forms

            add_form = "add_form_" + parent2;
            $('#'+add_form).fadeIn();
            $('#'+add_form).fadeIn("slow");
            $('#'+add_form).fadeIn(3000);
        });



        //hide all subcontests when hide btn is clicked
        $('.sub_con_hide_btn').on('click',function(){
            //$('.subcontests_tr').hide(); //hide all subcontests
            $('.subcontests_tr').fadeOut();
            $('.subcontests_tr').fadeOut("slow");
            $('.subcontests_tr').fadeOut(3000);


            //$('.sub_con_hide_btn_con').hide(); //hide the subcontest hide button
            $('.sub_con_hide_btn_con').fadeOut();
            $('.sub_con_hide_btn_con').fadeOut("slow");
            $('.sub_con_hide_btn_con').fadeOut(3000);
            
            //$('.subcon_upf').hide(); //hide the subcontest form
            $('.subcon_upf').fadeOut();
            $('.subcon_upf').fadeOut("slow");
            $('.subcon_upf').fadeOut(3000);


            //$('.add_sub_con').hide();
            $('.add_sub_con').fadeOut();
            $('.add_sub_con').fadeOut("slow");
            $('.add_sub_con').fadeOut(3000);

            //$('.add_form_con').hide();
            $('.add_form_con').fadeOut();
            $('.add_form_con').fadeOut("slow");
            $('.add_form_con').fadeOut(3000);

            //hide the header [ CONTESTANT TABLE ]
            $('.con_header').fadeOut();
            $('.con_header').fadeOut("slow");
            $('.con_header').fadeOut(3000);
        });


        //for the subcontest
            $('.subcon_upf').hide();

            $('.subcon_update_btn').on('click',function(){
                $('.subcon_upf').hide(); //hide all open forms

                var parent3 = $(this).parent().attr('id');
                $('.subcon_upf_'+parent2+'_'+parent3).show();

            });
        //end of for the SubContest
        
    // end of [ SUBCONTEST TABLE ] for the update and delete form


    //for the [ CONTESTANTS TABLE ]

    /**
     * we used the same jquery scripts for it
     */




    // [SubCriterias table]
        $('.add_form_subc').hide();
        $('.hide_subc').hide();

        $('.add_subc').on('click',function(){
            
            $('.add_form_subc').fadeIn();
            $('.add_form_subc').fadeIn("slow");
            $('.add_form_subc').fadeIn(3000);


            $('.hide_subc').fadeIn();
            $('.hide_subc').fadeIn("slow");
            $('.hide_subc').fadeIn(3000);

        });

        $('.hide_subc').on('click',function(){
            
            $('.add_form_subc').fadeOut();
            $('.add_form_subc').fadeOut("slow");
            $('.add_form_subc').fadeOut(3000);


            $('.hide_subc').fadeOut();
            $('.hide_subc').fadeOut("slow");
            $('.hide_subc').fadeOut(3000);

            $('.update_subc').fadeOut();
            $('.update_subc').fadeOut("slow");
            $('.update_subc').fadeOut(3000);

        });


         //hide update fomrs
        $('.update_subc').hide();

       
        $('.update_subc_btn').on('click',function(){
            $('.update_subc').hide(); //show all subcontests
            $('.hide_subc').show();
            

            var parent3 = $(this).parent().attr('id');
            sub_cons_tr = "update_subc_" + parent3; 
            
            //alert(update_form_id);

            $('.'+sub_cons_tr).fadeIn();
            $('.'+sub_cons_tr).fadeIn("slow");
            $('.'+sub_cons_tr).fadeIn(3000);

            /*
            $('#'+sub_con_btn).fadeIn();
            $('#'+sub_con_btn).fadeIn("slow");
            $('#'+sub_con_btn).fadeIn(3000);

            $('#'+add_con).fadeIn();
            $('#'+add_con).fadeIn("slow");
            $('#'+add_con).fadeIn(3000);


            //show CONTESTANT HEADER 
            var con_header_class_id = "con_header_" + parent2;
            $('.'+con_header_class_id).fadeIn();
            $('.'+con_header_class_id).fadeIn("slow");
            $('.'+con_header_class_id).fadeIn(3000);
            */
        }); 
        

    //end of [SubCriterias Table]



    // [Judgements Table ] --for the subcriteria
        $('.crt_form').hide();
        $('.crt_btn').on('click',function(){
            $('.crt_form').show();
        });


    //end of [Judgements Table ] --for the subcriteria
    
    /*
        //for the Profile Image Upload
        $('#image').change(function(e){
        
            var reader = new FileReader();
            reader.onload = function(e){
            $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
            
        });
    */

});