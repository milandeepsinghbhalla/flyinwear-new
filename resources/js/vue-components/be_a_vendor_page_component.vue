<template>
    <div class="container-fluid" style="margin-top:7.5em;">
        <vendor-registration-info-component></vendor-registration-info-component>
        <login-to-continue-component v-show="user.id==-1"></login-to-continue-component>
        <vendor-registration-form-component ></vendor-registration-form-component>
    </div>
</template>

<script>
import vendor_registration_info_component from "./vendor_registration_info_component.vue";
import login_to_continue_component from "./login_to_continue_component.vue";
import vendor_registration_form_component from "./vendor_registration_form_component.vue";

export default{
    data: function(){
        return {
            user: {}
        }
    },
    created(){
        this.user = this.$current_user;
    },
    components:{
        'vendor-registration-info-component': vendor_registration_info_component,
        'login-to-continue-component': login_to_continue_component,
        'vendor-registration-form-component': vendor_registration_form_component
    }
}
</script>
